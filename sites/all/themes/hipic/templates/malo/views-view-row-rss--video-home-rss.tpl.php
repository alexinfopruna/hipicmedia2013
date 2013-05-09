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
    <title at="<?php print $variables; ?>"><?php print $title; ?></title>
    <link><?php print $link; ?></link>
	<media:content url="<?php print file_create_url($field[0]['uri']); ?>" />
	<description>JWPlayer</description>
  </item>  

  <?php
 

// $field = field_view_field('node', $node, 'field_video_file');
// $output = field_view_value('node', $node, 'field_video_file', $field[0]);
  //print_r($page);
  //print_r($node);
  //file_create_url();  
?>