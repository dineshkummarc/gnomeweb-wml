SUBDIRS=

urlpath=/projects/ORBit2/orbit-docs

page_SCRIPTS=orbit.ps orbit/* orbit/stylesheet-images/*

include $(top_srcdir)/rules.common

orbit.ps: orbit.xml 
	db2ps   orbit.xml
	db2html orbit.xml
