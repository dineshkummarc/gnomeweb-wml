SUBDIRS = www.gnome.org www.guadec.org

install-data-local:
	$(INSTALL) -d $(prefix)/scripts
	$(INSTALL) -d $(prefix)/scripts/perl
	$(INSTALL) -d $(prefix)/scripts/php
	$(INSTALL_DATA) $(top_builddir)/scripts/perl/webwrap.pm $(prefix)/scripts/perl/webwrap.pm
	$(INSTALL_DATA) $(top_builddir)/scripts/php/webwrap.phtml $(prefix)/scripts/php/webwrap.phtml
	$(INSTALL_DATA) $(top_srcdir)/scripts/newsheadlines.py $(prefix)/scripts/newsheadlines.py
	$(INSTALL_DATA) $(top_srcdir)/scripts/db_trove_treesums.pl $(prefix)/scripts/db_trove_treesums.pl
