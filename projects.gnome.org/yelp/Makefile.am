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
	data/themes/yelp/document.all.css \
	data/themes/yelp/document.screen.css \
	$(NULL)

themeimgdir = $(themedir)/images
themeimg_DATA = \
	data/themes/yelp/images/title.png \
	data/themes/yelp/images/gnome.png \
	data/themes/yelp/images/top-bg.png \
	$(NULL)

imagesdir = $(pagedir)/data/images
images_DATA =\
	data/images/yelp-favicon.png \
	data/images/yelp-big.png \
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
