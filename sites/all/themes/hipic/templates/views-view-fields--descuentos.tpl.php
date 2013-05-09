<div class="promocion promo-<?php print $fields['field_promo_color']->content; ?>">

<a href="profile-anunciante/<?php print $fields['user_1']->content.'/'.$fields['field_nombre_de_la_empresa_1']->content;?>" style="text-decoration:none;">
<table>
	<tr class="promo-fila1">
		<td class="col1">
		 <?php if (!empty($fields['field_fecha_caducidad']->content)): ?>
		 <?php //if ($fields['field_fecha_caducidad']->content>"0"): ?>
			<?php print t('Up to'); ?>
			<?php print $fields['field_fecha_caducidad']->content; ?>
		  <?php endif; ?>
			<br/>
		 <?php if (isset($fields['field_portal_promo_descuento']) && !empty($fields['field_portal_promo_descuento']->content)): ?>
			<div class="descuento">
				<?php print $fields['field_portal_promo_descuento']->content; ?>
			</div>
				<span class="label-descuento"><?php print t('DISCOUNT'); ?></span>
		  <?php endif; ?>
				
			
		</td>
		<td>
			<?php print $fields['field_imagen_portal_anuncio']->content; ?>

		</td>
	</tr>
</table>
<table>
	<tr class="promo-fila2">
		<td class="col1">
			<strong><?php print $fields['field_nombre_de_la_empresa']->content; ?></strong>
		</td>
		<td class="fr">
			<?php print $fields['field_concepto']->content." "; ?>
		</td>
	</tr>
</table>
</a>
</div>