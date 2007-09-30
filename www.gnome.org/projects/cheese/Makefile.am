#SUBDIRS=doc data

urlpath=/projects/cheese/

mrproper:
	rm -rf *;

page_SCRIPTS= \
	index.html \
	download.html \
	screenshots.html \
	$(NULL)

themedir=$(pagedir)/data/themes/cheese
theme_DATA = \
	data/themes/cheese/document.all.css \
	data/themes/cheese/frontpage.css \
	data/themes/cheese/document.print.css \
	data/themes/cheese/document.screen.css \
	$(NULL)

themeimgdir = $(themedir)/images
themeimg_DATA = \
	data/themes/cheese/images/title.png \
	data/themes/cheese/images/gnome.png \
	data/themes/cheese/images/top-bg.png \
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
	data/images/package-x-generic.png \
	data/images/preferences-desktop-wallpaper.png \
  data/images/internet-group-chat.png \
  data/images/system-users.png \
  data/images/video-x-generic.png \
  data/images/applications-development.png \
  data/images/package-x-generic.png \
  data/images/dialog-information.png \
  data/images/application-x-executable.png \
	$(NULL)

include $(top_srcdir)/rules.common
