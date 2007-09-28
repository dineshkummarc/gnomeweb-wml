#SUBDIRS=doc data

urlpath=/projects/cheese/

mrproper:
	rm -rf *;

page_SCRIPTS= \
	index.html \
	screenshots.html \
	appendix.shtml \
	$(NULL)

themedir=$(pagedir)/data/themes/gnome
theme_DATA = \
	data/themes/gnome/screenshots.screen.css \
	data/themes/gnome/document.all.css \
	data/themes/gnome/frontpage.css \
	data/themes/gnome/document.print.css \
	data/themes/gnome/document.screen.css \
	$(NULL)

themeimgdir = $(themedir)/images
themeimg_DATA = \
	data/themes/gnome/images/title.png \
	data/themes/gnome/images/gnome.png \
	data/themes/gnome/images/top-bg.png \
	$(NULL)

screenshotsdir = $(pagedir)/data/screenshots
screenshots_DATA = \
	data/screenshots/cheese-pre0.1.0.jpg \
	data/screenshots/cheese-0.1.0.jpg \
	data/screenshots/cheese-0.1.1_2.jpg \
	data/screenshots/cheese-0.1.1.jpg \
	data/screenshots/cheese-0.1.2.jpg \
	data/screenshots/cheese-0.1.4.jpg \
	data/screenshots/cheese-0.2.1.jpg \
	data/screenshots/cheese-0.2.2.jpg \
	$(NULL)

imagesdir = $(pagedir)/data/images
images_DATA =\
	data/images/cheese-big.png \
	data/images/gnome-favicon.png \
	$(NULL)

include $(top_srcdir)/rules.common
