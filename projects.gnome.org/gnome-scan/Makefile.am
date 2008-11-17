#SUBDIRS=doc data

urlpath = /gnome-scan/

mrproper:
	rm -rf *;

page_SCRIPTS= \
	index.html \
	index.html.en \
	index.html.ca \
	index.html.de \
	index.html.fr \
	index.html.sv \
	screenshots.html \
	screenshots.html.en \
	screenshots.html.ca \
	screenshots.html.de \
	screenshots.html.fr \
	screenshots.html.sv \
	contribute.html \
	contribute.html.fr \
	download.html \
	download.html.en \
	download.html.ca \
	download.html.de \
	download.html.fr \
	download.html.sv \
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
	data/themes/gnome/images/multi-function.png \
	data/themes/gnome/images/flatbed.png \
	data/themes/gnome/images/title.png \
	data/themes/gnome/images/gnome.png \
	data/themes/gnome/images/top-bg.png \
	$(NULL)

screenshotsdir = $(pagedir)/data/screenshots

ss03dir = $(screenshotsdir)/0.3
ss03_DATA = \
	data/screenshots/0.3/multipage-pdf.png \
	data/screenshots/0.3/multipage-pdf-mini.png \
	data/screenshots/0.3/apropos-mini.png \
	data/screenshots/0.3/acquisition-mini.png \
	data/screenshots/0.3/apropos.png \
	data/screenshots/0.3/acquisition.png \
	$(NULL)

ss021dir = $(screenshotsdir)/0.2.1
ss021_DATA = \
	data/screenshots/0.2.1/gimp-scan-mini.png \
	data/screenshots/0.2.1/flegita-scan.png \
	data/screenshots/0.2.1/gimp-scan.png \
	data/screenshots/0.2.1/flegita-scan-mini.png \
	data/screenshots/0.2.1/overview.png \
	data/screenshots/0.2.1/overview-mini.png \
	data/screenshots/0.2.1/documentation-mini.png \
	data/screenshots/0.2.1/documentation.png \
	$(NULL)

ss041dir = $(screenshotsdir)/0.4.1
ss041_DATA = \
	data/screenshots/0.4.1/main-filled-mini.png \
	data/screenshots/0.4.1/main-filled.png \
	data/screenshots/0.4.1/preview.png \
	data/screenshots/0.4.1/advanced.png \
	data/screenshots/0.4.1/main.png \
	data/screenshots/0.4.1/gimp-plugin.png \
	data/screenshots/0.4.1/preview-mini.png \
	data/screenshots/0.4.1/advanced-mini.png \
	data/screenshots/0.4.1/main-mini.png \
	data/screenshots/0.4.1/gimp-plugin-mini.png \
	data/screenshots/0.4.1/pdf-multipage-bug.png \
	data/screenshots/0.4.1/new-preview-ubuntu.png \
	data/screenshots/0.4.1/pdf-multipage-bug-mini.png \
	data/screenshots/0.4.1/new-preview-ubuntu-mini.png \
	$(NULL)

ss06dir = $(screenshotsdir)/0.6
ss06_DATA = \
	data/screenshots/0.6/30-acquire-preview-mini.png \
	data/screenshots/0.6/30-acquire-preview.png \
	data/screenshots/0.6/50-acquire-mini.png \
	data/screenshots/0.6/20-device-selected.png \
	data/screenshots/0.6/40-preview-mini.png \
	data/screenshots/0.6/50-acquire.png \
	data/screenshots/0.6/40-preview.png \
	data/screenshots/0.6/10-main-mini.png \
	data/screenshots/0.6/20-device-selected-mini.png \
	data/screenshots/0.6/10-main.png \
	$(NULL)

imagesdir = $(pagedir)/data/images
images_DATA =\
	data/images/screenshot.png \
	data/images/gnome-favicon.png \
	$(NULL)

include $(top_srcdir)/rules.common
