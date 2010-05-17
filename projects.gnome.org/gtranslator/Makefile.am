SUBDIRS=css

urlpath = /gtranslator

HTMLFILES = \
	index.shtml \
	index.html  \
	features.html \
	development.html \
	authors.html 

page_DATA = $(HTMLFILES)

%.page: %.xsl Makefile current-release.xml
	xsltproc --nonet --stringparam date "$$(date -R)" -o $@ $< current-release.xml

%.html: %.page layout.xsl Makefile current-release.xml
	xsltproc --nonet --stringparam date "$$(date -R)" -o $@ layout.xsl $<

# update:
# 	wget http://git.gnome.org/browse/anjuta/plain/AUTHORS -O authors.txt
# 	perl -w create-team-page.pl

include $(top_srcdir)/rules.common
