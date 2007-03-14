
SUBDIRS = docbook

urlpath = /start/2.18/notes

page_SCRIPTS=
page_DATA =

include $(top_srcdir)/rules.common


# Get DOC_INCLUDES and DOC_LINGUAS
include $(top_srcdir)/www.gnome.org/start/2.18/notes/docbook/Makefile_shared.am_fragment


VERSION = 2.18
ROOTDOC = release-notes.xml
STYLE_PATH = ../../../../docbook_html_style/


DOC_LINGUAS_PLUS_ORIGINAL = C $(DOC_LINGUAS) 

#This is voodoo, but it seems to work.
#I really have no idea how to do this loop stuff in a Makefile.
#And this would be easier if I could define some variables inside the @for loop.
#Murray Cumming
html:
	@for docbookdir in $(DOC_LINGUAS_PLUS_ORIGINAL); do \
	  echo "Generating html for language: " $$docbookdir; \
	  rm -rf $$docbookdir; \
	  mkdir $$docbookdir; \
	  echo "Running xlstproc on: " docbook/$$docbookdir/$(ROOTDOC); \
	  xsltproc --xinclude -o $$docbookdir/unused.html.ignore \
	    --param yelp_max_chunk_depth 1 \
	    --stringparam admon.graphics.path ./images/ \
	    --stringparam http_root http://www.gnome.org \
	    --stringparam http_prefix /start/2.18/notes \
	    $(STYLE_PATH)db2html.xsl docbook/$$docbookdir/$(ROOTDOC); \
	  echo "  xlstproc finished"; \
	  cp -R docbook/C/figures $$docbookdir; \
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


install-data-local:
	@for docbookdir in $(DOC_LINGUAS_PLUS_ORIGINAL); do \
	  echo "Installing generated html"; \
	  $(INSTALL) -d $(pagedir)/$$docbookdir; \
	  $(INSTALL_DATA) $(srcdir)/$$docbookdir/*.html $(pagedir)/$$docbookdir/; \
	  $(INSTALL) -d $(pagedir)/$$docbookdir/images; \
	  $(INSTALL_DATA) $(srcdir)/$$docbookdir/images/*.png $(pagedir)/$$docbookdir/images/; \
	  $(INSTALL) -d $(pagedir)/$$docbookdir/figures; \
	  $(INSTALL_DATA) $(srcdir)/C/figures/*.png $(pagedir)/C/figures/; \
	  $(INSTALL_DATA) $(srcdir)/$$docbookdir/figures/*.png $(pagedir)/$$docbookdir/figures/; \
	  (cd $(srcdir)/C && \
	  for figure in figures/*.png; do \
	    if [ ! -f $(pagedir)/$$docbookdir/$$figure ]; then \
	      $(INSTALL_DATA) $$figure $(pagedir)/$$docbookdir/figures/; \
	    fi; \
	  done); \
	done


