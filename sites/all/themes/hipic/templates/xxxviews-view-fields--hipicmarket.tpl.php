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
kkkkkkkkkkkkkkkkkkk
<?php
if (isset($fields['timestamp'])) print $fields['timestamp']->content; 
if (isset($fields['field_image'])) print $fields['field_image']->content; 
if (strstr($fields['field_categor_as']->content,"Accesorios") || (strstr($fields['field_categor_as']->content,"Accesories")))
{
	print $fields['field_art_culo']->content; 
	print $fields['field_marca']->content; 
	print $fields['field_modelo']->content; 
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
?>
<?php

?>