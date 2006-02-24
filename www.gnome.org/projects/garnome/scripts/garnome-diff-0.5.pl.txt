#!/usr/bin/perl -W

#    garnome-diff.pl version 0.5
#
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation; either version 2 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    See http://www.gnu.org/licenses/gpl.txt for a copy of the license
#
#    Author:    Aschwin van der Woude <aschwin.van.der.woude@linux-aktivaattori.org>
#    Copyright: Jan 2003, Aschwin van der Woude
#

# Changes 0.5
#   * Automatically detects categories, no need to specify them any more
#   * Will now list to what meta-category the package belongs

use strict;


### Config ###

# The listed directories in the top of a garnome package 
# won't be scanned for comparison
my @ignore_dirs = ("meta");

# File the results of the analysis will be written to
my $analysis_report_file = "garnome-changelog.txt";

# The header placed on top of the report
my $report_header = "*** Garnome Changelog ***\n";


### Globals ###

my %garnome_versions;
my @categories;
my %meta_packages;

# results of the analysis
my %packages_removed;
my %packages_added;
my %packages_upgraded;
my %packages_downgraded;


### Functions ###

sub show_help() {
	print "Usage:\n";
	print "\t" . $0 . " <old_dir> <new_dir>\n";
	print "\n";
	print "\told_dir =  directory with old garnome version\n";
	print "\tnew_dir =  directory with new garnome version\n";
}

sub sanity_check_dirs($$) {
	my $dir;

	# Some sanity checking on the input
	foreach $dir (@_) {
		if (! -d $dir) {
			print "Sorry '$dir' is not a directory\n";
			exit(1);
		}
		if (! -r $dir) {
			print "Sorry directory '$dir' is not readable\n";
			exit(1);
		}
		if (! -e "$dir/gar.mk") {
			print "Sorry directory '$dir' is not a Garnome directory\n";
			exit(1);
		}
	}
	
	if ($_[0] eq $_[1]) {
			print "Please don't gimme the same directories\n";
			exit(1);
	}
}

sub determine_categories(@) {
	my $category;
	my @raw_categories;
	my $dir;
	my $ignore_dir;
	my $ignore = "no";
	my $category_ignore;
	
	foreach $dir (@_) {
		opendir DIR, $dir;
		push @raw_categories, readdir DIR;
		closedir DIR;
	}
	foreach $category (@raw_categories) {
		if ($category eq '.' or $category eq '..') {
			next;
		}
		$ignore = "no";
		foreach $dir (@_) {
			if (-e $dir . "/" . $category and ! -d $dir . "/" . $category) {
				$ignore = "yes";
				last;
			}
		}
		if ($ignore eq "yes") {
			next;
		}

		$ignore = "no";
		foreach $ignore_dir (@ignore_dirs) {
			if ($category eq $ignore_dir) {
				$ignore = "yes";
				last;
			}
		}
		if ($ignore eq "yes") {
			next;
		}

		$ignore = "no";
		foreach $category_ignore (@categories) {
			if ($category eq $category_ignore) {
				$ignore = "yes";
				last;
			}
		}
		if ($ignore eq "yes") {
			next;
		}
		push @categories, $category;
	}
}

# Explicit declaration to avoid a warning, 
# needed because it is a recursive function
sub create_meta_package_list($$@);

sub create_meta_package_list($$@) {
	my $dir = shift;
	my $meta_name = shift;
	my @deps = @_;
	my $dep;
	my $makefile;
	my @package_deps;
	my $line;

	foreach $dep (@deps) {
#		print $meta_name . ": " . $dep . "\n";
		if (exists $meta_packages{$dep}) {
			next;
		}
		$meta_packages{$dep} = $meta_name;
		$makefile = $dir . "/" . $dep . "/Makefile";
		if (-e $makefile) {
			open FILE, $makefile;
			foreach $line (<FILE>) {
				if ($line =~ /^LIBDEPS.*=(.*)/) {
					@package_deps = split / /, $1;
					create_meta_package_list($dir, $meta_name, @package_deps);
				}
			}
			
		}
	}
}

sub retrieve_meta_package_list(@){
	my @meta_dirs;
	my $dir;
	my $meta_dir;
	my $line;
	my @deps;
	
	foreach $dir (@_) {
		opendir DIR, $dir . "/meta";
		@meta_dirs = readdir DIR;
		closedir DIR;
		foreach $meta_dir (@meta_dirs) {
			if (-e $dir . "/meta/" . $meta_dir . "/Makefile") {
				open FILE, $dir . "/meta/" . $meta_dir . "/Makefile";
				foreach $line (<FILE>) {
					if ($line =~ /^LIBDEPS.*=(.*)/) {
						@deps = split / /, $1;
						create_meta_package_list($dir, $meta_dir, @deps);
					}
				}
				close FILE;
			}
		}
	}
#	exit;
}

sub get_package_meta_category($$) {
	my $category = shift;
	my $package = shift;
	
	if (exists $meta_packages{$category . "/" . $package}) {
		return $meta_packages{$category . "/" . $package};
	} else {
		return "";
	}
}

sub retrieve_package_version($$$) {
	my $dir = shift;
	my $category = shift;
	my $package = shift;
	my $package_version;
	my $line;
	
	open FILE, $dir . "/" . $category . "/" . $package . "/Makefile";
	foreach $line (<FILE>) {
		if ($line =~ /^GARVERSION.*=\s*(.*)\s*/) {
			$package_version = $1;
			return $package_version;
		}
	}
	close FILE;
	return "";
}

sub retrieve_garnome_information($$) {
	my $version = shift;
	my $dir = shift;
	my $category = "";
	my $package_list;
	my $direntry = "";

	foreach $category (@categories) {
		undef $package_list;
		$direntry = "";
		opendir DIR, $dir . "/" . $category;
		while (defined $direntry) {
			$direntry = readdir DIR;
			if (defined $direntry && -d $dir . "/" . $category . "/" . $direntry) {
				if ($direntry ne '.' && $direntry ne '..') {
					$package_list->{$direntry} = retrieve_package_version($dir, $category, $direntry);
				}
			}
		} 
		closedir DIR;
		$garnome_versions{$version}->{$category} = $package_list;
	}
}

sub removal_analysis() {
	my $category = "";
	my $package;

	foreach $category (keys %{$garnome_versions{'old_version'}}) {
		foreach $package (keys %{$garnome_versions{'old_version'}->{$category}}) {
			if (! package_present('new_version', $category, $package)) {
				push @{$packages_removed{$category}}, $package;
				print "Package '$category/$package' has been removed\n";
			}
		}
	}
}

sub addition_analysis() {
	my $category = "";
	my $package;
	my $package_version;

	foreach $category (keys %{$garnome_versions{'new_version'}}) {
		foreach $package (keys %{$garnome_versions{'new_version'}->{$category}}) {
			if (! package_present('old_version', $category, $package)) {
				$package_version = package_version('new_version', $category, $package);
				$packages_added{$category}->{$package} = $package_version;
				print "Package '$category/$package' (version $package_version) has been added\n";
			}
		}
	}
}

sub package_update_analysis() {
	my $category = "";
	my $package;
	my $package_version_old;
	my $package_version_new;
	my $upgrade = 0;

	foreach $category (keys %{$garnome_versions{'new_version'}}) {
		foreach $package (keys %{$garnome_versions{'new_version'}->{$category}}) {
			if (package_present('old_version', $category, $package)) {
				$package_version_old = package_version('old_version', $category, $package);
				$package_version_new = package_version('new_version', $category, $package);
#				if ($package_version_old ne $package_version_new) {
				$upgrade = package_version_upgraded($package_version_old, $package_version_new);
				if ($upgrade > 0) {
					$packages_upgraded{$category}->{$package} = $package_version_new;
					print "Package '$category/$package' upgraded to version '$package_version_new'\n";
				} elsif ($upgrade < 0) {
					$packages_downgraded{$category}->{$package} = $package_version_new;
					print "Package '$category/$package' downgraded to version '$package_version_new'\n";
				}
			}
		}
	}
}

sub package_version_upgraded($$) {
	# Return 1 if it is an upgrade
	# Return 0 when the version hasn't changed
	# Return -1 when it is a downgrade
	my $old_version = shift;
	my $new_version = shift;
	my @old_version_split;
	my @new_version_split;
	my $i;
	
	if ($old_version eq $new_version) {
		return 0;
	}
	if ($old_version !~ /^[0-9.]+$/ || $new_version !~ /^[0-9.]+$/) {
		# Version contains characters, no way to know how to interpret them
		if ($old_version ne $new_version) {
			return 1;
		}
		return 0;
	}
	@old_version_split = split /\./, $old_version;
	@new_version_split = split /\./, $new_version;
	for ($i = 0; $i <= $#old_version_split ;$i++) {
		if (! defined $new_version_split[$i] || ! defined $old_version_split[$i]) {
			return 1; # Not sure if it up or downgraded
		}
		if ($old_version_split[$i] < $new_version_split[$i]) {
			return 1;
		} elsif ($old_version_split[$i] > $new_version_split[$i]) {
			return -1;
		}
	}
	return 0;
}

sub package_present($$$) {
	my $version = shift;
	my $category = shift;
	my $package = shift;

	if (exists $garnome_versions{$version}->{$category}->{$package}) {
		return 1;
	}
	return 0;
}

sub package_version($$$) {
	my $version = shift;
	my $category = shift;
	my $package = shift;
	
	return $garnome_versions{$version}->{$category}->{$package};
}

sub print_package_hierarchy() {
	# Debugging function
	my $version = "";
	my $category = "";
	my $package = "";

	foreach $version (keys %garnome_versions) {
		print "version '$version':\n";
		foreach $category (keys %{$garnome_versions{$version}}) {
			print "\tInteresting dir '$category':\n";
			foreach $package (@{$garnome_versions{$version}->{$category}}) {
				print "\t\t$package\n";
			}
		}
	}
}

sub produce_package_removal_report() {
	my $category = "";
	my $package = "";
	my $FILE;
	my $meta_category;

	if (scalar keys %packages_removed <= 0 ) {
		return; # No need to print anything, there were no packages removed
	}
	open $FILE, ">>" . $analysis_report_file;
	print $FILE "\nThe following packages have been removed:";
	foreach $category (sort keys %packages_removed) {
		print $FILE "\n\t Category '" . $category . "':\n";
		foreach $package (@{$packages_removed{$category}}) {
			$meta_category = get_package_meta_category($category, $package);
			print_pretty_item($FILE, $package, "", $meta_category);
		}
	}
	close FILE;
}

sub produce_package_addition_report() {
	my $category = "";
	my $package = "";
	my $test;
	my $FILE;
	my $meta_category;

	if (scalar keys %packages_added <= 0 ) {
		return; # No need to print anything, there were no packages added
	}
	open $FILE, ">>" . $analysis_report_file;
	print $FILE "\nThe following packages have been added:";
	foreach $category (sort keys %packages_added) {
		print $FILE "\n\t Category '" . $category . "':\n";
		foreach $package (sort keys %{$packages_added{$category}}) {
			$meta_category = get_package_meta_category($category, $package);
			print_pretty_item($FILE, $package, $packages_added{$category}->{$package}, $meta_category);
		}
	}
	close $FILE;
}

sub produce_package_upgrade_report() {
	my $category = "";
	my $package = "";
	my $test;
	my $FILE;
	my $meta_category;

	if (scalar keys %packages_upgraded <= 0 ) {
		return; # No need to print anything, there were no updated packages
	}
	open $FILE, ">>" . $analysis_report_file;
	print $FILE "\nThe following packages have been upgraded:";
	foreach $category (sort keys %packages_upgraded) {
		print $FILE "\n\t Category '" . $category . "':\n";
		foreach $package (sort keys %{$packages_upgraded{$category}}) {
			$meta_category = get_package_meta_category($category, $package);
			print_pretty_item($FILE, $package, $packages_upgraded{$category}->{$package}, $meta_category);
		}
	}
	close $FILE;
}

sub produce_package_downgrade_report() {
	my $category = "";
	my $package = "";
	my $test;
	my $FILE;
	my $meta_category;

	if (scalar keys %packages_downgraded <= 0 ) {
		return; # No need to print anything, there were no downgraded packages
	}
	open $FILE, ">>" . $analysis_report_file;
	print $FILE "\nThe following packages have been downgraded:";
	foreach $category (sort keys %packages_downgraded) {
		print $FILE "\n\t Category '" . $category . "':\n";
		foreach $package (sort keys %{$packages_downgraded{$category}}) {
			$meta_category = get_package_meta_category($category, $package);
			print_pretty_item($FILE, $package, $packages_downgraded{$category}->{$package}, $meta_category);
		}
	}
	close $FILE;
}

sub print_pretty_item($$$$) {
	my $FILE = shift;
	my $package = shift;
	my $version = shift;
	my $meta_category = shift;
	my $i;
	my $max_dots;
	my $max_spaces;

	print $FILE "\t\t";
	print $FILE $package;
	if ($version eq "") {
		if ($meta_category ne "") {
			$max_spaces = 37 - length $package;
			for ($i=0;$i < $max_spaces; $i++) {
				print $FILE " ";
			}
			print $FILE "[" . $meta_category . "]";
		}
		print $FILE "\n";
		return;
	}
	$max_dots = 25 - length $package;
	for ($i=0;$i < $max_dots; $i++) {
		print $FILE ".";
	}
	print $FILE $version;
	if ($meta_category ne "") {
		$max_spaces = 12 - length $version;
		for ($i=0;$i < $max_spaces; $i++) {
			print $FILE " ";
		}
		print $FILE "[" . $meta_category . "]";
	}
	print $FILE "\n";
}

sub prepare_report_file() {
	open FILE, ">" . $analysis_report_file;
	print FILE $report_header;
	close FILE;
}

### Main ###

my $prev_version_dir;
my $new_version_dir;

if ($#ARGV <= 0 || $#ARGV > 2) {
	show_help();
	exit(1);
}

$prev_version_dir = shift @ARGV;
$new_version_dir = shift @ARGV;

sanity_check_dirs($prev_version_dir, $new_version_dir);
determine_categories($prev_version_dir, $new_version_dir);
retrieve_meta_package_list($prev_version_dir, $new_version_dir);
retrieve_garnome_information("old_version", $prev_version_dir);
retrieve_garnome_information("new_version", $new_version_dir);
removal_analysis();
addition_analysis();
package_update_analysis();
prepare_report_file();
produce_package_removal_report();
produce_package_addition_report();
produce_package_upgrade_report();
produce_package_downgrade_report();
#print_package_hierarchy();
