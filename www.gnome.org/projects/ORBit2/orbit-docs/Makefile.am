SUBDIRS=

urlpath=/projects/ORBit2/orbit-docs

PKG_FILES=$(shell tar tzf orbit.tar.gz)

page_SCRIPTS=orbit.ps $(PKG_FILES)

$(PKG_FILES): orbit/book1.html

orbit/book1.html: orbit.tar.gz
	tar xzf orbit.tar.gz

include $(top_srcdir)/rules.common


