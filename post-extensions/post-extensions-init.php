<?php
/*
 * Custom Metaboxes and Fields
 *
 * Define the metabox and field configurations.
 * @param  array $meta_boxes
 * @return array
 *
 */

 
/*
 * Display the Correct Metabox at the Correct Time
 * 
 */

function uix_products_metaboxes_display_script() {
	global $metaboxes;
	if ( get_post_type() == "uix_products" ) :
		?>
		<script type="text/javascript">
		( function( $ ) {
		
			var formats = { 
				'uix_products_typeshow1': 'uix-products-meta-artwork-settings', 
				'uix_products_typeshow2': 'uix-products-meta-themeplugin-settings',
				
				
			};
			var ids = '#uix-products-meta-artwork-settings,#uix-products-meta-themeplugin-settings';
			
			function displayMetaboxes() {
				// Hide all post format metaboxes
				$(ids).hide();
				// Get current post format
				var selectedElt = $("input[name='uix_products_typeshow']:checked").attr("id");
 
				// If exists, fade in current post format metabox
				if ( formats[selectedElt] )
					$("#" + formats[selectedElt]).fadeIn();
			}
 
			$(function() {
				// Show/hide metaboxes on page load
				displayMetaboxes();
 
				// Show/hide metaboxes on change event
				$("input[name='uix_products_typeshow']").change(function() {
					displayMetaboxes();
				});
			});
		
		} )( jQuery );
		</script>
		<?php
	endif;
}		

add_action( 'admin_print_scripts', 'uix_products_metaboxes_display_script', 1000 );
 
 
function uix_products_metaboxes( array $meta_boxes ) {

	$meta_boxes[] = array(
		'id'			=> 'uix-products-meta-typeshow',
		'title'			=> __( 'Product Type', 'uix-products' ),
		'pages'			=> array( 'uix_products' ),
		'context'		=> 'side',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'	=> '',
				'id'	=> 'uix_products_typeshow',
				'type'	=> 'radio',
				'default'  => 'artwork',
				'options' => array(
					'artwork'     => __( '<i class="dashicons dashicons-admin-customizer uix-products-type-icon"></i>Artwork', 'uix-products' ),
					'theme-plugin'       => __( '<i class="dashicons dashicons-laptop uix-products-type-icon"></i>Theme or Plugin', 'uix-products' ),
				),
							
			),
		),
	);


    // Artwork Options
	$meta_boxes[] = array(
		'id'			=> 'uix-products-meta-artwork-settings',
		'title'			=> __( 'Artwork Settings', 'uix-products' ),
		'pages'			=> array( 'uix_products' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'	=> __( 'Client Name', 'uix-products' ),
				'desc'	=>  __( 'Enter name of your clients. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_client',
				'type'	=> 'text',
				
			),
			array(
				'name'	=> __( 'URL', 'uix-products' ),
				'desc'	=>  __( 'Enter URL of your clients site. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_client_URL',
				'placeholder' => 'http://',
				'type'	=> 'text',
				
			),
			array(
				'name'	=> __( 'Date Projects', 'uix-products' ),
				'desc'	=>  __( 'Enter date of your projects. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_date',
				'type'	=> 'text_date',
				
			),		
			
			
		),
	);
	
	
    // Theme or Plugin Options
	$meta_boxes[] = array(
		'id'			=> 'uix-products-meta-themeplugin-settings',
		'title'			=> __( 'Theme or Plugin Settings', 'uix-products' ),
		'pages'			=> array( 'uix_products' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'	=> __( 'Type', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_type',
				'default' => 'theme',
				'type'	=> 'radio_inline',
				'options' => array(
					'theme' => __( 'Theme', 'uix-products' ),
					'plugin'   => __( 'Plugin', 'uix-products' ),
				),
			),	
			array(
				'name'	=> __( 'Item Prices', 'uix-products' ),
				'desc'	=>  __( 'Enter your expected value of this item for every single sell minimum', 'uix-products' ),
				'id'	=> 'uix_products_themeplugin_price',
				'type'	=> 'text_money',
				'default' => 0,
				'before' => '$',
				
			),	
		
			array(
				'name'	=> __( 'Item Name', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_name',
				'desc'	=>  __( 'Eg. Uixplant, 15 characters maximum', 'uix-products' ),
				'type'	=> 'text',
				
			),
			array(
				'name'	=> __( 'Item Title', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_title',
				'desc'	=>  __( 'Eg. Multi-purpose HTML5 WordPress Theme', 'uix-products' ),
				'type'	=> 'text',
				
			),
		
			array(
				'name'	=> __( 'Demo Link', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_previewURL',
				'desc'	=>  __( 'Direct link to your demo or video without any iframe. (Eg. http://my-site.com/demo/)', 'uix-products' ),
				'type'	=> 'text',
				'attributes'  => array(
					'placeholder' => 'http://',
				),
				
			),
			array(
				'name'	=> __( 'Purchase/Download Link', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_fileURL',
				'desc'	=>  __( 'Direct link to the purchase or download page. (Eg. http://market-place.com/yourtheme/)', 'uix-products' ),
				'type'	=> 'text',
				'attributes'  => array(
					'placeholder' => 'http://',
				),
				
			),	
		
			array(
				'name'	=> __( 'Current Version', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_version',
				'desc'	=>  __( 'Your Item Version, Eg. 1.0.0', 'uix-products' ),
				'type'	=> 'text',
			),		
			array(
				'name'	=> __( 'Compatible With', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_dep',
				'desc'	=>  __( 'Eg. WPML, Bootstrap 3.x, WordPress 4.5+', 'uix-products' ),
				'type'	=> 'text',
				'attributes'  => array(
					'placeholder' => '',
				),
			),
			array(
				'name'	=> __( 'Compatible Browsers', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_browsers',
				'type'	=> 'multicheck',
				'options' => array(
					'ie7' => 'IE7',
					'ie8' => 'IE8',
					'ie9' => 'IE9',
					'ie10' => 'IE10',
					'ie11' => 'IE11',
					'firefox' => 'Firefox',
					'safari' => 'Safari',
					'opera' => 'Opera',
					'chrome' => 'Chrome',
					'edge' => 'Edge'
				)
			),	
			array(
				'name'	=> __( 'Files Included', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_include',
				'type'	=> 'multicheck',
				'options' => array(
					'css' => 'CSS',
					'html' => 'HTML',
					'img' => 'Images',
					'js' => 'JavaScript',
					'php' => 'PHP',
					'svg' => 'SVG',
					'psd' => 'Photoshop PSD',
					'ai' => 'AI',
					'eps' => 'EPS',
					'pdf' => 'PDF',
					'sketch' => 'Sketch Files',
					'other' => 'Other'
					
				)
			),				
			
			array(
				'name'	=> __( 'Layout', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_layout',
				'default' => 'null',
				'type'	=> 'radio_inline',
				'options' => array(
				    'null' => __( 'Null', 'uix-products' ),
					'responsive' => __( 'Responsive', 'uix-products' ),
					'fixed'   => __( 'Fixed', 'uix-products' ),
					'liquid'     => __( 'Liquid', 'uix-products' ),
					'static'     => __( 'Static', 'uix-products' ),
				),
			),	
			array(
				'name'	=> __( 'Additional Info', 'uix-products' ),
				'desc'	=> __( 'Eg. Well Documentation', 'uix-products' ),
				'id'	=> 'uix_products_themeplugin_addinfo',
				'default' => '',
				'type'	=> 'text',
			),		
			array(
				'name'	=> __( 'Installation Info', 'uix-products' ),
				'desc'	=> __( 'Eg. Installation and set up instructions are attached (look for Documentation folder).', 'uix-products' ),
				'id'	=> 'uix_products_themeplugin_install',
				'default' => '',
				'type'	=> 'text',
			),		
			array(
				'name'	=> __( 'Tags', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_tags',
				'desc'	=>  __( 'Maximum of 15 keywords covering features, usage, and styling. Keywords should all be in lowercase and separated by commas. e.g. photography, gallery, modern, jquery, wordpress theme', 'uix-products' ),
				'type'	=> 'text',
			),	
			array(
				'name'	=> __( 'Updated Date', 'uix-products' ),
				'desc'	=> '',
				'id'	=> 'uix_products_themeplugin_updated_date',
				'type'	=> 'text_date',
				
			),
				
			
		),
	);
	

	

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'uix_products_metaboxes' );





/*
 * Custom Post Types
 *
 * WordPress can hold and display many different types of content. A single item of such a content is generally called a post, 
 * although post is also a specific post type. Internally, all the post types are stored in the same place, 
 * in the wp_posts database table, but are differentiated by a column called post_type.
 *
 */

//New custom post type 'Products' 
require_once 'products.php';









 