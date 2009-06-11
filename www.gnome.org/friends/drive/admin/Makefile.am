SUBDIRS =

urlpath = /friends/drive/admin

page_SCRIPTS = \
	.htpasswd \
	.htaccess

include $(top_srcdir)/rules.common

DRIVE_PATH = $(prefix)/$(SITE)/friends/drive
DRIVE_WEBROOT = http://$(SITE)/friends/drive

.htpasswd: htpasswd
	cp $< $@

%.cgi: %.wml
	@sed -e "s,@DRIVE_WEBROOT@,$(DRIVE_WEBROOT),g;s,@DRIVE_PATH@,$(DRIVE_PATH),g" $< > $@

page_DATA = \
	admin.cgi \
	index.html

EXTRA_DIST=$(page_DATA)
