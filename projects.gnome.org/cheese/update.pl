#!/usr/bin/perl -w

# Copyright © 2009 Filippo Argiolas <fargiolas@gnome.org>
# Copyright © 2009 daniel g. siegel <dgsiegel@gnome.org>
#
# Licensed under the GNU General Public License Version 2
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

# Little script that updates download page in Cheese website
# retrieving data from ftp.gnome.org and mail.gnome.org.
# Just run it in the main website directory and commit the changes.
# Use at your own risk!

use strict;

use Date::Format;
use File::Basename;
use JSON;
use LWP::Simple;
use Net::FTP; # Must use FTP in order to get the modification time.

# directory where the include files lurk around
my $includes_dir = "includes/";
# maximum stable packages to list
my $max_stables = 7;
# maximum unstable packages to list
my $max_unstables = 5;
# maximum news items
my $max_news = 7;
# other useful vars, probably not enough if you want to use the script
# elsewhere, feel free to readapt to your needs, fwiw
my $ftpserver = "ftp.gnome.org";
my $gnomeurl = "http://download.gnome.org/";
my $sources = "sources/";
my $projectname = "cheese";
my $ftpdir = "pub/GNOME/$sources$projectname/";
my $downloaddir = "$gnomeurl$sources$projectname/";
my $cachename = "cache.json";

print "Fetching JSON cache from server\n";
my $gnomeftp = Net::FTP->new($ftpserver, Debug => 0)
    or die "Cannot connect to $ftpserver: $@";

$gnomeftp->login
    or die "Cannot login ", $gnomeftp->message;

$gnomeftp->cwd($ftpdir)
    or die "Cannot set working directory ", $gnomeftp->message;

my $jsoncache = $gnomeftp->get("$cachename")
    or die "Cannot download JSON cache ", $gnomeftp->message;

my $json = JSON->new;
open(CACHE, $jsoncache);
my $jsondecoded = $json->decode(<CACHE>);
close(CACHE);
unlink $jsoncache;

# Hash of all releases.
my %packages;

print "Parsing JSON cache, checking release dates and fetching checksums\n";

foreach my $tarballversion(@{@{$jsondecoded}[2]->{"$projectname"}}) {
    # Build the tarball version to use as the key in the hash table.
    my $tarball = @{$jsondecoded}[1]->{"$projectname"}->{"$tarballversion"};

    # Filename, including the leading version-specific directory.
    my $filename;
    # Prefer xz over bz2 over gz.
    for my $compression ("tar.xz", "tar.bz2", "tar.gz") {
        if (exists $tarball->{"$compression"}) {
            $filename = $tarball->{"$compression"};
            last;
        }
    }

    # Prefer sha256sum over md5sum.
    my $sumfile;
    for my $sumtype ("sha256sum", "md5sum") {
        if (exists $tarball->{"$sumtype"}) {
            $sumfile = $tarball->{"$sumtype"};
            last;
        }
    }

    my $sumfilename = $gnomeftp->get("$sumfile")
        or die "Cannot download sumfile $sumfile ", $gnomeftp->message;

    open (SUM, "<$sumfilename");
    my $tarballbasename = basename($filename);
    my $sum = "";
    while (<SUM>) {
        m/^(\w+)\s+$tarballbasename/ and $sum = $1;
    }
    close (SUM);
    unlink $sumfilename;
    if ($sum eq "") { print "** WARNING: no hash found for $filename\n"; }

    $packages{$tarballversion}{"sum"} = $sum;

    # Prefer ChangeLog over NEWS.
    for my $changestype ("changes", "news") {
        if (exists $tarball->{"$changestype"}) {
            $packages{$tarballversion}{"news"} = $tarball->{"$changestype"};
            last;
        }
    }

    # Check the modification time, as it is not in the JSON cache.
    my $mdtm = $gnomeftp->mdtm($filename)
        or die "Cannot retrieve mtime ", $gnomeftp->message;

    $packages{$tarballversion}{"filename"} = $filename;
    $packages{$tarballversion}{"url"} = "$downloaddir$filename";
    $packages{$tarballversion}{"epoch"} = $mdtm - 3600;
    $packages{$tarballversion}{"mdtm"} = time2str ("%B %o %Y", $mdtm, "GMT");
}

$gnomeftp->quit;

# Sort by mtime.
my @sorted_keys =
    sort { $packages{$b}{"epoch"} <=> $packages{$a}{"epoch"} } keys %packages;

# Delete the includes before appending to them.
foreach my $includefiles ("stable.shtml", "stable_archive.shtml", "unstable.shtml",
    "unstable_archive.shtml") {
    unlink ("$includes_dir/$includefiles");
}

my $includefile = FileHandle->new;

# Create download page includes.
for (@sorted_keys) {
    print "release: $_\n";
    print "  news: " . $packages{$_}{"news"} . "\n"
        if exists $packages{$_}{"news"};
    print "  filename: " . $packages{$_}{"filename"} . "\n";
    print "  hash: " . $packages{$_}{"sum"} . "\n";
    print "  epoch: " . $packages{$_}{"epoch"} . "\n";
    print "  release date: " . $packages{$_}{"mdtm"} . "\n";

    # GNOME release cycle: minor odd number is unstable, except the 0.x releases
    my @components = split(/\./, $_);
    my $major = $components[0];
    my $minor = $components[1];
    if ($minor % 2 && $major != 0) {
        $packages{$_}{"stable"} = 0;
        if ($max_unstables > 0) {
            $max_unstables--;
            $includefile->open(">>${includes_dir}unstable.shtml");
        } else { $includefile->open(">>${includes_dir}unstable_archive.shtml"); }
    } else {
        $packages{$_}{"stable"} = 1;
        if ($max_stables > 0) {
            $max_stables--;
            $includefile->open(">>${includes_dir}stable.shtml");
        } else { $includefile->open(">>${includes_dir}stable_archive.shtml"); }
    }

    my $hashtype = "md5sum";
    if (length($packages{$_}{"sum"}) > 32) {
      $hashtype = "sha256";
    }
    my $htmlsnippet = <<EOF;
<div class="download">
  <a href="$packages{$_}{"url"}"
     title="Download $_ tarball">
    <img src="data/images/package-x-generic.png" alt="source package" />
      Cheese $_
  </a>
  <p>
    released on $packages{$_}{"mdtm"} <br />
    $hashtype: $packages{$_}{"sum"}
  </p>
</div>

EOF

    $includefile->print($htmlsnippet);
}

# Fetch release announcements from gnome-announce-list.
# WARNING: poor error checking, check results before commit

print "\nRetrieving release announcements from mail.gnome.org\n";

open (NEWS, ">${includes_dir}news.shtml");
print NEWS "          <h2>News</h2>\n";

for (@sorted_keys) {
    my $release = $_;
    my $date = time2str ("%Y-%B", $packages{$release}{"epoch"}, "GMT");
    print "release: $release\n";
    my $stable = $packages{$release}{"stable"} ? "Stable" : "Unstable";
    print "  retrieving $date archive\n";
    my $thread = get("http://mail.gnome.org/archives/gnome-announce-list/$date/thread.html");
    die "  Could not get $date thread!" unless defined $thread;
    my @lines = split (/\n/, $thread);
    for (@lines) {
        m/href=\"(\w+\.html)\">.*$projectname.*$release.*<\/a>/i and do {
            print "  found release message $1\n";
            print NEWS <<EOF;

          <h3>$packages{$release}{"mdtm"}</h3>
          <p>
          <b>$stable</b>
          version $release was released!<br/>
          </p>
          <a href="download">Download it</a>
          <a href="http://mail.gnome.org/archives/gnome-announce-list/$date/$1">Release Notes</a>.
EOF
            $max_news--;
            last;
        };
    }
    last if ($max_news <= 0);
}

close (NEWS);
