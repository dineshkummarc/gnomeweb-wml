SUBDIRS=images start

urlpath=

page_SCRIPTS=index.html special-page.html

include $(top_srcdir)/rules.common

install-data-local: special-page.html
	chmod +x $(top_srcdir)/scripts/split-special.pl
	$(top_srcdir)/scripts/split-special.pl special-page.html $(pagedir)
