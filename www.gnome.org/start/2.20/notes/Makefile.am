SUBDIRS = docbook

urlpath = /start/2.20/notes

page_SCRIPTS=
page_DATA =

include $(top_srcdir)/rules.common


# Get DOC_INCLUDES and DOC_LINGUAS
include $(top_srcdir)/www.gnome.org/start/2.20/notes/docbook/Makefile_shared.am_fragment


VERSION = 2.20
ROOTDOC = release-notes.xml
STYLE_PATH = ./


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
	  xsltproc --xinclude -o $$docbookdir/index.html \
	    --param yelp_max_chunk_depth 1 \
	    $(STYLE_PATH)db2html.xsl docbook/$$docbookdir/$(ROOTDOC); \
	  echo "  xlstproc finished"; \
	  cp -R docbook/$$docbookdir/figures $$docbookdir; \
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
	  $(INSTALL) -d $(pagedir)/$$docbookdir/figures; \
	  if test "`echo $(srcdir)/$$docbookdir/figures/*.png`" = $(srcdir)/$$docbookdir/figures/'*.png' ; then \
	    echo "WARNING: missing figures/ subdir in $$docbookdir" ; \
	  else \
	    $(INSTALL_DATA) $(srcdir)/$$docbookdir/figures/*.png $(pagedir)/$$docbookdir/figures/; \
 	  fi ; \
	  (cd $(srcdir)/C && \
	  for figure in figures/*.png; do \
	    if [ ! -f $(pagedir)/$$docbookdir/$$figure ]; then \
	      $(INSTALL_DATA) $$figure $(pagedir)/$$docbookdir/figures/; \
	    fi; \
	  done); \
	done



