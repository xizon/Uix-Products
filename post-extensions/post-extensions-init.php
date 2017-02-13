<?php
/*
 * Custom Metaboxes and Fields
 *
 * Define the metabox and field configurations.
 * @param  array $meta_uix_boxes
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
		"use strict";
			$( function() {

				/*
				 *  -------- Switch post type --------
				*/
				if ( $( '.uix-products-meta-theme-custom' ).length == 0 ) {
					setTimeout( function() {
						var $type = $( '#uix-products-meta-typeshow-hide' );
						if ( ! $type.is( ":checked" ) ) $type.trigger( 'click' );	
					}, 100 );
				}
					

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

				// Show/hide metaboxes on page load
				displayMetaboxes();

				// Show/hide metaboxes on change event
				$("input[name='uix_products_typeshow']").change(function() {
					displayMetaboxes();
				});


				<?php //echo esc_url( UixProducts::plug_directory() . 'assets/images/remove-icon.png' ); ?>
				/*
				 * -------- Custom Attributes --------
				*/

				var maxField  = 20;
				
				$( '.uix-plug-cus-metabox-attributes-wrapper' ).each( function()  {
					var _id       = $( this ).data( 'id' ),
						addButton = $( this ).find( '.uix-plug-cus-metabox-attributes-add-button' ),
						wrapper   = $( this ).find( '#uix-plug-cus-metabox-attributes-appendbox-' + _id ),
						fieldHTML = $( this ).find( '#uix-plug-cus-metabox-attributes-clonehtml-' + _id ).html();
					var x = 1;
					$( addButton ).click(function(){
						if(x < maxField){ 
							x++;
							$( wrapper ).append( fieldHTML );
						}
					});
					$( document ).on( 'click', '.uix-plug-cus-metabox-attributes-remove-button', function(e){
						e.preventDefault();
						var $li = $( this ).closest( '.uix-plug-cus-metabox-text-div' );
						
						if ( $( '.uix-plug-cus-metabox-attributes-wrapper .uix-plug-cus-metabox-text-div' ).length == 1 ) {
							$li.find( 'input' ).val( '' );
							$li.hide();
						} else {
							$li.remove();
						}
						
						x--;
					});
				});
				
			} );


		} ) ( jQuery );	
		</script>
		<?php
	endif;
}		

add_action( 'admin_print_scripts', 'uix_products_metaboxes_display_script', 1000 );
 
 
function uix_products_metaboxes( array $meta_uix_boxes ) {

	$meta_uix_boxes[] = array(
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
	$meta_uix_boxes[] = array(
		'id'			=> 'uix-products-meta-artwork-settings',
		'title'			=> __( 'Artwork Settings', 'uix-products' ),
		'pages'			=> array( 'uix_products' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
		
			array(
				'name'	=> __( 'Project URL', 'uix-products' ),
				'desc'	=>  __( 'Enter destination URL of this project. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_project_url',
				'placeholder' => 'http://',
				'type'	=> 'text',
				
			),
			array(
				'name'	=> __( 'Client Name', 'uix-products' ),
				'desc'	=>  __( 'Enter name of your clients. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_client',
				'type'	=> 'text',
				
			),
			array(
				'name'	=> __( 'Client URL', 'uix-products' ),
				'desc'	=>  __( 'Enter URL of your clients site. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_client_URL',
				'placeholder' => 'http://',
				'type'	=> 'text',
				
			),
		
			array(
				'name'	=> __( 'Author', 'uix-products' ),
				'desc'	=>  __( 'Enter name of this project author. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_author',
				'placeholder' => 'http://',
				'type'	=> 'text',
				
			),
		
			array(
				'name'	=> __( 'Release Date', 'uix-products' ),
				'desc'	=>  __( 'Enter date of your projects. <strong>(optional)</strong>', 'uix-products' ),
				'id'	=> 'uix_products_artwork_date',
				'type'	=> 'text_date',
				
			),		
			array(
				'name'	=> __( 'Custom Attributes', 'uix-products' ),
				'desc'	=>  '',
				'id'	=> 'uix_products_artwork_attrs',
				'type'	=> 'dynamic_attributes',
				
			),
			
		),
	);
	
	
    // Theme or Plugin Options
	$meta_uix_boxes[] = array(
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
			array(
				'name'	=> __( 'Custom Attributes', 'uix-products' ),
				'desc'	=>  '',
				'id'	=> 'uix_products_themeplugin_attrs',
				'type'	=> 'dynamic_attributes',
				
			),
				
			
		),
	);
	

	

	return $meta_uix_boxes;
}
add_filter( 'cmb_uix_meta_boxes', 'uix_products_metaboxes' );



/*
 * Removing a Meta Box
 * 
 */ 

function uix_products_featured_image_column_remove_post_types( $post_types ) {
    foreach( $post_types as $key => $post_type ) {
        if ( 'uix_products' === $post_type ) // Post type you'd like removed. Ex: 'post' or 'page'
            unset( $post_types[$key] );
    }
    return $post_types;
}

function uix_products_featured_image_column_init() {
    add_filter( 'featured_image_column_post_types', 'uix_products_featured_image_column_remove_post_types', 11 ); // Remove
}
add_action( 'featured_image_column_init', 'uix_products_featured_image_column_init' );




/**
 * Registers the "Products" custom post type
 *
 * @link	http://codex.wordpress.org/Function_Reference/register_post_type
 */
function uix_products_taxonomy_register() {

	// Define post type args
	$args = array(
		'labels'			    => array(
			'name'                  => __( 'Uix Products', 'uix-products' ),
			'singular_name'         => __( 'Products Item', 'uix-products' ),
			'add_new'               => __( 'Add New Item', 'uix-products' ),
			'add_new_item'          => __( 'Add New Products Item', 'uix-products' ),
			'edit_item'             => __( 'Edit Item', 'uix-products' ),
			'new_item'              => __( 'Add New Item', 'uix-products' ),
			'view_item'             => __( 'View Item', 'uix-products' ),
			'search_items'          => __( 'Search Items', 'uix-products' ),
			'not_found'             => __( 'No Items Found', 'uix-products' ),
			'not_found_in_trash'    => __( 'No Items Found In Trash', 'uix-products' ),
		),
        'public'            => true,  
        'show_ui'           => true,  
		'supports'			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'capability_type'	=> 'post',
		'rewrite'			=> array(
		    /*
			 *
			 * Get the single page's permalink from the ID using "http://yoursite.com/products-item/*"
			 *
			 */
			'slug'       => 'products-item'
			
		),
		
		
		
		/*
		 *
		 * Post type archive page working
		 *
		 */
		'has_archive'		=> true,
		'menu_icon'			=> 'dashicons-book-alt',
	);
	
	// Apply filters for child theming
	$args = apply_filters( 'uix_products_args', $args);

	// Register the post type
	register_post_type( 'uix_products', $args );

	
	// Define products category taxonomy args
	$args = array(
		'labels'			    => array(
			'name'                       => __( 'Categories', 'uix-products' ),
			'singular_name'              => __( 'Category', 'uix-products' ),
			'menu_name'                  => __( 'Categories', 'uix-products' ),
			'search_items'               => __( 'Search','uix-products' ),
			'popular_items'              => __( 'Popular', 'uix-products' ),
			'all_items'                  => __( 'All', 'uix-products' ),
			'parent_item'                => __( 'Parent', 'uix-products' ),
			'parent_item_colon'          => __( 'Parent', 'uix-products' ),
			'edit_item'                  => __( 'Edit', 'uix-products' ),
			'update_item'                => __( 'Update', 'uix-products' ),
			'add_new_item'               => __( 'Add New', 'uix-products' ),
			'new_item_name'              => __( 'New', 'uix-products' ),
			'separate_items_with_commas' => __( 'Separate with commas', 'uix-products' ),
			'add_or_remove_items'        => __( 'Add or remove', 'uix-products' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'uix-products' ),
		),
		'public'			    => true,
		'show_in_nav_menus'	=> true,
		'show_ui'			=> true,
		'show_tagcloud'		=> true,
		'hierarchical'		=> true,
		'rewrite'			=> array( 
		 'slug'             => 'products-category'
		), 
		'query_var'			=> true
	);

	// Apply filters for child theming
	$args = apply_filters( 'uix_products_category_args', $args );

	
	// Register the uix_products_category taxonomy
	register_taxonomy( 'uix_products_category', array( 'uix_products' ), $args );
	
  
}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'uix_products_taxonomy_register', 0 );


/**
 * Enable the gallery metabox for products items
 *
 *
 *
 */
function uix_products_taxonomy_gallery_metabox( $types ) {

	// Enable for products
	$types[] = 'uix_products';

	// Return types
	return $types;

}
add_filter( 'gallery_metabox_post_types', 'uix_products_taxonomy_gallery_metabox' );




/**
 * Adds taxonomy filters to the products admin page
 *
 *
 */
function uix_products_taxonomy_tax_filters() {
	
	global $typenow;

	// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array( 'uix_products_category' );

	// must set this to the post type you want the filter(s) displayed on
	if ( $typenow == 'uix_products' ) {

		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if ( count( $terms ) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' ( ' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'uix_products_taxonomy_tax_filters' );


/**
 *  Alter post formats based on custom post types
 *
 *
 *
 */
function uix_products_taxonomy_adjust_formats() {
	if ( isset( $_GET['post'] ) ) {
		$post = get_post($_GET['post']);
		if ($post) {
			$post_type = $post->post_type;
		}
	} elseif ( ! isset( $_GET['post_type'] ) ) {
		$post_type = 'post';
	} elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) ) {
		$post_type = $_GET['post_type'];
	} else {
		return; // Page is going to fail anyway
	}

}
add_action( 'load-post.php', 'uix_products_taxonomy_adjust_formats' );
add_action( 'load-post-new.php', 'uix_products_taxonomy_adjust_formats' );





/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 *
 *
 */
function uix_products_taxonomy_edit_cols( $columns ) {
	
	$columns = array(
		'cb' 		                   => $columns['cb'], 
		'uix-products-thumbnail'       => __( 'Thumbnail', 'uix-products' ),
		'title'                  	   => $columns['title'], 
		'uix-products-type'            => __( 'Type', 'uix-products' ),
		'uix-products-category'        => __( 'Category', 'uix-products' ),
		'author' 	                   => __('Author', 'uix-products'),
		'date'                         => $columns['date']
		
	);
	
	return $columns;
}
add_filter( 'manage_edit-uix_products_columns', 'uix_products_taxonomy_edit_cols' );

/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 * Display the meta_boxes in the column view
 */
function uix_products_taxonomy_cols_display( $columns, $post_id ) {

	switch ( $columns ) {

		case "uix-products-thumbnail":

			// Get post thumbnail ID
			$thumbnail_id = get_post_thumbnail_id();

			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array( '50', '50' ), true );
			}
			if ( isset( $thumb ) ) {
				echo $thumb;
			} else {
				echo '&mdash;';
			}

		break;	

		
		case "uix-products-category":

			if ( $category_list = get_the_term_list( $post_id, 'uix_products_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo '&mdash;';
			}

		break;	
		
		
		case "uix-products-type":
		
            $project_btype = get_post_meta( get_the_ID(), 'uix_products_typeshow', true );
            $project_type  = get_post_meta( get_the_ID(), 'uix_products_themeplugin_type', true );
			
			if ( $project_btype == 'theme-plugin' ) {
				if ( !empty( $project_type ) ) {
					echo '['.$project_type.']';
				}
			} else {
				echo __( '[artwork]', 'uix-products' );
			}

		break;			
		
		
		

	}
}
add_action( 'manage_uix_products_posts_custom_column', 'uix_products_taxonomy_cols_display', 10, 2 );



