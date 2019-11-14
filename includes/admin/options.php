<?php
/*
 * Custom Metaboxes and Fields
 *
 */
if ( class_exists( 'Uix_Products_Custom_Metaboxes' ) ) { 
	

	$custom_metaboxes_uix_products_vars = array(


		//-- Products Type
		array(
			'config' => array( 
				'id'         =>  'uix-products-meta-typeshow', 
				'title'      =>  esc_html__( 'Product Type', 'uix-products' ),
				'screen'     =>  'uix_products', 
				'context'    =>  'side',
				'priority'   =>  'high',
				'fields' => array( 

					array(
						'id'          =>  'uix_products_typeshow',
						'type'        =>  'radio',
						'title'       =>  '',
						'default'     =>  'artwork',
						'options'     =>  array( 
											'br'          => true,
											'radio_type'  => 'normal',
											'value'       => array(
												'artwork'          => '<i class="dashicons dashicons-admin-customizer uix-products-type-icon"></i>'.esc_html__( 'Artwork', 'uix-products' ),
												'theme-plugin'     => '<i class="dashicons dashicons-laptop uix-products-type-icon"></i>'.esc_html__( 'Theme or Plugin', 'uix-products' ),
											 )


										  )

					),




				)
			)

		),



		//-- Artwork Options
		array(
			'config' => array( 
				'id'         =>  'uix-products-meta-artwork-settings', 
				'title'      =>  esc_html__( 'Artwork Settings', 'uix-products' ),
				'screen'     =>  'uix_products', 
				'context'    =>  'normal',
				'priority'   =>  'high',
				'fields' => array( 


					array(
						'id'             =>  'uix_products_artwork_project_url',
						'type'           =>  'url',
						'title'          =>  esc_html__( 'Project URL', 'uix-products' ),
						'placeholder'    =>  esc_html__( 'http://', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Enter destination URL of this project. <strong>(optional)</strong>', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_artwork_client',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Client Name', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Enter name of your clients. <strong>(optional)</strong>', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_artwork_client_URL',
						'type'           =>  'url',
						'title'          =>  esc_html__( 'Client URL', 'uix-products' ),
						'placeholder'    =>  esc_html__( 'http://', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Enter URL of your clients site. <strong>(optional)</strong>', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_artwork_author',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Author', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Enter name of this project author. <strong>(optional)</strong>', 'uix-products' ) ),
					),

					array(
						'id'            =>  'uix_products_artwork_date',
						'type'          =>  'date',
						'title'         =>  esc_html__( 'Release Date', 'uix-products' ),
						'desc_primary'  =>  UixProducts::kses( __( 'Enter date of your projects. <strong>(optional)</strong>', 'uix-products' ) ),
						'options'       =>  array( 
											'format'  => 'MM dd, yy',
										  )


					),

					array(
						'id'            =>  'uix_products_artwork_attrs',
						'type'          =>  'custom-attrs',
						'title'         =>  esc_html__( 'Custom Attributes', 'uix-products' ),
						'options'       =>  array( 
                                                'one_column'         => false, //Use only one column as a separate module
                                                'label_title'        => esc_html__( 'Title', 'uix-products' ),
                                                'label_value'        => esc_html__( 'Value', 'uix-products' ),
                                                'label_upbtn_remove' => esc_html__( 'Remove', 'uix-products' ),
                                                'label_upbtn_add'    => esc_html__( 'Add New', 'uix-products' ),
										  )



					),


				)
			)

		),


		//-- Theme or Plugin Options
		array(
			'config' => array( 
				'id'         =>  'uix-products-meta-themeplugin-settings', 
				'title'      =>  esc_html__( 'Theme or Plugin Settings', 'uix-products' ),
				'screen'     =>  'uix_products', 
				'context'    =>  'normal',
				'priority'   =>  'high',
				'fields' => array( 


					array(
						'id'          =>  'uix_products_themeplugin_type',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Type', 'uix-products' ),
						'default'     =>  'theme',
						'options'     =>  array( 
											'radio_type'  => 'normal',
											'value'       => array(
												'theme'          =>  esc_html__( 'Theme', 'uix-products' ),
												'plugin'         =>  esc_html__( 'Plugin', 'uix-products' ),
											 )


										  )

					),

					array(
						'id'             =>  'uix_products_themeplugin_price',
						'type'           =>  'price',
						'title'          =>  esc_html__( 'Item Prices', 'uix-products' ),
						'desc_primary'   =>  esc_html__( 'Enter your expected value of this item for every single sell minimum.', 'uix-products' ),
						'options'        =>  array( 
											'units'  =>  esc_html__( '$', 'uix-products' )
										  )

					),

					array(
						'id'             =>  'uix_products_themeplugin_name',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Item Name', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'E.g. Uixplant, 15 characters maximum.', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_themeplugin_title',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Item Title', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'E.g. Multi-purpose HTML5 WordPress Theme', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_themeplugin_previewURL',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Demo Link', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Direct link to your demo or video without any iframe, support WP shortcode. (E.g. http://my-site.com/demo/)', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_themeplugin_fileURL',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Purchase/Download Link', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Direct link to the purchase or download page, support WP shortcode. (E.g. http://market-place.com/yourtheme/)', 'uix-products' ) ),
					),


					array(
						'id'             =>  'uix_products_themeplugin_version',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Current Version', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Your Item Version, E.g. 1.0.0', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_themeplugin_dep',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Compatible With', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'E.g. WPML, Bootstrap 3.x, WordPress 4.5+', 'uix-products' ) ),
					),

					array(
						'id'          =>  'uix_products_themeplugin_browsers',
						'type'        =>  'multi-checkbox',
						'title'       =>  esc_html__( 'Compatible Browsers', 'uix-products' ),
						'default'     =>  array( '' ),
						'options'     =>  array( 
											'br'          => true,
											'value'       => array(
												'IE7'             =>   'IE7',
												'IE8'             =>   'IE8',
												'IE9'             =>   'IE9',
												'IE10'            =>   'IE10',
												'IE11'            =>   'IE11',
												'Edge'            =>   'Edge',
												'Chrome'          =>   'Chrome',
												'Firefox'         =>   'Firefox',
												'Safari'          =>   'Safari',
												'Opera'           =>   'Opera',
												'iOS'             =>   'iOS',
												'Android'         =>   'Android',

											 )



										  )

					),


					array(
						'id'          =>  'uix_products_themeplugin_include',
						'type'        =>  'multi-checkbox',
						'title'       =>  esc_html__( 'Files Included', 'uix-products' ),
						'default'     =>  array( '' ),
						'options'     =>  array( 
											'br'          => true,
											'value'       => array(
												'css'         =>   'CSS',
												'html'        =>   'HTML',
												'img'         =>   'Images',
												'js'          =>   'JavaScript',
												'php'         =>   'PHP',
												'svg'         =>   'SVG',
												'psd'         =>   'Photoshop PSD',
												'ai'          =>   'AI',
												'eps'         =>   'EPS',
												'pdf'         =>   'PDF',
												'sketch'      =>   'Sketch Files',
												'other'       =>   'Other',

											 )

										  )

					),

					array(
						'id'          =>  'uix_products_themeplugin_layout',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Layout', 'uix-products' ),
						'default'     =>  'null',
						'options'     =>  array( 
											'radio_type'  => 'normal',
											'value'       => array(
												'null'          => esc_html__( 'Null', 'uix-products' ),
												'responsive'    => esc_html__( 'Responsive', 'uix-products' ),
												'fixed'         => esc_html__( 'Fixed', 'uix-products' ),
												'liquid'        => esc_html__( 'Liquid', 'uix-products' ),
												'static'        => esc_html__( 'Static', 'uix-products' ),
											 )


										  )

					),

					array(
						'id'             =>  'uix_products_themeplugin_addinfo',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Additional Info', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'E.g. Well Documentation', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_themeplugin_install',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Installation Info', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'E.g. Installation and set up instructions are attached (look for Documentation folder).', 'uix-products' ) ),
					),

					array(
						'id'             =>  'uix_products_themeplugin_tags',
						'type'           =>  'text',
						'title'          =>  esc_html__( 'Tags', 'uix-products' ),
						'desc_primary'   =>  UixProducts::kses( __( 'Maximum of 15 keywords covering features, usage, and styling. Keywords should all be in lowercase and separated by commas. e.g. photography, gallery, modern, jquery, wordpress theme', 'uix-products' ) ),
					),


					array(
						'id'            =>  'uix_products_themeplugin_updated_date',
						'type'          =>  'date',
						'title'         =>  esc_html__( 'Updated Date', 'uix-products' ),
						'options'       =>  array( 
											'format'  => 'MM dd, yy',
										  )


					),


					array(
						'id'            =>  'uix_products_themeplugin_attrs',
						'type'          =>  'custom-attrs',
						'title'         =>  esc_html__( 'Custom Attributes', 'uix-products' ),
						'options'       =>  array( 
                                                'one_column'         => false, //Use only one column as a separate module
                                                'label_title'        => esc_html__( 'Title', 'uix-products' ),
                                                'label_value'        => esc_html__( 'Value', 'uix-products' ),
                                                'label_upbtn_remove' => esc_html__( 'Remove', 'uix-products' ),
                                                'label_upbtn_add'    => esc_html__( 'Add New', 'uix-products' ),
										  )



					),
      
   
                    
                    
				)
			)

		),
        
        
        //-- Image Gallery
        array(
            'config' => array( 
                'id'         =>  'uix-products-meta-gallery-settings', 
                'title'      =>  esc_html__( 'Image Gallery', 'uix-products' ),
                'screen'     =>  'uix_products', 
                'context'    =>  'normal',
                'priority'   =>  'high',
                'fields' => array( 


                    array(
                        'id'            =>  '_easy_image_gallery',
                        'type'          =>  'multi-portfolio',
                        'title'         =>  '',
                        'options'       =>  array( 
                                            'one_column'      => true, //Use only one column as a separate module
                                            'label_type'      => array( 
                                                'file' => esc_html__( 'Files', 'uix-products' ),
                                                'html' => esc_html__( 'Text', 'uix-products' )

                                            ),
                                            'label_lightbox'              => esc_html__( 'Enable Lightbox for this gallery?', 'uix-products' ),
                                            'label_controller_up_remove'  => esc_html__( 'Remove', 'uix-products' ),
                                            'label_controller_up_add'     => esc_html__( 'Select an image', 'uix-products' ),
                                            'label_html'           => esc_html__( 'Custom Content', 'uix-products' ),
                                            'label_file'           => esc_html__( 'Upload Your Files', 'uix-products' ),
                                            'label_upbtn_remove'   => esc_html__( 'Remove', 'uix-products' ),
                                            'label_upbtn_add_file' => esc_html__( 'Add Files', 'uix-products' ),
                                            'label_upbtn_add_html' => esc_html__( 'Add Text', 'uix-products' ),
                                            'editor_height'        => 300,
                                            'editor_toolbar'       => 'formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote code alignleft aligncenter alignright uix_products_link uix_products_unlink | removeformat outdent indent superscript subscript hr uix_products_image uix_products_highlightcode media customCode fullscreen'
                                          )



                    ),



                )
            )
        ),  
        
        
        //---


	);

	$custom_metaboxes_uix_products = new Uix_Products_Custom_Metaboxes( $custom_metaboxes_uix_products_vars );

	
}

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


