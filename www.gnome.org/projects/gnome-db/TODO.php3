<?php

require('include/html.php3');

html_begin_doc('TODO List');
?>

<CENTER><h2>TODO List</h2></CENTER>
<p>
  This is intended to be a list of things to do as well as a wishlist,
  for users to be able to suggest features they think should go into the
  whole suite.
</p>
<ul>
  <li>Finish Sybase, LDAP and Interbase providers</li>
  <li>Migrate all the current providers to make use of the new gda-server library</li>
  <li>Add more and more providers: mSQL, Informix, dBase, GNU SQL Server, ...</li>
  <li>Add Perl/Python/Pascal (or any other language) bindings for the client libraries</li>
  <li>Write a complete user guide</li>
  <li>Create Debian packages</li>
</ul>
<p>
  If you think something is missing in the suite, please
  <B><a href="mailto:rmoya@chez.com?SUBJECT=GNOME-DB TODO">email us</a></B> and
  tell us about it. We may include it in future releases... Or if you think
  you can help us on one of these issues, please also get in touch!
</p>

<?php
html_end_doc();
?>