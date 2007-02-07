#!/usr/bin/perl

use strict;
use warnings;
use Cwd;

my $dir = getcwd;
opendir(DIRHANDLE, $dir);

my @files_names = readdir(DIRHANDLE);

@files_names = sort(@files_names);

foreach (@files_names) {
 
	next if (substr($_,0,1) eq '.');
	if( $_ =~ m/\w+.png/ ) {
		print "\t$_ \\\n";
	}
	
}
closedir(DIRHANDLE);
