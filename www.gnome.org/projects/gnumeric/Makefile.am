SUBDIRS= new-pics doc images func-tests announcements changelogs style

urlpath=/projects/gnumeric

page_SCRIPTS=index.shtml		\
		contact-info.shtml	\
		downloads.shtml		\
		footer.shtml		\
		header-begin.shtml	\
		header-end.shtml	\
		how-to-help.shtml	\
		mailing-list.shtml	\
		to-do.shtml		\
		credits.shtml		\
		download.shtml		\
		faq.shtml		\
		features.shtml		\
		screenshots.shtml	\
		technology.shtml	\
		function-info.shtml	\
		functions.shtml

include $(top_srcdir)/rules.common

install-exec-hook:
	ls -lR $(pagedir) >$(pagedir)/files
