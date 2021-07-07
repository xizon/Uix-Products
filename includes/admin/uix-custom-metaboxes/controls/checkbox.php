<?php
	/**
	* Field Type: Checkbox
	*
	* @print: 
	* echo ( get_post_meta( get_the_ID(), 'cus_page_ex_demoname_8', true ) ) ? esc_attr( '_blank' ) : esc_attr( '_self' );
	*
	*/
class UixProductsCmbFormType_Checkbox extends Uix_Products_Custom_Metaboxes {
	
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


				<div class="uix-products-cmb__checkbox-selector">

					<label>
						<input name="<?php echo esc_attr( $id ); ?>" type="checkbox" value="1" <?php checked( $default, 1 ); ?>>
						<?php if ( !empty ( $desc_primary ) ) { ?>
							<span class="uix-products-cmb__description"><?php echo self::kses( $desc_primary ); ?></span>
						<?php } ?>

					</label>

				</div>


		<?php if ( $enable_table ) : ?>
			</td>
		</tr>
		<?php endif; ?>

	<?php	
	}	

}
