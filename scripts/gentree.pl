#!/usr/bin/perl

sub get_title;

scalar @ARGV >= 2 || die("Not enough args - need cururl and topdir");

$topdir = $ARGV[0];
$cururl = $ARGV[1];

sub get_title {
  my($fn) = @_;

  open(FH, $fn) || return "";

  my($aline, $tmatch, $retval);
  $retval = "";
  $aline = join("", <FH>);
  close(FH);
  if($aline =~ /<document[^>]*\stitle=\"([^\"]*)\"[^>]*>/si) {
    $retval = $1;
  }

  return $retval;
}

$fn = $topdir."/".$cururl;


%sections = ("start"=>"Download", "news"=>"News", "help"=>"Help", "devel"=>"Development");

foreach $asection (@sections) {
  
}

printf "Title of %s is %s\n", $fn, get_title($fn);
