SUBDIRS = www.gnome.org projects.gnome.org people.gnome.org

install-data-local:
	$(INSTALL) -d $(prefix)/scripts
	$(INSTALL_DATA) $(top_srcdir)/scripts/DistroParser.py $(prefix)/scripts/DistroParser.py
	$(INSTALL_DATA) $(top_srcdir)/scripts/newsheadlines.py $(prefix)/scripts/newsheadlines.py
	$(INSTALL_DATA) $(top_srcdir)/scripts/db_trove_treesums.pl $(prefix)/scripts/db_trove_treesums.pl
