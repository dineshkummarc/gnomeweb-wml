SUBDIRS=

urlpath=/projects/ORBit2/orbit-faq

PKG_FILES=$(shell tar tzf faq.tar.gz)

page_SCRIPTS=faq.ps $(PKG_FILES)

include $(top_srcdir)/rules.common

$(PKG_FILES): faq/faq.html

faq/faq.html: faq.tar.gz
	tar xzf faq.tar.gz

