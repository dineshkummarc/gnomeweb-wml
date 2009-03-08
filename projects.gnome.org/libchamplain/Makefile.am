#SUBDIRS=doc data

urlpath = /libchamplain/

mrproper:
	rm -rf *;

page_SCRIPTS= \
	index.html \
	download.html \
	features.html \
	$(NULL)

themedir=$(pagedir)/data/themes/libchamplain
theme_DATA = \
	data/themes/libchamplain/document.all.css \
	data/themes/libchamplain/document.screen.css \
	$(NULL)

themeimgdir = $(themedir)/images
themeimg_DATA = \
	data/themes/libchamplain/images/title.png \
	data/themes/libchamplain/images/gnome.png \
	data/themes/libchamplain/images/top-bg.png \
	$(NULL)

screenshotsdir = $(pagedir)/data/screenshots
screenshots_DATA = \
	data/screenshots/animated-marker.gif \
	data/screenshots/animated-marker_t.gif \
	data/screenshots/default-markers.png \
	data/screenshots/default-markers_t.png \
	data/screenshots/empathy-markers.png \
	data/screenshots/empathy-markers_t.png \
	data/screenshots/map-source-osm.png \
	data/screenshots/map-source-osm_t.png \
	data/screenshots/map-source-oam.png \
	data/screenshots/map-source-oam_t.png \
	data/screenshots/map-source-mff.png \
	data/screenshots/map-source-mff_t.png \
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
	data/images/package-x-generic.png \
	data/images/dialog-information.png \
	data/images/application-x-executable.png \
	data/images/dialog-warning.png \
	data/images/empathy-map.png \
	data/images/logo.png \
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
