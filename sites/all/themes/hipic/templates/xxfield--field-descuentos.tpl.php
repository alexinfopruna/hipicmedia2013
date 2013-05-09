<?php
print "HOLAAA";
print $content;
// check if field collection is not empty. If content exists, do some stuff.
if (!empty($content['field_descuentos'])) {

  //Your custom wrapper goes here
  print '<div class="collectin-it">';

  //Grab each entity uri (which is basically a field collection item), and load it through entity_load(). The entity type is field_collection_item.
  foreach ($content['field_descuentos']['#items'] as $entity_uri) {
    $a_field_collection_item = entity_load('field_collection_item', $entity_uri);

        //Now you have a variable with the entity object loaded in it, and you can do stuff. 
    foreach ($a_field_collection_item as $a_field_collection_item_object ) {
      print "HOLAAA";
    // print render($a_field_collection_item_object->field_1);
    // print render($a_field_collection_item_object->field_2);
    // print render($a_field_collection_item_object->field_3);
    }

  }

  //close your custom wrapper.
  print '</div>' . "\n"; 
}
?>