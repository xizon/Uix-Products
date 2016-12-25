<?php

function uix_products_options_page(){
	
    //must check that the user has the required capability 
    if ( !current_user_can( 'manage_options' ) ){
      wp_die( __('You do not have sufficient permissions to access this page.', 'uix-products') );
    }

  
?>


<style>
.uix-bg-custom-wrapper img{
	background-color:#fff;
    border: 1px solid #ddd;
    padding: 5px;
	-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.uix-bg-custom-wrapper a{
	text-decoration:none;
}

.uix-bg-custom-wrapper code{
	border:1px solid #B1B1B1;
	-webkit-border-radius: 2px; 
	-moz-border-radius: 2px; 
	border-radius: 2px;
	line-height:1.1em;
	margin-bottom:5px;
	display:inline-block;
	
}

.uix-bg-custom-title{
	font-size:1.1em;
	font-weight:bold;
}
.uix-bg-custom-title strong{
	color:#D16E15;
}

</style>

<div class="wrap uix-bg-custom-wrapper">
    
    <h2><?php _e( 'Uix Products Helper', 'uix-products' ); ?></h2>
    <?php
	
	if( !isset( $_GET[ 'tab' ] ) ) {
		$active_tab = 'about';
	}
	
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} 
	
	$tabs = array();
	$tabs[] = [
	    'tab'     =>  'about', 
		'title'   =>  __( 'About', 'uix-products' )
	];
	$tabs[] = [
	    'tab'     =>  'usage', 
		'title'   =>  __( 'How to use?', 'uix-products' )
	];
	
	$tabs[] = [
	    'tab'     =>  'credits', 
		'title'   =>  __( 'Credits', 'uix-products' )
	];
	
	$tabs[] = [
	    'tab'     =>  'temp', 
		'title'   =>  __( 'Template Files', 'uix-products' )
	];
	
	if ( UixProducts::product_preview( '', '', '', false ) ) {
		$tabs[] = [
				'tab'     =>  'products-list', 
				'title'   =>  __( 'Products List File', 'uix-products' )
		];	
	}

	$tabs[] = [
	    'tab'     =>  'general-settings', 
		'title'   =>  __( '<i class="dashicons dashicons-admin-generic"></i> General Settings', 'uix-shortcodes' )
	];
	
	if ( UixProducts::core_css_file_exists() ) {
		$tabs[] = [
			'tab'     =>  'custom-css', 
			'title'   =>  __( '<i class="dashicons dashicons-welcome-view-site"></i> Custom CSS', 'uix-shortcodes' )
		];		
	}

	
	
	?>
    <h2 class="nav-tab-wrapper">
        <?php foreach ( $tabs as $key ) :  ?>
            <?php $url = 'admin.php?page=' . rawurlencode( UixProducts::HELPER ) . '&tab=' . rawurlencode( $key[ 'tab' ] ); ?>
            <a href="<?php echo esc_attr( is_network_admin() ? network_admin_url( $url ) : admin_url( $url ) ) ?>"
               class="nav-tab<?php echo $active_tab === $key[ 'tab' ] ? esc_attr( ' nav-tab-active' ) : '' ?>">
                <?php echo $key[ 'title' ] ?>
            </a>
        <?php endforeach ?>
    </h2>

    <?php 
		foreach ( glob( UIX_PRODUCTS_PLUGIN_DIR. "helper/tabs/*.php") as $file ) {
			include $file;
		}	
	?>
        
    
    
</div>
 
    <?php
     
}