<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_products_customcss';

	
// If they did, this hidden field will be set to 'Y'
if ( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_products_customcss' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$uix_products_opt_cssnewcode = wp_unslash( $_POST[ 'uix_products_opt_cssnewcode' ] );
	
		// Save the posted value in the database
		update_option( 'uix_products_opt_cssnewcode', $uix_products_opt_cssnewcode );
	
	
		// Put a "settings saved" message on the screen
		echo '<div class="updated"><p><strong>'.__('Settings saved.', 'uix-products' ).'</strong></p></div>';
		
	}

 }  


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'custom-css' ) {
	

?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_products_customcss' ); ?>
        
        <h4><?php _e( 'You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files.', 'uix-products' ); ?></h4>
            
        <table class="form-table">
          <tr>
            <th scope="row">
              <?php _e( 'Paste your CSS code', 'uix-products' ); ?>
            </th>
            <td>
              <textarea name="uix_products_opt_cssnewcode" class="regular-text" rows="25" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_products_opt_cssnewcode' ) ); ?></textarea>
            </td>
          </tr>
        </table> 
        
          
<?php


	$org_cssname_uix_products = 'uix-products.css';
	$org_csspath_uix_products = UixProducts::plug_directory() .'assets/css/'. $org_cssname_uix_products;
	$filesystype = 'plugin';
	$filesyspath = 'assets/css/';


	// capture output from WP_Filesystem
	ob_start();
	
		UixProducts::wpfilesystem_read_file( 'uix_products_customcss', 'edit.php?post_type=uix_products&page='.UixProducts::HELPER.'&tab=custom-css', $filesyspath, $org_cssname_uix_products, $filesystype );
		$filesystem_uix_products_out = ob_get_contents();
	ob_end_clean();
	
	if ( empty( $filesystem_uix_products_out ) ) {
		
		$style_org_code_uix_products = UixProducts::wpfilesystem_read_file( 'uix_products_customcss', 'edit.php?post_type=uix_products&page='.UixProducts::HELPER.'&tab=custom-css', $filesyspath, $org_cssname_uix_products, $filesystype );
		
		echo '
		
		         <p>'.__( 'CSS file root directory:', 'uix-products' ).' 
				     <a href="javascript:" id="uix_products_view_css" >'.$org_csspath_uix_products.'</a>
					 <div class="uix-products-dialog-mask"></div>
					 <div class="uix-products-dialog" id="uix-products-view-css-container">  
						<textarea rows="15" style=" width:95%;" class="regular-text">'.$style_org_code_uix_products.'</textarea>
						<a href="javascript:" id="uix_products_close_css" class="close button button-primary">'.__( 'Close', 'uix-products' ).'</a>  
					</div>
				 </p><hr />
				<script type="text/javascript">
					
				( function($) {
					
					"use strict";
					
					$( function() {
						
						var dialog_uix_products = $( "#uix-products-view-css-container, .uix-products-dialog-mask" );  
						
						$( "#uix_products_view_css" ).click( function() {
							dialog_uix_products.show();
						});
						$( "#uix_products_close_css" ).click( function() {
							dialog_uix_products.hide();
						});
					
			
					} );
					
				} ) ( jQuery );
				
				</script>
		
		';	

	} else {
		
		echo '
		         <p>'.__( 'CSS file root directory:', 'uix-products' ).' 
				     <a href="'.$org_csspath_uix_products.'" target="_blank">'.$org_csspath_uix_products.'</a>
				 </p><hr />

		';	
		
		
	}
?>
        
        
        <?php submit_button(); ?>

    
    </form>


    
<?php } ?>