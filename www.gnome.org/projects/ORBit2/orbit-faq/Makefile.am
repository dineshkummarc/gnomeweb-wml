SUBDIRS=

urlpath=/projects/ORBit2/orbit-faq

page_SCRIPTS=faq.ps faq/* faq/stylesheet-images/*

include $(top_srcdir)/rules.common

faq.ps: faq.xml 
	db2ps   faq.xml
	db2html faq.xml
