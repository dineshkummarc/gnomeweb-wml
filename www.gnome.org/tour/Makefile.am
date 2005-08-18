
SUBDIRS = docbook

urlpath = /tour

page_SCRIPTS=
page_DATA =

include $(top_srcdir)/rules.common


# Get DOC_INCLUDES and DOC_LINGUAS
include $(top_srcdir)/www.gnome.org/tour/docbook/Makefile_shared.am_fragment


VERSION = 2.10
ROOTDOC = tour.xml
STYLE_PATH = ../../docbook_html_style/


DOC_LINGUAS_PLUS_ORIGINAL = C $(DOC_LINGUAS) 

#This is voodoo, but it seems to work.
#I really have no idea how to do this loop stuff in a Makefile.
#And this would be easier if I could define some variables inside the @for loop.
#Murray Cumming
html:
	@for docbookdir in $(DOC_LINGUAS_PLUS_ORIGINAL); do \
	  echo "Generating html for language: " $$docbookdir; \
	  export PYTHONPATH=/home/users/murrayc/cvs/gnomeweb-wml/www.gnome.org/tour:$PYTHONPATH; \
	  rm -rf $$docbookdir; \
	  mkdir $$docbookdir; \
	  echo "Running xlstproc on: " docbook/$$docbookdir/$(ROOTDOC); \
	  xsltproc --xinclude -o $$docbookdir/index.html \
	    --param yelp_max_chunk_depth 1 \
 	    --stringparam admon.graphics.path ./images/ \
	    --stringparam http_root http://www.gnome.org \
	    --stringparam http_prefix /tour/ \
	    $(STYLE_PATH)db2html.xsl docbook/$$docbookdir/$(ROOTDOC); \
	  echo "  xlstproc finished"; \
	  cp -R $(STYLE_PATH)images docbook/$$docbookdir/figures $$docbookdir; \
	  for i in $$docbookdir/*.html; do \
	    perl -p -i -e 's,<p class="section"></p>,<p class="section">Sections</p>,g' $$i; \
	  done \
	done

all-local: html

clean: 
	@for docbookdir in $(DOC_LINGUAS_PLUS_ORIGINAL); do \
	  echo "Removing html for language: " $$docbookdir; \
	  rm -rf $$docbookdir; \
	done

