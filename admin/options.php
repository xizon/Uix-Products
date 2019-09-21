<?php
/*
 * Custom Metaboxes and Fields
 *
 */


/*

 
if ( class_exists( 'Uix_Products_Custom_Metaboxes' ) ) {

	$custom_metaboxes_page_vars = array(

		//-- Group
		array(
			'config' => array( 
				'id'         =>  'yourtheme_metaboxes-1', 
				'title'      =>  esc_html__( '[Demo] Normal Fields', 'your-theme' ),
				'screen'     =>  'page', 
				'context'    =>  'normal',
				'priority'   =>  'high',
				'fields' => array( 
					array(
						'id'          =>  'cus_page_ex_demoname_1',
						'type'        =>  'textarea',
						'title'       =>  esc_html__( 'Textarea', 'your-theme' ),
						'placeholder' =>  esc_html__( 'Placeholder Text', 'your-theme' ),
						'desc'        =>  esc_html__( 'Here is the description. It could be left blank. (Support for HTML tags)', 'your-theme' ),
						'default'     =>  '',
						'options'     =>  array( 
											'rows'  => 5	
										  )
					),
					array(
						'id'            =>  'cus_page_ex_demoname_2',
						'type'          =>  'text',
						'title'         =>  esc_html__( 'Text', 'your-theme' ),
						'desc_primary'  =>  esc_html__( 'Here is the description. It could be left blank.', 'your-theme' ),
						'default'       =>  '123',
					),

					array(
						'id'            =>  'cus_page_ex_demoname_3',
						'type'          =>  'url',
						'title'         =>  esc_html__( 'URL', 'your-theme' )
					),

					array(
						'id'          =>  'cus_page_ex_demoname_4',
						'type'        =>  'number',
						'title'       =>  esc_html__( 'Number', 'your-theme' ),
						'options'     =>  array( 
											'units'  =>  esc_html__( 'px', 'your-theme' )
										  )

					),



					array(
						'id'          =>  'cus_page_ex_demoname_5',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Radio', 'your-theme' ),
						'default'     =>  '2',
						'options'     =>  array( 
											'radio_type'  => 'normal',
											'value'       => array(
												'1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'2'            =>  esc_html__( 'Option: 2 (Default)', 'your-theme' ),
												'3'            =>  esc_html__( 'Option: 3', 'your-theme' ),	
											 )


										  )

					),

					array(
						'id'          =>  'cus_page_ex_demoname_5_2',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Radio 2', 'your-theme' ),
						'options'     =>  array( 
											'br'          => true,
											'radio_type'  => 'normal',
											'value'       => array(
												'1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'2'            =>  esc_html__( 'Option: 2', 'your-theme' ),
												'3'            =>  esc_html__( 'Option: 3', 'your-theme' ),	
											 )


										  )

					),



					array(
						'id'            =>  'cus_page_ex_demoname_6',
						'type'          =>  'radio',
						'title'         =>  esc_html__( 'Radio(Associated)', 'your-theme' ),
						'desc_primary'  =>  esc_html__( 'It is valid to assign height to page title area when the featured image is not empty.', 'your-theme' ),

						'default'     =>  'normal',
						'options'     =>  array( 
											'radio_type'  => 'normal',
											'value'       =>  array(
												'normal'       =>  esc_html__( 'Option: Normal(Default)', 'your-theme' ),
												'higher'       =>  esc_html__( 'Option: Higher', 'your-theme' ),
												'full-screen'  =>  esc_html__( 'Option: Full Screen', 'your-theme' ),
												'cus-height'   =>  esc_html__( 'Option: Custom Height', 'your-theme' ),
											 ),
											'toggle'      =>  array(
												'normal'       =>  '',
												'higher'       =>  '',
												'full-screen'  =>  array(
                                                                    'id'             =>  'cus_page_ex_demoname_6_opt-full-screen-toggle',
                                                                    'type'           =>  'text',
                                                                    'title'          =>  esc_html__( 'full-screen', 'uix-products' ),
                                                                    'desc_primary'   =>  '',
                                                                ),
												'cus-height'   =>  array( 
                                                                    'id'       =>  'cus_page_ex_demoname_6_opt-cus-height-toggle', 
                                                                    'type'     =>  'number',
                                                                    'default'  =>  350,
                                                                    'options'     =>  array( 
                                                                                        'units'  =>  esc_html__( 'px', 'your-theme' )
                                                                                      )
                                                                ),
											 ),
										  )

					),


					array(
						'id'          =>  'cus_page_ex_demoname_7',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Radio Image', 'your-theme' ),
						'default'     =>  'no-sidebar',
						'options'     =>  array( 
											'radio_type'  => 'image',
											'value'       => array(
												'no-sidebar'    =>  esc_url( '/images/layouts/no-sidebar.png' ),
												'sidebar'       =>  esc_url( '/images/layouts/sidebar.png' ),
											 )


										  )

					),

					array(
						'id'            =>  'cus_page_ex_demoname_8',
						'type'          =>  'checkbox',
						'title'         =>  esc_html__( 'Checkbox', 'your-theme' ),
						'desc_primary'  =>  esc_html__( 'Here is the description. It could be left blank.', 'your-theme' ),

					),

					array(
						'id'          =>  'cus_page_ex_demoname_9',
						'type'        =>  'select',
						'title'       =>  esc_html__( 'Select', 'your-theme' ),
						'default'     =>  '3',
						'options'     =>  array( 
											'value'       => array(
												'1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'2'            =>  esc_html__( 'Option: 2', 'your-theme' ),
												'3'            =>  esc_html__( 'Option: 3 (Default)', 'your-theme' ),	
											 )


										  )

					),

					array(
						'id'             =>  'cus_page_ex_demoname_10',
						'type'           =>  'price',
						'title'          =>  esc_html__( 'Price', 'your-theme' ),
						'desc_primary'   =>  esc_html__( 'Here is the description. It could be left blank.', 'your-theme' ),
						'options'        =>  array( 
											'units'  =>  esc_html__( '$', 'your-theme' )
										  )

					),

					array(
						'id'          =>  'cus_page_ex_demoname_11',
						'type'        =>  'multi-checkbox',
						'title'       =>  esc_html__( 'Multi Checkbox', 'your-theme' ),
						'default'     =>  array( 'opt-1', 'opt-3' ),
						'options'     =>  array( 
											'br'          => true,
											'value'       => array(
												'opt-1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'opt-2'            =>  esc_html__( 'Option: 2', 'your-theme' ),
												'opt-3'            =>  esc_html__( 'Option: 3', 'your-theme' ),	
												'opt-4'            =>  esc_html__( 'Option: 4', 'your-theme' ),
												'opt-5'            =>  esc_html__( 'Option: 5', 'your-theme' ),
												'opt-6'            =>  esc_html__( 'Option: 6', 'your-theme' ),	
											 )


										  )

					),



				)
			)

		),

		//-- Group
		array(
			'config' => array( 
				'id'         =>  'yourtheme_metaboxes-2', 
				'title'      =>  esc_html__( '[Demo] Appearance Fields', 'your-theme' ),
				'screen'     =>  'page',
				'context'    =>  'normal',
				'priority'   =>  'high',
				'fields' => array( 
					array(
						'id'          =>  'cus_page_ex_demoname_appear_1',
						'type'        =>  'image',
						'title'       =>  esc_html__( 'Image', 'your-theme' ),
						'placeholder' =>  esc_html__( 'Image URL', 'your-theme' ),
					),
					array(
						'id'       =>  'cus_page_ex_demoname_appear_2',
						'type'     =>  'color',
						'title'    =>  esc_html__( 'Color', 'your-theme' ),
					),
					array(
						'id'       =>  'cus_page_ex_demoname_appear_3',
						'type'     =>  'editor',
						'title'    =>  esc_html__( 'Editor', 'your-theme' ),
						'options'     =>  array( 
											'height'  => 200,
											'toolbar'  => 'formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote code alignleft aligncenter alignright uix_products_link uix_products_unlink | removeformat outdent indent superscript subscript hr uix_products_image uix_products_highlightcode media customCode fullscreen'
										  )
					),
					array(
						'id'            =>  'cus_page_ex_demoname_appear_4',
						'type'          =>  'date',
						'title'         =>  esc_html__( 'Date', 'your-theme' ),
						'desc_primary'  =>  UixShortcodes::kses( __( 'Enter date of your projects. <strong>(optional)</strong>', 'your-theme' ) ),
						'options'       =>  array( 
											'format'  => 'MM dd, yy',
										  )


					),

					array(
						'id'            =>  'cus_page_ex_demoname_appear_5',
						'type'          =>  'custom-attrs',
						'title'         =>  esc_html__( 'Custom Attributes', 'your-theme' ),
						'options'       =>  array( 
											'label_title'  => esc_html__( 'Title', 'your-theme' ),
											'label_value'  => esc_html__( 'Value', 'your-theme' ),
										  )



					),
                    
                    
                    
					array(
						'id'            =>  'uix_products_themeplugin_multicontent',
						'type'          =>  'multi-content',
						'title'         =>  esc_html__( 'Multiple Content Area', 'uix-products' ),
						'options'       =>  array( 
											'label_title'      => esc_html__( 'Title', 'uix-products' ),
											'label_value'      => esc_html__( 'Contnet', 'uix-products' ),
                                            'label_id'         => esc_html__( 'Step ID', 'uix-products' ),
                                            'label_subtitle'   => esc_html__( 'Subtitle', 'uix-products' ),
                                            'label_level'      => esc_html__( 'Level', 'uix-products' ),
                                            'label_classname'  => esc_html__( 'Class Name', 'uix-products' ),
                                            'height_teeny'     => 50,
                                            'toolbar_teeny'    => 'formatselect forecolor backcolor bold italic underline strikethrough alignleft aligncenter alignright uix_products_link uix_products_unlink removeformat customCode',
											'height'           => 450,
											'toolbar'          => 'formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote code alignleft aligncenter alignright uix_products_link uix_products_unlink | removeformat outdent indent superscript subscript hr uix_products_image uix_products_highlightcode media customCode fullscreen'
										  )



					),




				)
			)

		),	
	);

	$custom_metaboxes_page = new Uix_Products_Custom_Metaboxes( $custom_metaboxes_page_vars );
}


 */



/*
 [Front-end Page]:
 
 $demoname = get_post_meta( get_the_ID(), 'cus_page_ex_demoname_1', true );
 
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
											'label_title'  => esc_html__( 'Title', 'uix-products' ),
											'label_value'  => esc_html__( 'Value', 'uix-products' ),
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
											'label_title'  => esc_html__( 'Title', 'uix-products' ),
											'label_value'  => esc_html__( 'Value', 'uix-products' ),
										  )



					),
                    
                    

   
                    
                    
				)
			)

		),


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



