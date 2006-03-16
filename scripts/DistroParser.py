#!/usr/bin/env python

import urllib2
import libxml2
import sys
import re
import math

### These variables may need tweaking ###

gnomeVersion = "2.14"
gnomeMinVersion = 2.0
gnomeStrings = re.compile (r".*GNOME.*")
develVersions = re.compile (
		r"(snapshot|devel|.*test.*|unstable|.*pre.*|cooker|.*[Aa]lpha.*|.*[Bb]eta.*|.*-rc[0-9]+|VineSeed)")
versionNo = re.compile (r"^(\d+.\d+)\..*$")

### Code Past This Point ###

class GenericObject:
	"Implements generic variables and functions we need"
	def __self__ (self):
		self.url	= None
		self.page	= None

	def getPage (self, url):
		self.url = url
		self.page = urllib2.urlopen (url).read ()
	
	def getPageFromFile (self, file):
		self.page = open (file).read ()

class DistroObject (GenericObject):
	"Data structure to represent and print a distrobution"
	def __init__ (self):
		GenericObject ()
		
		self.name	= None
		self.versions	= []
		self.version	= None
		self.hasGnome	= False
		self.hasGnomeDefault = False
		self.gVersions	= []
		self.gVersion	= None
		self.deskStrings = []
		self.deskString	= None
		
		self.doc	= None
	
	def getVersion (self):
		if self.gVersion:
			match = versionNo.match (self.gVersion)
		else:
			match = None
		if match: return match.group (1)
	
	def __repr__ (self):
		out = ""
		out += "Distribution: %s (" % (self.name)
		for version in self.versions[:-1]:
			out += "%s, " % (version)
		out += "%s)\n" % self.versions[-1]
		if self.hasGnome:
			out += "GNOME: "
			for gVersion in self.gVersions[:-1]:
				out += "%s, " % (gVersion)
			out += "%s\n" % self.gVersions[-1]
		out += "Latest: %s (%s)" % (self.version, self.getVersion ())
		return out
	
	def __str__ (self):
		out = ""
		version = self.getVersion ()
		if self.hasGnome:
			if version == gnomeVersion:
				tdClass = ' class="current"'
			else:
				tdClass = ''
			
			out += '<tr>\n'
			out += ' <td%s>' % tdClass
			out += '<a href="%s">%s</a></td>\n' % (
					self.url, self.name)
			
			try:
			  if float (self.getVersion ()) < gnomeMinVersion:
				aHref = ""
			  else:
				aHref = ' href="http://www.gnome.org/start/%s/"' % version
			except:
				aHref = ""

			out += ' <td%s><a%s>%s</a></td>\n' % (
				tdClass, aHref, version)
			out += '</tr>\n'
		return out

class DistroWatchHTMLParser (DistroObject):
	"HTML screenscraping class for Distros"
	def parse (self):
		nautilusVersions = []
		self.doc = libxml2.htmlParseDoc (self.page, 'utf-8')
		self.name = self.doc.xpathEval (
			"//td[preceding-sibling::th[1] = 'Distribution']"
						)[0].content
		for i in self.doc.xpathEval (
			"//td[preceding-sibling::th[1] = 'Feature']"):
			self.versions.append (i.content)
		for i in self.doc.xpathEval (
			"//td[preceding-sibling::th[1] = 'Default Desktop']"):
			self.deskStrings.append (i.content)
		for i in self.doc.xpathEval (
			"//td[preceding-sibling::th[1]/a = 'libgnome']"):
			self.gVersions.append (i.content)
		for i in self.doc.xpathEval (
			"//td[preceding-sibling::th[1]/a = 'nautilus']"):
			nautilusVersions.append (i.content)

		for i in range (len (self.versions)):
			self.deskString = self.deskStrings[i]
			if not develVersions.match (self.versions[i]):
			    self.version = self.versions[i]
			    if gnomeStrings.match (self.deskStrings[i]):
				self.gVersion = self.gVersions[i]
				self.hasGnomeDefault = True
				self.hasGnome = True
				break
			    elif len (self.gVersions) > i and len (nautilusVersions) > i:
			    	if versionNo.match (self.gVersions[i]) and versionNo.match (nautilusVersions[i]):
					self.gVersion = self.gVersions[i]
					self.hasGnome = True
					break

class DistroWatchListHTMLParser (GenericObject):
	"HTML screenscraping class to parse the Distro list"
	def __init__ (self):
		GenericObject ()

		self.distroList	= []
		
	def parse (self):
		self.doc = libxml2.htmlParseDoc (self.page, 'utf-8')
		rawDistroList = self.doc.xpathEval (
		    '//table[contains(string(.), "Last 1 month")]/tr/td/a/@href'
						)
		for distro in rawDistroList:
			self.distroList.append (distro.content)

class DistroList:
	def __init__ (self):
		self.distrolist1 = []
		self.distrolist2 = []	

	def __cmp__ (self, entry1, entry2):
		v1 = math.floor (float (entry1.getVersion ()))
		v2 = math.floor (float (entry2.getVersion ()))
		r = cmp (v1, v2)
		if r == 0:
			v1 = int (entry1.getVersion ().split ('.')[-1])
			v2 = int (entry2.getVersion ().split ('.')[-1])
			return -1 * cmp (v1, v2)
		else: return -1 * r

	def sort (self):
		self.distrolist1.sort (self.__cmp__)
		self.distrolist2.sort (self.__cmp__)
	
	def append (self, d):
		if d.hasGnome:
			sys.stdout.write ("have GNOME %s" % d.getVersion ())
			if d.hasGnomeDefault:
				sys.stdout.write (" (default)")
				self.distrolist1.append (d)
			else:
				sys.stdout.write (" (%s)" % d.deskString)
				self.distrolist2.append (d)
			sys.stdout.write ("\n")
		else: sys.stdout.write ("no GNOME (%s)\n" % d.deskString)
	
	def write (self):
		sys.stdout.write ("Writing first list... ")
		distrolist_file = open (sys.argv[1], 'w')

		for distro in self.distrolist1:
			distrolist_file.write ("%s\n" % distro)

		distrolist_file.close ()
		sys.stdout.write ("done\n")
		
		sys.stdout.write ("Writing second list... ")
		distrolist_file = open (sys.argv[2], 'w')

		for distro in self.distrolist2:
			distrolist_file.write ("%s\n" % distro)

		distrolist_file.close ()
		sys.stdout.write ("done\n")
	

if __name__ == '__main__':
	if len (sys.argv) < 3:
		sys.stderr.write ("DistroList.py: Default.html Other.html\n")
		sys.exit (1)

	dl = DistroWatchListHTMLParser ()
	sys.stdout.write ("Getting distribution list... ")
	dl.getPage (
		"http://distrowatch.com/stats.php?section=popularity")
	dl.parse ()
	sys.stdout.write ("done\n")

	distrolist = DistroList ()

	for distro in dl.distroList:
		sys.stdout.write ("Checking distro, %s... " % distro)
		d = DistroWatchHTMLParser ()
		d.getPage ("http://distrowatch.com/table.php?distribution=%s"
			% (distro))
		d.parse ()
		distrolist.append (d)
	
	distrolist.sort ()
	distrolist.write ()
