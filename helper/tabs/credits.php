<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'credits' ) {
?>


        <h3>
           <?php _e( 'I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:', 'uix-products' ); ?>
        </h3>  
        <p>
        
        <ul>
            <li><a href="https://github.com/uixplorer/gallery-metabox" target="_blank" rel="nofollow"><?php _e( 'Gallery Metabox', 'uix-products' ); ?></a></li>
            <li><a href="https://github.com/woothemes/FlexSlider" target="_blank" rel="nofollow"><?php _e( 'Flexslider', 'uix-products' ); ?></a></li>
            <li><a href="https://github.com/Vestride/Shuffle" target="_blank" rel="nofollow"><?php _e( 'Shuffle', 'uix-products' ); ?></a></li>
            <li><a href="https://github.com/OriginalEXE/Switcheroo" target="_blank" rel="nofollow"><?php _e( 'Switcheroo', 'uix-products' ); ?></a></li>
        </ul>
        
        </p> 
        
    
<?php } ?>