#!/usr/bin/perl -w

use Net::FTP;
use Date::Format;

my $max_stables = 7;
my $max_unstables = 5;
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
        m/^(.*)\.(.*)\/(.*)\.tar\.gz/g or next;
        $filename = "$3.tar.gz";
        $packages{$filename}{"news"} = "$3\.changes";
        $packages{$filename}{"url"} =
            "http://ftp.gnome.org/pub/GNOME/sources/cheese/$_";
        $packages{$filename}{"major"} = $1;
        $packages{$filename}{"minor"} = $2;
        print "++ $filename\n";
        $sumfile = $gnomeftp->get("$1.$2/$3.md5sum");
        open (SUM, "<$sumfile");
        $sum = <SUM>;
        $sum =~ s/^(\w+)\s.*$/$1/;
        chomp ($sum);
        close (SUM);
        unlink $sumfile;
        $packages{$filename}{"sum"} = $sum;
        $mdtm = $gnomeftp->mdtm($_)
            or die "Cannot retrieve mtime ", $ftp->message;
        $packages{$filename}{"epoch"} = $mdtm;
        $packages{$filename}{"mdtm"} = time2str ("%B %o %Y", $mdtm);
        if ($filename =~ m/.*-(\d+\.\d+.\d+)(\.[\d\.]+)?\.tar\.gz/) {
            $packages{$filename}{"release"} = "$1" . ($2 or "");
        }
    }
}

$gnomeftp->quit;

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
  <a href="http://ftp.gnome.org/pub/GNOME/sources/cheese/$packages{$_}{"url"}"
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
