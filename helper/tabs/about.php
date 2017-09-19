<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
	
?>

        <p>
            <?php _e( 'This plugin enables a products post type and taxonomies. You can add a new artwork, theme or plugin item to appear in your theme. It also registers separate products taxonomies for tags and categories. If featured images are selected, they will be displayed in the column view.', 'uix-products' ); ?>
        </p>  
        <h3>
            <?php _e( 'Features', 'uix-products' ); ?>
        </h3>  
        <p>
			<?php _e( '* 3 Product types for choice', 'uix-products' ); ?><br>
            <?php _e( '* List of retina-ready', 'uix-products' ); ?><br>
            <?php _e( '* Full responsive design', 'uix-products' ); ?><br>
            <?php _e( '* Using template files to customize your theme & display all product items', 'uix-products' ); ?><br>
            <?php _e( '* Regenerate thumbnails after changing their size.', 'uix-products' ); ?><br>
            <?php _e( '* Adding categories support to a custom post type in WordPress', 'uix-products' ); ?><br>
            <?php _e( '* It contains about 4 different layouts to choose from', 'uix-products' ); ?><br>
            <?php _e( '* Support gallery', 'uix-products' ); ?><br>
            <?php _e( '* There are some simple options to the theme customizer', 'uix-products' ); ?><br>
            <?php _e( '* Filterable to display product items to your site', 'uix-products' ); ?><br>
            <?php _e( '* Support widgets to the spot you wish it to appear', 'uix-products' ); ?><br>
        
        </p>   

   
    
<?php } ?>