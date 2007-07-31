#This should not be necessary, because no files here should be installed (visible from the web server)
#but let's see if it makes a difference.
urlpath = /start/2.20/notes/docbook

PKG_CONFIG=pkg-config
include $(top_srcdir)/www.gnome.org/start/2.20/notes/docbook/gnome-doc-utils.make
dist-hook: doc-dist-hook

DOC_MODULE = release-notes

# Get DOC_INCLUDES and DOC_LINGUAS
include $(top_srcdir)/www.gnome.org/start/2.20/notes/docbook/Makefile_shared.am_fragment

SUBDIRS = 
