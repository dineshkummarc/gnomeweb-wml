#!/usr/bin/perl -w

use strict;
use XML::Parser;

my %elements;

my $parser = new XML::Parser(ErrorContext => 2);
$parser->setHandlers(Start => \&start_handler,
		     Char => \&char_handler,
		     End => \&end_handler);

# Print a header
print <<EOF;
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<META NAME="Author" CONTENT="f.toussaint">
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE>Dia links</TITLE>
<link rel="StyleSheet" href="dia.css" type="text/css">
<link rel="shortcut icon" href="images/dia_gnome_icon.png">
</HEAD>
<BODY BGCOLOR="#FFFFFF">


<!-- 
			DO NOT EDIT THIS FILE!
    It is automatically generated from links.xml by make-links.pl
-->


    <table width="100%" cellpadding="0" border="0">
    <tr>
    <td>
    <h1>L i n k s</h1>
    </td>
    <td>
    <P ALIGN="right">
    <IMG SRC="images/links.jpg" alt="Links logo">
    </P>
    </td>
    </tr>
    </table>

    <p>Some links to...</p>

    <table width="100%" cellpadding="5" border="0">
EOF

$parser->parsefile(shift);

# Print out a trailer
print <<EOF;
</table>

    <p>Graphics of this web site are made with the Gimp and Xfig by 
    <A HREF="mailto:ftoussin\@club-internet.fr"><font color ="#459fa8">Toussaint Fr�d�ric</font></A></p>

    </BODY>
    </HTML>
EOF

sub start_handler() {
    my ($p, $el, %attrs) = @_;

    my $name = $attrs{"name"};

    if ($el eq "links:group") {
	print "<tr><th colspan=2 align=left>$name</th></tr>\n";
    } elsif ($el eq "links:link") {
	my $link = $attrs{"url"};
	print "<tr>
  <td class=\"link\" bgcolor=\"#d7e9ed\">
    <a href=\"$link\" target=\"_top\">
      $name</a>
    </td>
    <td class=\"link-desc\" bgcolor=\"#459fa8\">\n";
    }
}

sub end_handler() {
    my ($p, $el) = @_;

    if ($el eq "links:link") {
	print "  </td>
 </tr>\n";
    }
}

sub char_handler() {
    my ($p, $data) = @_;

    print "$data\n";
}
