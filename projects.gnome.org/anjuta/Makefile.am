SUBDIRS=css team

urlpath = /anjuta

HTMLFILES = \
	index.shtml \
	index.html \
	development.html \
	downloads.html \
	features.html \
	projects.html \
	team.html 

page_DATA = $(HTMLFILES)

%.page: %.xsl Makefile current-release.xml
	xsltproc --nonet --stringparam date "$$(date -R)" -o $@ $< current-release.xml

%.html: %.page layout.xsl Makefile current-release.xml
	xsltproc --nonet --stringparam date "$$(date -R)" -o $@ layout.xsl $<

include $(top_srcdir)/rules.common
