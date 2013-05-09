<?php
/**
 * @file views-view-row-rss.tpl.php
 * Default view template to display a item in an RSS feed.
 *
 * @ingroup views_templates
 */
$nid= $row->nid;
$node = node_load($nid);
$field = field_get_items('node', $node, 'field_video_file');
 
 
?>
  <item>
    <title at="<?php  if (!is_array($variables)) print $variables; ?>"><?php print $title; ?></title>
    <link><?php  if (!is_array($link)) print $link; ?></link>
	<media:content url="<?php print file_create_url($field[0]['uri']); ?>" />
	<description>JWPlayer</description>
  </item>  