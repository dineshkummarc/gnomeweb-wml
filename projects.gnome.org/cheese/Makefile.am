#SUBDIRS=doc data

urlpath = /cheese/

#mrproper:
#	rm -rf *;

page_SCRIPTS= \
	index.shtml \
	download.shtml \
	archive.shtml \
	tour.shtml \
	header.shtml \
	footer.shtml \
	detect.py \
	$(NULL)

includesdir=$(pagedir)/includes
includes_DATA = \
	includes/news.shtml \
	includes/unstable.shtml \
	includes/stable_archive.shtml \
	includes/unstable_archive.shtml \
	includes/stable.shtml \
	$(NULL)

themedir=$(pagedir)/data/themes/cheese
theme_DATA = \
	data/themes/cheese/document.all.css \
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
	data/screenshots/cheese-0.3.0.jpg \
	data/screenshots/cheese-2.22.0.jpg \
	data/screenshots/cheese-2.22.0_2.jpg \
	data/screenshots/cheese-2.24.0-countdown.jpg \
	data/screenshots/cheese-2.24.0-effects.jpg \
	data/screenshots/cheese-2.24.0-fullscreen.jpg \
	data/screenshots/cheese-2.24.0-main.jpg \
	data/screenshots/cheese-2.28.0-burst.jpg \
	data/screenshots/cheese-2.28.0-countdown.jpg \
	data/screenshots/cheese-2.28.0-effects.jpg \
	data/screenshots/cheese-2.28.0-fullscreen.jpg \
	data/screenshots/cheese-2.28.0-main.jpg \
	data/screenshots/cheese-2.28.0-preferences.jpg \
	data/screenshots/cheese-2.28.0-share.jpg \
	data/screenshots/cheese-2.28.0-video.jpg \
	data/screenshots/cheese-2.28.0-wide.jpg \
	data/screenshots/cheese-2.24.0-share.jpg \
	$(NULL)

imagesdir = $(pagedir)/data/images
images_DATA =\
	data/images/cheese-big.png \
	data/images/cheese-favicon.png \
	data/images/package-x-generic.png \
	data/images/preferences-desktop-wallpaper.png \
	data/images/internet-group-chat.png \
	data/images/system-users.png \
	data/images/video-x-generic.png \
	data/images/applications-development.png \
	data/images/dialog-information.png \
	data/images/application-x-executable.png \
	data/images/dialog-warning.png \
	data/images/cheese-tour.png \
	data/images/cheese-birthday.png \
	data/images/cheese-2.24.png \
	$(NULL)

tourdir = $(pagedir)/data/tour
tour_DATA =\
	data/tour/cheese-video.jpg \
	data/tour/cheese-effects.jpg \
	data/tour/cheese-countdown.jpg \
	data/tour/cheese-share.jpg \
	data/tour/cheese-main.jpg \
	data/tour/cheese-prefs.jpg \
	data/tour/cheese-fullscreen.jpg \
	data/tour/cheese-burst.jpg \
	data/tour/cheese-wide.jpg \
	$(NULL)

shadowboximagesdir = $(pagedir)/data/shadowbox/images
shadowboximages_DATA =\
	data/shadowbox/images/loading.gif \
	data/shadowbox/images/loading-light.gif \
	$(NULL)

shadowboxcssdir = $(pagedir)/data/shadowbox/css
shadowboxcss_DATA =\
	data/shadowbox/css/shadowbox.css \
	data/shadowbox/css/shadowbox-light.css \
	$(NULL)

shadowboxjsdir = $(pagedir)/data/shadowbox/js
shadowboxjs_DATA =\
	data/shadowbox/js/shadowbox.js \
	data/shadowbox/js/yui-utilities.js \
	data/shadowbox/js/shadowbox-yui.js \
	$(NULL)

include $(top_srcdir)/rules.common
