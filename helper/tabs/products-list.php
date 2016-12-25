<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
 *
 * Tips: your WordPress site in local server, you need to chang file permissions to use "wpfilesystem_write_file"
   Add following code to "wp-config.php":
   
   -----
   define("FS_METHOD", "direct"); 
   define("FS_CHMOD_DIR", 0777); 
   define("FS_CHMOD_FILE", 0777); 
   
*
*/

// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_products_list';


// If they did, this hidden field will be set to 'Y'
if ( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_products_listfiles' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$status_echo = '';
		
		$status_echo = UixProducts::wpfilesystem_write_file( 'uix_products_listfiles', 'admin.php?page='.UixProducts::HELPER.'&tab=products-list', 'live-demo/', 'themes.js', UixProducts::theme_list() );
		echo $status_echo;
		
	}
	

 }


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'products-list' ) { ?>
	
	
    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_products_listfiles' ); ?>
        
         <h3><?php _e( 'Create Uix Products list files in this plugin directory:', 'uix-products' ); ?></h3>
 
         <div class="uix-plug-note">
            <h4><?php _e( 'Themes list file\'s name:', 'uix-products' ); ?></h4>
            <?php echo UixProducts::plug_directory().'live-demo/themes.js'; ?>  
            <br><br>
         </div>
         
         <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_attr__( 'Click This Button to Create Uix Products List Files', 'uix-products' ); ?>"  /></p>
         
    </form>

	
	
 
	
    
<?php } ?>