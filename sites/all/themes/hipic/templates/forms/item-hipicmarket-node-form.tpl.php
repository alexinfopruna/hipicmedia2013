<div class="fl">
<?php

  print drupal_render($form['field_categor_as']);
    ?>
</div>
<div class="fl">
  <?php 
  print drupal_render($form['title_field']);
  //dpm($form);

  print drupal_render($form['name_field']);
  print drupal_render($form['field_apellidos']);
  print drupal_render($form['field_email']);
  print drupal_render($form['field_direccion']);
  print drupal_render($form['field_ciudad']);
  print drupal_render($form['field_provincia']);
  print drupal_render($form['field_c_postal']);
  
  print drupal_render($form['body']);
  print drupal_render($form['field_image']);

  ?>
</div>

<div id="form-animal" class="">

  <?php

  print drupal_render($form['field_nombre_del_animal']);
  print drupal_render($form['field_edad_del_animal']);
  print drupal_render($form['field_talla_animal']);
  print drupal_render($form['field_raza_del_animal']);
  print drupal_render($form['field_sexo_del_animal']);
  print drupal_render($form['field_capa']);
  //print drupal_render($form['field_']);
  ?>
</div>
  <div id="form-accesorio" >
  <?php 
  print drupal_render($form['field_art_culo']);
  print drupal_render($form['field_marca']);
  print drupal_render($form['field_modelo']);
  print drupal_render($form['field_antig_edad']);
  ?>
    
  </div>
  
  <div id="form-market-final">
  <?php 
  
  print drupal_render($form['field_disciplina']);
  print drupal_render($form['field_categoria_otros']);
  print drupal_render($form['field_preu']);
  print drupal_render($form['field_observaciones']);
  
  ?>
  </div>
  
  <div id="form-market-botones">
  <?php 
  print drupal_render_children($form);
  ?>
  </div>
</div>
