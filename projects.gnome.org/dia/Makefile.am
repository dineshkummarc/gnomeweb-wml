SUBDIRS=diatut doc images umltut visio

urlpath = /dia

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
	pydia.html \
	python.html \
	right_bar.html \
	scrshot.html \
	umlclass.html \
	workspac.html \
	\
	dia-0.97-integrated-ui.png \
	dia-0-97-coming-soon.png \
	render-test.pdf 

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
