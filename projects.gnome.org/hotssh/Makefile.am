#SUBDIRS=doc data

urlpath = /hotssh/

mrproper:
	rm -rf *;

page_SCRIPTS= \
	index.html \
	screenshots.html \
	$(NULL)

themedir=$(pagedir)/data/themes/hotssh
theme_DATA = \
	data/themes/hotssh/document.all.css \
	data/themes/hotssh/document.screen.css \
	$(NULL)

themeimgdir = $(themedir)/images
themeimg_DATA = \
	data/themes/hotssh/images/title.png \
	data/themes/hotssh/images/gnome.png \
	data/themes/hotssh/images/top-bg.png \
	$(NULL)

screenshotsdir = $(pagedir)/data/screenshots
screenshots_DATA = \
	data/screenshots/HotSSH-1.png \
	data/screenshots/HotSSH-1-small.png \
	data/screenshots/HotSSH-2.png \
	$(NULL)

imagesdir = $(pagedir)/data/images
images_DATA =\
	data/images/gnome-favicon.png \
	data/images/package-x-generic.png \
	data/images/preferences-desktop-wallpaper.png \
  data/images/internet-group-chat.png \
  data/images/system-users.png \
  data/images/video-x-generic.png \
  data/images/applications-development.png \
  data/images/dialog-information.png \
  data/images/application-x-executable.png \
  data/images/dialog-warning.png \
	$(NULL)

#tourdir = $(pagedir)/data/tour
#tour_DATA =\
#	$(NULL)

include $(top_srcdir)/rules.common
