<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_products_temp';

	
// If they did, this hidden field will be set to 'Y'
if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' &&
    ( ( isset( $_GET[ 'tempfiles' ] ) && $_GET[ 'tempfiles' ] == 'ok' ) || ( isset( $_GET[ '_wpnonce' ] ) && !empty( $_GET[ '_wpnonce' ] ) ) ) 
  ) {

	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$status_echo = "";
		
		if( UixProducts::tempfile_exists() ) {
			// Template files removed
			$status_echo = UixProducts::templates( 'uix_products_tempfiles', 'admin.php?page='.UixProducts::HELPER.'&tab=temp', true );
			echo $status_echo;
	
		} else {
			// Template files copied
			$status_echo = UixProducts::templates( 'uix_products_tempfiles', 'admin.php?page='.UixProducts::HELPER.'&tab=temp' );
			echo $status_echo;
		
		}
	
	}
	
 }


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' ) { ?>

	<?php if ( !isset( $_GET[ 'tempfiles' ] ) && !isset( $_GET[ '_wpnonce' ] ) ) { ?>
   
		<?php if( UixProducts::tempfile_exists() ) { ?>

			 <h3><?php _e( 'Uix Products template files already exists. Remove Uix Products template files in your templates directory:', 'uix-products' ); ?></h3>
			 <p>
			   <?php _e( 'As a workaround you can use FTP, access path <code>/wp-content/themes/{your-theme}/</code> and remove Uix Products template files.', 'uix-products' ); ?>
			 </p>   

			 <div class="uix-plug-note">
				<h4><?php _e( 'Template files list:', 'uix-products' ); ?></h4>
				<?php UixProducts::list_templates_name( 'theme' ); ?>
			 </div>
			<p>
				<a class="button button-remove" href="<?php echo esc_url( 'admin.php?page='.UixProducts::HELPER.'&tab=temp&tempfiles=ok' ); ?>" onClick="return confirm('<?php echo esc_attr__( 'Are you sure?\nIt is possible based on your theme of the plugin templates. When you create them again, the default plugin template will be used.', 'uix-products' ); ?>');"><?php echo esc_html__( 'Remove Uix Products Template Files', 'uix-products' ); ?></a>
			</p>


		<?php } else { ?>

			 <h3><?php _e( 'Copy Uix Products template files in your templates directory:', 'uix-products' ); ?></h3>
			 <p>
			   <?php _e( 'As a workaround you can use FTP, access the Uix Products template files path <code>/wp-content/plugins/uix-products/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-products' ); ?>

			 </p>   

			 <p>
			 <strong><?php _e( 'Hi, there! It’s just a custom template file in the theme folder. Of course you doesn’t need to create it, you can use of the default page template or your own custom template file directly.', 'uix-products' ); ?></strong>

			</p> 

			 <div class="uix-plug-note">
				<h4><?php _e( 'Template files list:', 'uix-products' ); ?></h4>
				<?php UixProducts::list_templates_name( 'plug' ); ?>
			 </div>


			<p>
				<a class="button button-primary" href="<?php echo esc_url( 'admin.php?page='.UixProducts::HELPER.'&tab=temp&tempfiles=ok' ); ?>"><?php echo esc_html__( 'Click This Button to Copy Uix Products Files', 'uix-products' ); ?></a>
			</p> 



		<?php } ?>

	
	<?php } ?>
 
	
    
<?php } ?>