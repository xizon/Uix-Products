<?php

/*
 * Removing a Meta Box
 * 
 */ 
if ( !function_exists( 'uix_products_featured_image_column_init' ) ) {
  
    add_action( 'featured_image_column_init', 'uix_products_featured_image_column_init' );
    function uix_products_featured_image_column_init() {
        add_filter( 'featured_image_column_post_types', 'uix_products_featured_image_column_remove_post_types', 11 ); // Remove
    }  
    
    function uix_products_featured_image_column_remove_post_types( $post_types ) {
        foreach( $post_types as $key => $post_type ) {
            if ( 'uix_products' === $post_type ) // Post type you'd like removed. Ex: 'post' or 'page'
                unset( $post_types[$key] );
        }
        return $post_types;
    }

    
}


/**
 * Registers the "Products" custom post type
 *
 * @link	http://codex.wordpress.org/Function_Reference/register_post_type
 */
if ( !function_exists( 'uix_products_taxonomy_register' ) ) {
    // hook into the init action and call create_book_taxonomies when it fires
    add_action( 'init', 'uix_products_taxonomy_register', 0 );
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
  
}




/**
 * Enable the gallery metabox for products items
 *
 *
 *
 */
if ( !function_exists( 'uix_products_taxonomy_gallery_metabox' ) ) {
    add_filter( 'gallery_metabox_post_types', 'uix_products_taxonomy_gallery_metabox' );
    function uix_products_taxonomy_gallery_metabox( $types ) {

        // Enable for products
        $types[] = 'uix_products';

        // Return types
        return $types;

    }
 
}





/**
 * Adds "taxonomy" and "custom product types for metaboxes" filters to the products admin page
 *
 *
 */
if ( !class_exists( 'Uix_Products_Walker_Custom_CategoryDropdown' ) ) {
	class Uix_Products_Walker_Custom_CategoryDropdown extends Walker_CategoryDropdown {

		public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
			$pad = str_repeat('&nbsp;', $depth * 3);

			/** This filter is documented in wp-includes/category-template.php */
			$cat_name = apply_filters( 'list_cats', $category->name, $category );

			if ( isset( $args['value_field'] ) && isset( $category->{$args['value_field']} ) ) {
				$value_field = $args['value_field'];
			} else {
				$value_field = 'slug';
			}


			$output .= "\t<option class=\"level-$depth\" data-term-id=\"" . esc_attr( $category->{$value_field} ) . "\"";

			// Type-juggling causes false matches, so we force everything to a string.
			if ( isset( $_GET[$category->taxonomy] ) && (string) $_GET[$category->taxonomy] === (string) $category->slug )
				$output .= ' selected="selected"';

			$output .= ' value="'.esc_attr($category->slug).'" '; /* Custom */

			$output .= '>';
			$output .= $pad.$cat_name;
			if ( $args['show_count'] )
				$output .= '&nbsp;&nbsp;('. number_format_i18n( $category->count ) .')';
			$output .= "</option>\n";
		}
	}

}



if ( !function_exists( 'uix_products_taxonomy_tax_filters' ) ) {
    add_action( 'restrict_manage_posts', 'uix_products_taxonomy_tax_filters' );
    function uix_products_taxonomy_tax_filters() {

        global $typenow;
        

		//get Custom product types for metaboxes
		global $uix_products_typeshow_val;

        // must set this to the post type you want the filter(s) displayed on
        if ( $typenow == 'uix_products' ) {

            // Filtering for Post Formats
            //--------------------

            $cat_taxonomy = 'uix_products_category';

            // An array of all the taxonomyies you want to display. Use the taxonomy name or slug
            $taxonomies = array( $cat_taxonomy );

            foreach ( $taxonomies as $tax_slug ) {
                $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
                $tax_obj = get_taxonomy( $tax_slug );
				
                $tax_name = $tax_obj->labels->name;
				
				
				$taxonomies = get_terms( array(
					'taxonomy' => $tax_slug,
					'hide_empty' => true
				) );
				
				
				wp_dropdown_categories( array(
                    'show_option_all' => __('All Categories', 'uix-products'),
					'taxonomy' => $tax_slug,
					'name' => $cat_taxonomy,
					'id' => $cat_taxonomy,
                    'order' => 'asc',
                    'orderby' => 'name',
                    'show_count' => true,
					'class' => 'postform',
					'hide_empty' => true,
					'hierarchical' => true,
					'walker'  => new Uix_Products_Walker_Custom_CategoryDropdown()
				) );

            }

            // Filtering for Custom product types for metaboxes
            //--------------------
            //check product type
            if ( is_array( $uix_products_typeshow_val ) ) {
            
                // generate select
                $select_id_for_type = 'uix_products_typeshow';
                $current_type = isset($_GET[$select_id_for_type]) ? $_GET[$select_id_for_type] : '';
                echo '<select name="'.$select_id_for_type.'" id=" '.$select_id_for_type.'">';
                echo '<option value = "" >'.__( 'All Types', 'uix-products' ).'</option>';



                foreach ($uix_products_typeshow_val as $key=>$value) {

                    // get count
                    $count_show = '';
                    $current_adminpage_url = admin_url(basename($_SERVER['REQUEST_URI']));
                    $current_adminpage_url_params = explode( '?', $current_adminpage_url);
                    $current_adminpage_url_params_count = count(explode( '&', $current_adminpage_url_params[1]));

                    if ( $current_adminpage_url_params_count === 1 ) {

                        // get count
                        $relevant_products = new WP_Query(array(
                            'post_type'           => 'uix_products',
                            'posts_per_page'      => -1,  // required
                            'post_status'         => 'publish',
                            'meta_query'          => array(
                                                        array(
                                                                'key'     => $select_id_for_type,
                                                                'value'   => $key
                                                        ),
                                                    ),
                            
                            ));

                        $count_show = ' ('.number_format_i18n($relevant_products->post_count).')';
                        
                        // Restore original Post Data
                        wp_reset_postdata();

                        
                    }

                 
                    echo '<option value="', sanitize_title($key), '"', $key == $current_type ? ' selected="selected"' : '', '>', strip_tags($value), $count_show.'</option>';

                    // Restore original Post Data
                    wp_reset_postdata();

                }	

                echo '</select>';
            } 


        }



    }  
}




/**
 *  Alter post formats based on custom post types
 *
 *
 *
 */
if ( !function_exists( 'uix_products_taxonomy_adjust_formats' ) ) {
    add_action( 'load-post.php', 'uix_products_taxonomy_adjust_formats' );
    add_action( 'load-post-new.php', 'uix_products_taxonomy_adjust_formats' );
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
  
}






/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 *
 *
 */
if ( !function_exists( 'uix_products_taxonomy_edit_cols' ) ) {
    add_filter( 'manage_edit-uix_products_columns', 'uix_products_taxonomy_edit_cols' );
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
 
}



/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 * Display the meta_boxes in the column view
 */
if ( !function_exists( 'uix_products_taxonomy_cols_display' ) ) {
    add_action( 'manage_uix_products_posts_custom_column', 'uix_products_taxonomy_cols_display', 10, 2 );
    function uix_products_taxonomy_cols_display( $columns, $post_id ) {

		//get Custom product types for metaboxes
		global $uix_products_typeshow_val;

        switch ( $columns ) {
                
            

            //------
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


            //------
            case "uix-products-category":
                
                $category_list = get_the_term_list( $post_id, 'uix_products_category', '', ', ', '' );
                $category_list_no_link = wp_get_object_terms( $post_id, 'uix_products_category' );
                

                if ( $category_list_no_link ) {
					
					$to_end = count($category_list_no_link);
					$category_list_no_link = array_reverse($category_list_no_link);
					$cat_slug = ( isset( $_GET['uix_products_category'] ) ) ? $_GET['uix_products_category'] : '';
					
					$params = array( 
							'post_type' => 'uix_products',
							'uix_products_category' => $cat_slug
						);

    

                    //push new param "uix_products_typeshow"
					$temp_var_typeshow = 'uix_products_typeshow';
					if ( isset( $_GET[ $temp_var_typeshow ] ) && !empty( $_GET[ $temp_var_typeshow ] ) ) {
						array_push( $params, array( 
							$temp_var_typeshow => $_GET[ $temp_var_typeshow ]
						));
					}

                    //push new param "order"
					if ( isset( $_GET[ 'order' ] ) && !empty( $_GET[ 'order' ] ) ) {
						array_push( $params, array( 
							'order' => $_GET[ 'order' ]
						));
					}    

					
					//echo categories
					foreach ($category_list_no_link as $key=>$value) {

                        $_url = esc_url( admin_url( 'edit.php' ) . '?post_type=uix_products&uix_products_category=' . $value -> slug ); 
						$_split = ', ';
						
						if (0 === --$to_end) {
						    $_split = '';
						}
						
						echo '<a href="'.$_url.'">'.$value -> name.'</a>' . $_split;	
						
					}
                    

                } else {
                    echo '&mdash;';
                }

            break;	


            //------
            case "uix-products-type":

                $type = get_post_meta( get_the_ID(), 'uix_products_typeshow', true );
				
                if ( !empty( $type ) ) {
                
                    $params = array( 
                            'post_type' => 'uix_products',
                            'uix_products_typeshow' => $type
                        );

                    //push new param "uix_products_category"
                    $temp_var_typeshow = 'uix_products_category';
                    if ( isset( $_GET[ $temp_var_typeshow ] ) && !empty( $_GET[ $temp_var_typeshow ] ) ) {
                        array_push( $params, array( 
                            $temp_var_typeshow => $_GET[ $temp_var_typeshow ]
                        ));
                    }


                    //push new param "order"
                    if ( isset( $_GET[ 'order' ] ) && !empty( $_GET[ 'order' ] ) ) {
                        array_push( $params, array( 
                            'order' => $_GET[ 'order' ]
                        ));
                    }      
                    
                    $_url = esc_url( add_query_arg( $params, admin_url( 'edit.php' ) ) ); 
                    
             
					//check product type
					if ( is_array( $uix_products_typeshow_val ) ) {
						
						$cat_not_match_str = '&mdash;';
							
						foreach ($uix_products_typeshow_val as $key=>$value) {
							if ( $key == $type ) {
								echo '<a href="'.$_url.'">'.$value.'</a>';
								$cat_not_match_str = '';
								break;
							}
						}	
						echo $cat_not_match_str;
					} else {
						echo '&mdash;';
					}

                    
                } else {
                    echo '&mdash;';
                }         
                

            break;			


            //------


        }
    }


   
}



/**
 * Custom column sorting and filtering for custom post type
 *
 */
if ( !function_exists( 'uix_products_admin_posts_filter' ) ) {
    add_filter( 'parse_query', 'uix_products_admin_posts_filter' );
    function uix_products_admin_posts_filter($query) {
        global $pagenow;

        $qv = &$query->query_vars;
        

        if ( is_admin() && $pagenow == 'edit.php' && (isset( $_GET[ 'post_type' ] ) && $_GET['post_type'] == 'uix_products') ) {

    
            // Update query with filter
            if ( isset( $_GET[ 'uix_products_typeshow' ] ) && !empty( $_GET[ 'uix_products_typeshow' ] ) ) {
                $args = array(

                    'meta_query'  => array(
                                        array(
                                                'key'     => 'uix_products_typeshow',
                                                'value'   => $_GET[ 'uix_products_typeshow' ],
                                                'compare' => 'IN',
                                           )
                                     )
                );


                $query -> set( 'meta_query', $args );

                return $query;    

            } 

        }
    }

}


    


/**
 * Add Sortable Custom Columns in WordPress Dashboard  
 *
 */
if ( !function_exists( 'uix_products_register_post_column_views_sortable' ) ) {
    add_filter( 'manage_edit-uix_products_sortable_columns', 'uix_products_register_post_column_views_sortable' );
    function uix_products_register_post_column_views_sortable( $newcolumn ) {
        $newcolumn['uix-products-category'] = 'uix-products-category';
        $newcolumn['uix-products-type'] = 'uix-products-type';
        return $newcolumn;
    }

}



/**
 * Set default title for Wordpress Custom Post Types
 *
 */
if ( !function_exists( 'uix_products_mask_empty_post_title' ) ) {
	add_filter('pre_post_title', 'uix_products_mask_empty_post_title');
	function uix_products_mask_empty_post_title($value) {

		if( get_post_type() === 'uix_products' ) {
			if ( empty($value) ) {
				return __( '(no title)' );
			}	
		}

		return $value;
	}
}

