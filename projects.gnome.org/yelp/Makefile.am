#SUBDIRS=doc data

urlpath = /yelp/

page_SCRIPTS= \
	index.shtml \
	download.shtml \
	header.shtml \
	footer.shtml \
	$(NULL)

themedir=$(pagedir)/data/themes/yelp
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

imagesdir = $(pagedir)/data/images
images_DATA =\
	data/images/yelp-favicon.png \
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
