<?php
print render($content);
//drupal_add_js('hm.localhost/sites/all/libraries/jwplayer/');
?>	

<script type="text/javascript">
/*
		file: 'http://www.youtube.com/watch?v=hRz-M30PcEU',
*/
alert("NODE");
		jwplayer("jwplayer-video").setup({
		width: 640,
		height: 390,
		'controlbar.position': 'bottom',
		provider: '/<?php print libraries_get_path('jwplayer');?>/vimeoprovider.swf',
		file: 'http://vimeo.com/19122850',

		'vimeoprovider.hide_watch_later_button': true,
		'vimeoprovider.hide_like_button': true,
		'vimeoprovider.hide_playbar': true,
		modes: [
		{ type: "flash", src: '/<?php print libraries_get_path('jwplayer');?>/player.swf' },
		{ type: "html5" }
		]
		});	
</script>

