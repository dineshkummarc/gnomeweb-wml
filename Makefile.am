SUBDIRS=www.gnome.org

install-data-local:
	$(INSTALL) -d $(prefix)/scripts/php
	$(INSTALL) -d $(prefix)/scripts/perl
	$(INSTALL_DATA) $(top_builddir)/scripts/perl/webwrap.pm $(prefix)/scripts/perl/webwrap.pm
	$(INSTALL_DATA) $(top_builddir)/scripts/php/webwrap.phtml $(prefix)/scripts/php/webwrap.phtml
