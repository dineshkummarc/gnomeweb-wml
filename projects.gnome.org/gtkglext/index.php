<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
class RSS2Image
{
    var $url = "";
    var $title = "";
    var $link = "";
    var $width = "";
    var $height = "";
}

class RSS2Item
{
    var $title = "";
    var $link = "";
    var $description = "";
    var $author = "";
    var $category = "";
    var $comments = "";
    var $enclosure = "";
    var $guid = "";
    var $pub_date = "";
    var $source = "";
}

class RSS2Channel
{
    var $title;
    var $link;
    var $description;
    var $copyright;
    var $last_build_date;
    var $generator;
    var $image;
    var $items;

    function RSS2Channel()
    {
        $this->title = "";
        $this->link = "";
        $this->description = "";
        $this->copyright = "";
        $this->last_build_date = "";
        $this->generator = "";
        $this->image = null;
        $this->items = array();
    }
}

class RSS2ParseInfo
{
    var $channel;

    var $in_channel, $in_image, $in_item;
    var $current_element;
    var $current_element_name;
    var $current_item;

    function RSS2ParseInfo()
    {
        $this->in_channel = false;
        $this->in_image = false;
        $this->in_item = false;
        $this->current_item = null;
    }

    function start_element($parser, $name, $attribs)
    {
        $name = strtolower($name);
        if ($name == "channel") {
            $this->in_channel = true;
            $this->channel = new RSS2Channel();
            return true;
        }

        if ($this->in_channel) {
            if ($name == "image") {
                $this->in_image = true;
                $this->channel->image = new RSS2Image();
                return true;
            } elseif ($name == "item") {
                $this->in_item = true;
                $this->current_item = new RSS2Item();
                $this->channel->items[] = &$this->current_item;
                return true;
            }
        }

        $this->current_element_name = $name;
        return true;
    }

    function end_element($parser, $name)
    {
        $name = strtolower($name);
        if ($name == "channel") {
            $this->in_channel = false;
        } elseif ($name == "image") {
            $this->in_image = false;
        } elseif ($name == "item") {
            $this->in_item = false;
            unset($this->current_item);
        }
        unset($this->current_element);
        unset($this->current_element_name);
        return true;
    }

    function character_data($parser, $data)
    {
        if (isset($this->current_element_name)) {
            if ($this->in_item) {
                if ($this->current_element_name == "title") {
                    $this->current_item->title .= $data;
                } elseif ($this->current_element_name == "description") {
                    $this->current_item->description .= $data;
                } elseif ($this->current_element_name == "link") {
                    $this->current_item->link .= $data;
                }
            }
        }
        return true;
    }
}

function get_feed($filename, $uri)
{
    if (((time() - filemtime($filename)) / 60) > 30) {
        if (!file_exists($filename)) {
            touch($filename);
        }
        $feed = file_get_contents($uri);
        $file = fopen($filename, "w");
        fwrite($file, $feed);
        fclose($file);
    }
    return file_get_contents($filename);
}

function parse($feed, $parse_info)
{
    $xml_parser = xml_parser_create();
    xml_set_object($xml_parser, &$parse_info);
    xml_set_element_handler($xml_parser,
                            "start_element",
                            "end_element");
    xml_set_character_data_handler($xml_parser,
                                   "character_data");
    xml_parse($xml_parser, $feed);
    xml_parser_free($xml_parser);
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>GTK+ OpenGL Extension - About</title>
  <link href="content" rel="stylesheet" />
  <link href="site" rel="stylesheet" />
</head>
<body>
<div id="container">
  <div id="header">
    <!-- Logo -->
    <h1>GTK+ OpenGL Extension - About</h1>
    <!-- Navigation Bar -->
    <ul id="nav">
      <li><a class="current" href="index">About</a></li>
      <li><a href="features">Features</a></li>
      <li><a href="download">Download</a></li>
      <li><a href="sshots">Screenshots</a></li>
      <li><a href="doc">Documentation</a></li>
      <li><a href="devel">Development</a></li>
    </ul>
  </div>
  <div id="content">
    <h2>Overview</h2>
    <p>GtkGLExt is an <a href="http://opengl.org">OpenGL</a> extension
    to <a href="http://gtk.org">GTK+</a>. It provides additional GDK
    objects which support OpenGL rendering in GTK+ and GtkWidget API
    add-ons to make GTK+ widgets OpenGL-capable. In contrast to Janne
    L&ouml;f's GtkGLArea, GtkGLExt provides a GtkWidget API that
    enables OpenGL drawing for standard and custom GTK+ widgets. Like
    GTK+ itself, GtkGLExt is licensed under
    the <a href="http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html">GNU
    LGPL 2.1</a>.</p>

    <p>GtkGLExt has a mature API used in
    many <a href="users">projects</a> to satisfy the need for GTK+ and
    OpenGL integration.</p>

    <p>GtkGLExt was originally written by Naofumi Yasufuku (安福 尚文).
    It is currently maintained by
    <a href="mailto:stephane@stephanebrunet.net">St&eacute;phane Brunet</a>,
    <a href="mailto:rc040203@freenet.de">Ralf Cors&eacute;pius</a>, and
    <a href="mailto:braden@endoframe.com">Braden McDaniel</a>.</p>

    <h2>News</h2>
<?php
$feed = get_feed("../persistent/rssfeeds/projnews.rss", "http://sourceforge.net/export/rss2_projnews.php?group_id=54333&rss_fulltext=1");
$parse_info = new RSS2ParseInfo();
parse($feed, &$parse_info);
$i = 0;
foreach ($parse_info->channel->items as $item) {
    if (++$i > 3) { break; }
    echo "    <h3>$item->title</h3>\n";
    echo "    <p>$item->description</p>\n";
}
?>
  </div>
  <div id="footer">
    <a href="http://sourceforge.net/projects/gtkglext"><img src="http://sflogo.sourceforge.net/sflogo.php?group_id=54333&type=10" width="80" height="15" border="0" alt="SourceForge.net" title="Get GtkGLExt at SourceForge.net. Fast, secure and Free Open Source software downloads" /></a>
  </div>
</div>
</body>
</html>
