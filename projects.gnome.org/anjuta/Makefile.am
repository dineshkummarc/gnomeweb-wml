SUBDIRS=css

urlpath = /anjuta

HTMLFILES = \
	index.html \
	development.html \
	downloads.html \
	features.html \
	projects.html

page_DATA = $(HTMLFILES)

%.html: %.page layout.xsl Makefile
	xsltproc --nonet --stringparam date "$$(date -R)" -o $@ layout.xsl $<

include $(top_srcdir)/rules.common
