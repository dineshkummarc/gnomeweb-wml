SUBDIRS=images start

urlpath=

page_SCRIPTS=index.html findout.html

include $(top_srcdir)/rules.common

install-data-local: findout.html
	chmod +x $(top_srcdir)/scripts/split-special.pl
	$(top_srcdir)/scripts/split-special.pl special-page.html $(pagedir)
