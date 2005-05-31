<?php

include ("./util.php");

?>

<?php write_page_header ("Addressbook Bounties"); ?>
<?php write_table_header ("no", "yes"); ?>
<?php taskrow ("Gaim/addressbook identity integration", "hidden", "Novell", "2500", "127513", "http://www.chipx86.com/gevolution/"); ?>
<?php taskrow ("Addressbook/GnomeMeeting integration", "hidden", "Novell", "500", "127515", "http://cvs.gnome.org/viewcvs/gnomemeeting/src"); ?>
<?php taskrow ("Planner (formerly MrProject) integration", "hidden", "Novell", "300", "127520", ""); ?>
<?php taskrow ("Contact search applet", "hidden", "Novell", "750", "127522", "http://www.burtonini.com/computing/contact-lookup-applet-0.4.tar.gz"); ?>
<?php taskrow ("Advanced LDAP Configuration", "hidden", "Novell", "250", "127525", ""); ?>
<?php write_table_footer (); ?>
<?php box_start ("Gaim/addressbook identity integration", "Addressbook", "2500", "127513", "127513", "http://www.chipx86.com/gevolution/"); ?>



<p>Gaim should be able to synchronize its buddy lists with the
Evolution addressbook. You will need to decide the details of this
work and discuss them with the other Gaim and Evolution
developers. Some beginning features:</p>

<ul>
<li>Auto-add buddies to your buddy list if their IM fields exist in  Evolution.</li>
<li>Auto-add buddies to your addressbook when you add them to your buddy list in Gaim. 
<li>Allow a user to select an addressbook entry that corresponds to a
buddy, which will fill the IM field of that addressbook entry. This
might work better if you can use the minicard widget and display a
list of minicards.</li>
<li>For extra credit: Allow the user to drag and drop buddies and
contacts between Gaim and Evolution.</li>
</ul>

<p>When the user clicks on the "Add Buddy" button in Gaim, or selects
the "Add a buddy" menu item, a dialog should appear allowing him to
select someone from his addressbook:</p>

<center>
<img src="IM-addbuddy1.png"><br>
</center>

<p>A separate entry should appear for each IM account a contact has,
so that the user can choose to add someone's AIM account to the buddy
list, for example, but not his Yahoo account.</p>

<p>If the user clicks on the "New Person" button, he gets prompted to
add a new contact and buddy at the same time:</p>

<center>
<img src="IM-addbuddy2.png"><br>
</center>

<p>Entering the contact's IM account information is required.
Entering his contact information is optional.</p>

<p>This same dialog will pop up if the user hits "Select Buddy" for a
contact whose IM information is not available in the Evolution
addressbook.  The user will have the opportunity to fill in the IM
information for that person, which will then be added to the Evolution
addressbook and the buddy list at the same time.</p>

<center>
<img src="IM-addbuddy3.png"><br>
</center>

<p>When "Add Buddy" is clicked, the person's IM account name is added to
the buddy list, and a new contact is added to the Evolution
addressbook.</p>

<?php box_sec ("Affected Modules"); ?>

Both <? bonsai ("evolution"); ?> and <a STYLE="text-decoration:none" href="http://gaim.sf.net/">gaim</a> are affected.

<?php box_sec ("Pointers"); ?>

For Evolution information, join the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">Evolution
Hackers</a> mailing list.  You'll find Gaim resources at <a STYLE="text-decoration:none" 
href="http://gaim.sf.net">the Gaim home page</a>.

<?php box_end (); ?>
<?php box_start ("Addressbook/GnomeMeeting integration", "Addressbook", "500", "127515", "127515", "http://cvs.gnome.org/viewcvs/gnomemeeting/src"); ?>


The desktop environment's central addressbook should be able to store
information about how to reach a given person via videoconferencing.
This involves two tasks:

<ul>
<li>Allow <a STYLE="text-decoration:none" href="http://www.gnomemeeting.org/">GnomeMeeting</a> to store the location information for a user in
the appropriate Evolution addressbook entry.</li><br>

<li>Add UI to the Evolution addressbook to allow a user to open a
videoconference with the contact.</li>
</ul>

<?php box_sec ("How"); ?>
<p>

You'll need to add fields to the Evolution addressbook that can
contain the videoconferencing coordinates for a person.  The <? bonsai
("gnomemeeting"); ?> code will need to be modified to use the
Evolution addressbook as its addressbook store.  </p>

<p>You will also need to add UI to Evolution's addressbook to allow
the user to start a videoconference from a contact.  This may also
require extending GnomeMeeting to enable videoconferences to be
programmatically started, and to create an interface that will report
whether a user is online and accepting videoconference calls.</p>

<?php box_sec ("Affected Modules"); ?>

<? bonsai ("evolution"); ?> and <? bonsai ("gnomemeeting"); ?>.

<?php box_sec ("Pointers"); ?>

Begin with the <a STYLE="text-decoration:none" 
href="http://www.gnomemeeting.org/">GnomeMeeting home page</a> and the
list <a STYLE="text-decoration:none" 
href="http://lists.gnome.org/mailman/listinfo/gnomemeeting-devel-list">gnomemeeting-devel-list@gnome.org</a>.
You'll also want to subscribe to the <a STYLE="text-decoration:none" href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">evolution-hackers</a>
mailing list.

<?php box_end (); ?>
<?php box_start ("Planner (formerly MrProject) integration", "Addressbook", "300", "127520", "127520", ""); ?>


<p>There are lots of things that could be done here, though they might
require some extensions to Evolution:</p>

<ul>
<li>Automatically use the "me" tool from Evolution (see previous challenge).</li>
<li>Choose project resources from your addressbook.</li>
<li>Synchronize with the Evolution tasks (requires the subtask
feature in Evolution, which will probably be available in the Evolution 2.2 time frame.</li>
<li>Do task assignment through iMIP (requires polishing Evolution's task assignment code). </li>
<li>Automatically fill in local task status from iMIP messages received in Evolution.</li>
</ul>

<?php box_sec ("Modules Affected"); ?>
 

Both <? bonsai ("evolution"); ?> and  <? bonsai ("planner"); ?>.

<?php box_sec ("Pointers"); ?>
 

<p>
Start with <a STYLE="text-decoration:none" href="http://www.imendio.com/projects/planner">the Planner
home page</a>. You will need to work with both Planner and Evolution
developers. Both coding and communication skills will be crucial with
this challenge.
</p>

<?php box_end (); ?>
<?php box_start ("Contact search applet", "Addressbook", "750", "127522", "127522", "http://www.burtonini.com/computing/contact-lookup-applet-0.4.tar.gz"); ?>


<p>
A panel applet where you can type in a search term and get matching contact cards. The
applet should reside in its own package, not in Evolution proper.
</p>

<img src="address-applet-anim.gif">

<p>
Once the wanted person is found in the list, one can click on it and the following
popup window is shown with the address card and some relevant action buttons.
</p>

<img src="address-applet-popup.png">

<p>
If the user is not online, one should just display the label as <b>"GFlash is not online."</b>
</p>

<?php box_sec ("How"); ?>

Most of this task revolves around writing a panel applet and GUI. The rest involves contacting
<? bonsai ("evolution-data-server"); ?>, and getting contact information from that. A useful starting point
is <? bonsai ("evolution-data-server/addressbook/libebook"); ?>, and the interfaces you'll find there.

<?php box_end (); ?>
<?php box_start ("Advanced LDAP Configuration", "Addressbook", "250", "127525", "127525", ""); ?>


<p>Evolution can store contacts in an LDAP directory, but there is no way
to tell Evolution exactly where in the directory contact data should
be stored. </p>

<p>For example, user accounts are stored in
<tt>ou=Accounts,dc=gnome,dc=org</tt> but you may want to store the
addressbook in <tt>ou=miguel,ou=AddressBooks,dc=gnome,dc=org</tt>,
another user may want his addressbook in
<tt>ou=nat,ou=AddressBooks,dc=gnome,dc=org</tt>, etc.  Currently,
Evolution just puts things in the root <tt>dn</tt>
(<tt>dc=gnome,dc=org</tt>) which isn't very convenient.</p>

<?php box_sec ("Affected Modules"); ?>

<ul>
<li><? bonsai ("evolution-data-server/addressbook/backends/ldap"); ?><li> and <? bonsai ("evolution/addressbook/gui/component"); ?></ul>

<?php box_sec ("How"); ?>

<p>
There are a few places that need changing for this to work.  An extra
field needs to be added to the LDAP config UI.  It should probably
default to whatever the user typed in for the search base (since
many/most times they will be the same.)
</p>

<p>
The ldap:// URLs we generate will also need to have the additional
argument added to them.  There is no place in the RFC-specified URL
for the value, so they should be added like we already do with
limit/ssl/timeout arguments.  This will require changing code in both
<tt>addressbook-storage.c</tt> and in the <tt>_load_uri method</tt> of
the LDAP backend.
</p>

<p>
Lastly, the <tt>_create_contact</tt> method in the LDAP backend will
need to call <tt>create_dn_from_contact</tt> using the proper creation
root, instead of the rootdn as it does now.
</p>

<p>
You should subscribe to the <a STYLE="text-decoration:none" 
href="http://lists.ximian.com/mailman/listinfo/evolution-hackers">
evolution-hackers</a> mailing list, and discuss any technical issues
there.  Chris Toshok &lt;<a STYLE="text-decoration:none" 
href="mailto:toshok@ximian.com">toshok@ximian.com</a>&gt; and Hans Petter Jansson
&lt;<a STYLE="text-decoration:none" href="mailto:hpj@ximian.com">hpj@ximian.com</a>&gt;
will be the primary contacts on the list.
</p>


<?php box_end (); ?>
<?php write_page_footer (); ?>

</center>
</body>
</html>
