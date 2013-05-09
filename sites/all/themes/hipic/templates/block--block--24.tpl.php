<?php
/***************************************************/
// VIDEOS VIDEOS
/***************************************************/
/**
 * @file
 * Zen theme's implementation to display a block.
 *
 * Available variables:
 * - $title: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be "block-user".
 *   - first: The first block in the region.
 *   - last: The last block in the region.
 *   - odd: An odd-numbered block in the region's list of blocks.
 *   - even: An even-numbered block in the region's list of blocks.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see zen_preprocess_block()
 * @see template_process()
 * @see zen_process_block()
 */
?>

<?php 
drupal_add_js($GLOBALS['base_url'] . '/sites/all/libraries/jwplayer/jwplayer.js');
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
	//alert('EE <?php print variable_get('jwplayer_autostart')?'true':'false'; ?>');
	  jwplayer('player').setup(
	{
		'flashplayer': '<?php print $GLOBALS['base_url']; ?>/sites/all/libraries/jwplayer/player.swf',
		'id': 'playerID',
		'width': '485',
		'height': '275',
		'backcolor' : 'ffffff',
		'playlistfile': '<?php print $GLOBALS['base_url']; ?>/video-home-rss.xml',
		'controlbar': 'over',
		'repeat': 'always',
		'skin': '<?php print file_create_url(libraries_get_path('jwplayer_skins') . "/$jwplayer_skin/$jwplayer_skin.xml") ?>',

	'image' :  '<?php print $GLOBALS['base_url'] . path_to_theme();?>/images/player_preview.png',
	'stretching' : 'fill',
	'autostart': '<?php print variable_get('jwplayer_autostart')?'true':'false'; ?>'

	  }	
		);
	});
</script>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
	<div id="video-home" name="video-home">
	  <div id="player">Player</div>
	  <div id="text-player-home">

	  <?php print render($title_prefix); ?>
	  <?php if ($title): ?>
		<h3<?php print $title_attributes; ?>><?php print $title; ?></h3>
	  <?php endif; ?>
	  <?php print render($title_suffix); ?>

	  
	<?php print $content; ?></div>
	</div>  
</div><!-- /.block -->
