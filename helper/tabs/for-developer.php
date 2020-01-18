<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'for-developer' ) {
	
?>
	   	<p>
		   <strong><?php _e( 'Occasionally you may wish to edit one of the meta boxes that come with Uix Products. Instead of editing the templates right in the plugin you should move them to your theme, so that your changes aren\'t lost when you update the Uix Products plugin. This document will show you how to safely custom meta boxes to your theme.', 'uix-products' ); ?></strong>

		</p>
       
        <h3>
            <?php _e( '(1) Added filter for current Custom Metaboxes. Add the following code to your theme or plugin:', 'uix-products' ); ?>
        </h3>  
	   
  	    <blockquote class="uix-bg-custom-blockquote">
<pre>// Custom metaboxes
//----------------------
if ( !function_exists( 'mytheme_uix_products_modify_vars' ) ) {
    add_filter( 'uix_products_custom_metaboxes_vars', 'mytheme_uix_products_modify_vars' );
    function mytheme_uix_products_modify_vars() {
        $all_config = array();
        $config  = array(

                //-- Settings 1
                array(
                    'config' => array( ... )
                ),

               //-- Settings 2
                array(
                    'config' => array( ... )
                ),
            );

        array_push( $all_config, $config );
        return $all_config;
    } 
}

// Custom publish page
//----------------------
if ( !function_exists( 'mytheme_uix_products_publish_page' ) ) {
    add_action( 'admin_enqueue_scripts' , 'mytheme_uix_products_publish_page' );
    function mytheme_uix_products_publish_page() {
        $currentScreen = get_current_screen();

        if ( $currentScreen->id == 'uix_products' ) {

            //Hide editor
            $custom_css = "
            #postdivrich {
                display: none;
            }";
            wp_add_inline_style( UixProducts::PREFIX . '-products-admin', $custom_css ); 

            //Disable excerpt
            remove_meta_box( 'postexcerpt', 'uix_products', 'normal' ); 
        }
    }
}</pre>
        </blockquote>


        <h3>
            <?php _e( '(2) How to call in a PHP page', 'uix-products' ); ?>
        </h3>  
		
 	    <blockquote class="uix-bg-custom-blockquote">
<pre>if ( ! class_exists( 'UixProducts' ) ) { 
    return;
}

// Query
$uix_products_query = new WP_Query(
	array(
		'post_type'      => 'uix_products',
		'posts_per_page' => -1, //lists all of the posts.
		'no_found_rows'  => true
	)
);

if ( $uix_products_query->posts && is_array ( $uix_products_query->posts ) ) { 
        
    // Loop through each item
    foreach( $uix_products_query->posts as $post ) : setup_postdata( $post ); 

        // Get data
        $option1       = get_post_meta( get_the_ID(), 'your_custom_option_name1', true );
        $option2   = get_post_meta( get_the_ID(), 'your_custom_option_name2', true );
        ...

    endforeach; 
			 
}

// Reset post data to prevent conflicts with the main query 
wp_reset_postdata();
</pre>
        </blockquote>
   
        <h3>
            <?php _e( '(3) Custom Meta Boxes API', 'uix-products' ); ?>
        </h3>  
   	
	   	<p>
	   	    <?php printf( __( '<a href="%1$s" target="_blank">Online Documentation</a>', 'uix-products' ), esc_url( 'https://github.com/xizon/Uix-Products/tree/master/includes/admin/uix-custom-metaboxes' ) ); ?>
		</p>   


    
    
<?php } ?>