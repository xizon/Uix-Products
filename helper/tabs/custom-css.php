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
	
	$newFilePath                 = get_stylesheet_directory() . '/uix-products-custom.css';
	$newFilePath2                = get_stylesheet_directory() . '/assets/css/uix-products-custom.css';
	$newJSFilePath               = get_stylesheet_directory() . '/uix-products-custom.js';
	$newJSFilePath2              = get_stylesheet_directory() . '/assets/js/uix-products-custom.js';
	$org_cssname_uix_products   = UixProducts::core_css_file( 'name' );
	$org_csspath_uix_products   = UixProducts::core_css_file();
	$org_jsname_uix_products    = UixProducts::core_js_file( 'name' );
	$org_jspath_uix_products    = UixProducts::core_js_file();

	//CSS file directory
	if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
		$cssfiletype = 'theme';
		
		$filepath = '';
		if ( file_exists( $newFilePath2 ) ) {
			$filepath = 'assets/css/';
		}

		
	} else {
		$cssfiletype   = 'plugin';
		$filepath   = 'assets/css/';	
	}
	
	
	//Javascript file directory
	if ( file_exists( $newJSFilePath ) || file_exists( $newJSFilePath2 ) ) {
		$JSfiletype = 'theme';
		
		$jsfilepath = '';
		if ( file_exists( $newJSFilePath2 ) ) {
			$jsfilepath = 'assets/js/';
		}	
			
	} else {
		$JSfiletype   = 'plugin';
		$jsfilepath = 'assets/js/';
	}
	
?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_products_customcss' ); ?>
        
        
	   	<p class="uix-bg-custom-desc">
		   <?php _e( '1) Making a new Cascading Style Sheet (CSS) document which name to <strong>uix-products-custom.css</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/css/</code> ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Products will use it as a default style sheet instead of the "<a href="'.$org_csspath_uix_products.'" target="_blank"><strong>uix-products.css</strong></a>" to your WordPress Theme. Of course, Uix Products\'s function of "Custom CSS" is still valid.', 'uix-products' ); ?>

		</p>    
		<p class="uix-bg-custom-desc">
		   <?php _e( '2) Making a new javascrpt (.js) document which name to <strong>uix-products-custom.js</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/js/</code> ). Once you have created an existing JS file, Uix Products will use it as a default script instead of the "<a href="'.$org_jspath_uix_products.'" target="_blank"><strong>uix-products.js</strong></a>" to your WordPress Theme.', 'uix-products' ); ?>

		</p>      
            
        <table class="form-table">
          <tr>
            <th scope="row">
              <?php _e( 'Paste your CSS code', 'uix-products' ); ?>
              <hr>
              <p class="uix-bg-custom-desc-note"><?php _e( 'You could add new styles code to your website, without modifying original .css files.', 'uix-products' ); ?></p>
            </th>
            <td>
              <textarea name="uix_products_opt_cssnewcode" class="regular-text" rows="25" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_products_opt_cssnewcode' ) ); ?></textarea>
            </td>
          </tr>
        </table> 
        
          
<?php

	// capture output from WP_Filesystem
	ob_start();
	
		UixProducts::wpfilesystem_read_file( 'uix_products_customcss', 'admin.php?page='.UixProducts::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_products, $cssfiletype );
		$filesystem_uix_products_out = ob_get_contents();
	ob_end_clean();
	
	if ( empty( $filesystem_uix_products_out ) ) {
		
		$style_org_code_uix_products = UixProducts::wpfilesystem_read_file( 'uix_products_customcss', 'admin.php?page='.UixProducts::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_products, $cssfiletype );
		
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
						
						
						$( "#uix_products_view_css" ).on( "click", function( e ) {
						    e.preventDefault();
							dialog_uix_products.show();
						});
						$( "#uix_products_close_css" ).on( "click", function( e ) {
						    e.preventDefault();
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