<?php
  $ruta_tema=drupal_get_path('theme', 'hipic'); 
   drupal_add_css($ruta_tema . "/css/hipicportal.css",array('group' => CSS_THEME, 'weight' => 200));

?>
qqqqqqqqqqqqqqqqqqqqqqqqqqqq
<div class="portal-detalle-empresa">
				<h2><?php print $fields['title']->content; ?></h2>
	<div class="empresa-col1 fl">
			<div class="fl">
				<?php print $fields['field_image']->content; ?>
			</div>
			<div class="empresa-direccion">
			<?php print $fields['field_direcci_n']->content; ?>
			</div>

		<div class="empresa-content cb">
			<?php print $fields['field_descripci_n_de_la_empresa_']->content; ?>
		</div>
		<div class="empresa-peu">
			<?php print $fields['field_enlace']->content; ?>
		</div>


	</div>
	<div class="empresa-col2 sepia">
		<h4><?php print t('INFORMATION') ?></h4>
		<hr/>
		<div class="empresa-sector">
			<?php 
				$fields['field_sector']->content=str_replace(",","",$fields['field_sector']->content);
			?>
						<?php print $fields['field_sector']->content; ?>

		</div>
		<div class="empresa-email">
			<?php print $fields['field_email']->content; ?>
		</div>
		<div class="empresa-tel">
			<?php print $fields['field_telefono']->content; ?>
		</div>
		<div class="empresa-tel2">
			<?php print $fields['field_tel_fono_2']->content; ?>
		</div>
		<div class="empresa-info-peu">
			<div class="empresa-fb fl">
				<?php 
					$options=array();
					$options['html']=TRUE;
					
					print l('<img src="/'.$ruta_tema.'/css/img/footer_facebook.png"/>',$fields['field_facebook']->content,$options); ?>
			</div>
			<div class="empresa-twit">
				<?php print l('<img src="/'.$ruta_tema.'/css/img/footer_twitter.png"/>',$fields['field_twitter']->content,$options); ?>
			</div>
		</div>
		<div class="cb"/>

	</div>
</div>

