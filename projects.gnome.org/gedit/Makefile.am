SUBDIRS=images

urlpath = /gedit

page_SCRIPTS =

EXTRA_DIST = \
	layout.xsl

HTML_FILES = \
	index.html \
	screenshots.html \
	developers.html \
	plugins.html

page_DATA = \
	$(HTML_FILES) \
	gedit.css \
	current-release.xml

%.html: %.page layout.xsl Makefile
	xsltproc --nonet --stringparam date "$$(date -R)" -o $@ layout.xsl $<

include $(top_srcdir)/rules.common

