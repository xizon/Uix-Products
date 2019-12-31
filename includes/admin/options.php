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
                                            'label_controller_up_add'     => esc_html__( 'Select image or video', 'uix-products' ),
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
