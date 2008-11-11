CC = php
PHP_INI = /etc/php.ini
INCLUDEDIR = ./inc
SCRIPTS = index.html
EXTRA = style.css
all: $(SCRIPTS)
INCLUDE = inc/common.inc inc/nav.inc inc/nav_links.inc inc/nav_links.inc \
	inc/template.inc inc/widgets.inc

%.html:	%.php inc/common.inc inc/nav.inc inc/
	$(CC) -c $(PHP_INI) -d include_path=$(INCLUDEDIR) $< > $@ 

install: $(SCRIPTS) $(EXTRA)
	@list='$(SCRIPTS) $(EXTRA)'; for p in $$list; do \
	  cp -f "$$p" .. ; \
	done 

