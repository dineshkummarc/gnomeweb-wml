<?php

include ("./util.php");

?>

<?php write_page_header ("Mailer Bounties"); ?>
<?php write_table_header ("no"); ?>
<?php taskrow ("Set wallpaper from mailer", "hidden", "100", "127514", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22642"); ?>
<?php taskrow ("Implement a panel notification applet for new mail", "hidden", "400", "127516", "http://cvs.gnome.org/viewcvs/evolution/plugins/new-mail-notify/"); ?>
<?php taskrow ("Mailing list actions", "hidden", "500", "127518", "http://cvs.gnome.org/viewcvs/evolution/plugins/mailing-list-actions/"); ?>
<?php taskrow ("Finish NNTP support in Evolution", "hidden", "750", "127519", "http://home.wanadoo.nl/meilof/evolution-nntp-patch-17"); ?>
<?php taskrow ("Inline PGP support for evolution", "hidden", "250", "127521", ""); ?>
<?php taskrow ("Custom mail headers display", "hidden", "200", "127523", "http://lists.ximian.com/archives/public/evolution-patches/2003-December/003697.html"); ?>
<?php taskrow ("Ask user to make Evolution default mail app", "hidden", "100", "127526", ""); ?>
<?php taskrow ("Attachment bar and drag-and-drop in the composer", "hidden", "500", "127527", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004052.html"); ?>
<?php taskrow ("Templates for new messages and replies", "hidden", "500", "127529", ""); ?>
<?php taskrow ("Language selection in composer", "hidden", "400", "127530", ""); ?>
<?php taskrow ("Better smiley substitution in the composer", "hidden", "200", "127533", "http://bugzilla.gnome.org/attachment.cgi?id=21716&action=view"); ?>
<?php taskrow ("Message receipts", "hidden", "500", "127534", "http://lists.ximian.com/archives/public/evolution-patches/2005-April/010399.html"); ?>
<?php taskrow ("Link URLs in the status bar", "hidden", "200", "127536", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/003949.html"); ?>
<?php write_table_footer (); ?>
<?php box_start ("Set wallpaper from mailer", "Mailer", "100", "127514", "127514", "http://bugzilla.gnome.org/showattachment.cgi?attach_id=22642"); ?>


<p>
It would be handy to be able to set the desktop background picture
directly from images displayed in Evolution.
</p>

<p align="center"><img src="set-as-wallpaper.png" alt="" /></p>

<?php box_sec ("How"); ?>

<p>
In em-popup.c there is already a hook for this, but unimplemented (see
emp_part_popup_set_background).  The menu item will automatically be
added to any image or image attachment referenced from a context menu.
The guts merely needs to be implemented.
</p>
<ul>
<li>You have access to the message part in the EMPopupTarget of type EM_POPUP_TARGET_PART of the popup target.
<li>There are message saving routines in em-utils.[ch], although you may need to add a new api
to save to a specific file, if GNOME wont copy a temporary file
<li>You then need to notify the GNOME Desktop of the new backdrop file (how?)
</ul>

<?php box_sec ("Affected Modules"); ?>

<? bonsai ("evolution/mail") ?>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
<p>
GNOME Desktop programming and mailing list information is available on
<a STYLE="text-decoration:none" href="http://developer.gnome.org/">developer.gnome.org</a>
</p>

<?php box_end (); ?>
<?php box_start ("Implement a panel notification applet for new mail", "Mailer", "400", "127516", "127516", "http://cvs.gnome.org/viewcvs/evolution/plugins/new-mail-notify/"); ?>


<p>
An often requested feature has been to have new mail notified via the panel.
</p>

<?php box_sec ("How"); ?>

<p>
There are two parts to this task. The first is to write a panel applet
component for the user interface.  This should be incorporated into
the mail code (as em-panel-applet.c), and it should attempt to insert
itself into the panel notification area when the mailer starts up.
The applet should be started from mail-component-factory.c and be
configurable in the usual manner.
</p>
<p align="center"><img alt="" src="email-notification.gif" /></p>
<p>
The second part is to hook into new mail events.  Currently all new
mail events are routed (from multiple threads) through
mail-folder-cache.c, so it can trivially be hooked up into the appropriate
place in the real_flush_updates function in that file.
</p><p>
This code should also either merge with or replace the current new
mail notification code in mail-folder-cache.c and the preferences
pages.  The original functionality must work if there are no panels running
in the current session and the applet is not started.
</p>

<?php box_sec ("Affected Modules"); ?>

<? bonsai ("evolution/mail"); ?>

<?php box_sec ("Extended functionality"); ?>

<p>
It would be nice to only watch specific folders or stores rather than
all folders.  This could re-use the folder selector widget and
configuration mechanism as used for offline mode selection.  It would
probably be appropriate to support drag and drop of folders from the
folder list onto the applet to add/remove them from the list of
watched folders.
<p>
Another extension would be to use different
colors/methods/sounds to indicate the new mail depending on the
folder/store or priority of the folder.  This is all applet-specific code.
<p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
</p>

<?php box_end (); ?>
<?php box_start ("Mailing list actions", "Mailer", "500", "127518", "127518", "http://cvs.gnome.org/viewcvs/evolution/plugins/mailing-list-actions/"); ?>


<p>Many mailing lists follow <?php rfc(2369); ?> and provide mailing list
information in their email headers.  This information can be used by
mail clients to present mailing list management functions to users.
For example, a mailing list can provide information on unsubscribing
from the list.

<?php box_sec ("How"); ?>

<p>
The RFC gives these actions:
<ul>
<li>Unsubscribe - How to remove yourself from the list.
<li>Subscribe - How to subscribe to the list.  (Helpful for forwarded messages.)
<br><br>
<li>Help - How to get more information about the mailing list.
<li>Owner - The contact information for the list administrator.
<li>Archive - Access to the list archives.
<br><br>
<li>Post - How to post to the list.
</ul>
<p>

Note that the formats of these fields can vary widely and may contain multiple URLs or actions which provide the same result.  Also, there is no reason to expect that a mailing list which includes one or more mailing list headers will include all of them.
<p>
Evolution should provide an interface to these actions.  If any of these headers are present in a message, Evolution should present them in a "List" submenu off the "Actions" menu.  A successful patch to Evolution should follow the usability guidelines mentioned in the RFC.
<p>
The only special action is "Post."  If a mailing list has a "Post" header of "NO" then posting is not allowed on this list.  Replies to this message should only go to the message sender; the "Reply to List" menu item should be disabled.  The "Reply to List" menu item should always follow the "Post" header clue.  <tt>EMFolderView</tt> manages these menus.
<p align="center">
<img alt="" src="ml-headers.gif" /> 
</p>

<?php box_sec ("Affected Modules"); ?>

<p>The mail component, <?php bonsai("evolution/mail"); ?>.</p>

<?php box_sec ("Pointers"); ?>

For Evolution information, join the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a> mailing list.

<?php box_end (); ?>
<?php box_start ("Finish NNTP support in Evolution", "Mailer", "750", "127519", "127519", "http://home.wanadoo.nl/meilof/evolution-nntp-patch-17"); ?>


<p>
Evolution has some initial NNTP (NEWS, or NNRP) support, but it is incomplete.
This task is to fill out the NNTP implementation and provide a
suitable user-interface for managing NNTP sessions.
<p>
This would help us get more adoption of Evolution inside the
OpenOffice team, since they use news for all their internal
discussions.
</p>

<?php box_sec ("Affected Modules"); ?>

<ul>
<li><? bonsai ("evolution/camel/providers/nntp"); ?>, is the existing
NNTP implementation, which should be extended/completed, rather than
being rewritten.
<li><? bonsai ("evolution/mail"); ?>, may need work for handling NNTP addressing.
<li><? bonsai ("evolution/composer"); ?>, similarly.
</ul>

<?php box_sec ("How"); ?>

<p>
The first aim should be to complete the CamelStore and CamelFolder
implementation of the NNTP provider.
<p>
For CamelNNTPStore, the folder list should be stored in a
CamelStoreSummary, which will require writing a CamelNNTPStoreSummary in
the same vein as CamelImapStoresummary.  It should support two modes,
one for a flat '.' separated list of folders, and another implementing
a hierarchy of folders canonicalized into '/' separated paths.
Once complete, offline operation, and the subscription interface can be implemented.
<tt>get_folder_info</tt> must also be finished, currently it doesn't
honor the path or mode arguments.
<p>
CamelNNTPFolder needs to have the append() method
implemented, which will be used to POST messages to the NNTP store.
<p>
The composer already has support for posting to folders, but it may
need additional support for NNTP addressing and cross-posting to NNTP
folders and email addresses.
</p>

<?php box_sec ("Extended functionality"); ?>

<p>CamelNNTPStoreSummary could also interact and cache standard NNTP
folder information into ~/.newsrc, to work with legacy news readers.
</p>

<?php box_sec ("Pointers"); ?>

<p>
The NNTP protocol is described in <?php rfc(977); ?>.  An
additional information RFC, <?php rfc(2980); ?> provides an
overview of commonly implemented NNTP extensions.
<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
</p>

<?php box_end (); ?>
<?php box_start ("Inline PGP support for evolution", "Mailer", "250", "127521", "127521", ""); ?>


<p>
An often requested feature for Evolution is to support inline-pgp
('clearsigned') secure emails, in addition to the PGP-MIME format we
already support.  This will aid interoperability with legacy
secure-mail implementations.
<p>
See bugs <?php bug(17540); ?>, and <?php bug(17541); ?>.
</p>

<?php box_sec ("Affected Modules"); ?>

<ul>
<li><? bonsai ("evolution/mail") ?> will require changes to recognize
inline pgp armoring and for formatting signature info.
<li><? bonsai ("evolution/camel") ?> contains pgp verification code.
</ul>

<?php box_sec ("How"); ?>

<p>
<tt>mail/em-inline-filter.c</tt> already has code (some commented out)
to identify and separate inline pgp messages into separate
CamelMimePart objects.  This needs to be activated, and the content type (in
<tt>emif_types[]</tt> needs to be changed to something unique
(&quot;application/x-inline-pgp&quot; perhaps?).
<p>
<tt>mail/em-format-html-display.c</tt> then needs to be modified to
handle that mime-type (see <tt>type_builtin_table</tt>).  It should use
similar code to <tt>efhd_application_xpkcs7mime</tt> or
<tt>efhd_multipart_signed</tt>, and should share common code where
appropriate.  Some of this code is currently undergoing changes, so
discuss this on the lists first.
<p>
Finally, you need to support this (pseudo) mime-type in
<tt>camel/camel-gpg-context.c:gpg_verify</tt>.  It already has code to
test the mime type of the incoming part, this just needs to be
extended to execute a different code path for the inline-pgp type.  It
may also need additional support in the <tt>gpg_ctx</tt> engine (in
the same file).
</p>

<?php box_sec ("Extended functionality"); ?>

<p>
Allow the sending of ASCII armored PGP (aka inline pgp) messages too.
This requires adding the support for inline signing to
<tt>camel-gpg-context.c</tt>, and passing the option to it from the
security configuration page via the composer signing code in
<tt>composer/e-msg-composer.c:build_message</tt>.  See the way
<tt>camel-smime-context.c</tt> implements it's <tt>sign_mode</tt>
option for how this should be done.
</p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
<p>
<?php rfc(2298); ?> contains details of the OpenPGP message format,
although much of the detail beyond ASCII armoring (section 6.2)
is not relevant.
</p>

<?php box_end (); ?>
<?php box_start ("Custom mail headers display", "Mailer", "200", "127523", "127523", "http://lists.ximian.com/archives/public/evolution-patches/2003-December/003697.html"); ?>


<p>As in <?php bug(1186); ?>, it would be nice to configure the header
display to show different default headers, merely as a convenience to
users.</p>

<p align="center">
<img border=0 src="mail-custom-header.png" alt="">
</p>

<?php box_sec ("Affected Modules"); ?>

<p>
Various files in <? bonsai ("evolution/mail"); ?>.
</p>

<?php box_sec ("How"); ?>

<p>
EMFormat already has api for setting which headers are displayed
by default, so most of the backend work is already done.  What is
required is a GUI for configuring the options, and glue to store the
options.
<p>
The configuration GUI should be a new tab on the Mailer Settings page.
A new tab should be created in the glade file
<? bonsai ("evolution/mail/mail-config.glade"); ?>, and hooked into
<? bonsai ("evolution/mail/em-mailer-prefs.c"); ?>, and it should store
the options in a gconf key under &quot;/apps/evolution/mail/display&quot;, for
example <b>&quot;headers&quot;</b>.  The key should be a simple string
array.
<p>
<? bonsai ("evolution/mail/em-folder-view.c"); ?> is used to listen to
configuration changes used by EMFormat, <tt>emfv_setting_notify</tt> needs to
be extended to include the new gconf key to manage the header list.
<p>
A FIXME in
<? bonsai ("evolution/mail/em-format.c"); ?><tt>:emf_format_clone</tt>
needs to be finished to complete the task so the headers displayed are
properly honored for printing and redisplays.
</p>

<?php box_sec ("Extended functionality"); ?>

<p>EMFormat (and EMFormatHTML) also defines properties for each
header (e.g. <b>BOLD LABEL</b>).  These could be added to the
configuration page and configuration key, and even extended.
</p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
</p>

<?php box_end (); ?>
<?php box_start ("Ask user to make Evolution default mail app", "Mailer", "100", "127526", "127526", ""); ?>

<p>It would be nice if Evolution would prompt the user if he or she would like to set
Evolution as the default "mailto:" handler for GNOME if:</p>
<ul>
<li>it is the first time the user has run Evolution</li>
<li>the default mailto handler gconf setting is unset</li>
</ul>

<?php box_sec ("Affected Modules"); ?>

<p>The only affected module will be <? bonsai ("evolution/mail"); ?></p>

<?php box_sec ("How"); ?>

<p>The best place to add this code is probably in <? bonsai ("evolution/mail/mail-component.c"); ?><tt>:mail_component_init</tt>
right after all the initialization happens.</p>
<p>You'll need to pop up a GtkDialog (probably a Yes/No; defaulting to Yes?)
with the prompt: "Would you like to make Evolution your default mail
application?". The setting should be saved to the gconf key
"/desktop/gnome/url-handlers/mailto"</p>

<p>You will probably also want to add a checkbox to the dialog to allow the
user to opt-out of ever seeing the dialog again. You will have to create a
new gconf key for this preference, probably something like
"/apps/evolution/mail/prompts/default_mailer" or some such.</p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.
</p>

<?php box_end (); ?>
<?php box_start ("Attachment bar and drag-and-drop in the composer", "Mailer", "500", "127527", "127527", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/004052.html"); ?>

<p>
Currently, to drag and drop a file into an Evolution message, you
must drop it outside the message body. To make it easier to
attach files via drag and drop, we would like to make the attachments
bar more visible.
</p>

<?php box_sec ("How"); ?>

<p>
<img alt="attachments bar mockup" src="composer-attachments.gif" />
</p>

<p>
First you will need to add an arrow widget with a label saying
&quot;Show/Hide Attachments Bar (drop attachments here)&quot;. When
the arrow is pressed it should show/hide the attachment bar as shown
in the animation.
</p>

<p>
When you drag a file over that arrow or label, the attachment bar
should be shown. Note that an <u>A</u> accelerator (M-a) should toggle
the attachment bar visibility. The direction of the arrow widget
should change depending on the attachment bar visibility.
</p>

<p>
Once there are files attached, it will be indicated on the right side
by an attachment icon and a label saying: &quot;%d File(s)
Attached&quot;, where %d will be substituted by the number of attached
files to that message (as shown in the animation).
</p>

<?php box_sec ("Affected Modules"); ?>
<p>
This will require work in Evolution's composer (<?php
bonsai("evolution/composer");?>), which is part of the Mailer
component. You will need an understanding of Gtk+ and especially of
Gtk's drag-and-drop API.
</p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list for the Mailer. Larry Ewing
&lt;<a STYLE="text-decoration:none" href="mailto:lewing@ximian.com">lewing@ximian.com</a>&gt; and
Radek Doulik &lt;<a STYLE="text-decoration:none" 
href="mailto:rodo@ximian.com">rodo@ximian.com</a>&gt; might help you
with composer knowledge as well.
</p>

<?php box_end (); ?>
<?php box_start ("Templates for new messages and replies", "Mailer", "500", "127529", "127529", ""); ?>

<p>
We would like to allow people to prepare their own message
templates. The templates will be stored in a Templates folder and may
contain patterns which will be substituted when the template is used.
</p>

<?php box_sec ("How"); ?>

<p>
First you will need to add a new special folder, named Templates to
the local mail folders tree (~/.evolution/mail/local). That folder
will act similar to the Drafts folder, except that it will not delete
the message template when writing of the new message/reply is sent (or
saved as a Draft).
</p>

<p>
The Action submenu in the menubar and the context popup menu in the
message list of the Templates folder will contain additional items
&quot;Default New Mail&quot; and &quot;Default Reply&quot;. When
activated, that template will become the default template which will
be used when composing a new message or replying to a message,
respectively. A &quot;Reset templates&quot; item should reset the
templates so that no template, but the original reply and new message
code will be used. In the other folders, the menubar items should be
grayed out and items should not appear in the popup menu.
</p>

<p>
Next you have to implement substitution patterns. These will be
substituted by common information like &quot;Me&quot; for user's used
account mail address, &quot;Sender&quot; for sender of a mail you are
replying to, &quot;Date&quot;, &quot;Received&quot; and so on. These
should be available in the composer's menus. The mailer component
should substitute these when formatting a reply or a new message. The
composer menu will have a &quot;Save Template&quot; item, which will
save the current message to the Templates folder. The patterns should have
the case-insensitive format: ${Me}, ${Sender}, ${Date}, ...
</p>

<?php box_sec ("Affected Modules"); ?>
<p>
This will require work in Evolution's composer (<?php
bonsai("evolution/composer");?>), which is part of the Mailer
component. You will also need to know GtkHTML editor control API
(<?php bonsai("gtkhtml");?>).
</p>

<?php box_sec ("Pointers"); ?>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list for the Mailer. Larry Ewing
&lt;<a STYLE="text-decoration:none" href="mailto:lewing@ximian.com">lewing@ximian.com</a>&gt; and
Radek Doulik &lt;<a STYLE="text-decoration:none" 
href="mailto:rodo@ximian.com">rodo@ximian.com</a>&gt; might help you
with GtkHTML knowledge.
</p>

<?php box_end (); ?>
<?php box_start ("Language selection in composer", "Mailer", "400", "127530", "127530", ""); ?>


<p>Add a pop-up menu to the composer toolbar for selecting the
language. This would affect the default spell-checking dictionary, the
"On DATE, PERSON said:" attribution, the Content-Language header, and
various other things. See <?php bug(10577); ?> for more details.</p>

<?php box_sec ("How"); ?>
<p>
<img alt="toolbar mockup" src="composer-lang.gif" />
</p>
<p>Add a pop-up menu to the toolbar. (Maybe using the flag icons from
the keyboard layout applet?) Add hooks to update the choice of
spell-check language, etc, as appropriate. Turn the strings like the
reply attribution and "Forwarded Message", etc, into special objects
so that they can be dynamically translated (the same way the signature
changes when you select a new one).</p>
<p>The user should be able to configure what languages appear in the
pop-up, and which is the default. If you receive a message with a
Content-Language header indicating a specific language, then the
composer should start with that language selected by default.</p>
<p>The switching should be implemented in a similar fashion
to the current signature switching code using gtkhtml private data.
And the current setting of the language should be exposed to the
composer through a bonobo property on the editor control.  The setting
should also be saved in the html output in a lang attribute on the
body element. 
<?php box_sec ("Affected Modules"); ?>
This will require work in <?php bonsai("gtkhtml");?> particularly the
editor component (<?php bonsai("gtkhtml/components/html_editor");?>) and
parts of the Mailer component (<?php bonsai("evolution/composer");?>)
<?php box_sec ("Pointers");?>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.    Larry Ewing &lt;<a STYLE="text-decoration:none" 
href="mailto:lewing@ximian.com">lewing@ximian.com</a>&gt; and Radek
Doulik &lt;<a STYLE="text-decoration:none" href="mailto:rodo@ximian.com">rodo@ximian.com</a>&gt;
will be the primary contacts on the list for GtkHTML.
Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list for the Mailer.
<?php box_end (); ?>
<?php box_start ("Better smiley substitution in the composer", "Mailer", "200", "127533", "127533", "http://bugzilla.gnome.org/attachment.cgi?id=21716&action=view"); ?>


<p>Make automatic smiley substitution easier to work around when enabled</p>

<?php box_sec ("How"); ?>
<p align="center"><img alt="" src="smiley.gif" /></p>
<p>Currently the when smiley substitution is on in the editor there
is no easy way to reverse the substitution.  Modify the behavior such
that if the user hits backspace while the cursor is on a smiley the 
first time the substitution is undone, but the smiley text remains.</p>
<?php box_end (); ?>
<?php box_start ("Message receipts", "Mailer", "500", "127534", "127534", "http://lists.ximian.com/archives/public/evolution-patches/2005-April/010399.html"); ?>


<p><?php rfc(2298); ?> describes a standard method for clients to
request a "Message Disposition Notification" (aka "Read Receipt") from
the recipient indicating that they have received the message.</p>

<?php box_sec ("Affected Modules"); ?>

<p>The mailer (<?php bonsai("evolution/camel"); ?>, <?php
bonsai("evolution/mail"); ?>, and <?php bonsai("evolution/composer");
?>).</p>

<?php box_sec ("How"); ?>

<p>Supporting this in Evolution would require the following things:</p>

<ul>
<li> Add an option to the composer for "Request a Read Receipt
for this Message" (or something like that). This would always
default to being off. Make the composer generate proper MDN request
headers if the option is turned on. </li>
<li> Add code to the mailer to recognize MDN requests and generate
MDNs, according to the rules in <?php rfc(2298); ?> and <?php
rfc(3503); ?>.  This would probably sit in em-folder-view somewhere.</li>
<li> Add configuration options allowing the user to configure when
MDNs should be returned. There should at least be options for
"Never", "Always", and "Ask each
time". The default should be either "Never" or
"Ask". </li>
<li> Create the dialog box to be used in the "Ask" case.
</li>
</ul>

<?php box_sec ("Pointers"); ?>

For Evolution information, join the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a> mailing list. Michael Zucchi &lt;<a STYLE="text-decoration:none" 
href="mailto:notzed@ximian.com">notzed@ximian.com</a>&gt; and Jeffrey
Stedfast &lt;<a STYLE="text-decoration:none" href="mailto:fejj@ximian.com">fejj@ximian.com</a>&gt;
will be the primary contacts on the list.

<?php box_end (); ?>
<?php box_start ("Link URLs in the status bar", "Mailer", "200", "127536", "127536", "http://lists.ximian.com/archives/public/evolution-patches/2004-January/003949.html"); ?>


<p>Evolution should make URLs embedded in emails visible to the user.
When the user tabs to, or hovers the mouse over a link in an email,
Evolution should show the selected URL in the status bar.

<p>The URLs should be displayed in a friendly way to the user.  For
example, "mailto:foo@bar.com" should display: "Click to send mail to
foo@bar.com".  Other URLs, like "http://www.foobar.com/", should
display the message: "Click to open http://www.foobar.com/".

<p>The URL could be shown in the status bar.  However, the message
window does not yet have an associated status bar.  The message window
would need a status bar in order to work correctly.

<p align="center">

<img alt="" src="evo-tooltip.png" />

</p>

<?php box_sec ("Affected Modules"); ?>

<p>This bounty requires changes to the mailer and shell.</p>

<?php box_sec ("Pointers"); ?>

<p>The GtkHTML widget emits an <tt>on_url</tt> signal when the user
mouses over a URL. <?php bug(3383); ?> has some more discussion of
this bug (though some of it may be specific to APIs that are changing
in 2.0).</p>

<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
