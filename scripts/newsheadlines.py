#! /usr/bin/python

import urllib
import time
import re
import string
from xml.sax import saxlib
from xml.sax import saxexts

class PrintHeadline(saxlib.HandlerBase):

    def __init__ (self):
	self.inItem = 0
	self.inTitle = 0
	self.inLink = 0
	self.itemTitle = ''
	self.itemLink = ''

    def startElement(self, name, attrs):

	if name == 'item':
	    print "<tr><td colspan='2'><img src='/images/dot.gif' height='6' alt=''></td></tr><tr valign='top'><td width='28' align='center'><img src='/images/news-bullet.png' alt=''></td><td><img src='/images/dot.gif' width='1' height='3' alt=''><br clear='all'>"
	    self.inItem = 1
	if name == 'title':
	    self.inTitle = 1
	    self.itemTitle = ''
	if name == 'link':
	    self.inLink = 1
	    self.itemLink = ''


    def endElement(self, name):

	if name == 'item':
	    self.timestamp = re.split("/", self.itemLink)[-2]
	    self.timetuple = time.gmtime(string.atoi(self.timestamp))
	    self.timestring = time.strftime("%a, %b %d %Y", self.timetuple)
	    print "<b><a href='" + self.itemLink + "'>" + self.itemTitle + "</a></b> <font size='-2'>[" + self.timestring + "]</font></td></tr>"
	    self.inItem = 0
	if name == 'title':
	    self.inTitle = 0
	if name == 'link':
	    self.inLink = 0


    def characters (self, ch, start, length):
	if (self.inItem & self.inTitle):
	    self.itemTitle = self.itemTitle + ch[start:start+length]
	if (self.inItem & self.inLink):
	    self.itemLink = self.itemLink + ch[start:start+length]


print "<p><img src='/images/news-header.png' width='173' height='22' alt='GNOME news:'>\n<table border='0' cellspacing='0' cellpadding='0' width='40%'>"


feedfile = urllib.urlopen("http://news.gnome.org/gnome-news/rdf")

if __name__ == '__main__':
    parser = saxexts.make_parser()
    dh = PrintHeadline()
    parser.setDocumentHandler(dh)
    parser.parseFile(feedfile)
    parser.close()

print "</table>"
