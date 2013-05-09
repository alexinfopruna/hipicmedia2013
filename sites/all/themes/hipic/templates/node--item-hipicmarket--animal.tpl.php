<!-- JUAN: 
ESTAS CAJAS SON PARA MOSTRARTE LAS VARIABLES. LA PUEDES BORRAR<br/> -->
<?php //foreach ($content as $key => $value) print '<div class="debug-var">print render($content["'.$key.'"])'. render($value).'</div>'?>

<?php
/**
 * @file
 * Zen theme's implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   - view-mode-[mode]: The view mode, e.g. 'full', 'teaser'...
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $pubdate: Formatted date and time for when the node was published wrapped
 *   in a HTML5 time element.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content. Currently broken; see http://drupal.org/node/823380
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess_node()
 * @see template_process()
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>

      <?php if ($unpublished): ?>
        <p class="unpublished"><?php print t('Unpublished'); ?></p>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    //print render($content);
  ?>
  
  <div class="col-first">
  	<?php print render($content['body']) ?> <br/>
    <?php print render($content["field_image"]) ?> <br />
    <!-- 
     <div class="hipic_animal_left"><div style="float:left"><?php print render($content["field_image"]) ?></div><div class="hipic_animal_right"><?php print render($content["field_image"]) ?></div></div>
     -->
  </div>
  <div class="col-last">
  	<div class="row">
  	<?php 
  	/*
  	 * RENDER!!!!
  	 * 
  	 * print drupal_render(field_view_field('node', $node, 'field_zipcode'));
  	 * 
  	 */
  	?>
        <div class="hipicmarket_animal_1">
            <div class="campos_form"><label><?php print t('Nombre') ?></label></div> <div class="fake-input"><?php print render($content['field_nombre_del_animal']); ?></div>
        </div>
        </div>
     <div class="row">
        <div class="hipicmarket_animal_1">    
            <div class="campos_form"> <label><?php print t('Edad') ?></label> </div><div class="fake-input"><?php print render($content['field_edad_del_animal']); ?></div>
        </div>
        <div class="hipicmarket_animal_1">
	  <div class="campos_form"> <label><?php print t('Talla') ?></label></div> <div class="fake-input"><?php print render($content['field_talla_animal']); ?></div>
      </div>
	</div>
    
   	<div class="row">
   	   
      <div class="hipicmarket_animal_1">
      <div class="campos_form"><label><?php print t('Raza') ?></label> </div><div class="fake-input"> <?php print render($content['field_raza_del_animal']); ?> </div>
      </div>   
	</div>
    
  	<div class="row">
    <div class="hipicmarket_animal_1">
	   <label><?php print t('Gender') ?></label> 
	   <?php 
	   $state = '';
	   ?>
	   <ul>
	     <?php $state = ($variables['field_sexo_del_animal'][0]['taxonomy_term']->tid == 94) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Male') ?></li>
	     <?php $state = ($variables['field_sexo_del_animal'][0]['taxonomy_term']->tid == 95) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Female') ?></li>
	     <?php $state = ($variables['field_sexo_del_animal'][0]['taxonomy_term']->tid == 96) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Castrated') ?></li>
	   </ul>
       </div>
       </div>
    <div class="row">
   		 <div class="hipicmarket_animal_1">
       	   <label><?php print t('Fur') ?></label> 
	   <?php 
	   $state = '';
	   ?>
	   <ul>
	     <?php $state = ($variables['field_capa'][0]['taxonomy_term']->tid == 41) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Gray') ?></li>
	     <?php $state = ($variables['field_capa'][0]['taxonomy_term']->tid == 43) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Black') ?></li>
	     <?php $state = ($variables['field_capa'][0]['taxonomy_term']->tid == 44) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Bay') ?></li>
	     <?php $state = ($variables['field_capa'][0]['taxonomy_term']->tid == 42) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Chestnut') ?></li>
	     <?php $state = ($variables['field_capa'][0]['taxonomy_term']->tid == 45) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Sorrell') ?></li>
	     <?php $state = ($variables['field_capa'][0]['taxonomy_term']->tid == 46) ? $state = 'active' : $state = ''; ?>
	   	 <li class="<?php print $state; ?>"><?php print t('Pio') ?></li>	   	 
	   </ul>
       </div>
	</div>
    
  	<div class="row">
    <div class="campos_form">
	   <label><?php print t('Disciplina') ?></label></div>
       <div class="hipicmarket_animal_1"><div class="fake-input">
	   <?php 
	   $state = print render($content["field_disciplina"]);

	   ?></div></div>
     </div>
     <div class="row">
     <div class="hipicmarket_animal_1">
	  <div class="fake-input"><?php print render($content['field_preu']);?></div>
      </div>
	</div>
  	<div class="row">
    
      <div class="hipicmarket_animal_observaciones">
	  <div class="campos_form"> <label><?php print t('Comments') ?></label> </div><div class="fake-input"><?php print render($content['field_observaciones']);?></div>
	</div>
	</div>
  	  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</article><!-- /.node -->
<div class="node-article-footer">

  <?php
  //print render();	
  print l($content['field_email'][0]['#markup'],'mailto:'.$content['field_email'][0]['#markup'],array('attributes' => array('target'=>'_blank')));
  
  print render($socials);?>
</div>

<div class="h2_hipicmarket"><h2>HipicMarket: <?php print $categoria ?> &gt; <?php print $sexo ?></h2></div>

<?php print $lista_hipicmarket;?>
