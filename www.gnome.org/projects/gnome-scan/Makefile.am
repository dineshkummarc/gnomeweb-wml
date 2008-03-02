#SUBDIRS=doc data

urlpath=/projects/gnome-scan/

mrproper:
	rm -rf *;

page_SCRIPTS= \
	index.html \
	index.en.html \
	index.ca.html \
	index.de.html \
	index.fr.html \
	index.sv.html \
	screenshots.html \
	screenshots.en.html \
	screenshots.ca.html \
	screenshots.de.html \
	screenshots.fr.html \
	screenshots.sv.html \
	contribute.html \
	contribute.fr.html \
	download.html \
	download.en.html \
	download.ca.html \
	download.de.html \
	download.fr.html \
	download.sv.html \
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

ss0404dir = $(screenshotsdir)/0.4.0.4
ss0404_DATA = \
	data/screenshots/0.4.0.4/main-filled-mini.png \
	data/screenshots/0.4.0.4/main-filled.png \
	data/screenshots/0.4.0.4/preview.png \
	data/screenshots/0.4.0.4/advanced.png \
	data/screenshots/0.4.0.4/main.png \
	data/screenshots/0.4.0.4/gimp-plugin.png \
	data/screenshots/0.4.0.4/preview-mini.png \
	data/screenshots/0.4.0.4/advanced-mini.png \
	data/screenshots/0.4.0.4/main-mini.png \
	data/screenshots/0.4.0.4/gimp-plugin-mini.png \
	data/screenshots/0.4.0.4/pdf-multipage-bug.png \
	data/screenshots/0.4.0.4/new-preview-ubuntu.png \
	data/screenshots/0.4.0.4/pdf-multipage-bug-mini.png \
	data/screenshots/0.4.0.4/new-preview-ubuntu-mini.png \
	$(NULL)

ss0594dir = $(screenshotsdir)/0.4.0.4
ss0594_DATA = \
	data/screenshots/0.5.94/30-acquire-preview-mini.png \
	data/screenshots/0.5.94/30-acquire-preview.png \
	data/screenshots/0.5.94/50-acquire-mini.png \
	data/screenshots/0.5.94/20-device-selected.png \
	data/screenshots/0.5.94/40-preview-mini.png \
	data/screenshots/0.5.94/50-acquire.png \
	data/screenshots/0.5.94/40-preview.png \
	data/screenshots/0.5.94/10-main-mini.png \
	data/screenshots/0.5.94/20-device-selected-mini.png \
	data/screenshots/0.5.94/10-main.png \
	$(NULL)

imagesdir = $(pagedir)/data/images
images_DATA =\
	data/images/screenshot.png \
	data/images/gnome-favicon.png \
	$(NULL)

include $(top_srcdir)/rules.common
