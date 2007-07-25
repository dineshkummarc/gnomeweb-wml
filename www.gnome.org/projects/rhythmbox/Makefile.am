SUBDIRS = screenshots

urlpath = /projects/rhythmbox

page_SCRIPTS=

EXTRA_DIST = mkpage.xsl

HTML_FILES = index.html screenshots.html download.html development.html feedback.html news.html translation.html utils.html

page_DATA = $(HTML_FILES) rb.css gstfamily2.png rhythmbox-16.png valid-xhtml10.png header.png

%.html: %.xml mkpage.xsl Makefile
	xsltproc --nonet --stringparam date "$$(date -R)" -o $@ mkpage.xsl $<
	xmllint --output /dev/null --valid $@

include $(top_srcdir)/rules.common
