<?php

require('include/html.php3');
require('include/news.php3');

html_begin_doc('News');
?>

<CENTER><h2>News</h2></CENTER>
<P>
  This is the official GNOME-DB project's ChangeLog.
</P>
<?php

news_show_latest(0);
html_end_doc();

?>