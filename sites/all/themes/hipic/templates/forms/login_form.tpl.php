<div class="h2-login"><?php print t('Access')?></div>
<div class="h1-login"><?php print t('User & HipicMarket')?></div>
<?php
  print drupal_render($form['name']);
  print drupal_render($form['pass']);

?>

<div class="login-footer">

<ul>
	<div class="login_links_footer">
  <li><?php print l(t('Without account? Register'),'user/register'); ?></li>
  <li><?php print l(t('Forgot your password? Click here'),'user/password'); ?></li>
  </div>
<?php 
  hide($form['links']);
  print drupal_render_children($form);
?>
</ul>
</div>
  