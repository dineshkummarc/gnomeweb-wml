#!/usr/bin/perl

scalar @ARGV == 2 || die("Incorrect arg count");

open(IF, $ARGV[0]) || die("Couldn't open ".$ARGV[0]." for reading");

$fn = $ARGV[1]."/special-header.html";
open(OF, ">".$fn) || die("Couldn't open $fn for writing");

while(1) {
  $aline = <IF>;
  if($aline =~ /!!BODY!!/) {
    last;
  }
  print OF $aline;
}
close(OF);

$fn = $ARGV[1]."/special-footer.html";
open(OF, ">".$fn) || die("Couldn't open $fn for writing");

while($aline = <IF>) {
  print OF $aline;
}

close(OF);
close(IF);
