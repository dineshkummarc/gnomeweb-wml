#!/usr/bin/perl -w

## A script to format AUTHORS file for webpage

my $authors_file = "authors.txt";
my $page_file = "team.page";

$page_file =~ s/\.txt$/.html/;

print "Text file: $authors_file\n";
print "Output page file: $page_file\n";

my $team = `cat team.xml`;
my ($team_top, $team_bottom) = split (/<!--contributors-->/, $team);

open (AUTHORS_FILE, $authors_file) or
    die "Cannot open $authors_file for reading";
open (PAGE_FILE, ">$page_file") or
    die "Cannot open $page_file for writing";

print PAGE_FILE "$team_top\n";

my $beginning = 0;
while (my $line = <AUTHORS_FILE>)
{
    $line =~ s/</&lt;/gs;
    $line =~ s/>/&gt;/gs;
    $line =~ s/@/|&#064;|/gs;

    next if (!$beginning && $line !~ m/Past Developers/);
    $beginning = 1;

    if ($line =~ m/Note:/)
    {
	# the end.
	print PAGE_FILE "<p>\n";
	print PAGE_FILE $line;
	while (my $line = <AUTHORS_FILE>)
	{
	    next if ($line =~ m/^\-\-/gs);
	    if ($line =~ m/^\s*$/gs)
	    {
		print PAGE_FILE "</p>\n";
		print PAGE_FILE "$team_bottom\n";
		exit;
	    }
	    print PAGE_FILE $line;
	}
    }
    if ($line =~ m/^\w/gs)
    {
	$line =~ s/^\s+//;
	$line =~ s/\s+$//;
	print PAGE_FILE "<h2>$line</h2>\n";
    }
    elsif ($line =~ m/^\-/gs) {
	print PAGE_FILE "<ul class=\"author-list\">\n";
    }
    elsif ($line =~ m/^\s+[^\s]/gs) {
	$line =~ s/^\s+//;
	$line =~ s/\s+$//;
	print PAGE_FILE "\t<li class=\"author-list-item\">$line</li>\n";
    }
    elsif ($line =~ m/^\s*$/gs) {
	print PAGE_FILE "</ul>\n";
    }
}
