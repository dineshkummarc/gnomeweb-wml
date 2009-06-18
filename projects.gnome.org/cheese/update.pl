#!/usr/bin/perl -w

# Copyright © 2009 Filippo Argiolas <fargiolas@gnome.org
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
# retrieving data from GNOME Ftp.
# Just run it in the main website directory and commit the changes.
# Use at your own risk!

use Net::FTP;
use Date::Format;

# maximum stable packages to list
my $max_stables = 7;
# maximum unstable packages to list
my $max_unstables = 5;
# other useful vars, probably not enough if you want to use the script
# elsewhere, feel free to readapt to your needs, fwiw
my $gnomeurl = "ftp.gnome.org";
my $directory = "pub/GNOME/sources/cheese/";

my $gnomeftp = Net::FTP->new($gnomeurl, Debug => 0)
    or die "Cannot connect to some.host.name: $@";

$gnomeftp->login("anonymous",'-anonymous@')
    or die "Cannot login ", $ftp->message;

$gnomeftp->cwd($directory)
    or die "Cannot set working directory ", $ftp->message;

my @maindir = $gnomeftp->ls()
    or die "Cannot list directory ", $ftp->message;


my %packages;

print "-- Retrieving packages informations from ftp.gnome.org\n";

for (@maindir) {
    @dir = $gnomeftp->ls("$_");
    for (@dir) {
        $current_file = $_;
        m/^(.*)\.(.*)\/(.*)\.tar\.gz/g or next;
        $filename = "$3.tar.gz";
        $packages{$filename}{"news"} = "$3\.changes";
        $packages{$filename}{"url"} =
            "http://ftp.gnome.org/pub/GNOME/sources/cheese/$current_file";
        $packages{$filename}{"major"} = $1;
        $packages{$filename}{"minor"} = $2;
        print "++ $filename\n";
        $sumfile = $gnomeftp->get("$1.$2/$3.md5sum");
        open (SUM, "<$sumfile");
        my $sum = "";
        while (<SUM>) {
            m/^(\w+)\s+$filename/ and $sum = $1;
        }
        close (SUM);
        unlink $sumfile;
        if ($sum eq "") { print "** WARNING: no hash found for $filename\n"; }
        $packages{$filename}{"sum"} = $sum;
        $mdtm = $gnomeftp->mdtm($current_file)
            or die "Cannot retrieve mtime ", $ftp->message;
        $packages{$filename}{"epoch"} = $mdtm;
        $packages{$filename}{"mdtm"} = time2str ("%B %o %Y", $mdtm);
        if ($filename =~ m/.*-(\d+\.\d+.\d+)(\.[\d\.]+)?\.tar\.gz/) {
            $packages{$filename}{"release"} = "$1" . ($2 or "");
        }
    }
}

$gnomeftp->quit;
print "QUIT\n";

# sort by mtime
my @sorted_keys =
    sort { $packages{$b}{"epoch"} <=> $packages{$a}{"epoch"} } keys %packages;

open (STABLE, ">stable.shtml");
open (UNSTABLE, ">unstable.shtml");
open (STABLE_ARCHIVE, ">stable_archive.shtml");
open (UNSTABLE_ARCHIVE, ">unstable_archive.shtml");

$i = 0;
$j = 0;

for (@sorted_keys) {
    print "==========================\n";
    print "filename: $_\n";
    print "news: " . $packages{$_}{"news"} . "\n";
    print "release: " . $packages{$_}{"release"} . "\n";
    print "md5sum: " . $packages{$_}{"sum"} . "\n";
    print "epoch: " . $packages{$_}{"epoch"} . "\n";
    print "release date: " . $packages{$_}{"mdtm"} . "\n";
    if ($packages{$_}{"minor"} % 2) {
        if ($i < $max_unstables) {
            $i++;
            $fh = UNSTABLE;
        } else { $fh = UNSTABLE_ARCHIVE; }
    } else {
        if ($j < $max_stables) {
            $j++;
            $fh = STABLE;
        } else { $fh = STABLE_ARCHIVE; }
    }
    print $fh <<EOF;
<div class="download">
  <a href="$packages{$_}{"url"}"
     title="Download $packages{$_}{"release"} tarball">
    <img src="data/images/package-x-generic.png" alt="source package" />
      Cheese $packages{$_}{"release"}
  </a>
  <p>
    released on $packages{$_}{"mdtm"} <br />
    md5sum: $packages{$_}{"sum"}
  </p>
</div>

EOF
}

close (STABLE);
close (UNSTABLE);
close (STABLE_ARCHIVE);
close (UNSTABLE_ARCHIVE);
