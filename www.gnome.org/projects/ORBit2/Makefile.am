SUBDIRS=python backup images orbit-docs orbit-faq 

urlpath=/projects/ORBit2/

page_SCRIPTS=go.css                \
               index.html          \
               news.html           \
               documentation.html  \
               download.html       \
               faq.html            \
               contact.html        \
               orbit-python.pdf    \
               legal.xml           \
               orbit-docs.tar.gz 

include $(top_srcdir)/rules.common

orbit-docs.tar.gz: orbit-docs/orbit.xml orbit-docs/examples/*/*
	$(MAKE) -C orbit-docs orbit.ps
	$(MAKE) -C orbit-docs/examples distclean
	rm -rf  orbit-docs/*.junk orbit-docs/*~
	tar czf orbit-docs.tar.gz --exclude CVS  orbit-docs/ 
