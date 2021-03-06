#! /usr/bin/python

# This script grabs the headlines from news.gnome.org in RDF format, and then
# outputs them as a little HTML table on stdout, suitable for including in
# the frontpage of the new site. It requires the PyXML package, which is
# available at http://www.python.org/sigs/xml-sig/files/PyXML-0.5.3.tar.gz

# In the unlikely case that anyone is interested, this is Copyright 2000
# Joakim Ziegler <joakim@helixcode.com>, and is under the GPL.

import urllib
import time
import re
import string
from xml.sax import saxlib
from xml.sax import saxexts

class PrintHeadline(saxlib.HandlerBase):

    def __init__ (self, number):
	self.inItem = 0
	self.inTitle = 0
	self.inLink = 0
	self.headlineLimit = number
	self.headlineCount = 0

    def startElement(self, name, attrs):
	if (self.headlineCount >= self.headlineLimit): return
	if name == 'item':
	    print "<tr><td colspan='2'><img src='/images/dot.gif' height='6' alt=''></td></tr><tr valign='top'><td width='28' align='center'><img src='/images/news-bullet' alt=''></td><td>"
	    self.inItem = 1
	if (name == 'title'):
	    self.inTitle = 1
	    self.itemTitle = ''
	if (name == 'link'):
	    self.inLink = 1
	    self.itemLink = ''


    def endElement(self, name):
	if (self.headlineCount >= self.headlineLimit): return
	if name == 'item':
	    print "<b><a href='" + self.itemLink + "'>" + self.itemTitle + "</a></b><font size='-2'></font><br>&nbsp;</td></tr>"
	    self.inItem = 0
	    self.headlineCount = self.headlineCount + 1
	if name == 'title':
	    self.inTitle = 0
	if name == 'link':
	    self.inLink = 0


    def characters (self, ch, start, length):
	if (self.headlineCount >= self.headlineLimit): return
	if (self.inItem & self.inTitle):
	    self.itemTitle = self.itemTitle + ch[start:start+length]
	if (self.inItem & self.inLink):
	    self.itemLink = self.itemLink + ch[start:start+length]


print "<p><a href='http://www.gnomedesktop.org/'><font size=\"+2\" color=\"#400000\"><b>FootNotes News:</b></font></a><br><table border='0' cellspacing='0' cellpadding='0'>"


try:
	feedfile = urllib.urlopen("http://gnomedesktop.org/backend.php")

	#feedfile.readline();

	if __name__ == '__main__':
	    parser = saxexts.make_parser()
	    dh = PrintHeadline(5)
	    parser.setDocumentHandler(dh)
	    parser.parseFile(feedfile)
	    parser.close()
except:
	pass

print "</table>"
