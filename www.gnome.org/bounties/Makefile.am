SUBDIRS=

urlpath=/bounties

page_DATA=address-applet-anim.gif\
	address-applet-popup.png\
	addressbook-icon.png\
	Addressbook.php3\
	buddy-away.png\
	buddy-offline.png\
	buddy-online.png\
	bug.png\
	build.cs\
	calendar-attachments.gif\
	calendar-icon.png\
	Calendar.php3\
	calendar.png\
	calendar-thumb.png\
	cal-weather.png\
	cat-footer.php\
	cat-header.php\
	composer-attachments.gif\
	composer-lang.gif\
	contact-bday.png\
	contact-bday-thumb.png\
	discuss.php\
	documentation-icon.png\
	Documentation.php3\
	email-notification.gif\
	evo-tooltip.png\
	evo-webcal-1.png\
	evo-webcal-1-small.png\
	footer.php\
	header.php\
	IM-addbuddy1.png\
	IM-addbuddy2.png\
	IM-addbuddy3.png\
	im-icon.png\
	IM.php3\
	imstatus-mailcomposer.gif\
	imstatus-mailmessage.png\
	index.php3\
	ipod.png\
	mail-custom-header.png\
	mailer-icon.png\
	Mailer.php3\
	miscellaneous-icon.png\
	Miscellaneous.php3\
	ml-headers.gif\
	online-offline-evo.png\
	openoffice-icon.png\
	OpenOffice.org.php3\
	OpenOffice-slidepane.gif\
	panel-calendar.png\
	publish_calendar.png\
	readme.png\
	send_file-anim-mockup.gif\
	send_file_single.gif\
	set-as-wallpaper.png\
	smiley.gif\
	suncloud.png\
	tasks-icon.png\
	Tasks.php3\
	timezone.png\
	util.php\
	dhtml-table.js

PHP3FILES := $(patsubst %.php3, %.html, $(wildcard ./*.php3))
                                                                                                                  
page_SCRIPTS = index.php3 index.html $(PHP3FILES) discuss.html

include $(top_srcdir)/rules.common

EXTRA_DIST=$(page_DATA)

index.php3: build.exe header.php footer.php bounties.xml cat-header.php cat-footer.php util.php Makefile
	mono --debug build.exe
	chmod 644 *.php3
                                                                                                                  
build.exe: build.cs
	mcs -g build.cs -o build.exe
                                                                                                                  
xml2csv.exe: xml2csv.cs
	mcs -g xml2csv.cs -o xml2csv.exe
                                                                                                                  
index.csv: bounties.xml xml2csv.exe Makefile xml2csv.cs
	mono --debug xml2csv.exe
                                                                                                                  
%.html: %.php3 util.php
	@echo Converting $< to $@
	@php -q $< > $@
                                                                                                                  
%.html: %.php util.php
	@echo Converting $< to $@
	@php -q $< > $@

