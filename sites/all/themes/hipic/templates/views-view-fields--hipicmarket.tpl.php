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

<?php
/*
if (isset($fields['timestamp'])) print $fields['timestamp']->content; 
if (isset($fields['field_image'])) print $fields['field_image']->content; 
if (strstr($fields['field_categor_as']->content,"Accesorios") || (strstr($fields['field_categor_as']->content,"Accesories")))
{
	if (isset($fields['field_art_culo'])) print $fields['field_art_culo']->content; 
	if (isset($fields['field_marca'])) print $fields['field_marca']->content; 
	if (isset($fields['field_modelo'])) print $fields['field_modelo']->content; 
}
else
{
	if (isset($fields['field_raza_del_animal'])) print $fields['field_raza_del_animal']->content; 
	if(isset($fields['field_capa'])) print $fields['field_capa']->content; 
	if(isset($fields['field_talla_animal'])) print $fields['field_talla_animal']->content; 
	if(isset($fields['field_edad_del_animal'])) print $fields['field_edad_del_animal']->content." ".t("years"); 
}
if(isset($fields['field_disciplina'])) print $fields['field_disciplina']->content; 

if(isset($fields['field_preu'])) print t('Price').'<span class="preu"> '.$fields['field_preu']->content.'</span>';
*/ 
?>
<?php 
//si es accesorio 
if ($row->field_field_categor_as[0]['raw']['tid']==35) $amaga_camps=array('field-nombre-del-animal','field-sexo-del-animal','field-edad-del-animal','field-edad-del-animal','field-talla-animal','field-capa');
else $amaga_camps=array('field-art-culo','field-marca','field-modelo','field-antig-edad');


foreach ($fields as $id => $field): 

	if (in_array($field->class,$amaga_camps)) continue;
?>
	
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php print $field->content; ?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; ?>