#!/usr/bin/perl -w

use strict;

# Read material
my @names = ();
my %questions = ();
my %answers = ();
my $name = "";
my $question = "";
my $answer = "";
my $state = "head";
my $head = "";
my $foot = "";
while (<>) {
    if ($state eq "head") {
	if (/\#(Name|Group):\s*(.*)/) {
	    if ($1 eq "Name") {
		$name = $2;
	    } else {
		push(@names, "\#$2");
		$name = "";
	    }
	    $question = "";
	    $answer = "";
	    $state = "heading";
	} elsif (/\#\w+:/) {
	    print "Illegal markup $_ in state $state.\n";
	} else {
	    $head .= $_;
	}
    } elsif ($state eq "heading") {
	if (/\#Name:\s*(\S*)/) {
	    $name = $1;
	    $question = "";
	    $answer = "";
	    $state = "heading";
	} elsif (/\#Question:\s*(.*)/) {
	    $state = "question";
	    $question = "$1\n";
	} elsif (/\#\w*:/) {
	    print "Must have Name or Question in $state state.\n";
	}
    } elsif ($state eq "question") {
	if (/\#Answer:\s*(.*)/) {
	    $answer = "$1\n";
	    $state = "answer";
	} else {
	    $question .= $_;
	}
    } elsif ($state eq "answer") {
	if (/\#(Name|Group|Footer):\s*(.*)/) {
	    $questions{$name} = $question;
	    $answers{$name} = $answer;
	    push(@names, $name);
	    $question = "";
	    $answer = "";
	    if ($1 eq "Name") {
		$name = $2;
		$state = "heading";
	    } elsif ($1 eq "Group") {
		push(@names, "\#$2");
		$name = "";
		$state = "heading";
	    } else {
		$name = "";
		$state = "foot";
	    }
	} else {
	    $answer .= $_;
	}
    } elsif ($state eq "foot") {
	$foot .= $_;
    }
}
if ($name ne "") {
    push(@names,$name);
    $questions{$name} = $question;
    $answers{$name} = $answer;
}
# Output material
print $head;
#print "<ol>\n";
my $i = 0;
for $name (@names) {
    if ($name =~ /^\#/) {
	my $realname = substr($name, 1);
	print "</ol>\n" if ($i);
	print "  <h4>$realname</h4>\n<ol>\n";
    } else {
	$i++;
	my $question = $questions{$name};
	print "  <li value=\"$i\"><a href=\"\#$name\">$question</a></li>\n";
    }
}
print "</ol>\n";
#print "<ol>\n";
$i = 0;
for $name (@names) {
    if ($name =~ /^\#/) {
	my $realname = substr($name,1);
	print "</ol>\n" if ($i);
	print "  <h3>$realname</h3>\n<ol>\n";
    } else {
	$i++;
	my $question = $questions{$name};
	my $answer = $answers{$name};
	print "<li value=\"$i\"><a name=\"$name\">Q: $question</a>\n";
	print "<br>A: $answer<p></p></li>\n";
    }
}
print "</ol>\n";
# Output footers
print $foot;
