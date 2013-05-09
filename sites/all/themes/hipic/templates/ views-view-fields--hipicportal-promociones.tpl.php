AKIIIIIII
<div class="promocion promo-<?php print $fields['field_promo_color']->content; ?>">
<table>
	<tr class="promo-fila1">
		<td class="col1">
			
		 <?php if (!empty($fields['field_fecha_caducidad']->content)): ?>
			<?php print t('Hasta'); ?>
			<br/>
			<?php print $fields['field_fecha_caducidad']->content; ?>
		  <?php endif; ?>
			<br/>
			<br/>
			
			<div class="descuento">
				<?php print $fields['field_portal_promo_descuento']->content; ?>%
			</div>
				<span class="label-descuento"><?php print t('DISCOUNT2'); ?></span>
			
			
		</td>
		<td>
			<?php print $fields['field_imagen']->content; ?>

		</td>
	</tr>
</table>
<table>
	<tr class="promo-fila2">
		<td class="col1">
			<strong><?php print $fields['title_field']->content; ?></strong>
		</td>
		<td class="fr">
			<?php print $fields['title']->content; ?>
		</td>
	</tr>
</table>
</div>
