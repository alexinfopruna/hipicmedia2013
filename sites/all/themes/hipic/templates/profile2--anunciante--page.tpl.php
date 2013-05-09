<div id="portal-detalle-empresa-tabs">

<div id="tabs-1" class="portal-detalle-empresa">
        <h2><?php print render($content['field_nombre_de_la_empresa']) ?></h2>
  <div class="empresa-col1 fl">
      <div class="fl">
        <?php print render($content['field_imagen']) ?>
      </div>
      <div class="empresa-direccion">
      <?php print render($content['field_direccion']) ?>
      <?php print render($content['field_ciudad']) ?>
      <?php print render($content['field_provincia']) ?>
      <?php print render($content['field_pais_apoderado']) ?>
      <?php print render($content['field_codigo_postal']) ?>
      </div>

    <div class="empresa-content cb">
      <?php print render($content['field_descripcion_empresa']) ?>
    </div>
    <div class="empresa-peu">
      <?php print render($content['field_direcci_n_web']) ?>
    </div>


  </div>
  <div class="empresa-col2 sepia">
    <h4><?php print t('INFORMATION') ?></h4>
    <hr/>
    <div class="empresa-sector">
      <?php 
        //$fields['field_sector']->content=str_replace(",","",$fields['field_sector']->content);
      ?>
            <?php print render($content['field_sector']);
            //print "<br/>";
            print "  ".render($content['field_sector_otro']);
            ?>

    </div>
    <?php if ($content['field_correo_electr_nico']): ?>
      <div class="empresa-email">
        <?php print render($content['field_correo_electr_nico'])?>
      </div>
    <?php endif; ?>
    <?php if ($content['field_tel_fono']): ?>
      <div class="empresa-tel">
        <?php print render($content['field_tel_fono']) ?>
      </div>
    <?php endif; ?>
    <?php if ($content['field_tel_fono_2']): ?>
      <div class="empresa-tel2">
        <?php print render($content['field_tel_fono_2']) ?>
      </div>
    <?php endif; ?>
    <div class="empresa-info-peu">
      <div class="empresa-fb fl">
        <?php
          $fb_url = $content['field_facebook']['#items'][0]['url'];
          if ($fb_url):
            print l('<img src="/'.drupal_get_path('theme', 'hipic').'/css/img/footer_facebook.png"/>', $fb_url, array('attributes' => array('class' => 'anchor-class', 'target' => '_blank'), 'html' => TRUE));
          endif;
          ?>
      </div>
      <div class="empresa-twit">
        <?php
          $tw_url = $content['field_twitter']['#items'][0]['url'];
          if ($tw_url):
            print l('<img src="/'.drupal_get_path('theme', 'hipic').'/css/img/footer_twitter.png"/>', $tw_url, array('attributes' => array('class' => 'anchor-class', 'target' => '_blank'), 'html' => TRUE));
          endif;
        ?>
      </div>
    </div>
    <div class="cb"></div>  

  </div>
</div>
<?php 
  $uid = arg(1);
  $account = user_load($uid);
  $profile = profile2_load_by_user($account,'anunciante_articulos_descuentos');
  ?>
<div id="tabs-2" class="portal-articulos-descuentos">
    <div id="portal-articulos">
    <?php 
      if ($profile) {
        print drupal_render(field_view_field('profile2', $profile, 'field_art_culos', 'value'));
      }
    ?>
    </div>
    <div id="portal-descuentos">
    <?php 
      //print drupal_render(field_view_field('profile2', $profile, 'field_descuentos', 'value'));
      
    $page='block';
    $que_vista='descuentos';
    
    $view = views_get_view($que_vista);
    $view->set_current_page($page);
    //$arguments=array($uid); //@todo
    //$view->set_arguments($arguments);
    $vista = $view->preview('block_1');
    print $vista;
    ?>
    </div>
    
</div>

    <ul>
        <li><a href="#tabs-1"><?php print t('Company');?></a></li>
        <li><a href="#tabs-2"><?php print t('Articles & Discounts')?></a></li>
    </ul>    

</div>
