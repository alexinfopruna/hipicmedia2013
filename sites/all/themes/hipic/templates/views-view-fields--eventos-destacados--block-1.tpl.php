<?php
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>



<?php /*
<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php echo "*** ".$id." *** ".print $field->content." +++<br/> "; ?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; ?>
  -------------------------------------------------------------------
*/ ?>
<?php //$categoria= $row->field_field_evento_categoria[0]['raw']['taxonomy_term']->field_color['und'][0]['safe_value']?>
<?php $categoria= $row->field_field_evento_categoria[0]['raw']['tid']?>


<div class="mini-calend shadow evento-categoria-<?php echo $categoria ?>" style="background-image:url(/<?php echo $directory ?>/css/img/eventos/mini_calend_<?php echo $categoria ?>.png)">
	<b class="mini-calend-cap"><?php echo  $fields['field_event_date_2']->content;?></b>
	<div class="mini-calend-cos"><?php echo  $fields['field_event_date_1']->content;?></div>
</div>
<b><?php echo  $fields['title']->content;?></b>
<?php echo  $fields['body']->content;?>
<div class="cb"></div>




