<?php
/**
 * @file
 * Display the JW Player.
 *
 * Variables available:
 * - $html_id: Unique id generated for each video.
 * - $width: Width of the video player.
 * - $height: Height of the video player.
 * - $file_url: The url of the file to be played.
 * - $jw_player_inline_js_code: JSON data with configuration settings for the video player.
 * - $poster: URL to an image to be used for the poster (ie. preview image) for this video.
 *
 * @see template_preprocess_jw_player()
 */
?>

<!--
-->
<div class="jwplayer-video">
  <video id="<?php print $html_id ?>" width="<?php print $width ?>" height="<?php print $height ?>" controls="controls" preload="none"<?php if(isset($poster)) : ?> poster="<?php print $poster ?>"<?php endif ?>>
    <source src="<?php print $file_url ?>"<?php if (isset($file_mime)): ?> type="<?php print $file_mime ?>"<?php endif ?> />
  </video>
</div>

<script type="text/javascript">
	var vimeo = <?php print (strpos($file_url,'vimeo.com/')!==FALSE)?'true':'false'; ?>;	
	if (vimeo) 
	{		
		alert("VIMEOOOOOO");
		//jQuery(document).bind("cbox_complete", jwplayer_setup_vimeo);
	}
	else{
		alert("NO VIMEO");
	}
	
	function jwplayer_setup_vimeo(){		
		jQuery(document).unbind("cbox_complete",jwplayer_setup_vimeo);

		jwplayer('<?php print $html_id ?>').setup({
		'controlbar.position': 'bottom',
		provider: '/<?php print libraries_get_path('jwplayer');?>/vimeoprovider.swf',
		autostart: true,
		file: '<?php print $file_url ?>',

		'vimeoprovider.hide_watch_later_button': true,
		'vimeoprovider.hide_like_button': true,
		'vimeoprovider.hide_playbar': true,
		modes: [
		{ type: 'flash', src: '/<?php print libraries_get_path('jwplayer');?>/player.swf' },
		{ type: 'html5' }
		]
		});	

	}
</script>
