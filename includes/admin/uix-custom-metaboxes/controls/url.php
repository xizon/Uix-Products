<?php
/**
* Field Type: URL
*
*/
class UixProductsFormType_Url extends Uix_Products_Custom_Metaboxes {
	
	public static function add( $id = '', $title = '', $desc = '', $default = '', $options = '', $placeholder = '', $desc_primary = '', $enable_table = false ) {
	?>
		<?php if ( $enable_table ) : ?>
		<tr>
			<th class="uix-products-cmb__title">
				<label><?php echo self::kses( $title ); ?></label>
				<?php if ( !empty ( $desc ) ) { ?>
					<p class="uix-products-cmb__title_desc"><?php echo self::kses( $desc ); ?></p>
				<?php } ?>
			</th>
			<td>
		<?php endif; ?>      


				   <input placeholder="<?php echo esc_attr( $placeholder ); ?>" type="text" class="uix-products-cmb__normal-text" value="<?php echo esc_url( $default ); ?>" name="<?php echo esc_attr( $id ); ?>" id="<?php echo esc_attr( $id ); ?>">
					<?php if ( !empty ( $desc_primary ) ) { ?>
						<p class="uix-products-cmb__description"><?php echo self::kses( $desc_primary ); ?></p>
					<?php } ?>

		<?php if ( $enable_table ) : ?>   
			</td>
		</tr>
		<?php endif; ?>   

	<?php	
	}	

}
