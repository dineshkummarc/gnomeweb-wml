SUBDIRS=diatut doc images umltut visio

urlpath=/projects/dia

page_SCRIPTS = \
	contact.html \
	custom-shapes \
	dcd.html \
	develop.html \
	dia.css \
	docs.html \
	downld.html \
	exempl.html \
	faq.html \
	fonts.html \
	home.html \
	index.html \
	links.html \
	mainwin.html \
	menu.html \
	news.html \
	python.html \
	right_bar.html \
	scrshot.html \
	umlclass.html \
	workspac.html

include $(top_srcdir)/rules.common

# Two special rules to make the links page and the FAQ page from sources
# in other formats.
links.html: links.xml
	-mv links.html links.html.old
	if ./make-links.pl links.xml >links.html; then \
	  rm -f links.html.old; \
	else \
	  -mv links.html.old links.html; \
	fi

faq.html: faq.src
	-mv faq.html faq.html.old
	-if ./make-faq.pl <faq.src >faq.html; then \
	  rm -f faq.html.old; \
	else \
	  -mv faq.html.old faq.html; \
	fi
