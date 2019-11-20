<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_products_generalsettings';

	
	
// If they did, this hidden field will be set to 'Y'
if ( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_products_generalsettings' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$uix_products_opt_layout                          = sanitize_text_field( $_POST[ 'uix_products_opt_layout' ] );
		$uix_products_opt_filterable 	                  = isset( $_POST['uix_products_opt_filterable'] ) ? sanitize_text_field( $_POST[ 'uix_products_opt_filterable' ] ) : 0;
		$uix_products_opt_pagination 	                  = isset( $_POST['uix_products_opt_pagination'] ) ? sanitize_text_field( $_POST[ 'uix_products_opt_pagination' ] ) : 0;
	
	
		$uix_products_opt_cover_width 	                  = intval( $_POST[ 'uix_products_opt_cover_width' ] );
		if ( !$uix_products_opt_cover_width ) {
			$uix_products_opt_cover_width = 400;
		}
	
		$uix_products_opt_cover_height 	                  = intval( $_POST[ 'uix_products_opt_cover_height' ] );
		if ( !$uix_products_opt_cover_height ) {
			$uix_products_opt_cover_height = 300;
		}
		
		$uix_products_opt_cover_single_width 	          = intval( $_POST[ 'uix_products_opt_cover_single_width' ] );
		if ( !$uix_products_opt_cover_single_width ) {
			$uix_products_opt_cover_single_width = 1920;
		}
		
		$uix_products_opt_cover_single_height 	          = intval( $_POST[ 'uix_products_opt_cover_single_height' ] );
		if ( !$uix_products_opt_cover_single_height ) {
			$uix_products_opt_cover_single_height = 15000;
		}
	
		$uix_products_show 	                              = intval( $_POST[ 'uix_products_show' ] );
		if ( !$uix_products_show ) {
			$uix_products_show = 10;
		}
	
        
        $uix_products_opt_custom_params 	         = wp_unslash( $_POST[ 'uix_products_opt_custom_params' ] );
	
	
		// Save the posted value in the database
		update_option( 'uix_products_opt_layout', $uix_products_opt_layout );
		update_option( 'uix_products_opt_filterable', $uix_products_opt_filterable );
		update_option( 'uix_products_opt_pagination', $uix_products_opt_pagination );
		update_option( 'uix_products_show', $uix_products_show );
		update_option( 'uix_products_opt_cover_width', $uix_products_opt_cover_width );
		update_option( 'uix_products_opt_cover_height', $uix_products_opt_cover_height );
		update_option( 'uix_products_opt_cover_single_width', $uix_products_opt_cover_single_width );
		update_option( 'uix_products_opt_cover_single_height', $uix_products_opt_cover_single_height );
        update_option( 'uix_products_opt_custom_params', $uix_products_opt_custom_params );
		
	
		// Put a "settings saved" message on the screen
		echo '<div class="updated"><p><strong>'.__('Settings saved.', 'uix-products' ).'</strong></p></div>';
	
	}
	

 }  


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'general-settings' ) {
	

?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_products_generalsettings' ); ?>
  
        <table class="form-table">
        
          <tr>
            <th scope="row">
              <?php _e( 'Numeric Pagination', 'uix-products' ); ?>
            </th>
             <td>
                <p>
                    <label>
                    <input name="uix_products_opt_pagination" type="checkbox" value="1" <?php checked( '1', get_option( 'uix_products_opt_pagination', 1 ) ); ?> />
                    <?php _e( 'If this option turned on, the products list will use numeric pagination.', 'uix-products' ); ?>
                    </label>
                </p>
            </td>         
            
          </tr>
        
          <tr>
            <th scope="row">
              <?php _e( 'Filterable Animated Products', 'uix-products' ); ?>
            </th>
             <td>
                <p>
                    <label>
                    <input name="uix_products_opt_filterable" type="checkbox" value="1" <?php checked( '1', get_option( 'uix_products_opt_filterable', 0 ) ); ?> />
                    <?php _e( 'Allows you to create a very modern and outstanding products which filters instantly.', 'uix-products' ); ?>
                    </label>
                </p>
            </td>         
            
          </tr>
          
        
          <tr>
            <th scope="row">
              <?php _e( 'Layout', 'uix-products' ); ?>
            </th>
            
            
            <td>
                <p>
                    <label>
                        <input name="uix_products_opt_layout" type="radio" value="standard" class="tog" <?php echo ( get_option( 'uix_products_opt_layout' ) == 'standard' || !get_option( 'uix_products_opt_layout' ) ) ? 'checked' : ''; ?> />
                        <?php _e( 'Standard', 'uix-products' ); ?>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="uix_products_opt_layout" type="radio" value="masonry" class="tog" <?php echo ( get_option( 'uix_products_opt_layout' ) == 'masonry' ) ? 'checked' : ''; ?> />
                        <?php _e( 'Masonry', 'uix-products' ); ?>
                    </label>
                </p>               
                  
            </td>
      
          </tr>
            
            
            
          <tr>
            <th scope="row">
              <?php _e( 'Products Pages Show at Most', 'uix-products' ); ?>
            </th>
             <td>
                <p>
                    <label>
                        <input name="uix_products_show" type="number" step="1" min="0" value="<?php echo esc_attr( get_option( 'uix_products_show', 10 ) ); ?>" class="small-text" /> <?php _e( 'products', 'uix-products' ); ?>
                    </label>
                </p>      
               
            </td>         
            
          </tr>     
            
            
          <tr>
            <th scope="row">
              <?php _e( 'Image Size for Cover Thumbnails', 'uix-products' ); ?>
            </th>
             <td>
                <p>
                    <label>
                        <input name="uix_products_opt_cover_width" type="number" step="1" min="0" value="<?php echo esc_attr( get_option( 'uix_products_opt_cover_width', 400 ) ); ?>" class="small-text" /> <?php _e( 'px', 'uix-products' ); ?> <?php _e( '(width)', 'uix-products' ); ?>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input name="uix_products_opt_cover_height" type="number" step="1" min="0" value="<?php echo esc_attr( get_option( 'uix_products_opt_cover_height', 300 ) ); ?>" class="small-text" /> <?php _e( 'px', 'uix-products' ); ?> <?php _e( '(height)', 'uix-products' ); ?>
                    </label>
                </p>        
               
            </td>         
            
          </tr>   
          
            
          <tr>
            <th scope="row">
              <?php _e( 'Image Size in Single Post', 'uix-products' ); ?>
            </th>
             <td>
                <p>
                    <label>
                        <input name="uix_products_opt_cover_single_width" type="number" step="1" min="0" value="<?php echo esc_attr( get_option( 'uix_products_opt_cover_single_width', 1920 ) ); ?>" class="small-text" /> <?php _e( 'px', 'uix-products' ); ?> <?php _e( '(width)', 'uix-products' ); ?>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input name="uix_products_opt_cover_single_height" type="number" step="1" min="0" value="<?php echo esc_attr( get_option( 'uix_products_opt_cover_single_height', 15000 ) ); ?>" class="small-text" /> <?php _e( 'px', 'uix-products' ); ?> <?php _e( '(height)', 'uix-products' ); ?>
                    </label>
                </p>        
               
            </td>         
            
          </tr>  
                  
            
          <tr>
            <th scope="row">
              <?php _e( 'Custom Parameters', 'uix-products' ); ?>
            </th>
             <td>
                <p>
                    <textarea name="uix_products_opt_custom_params" class="regular-text" rows="5" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_products_opt_custom_params', '{"key1":"value1","key2":"value2","key3":"value3"}' ) ); ?></textarea>
                    <?php _e( 'Can be used for your custom parameters.', 'uix-products' ); ?>
                </p>
               
            </td>         
            
          </tr> 
             
            
           
          
        </table> 
        
        
        <?php submit_button(); ?>

    
    </form>


    
<?php } ?>