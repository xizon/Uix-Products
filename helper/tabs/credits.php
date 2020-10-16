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
            <li><a href="https://github.com/haltu/muuri" target="_blank" rel="nofollow"><?php _e( 'Muuri', 'uix-products' ); ?></a></li>
            <li><a href="https://github.com/OriginalEXE/Switcheroo" target="_blank" rel="nofollow"><?php _e( 'Switcheroo', 'uix-products' ); ?></a></li>
        </ul>
        
        </p> 
        
    
<?php } ?>