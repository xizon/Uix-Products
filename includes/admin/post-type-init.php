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
 * Adds taxonomy filters to the products admin page
 *
 *
 */
if ( !function_exists( 'uix_products_taxonomy_tax_filters' ) ) {
    add_action( 'restrict_manage_posts', 'uix_products_taxonomy_tax_filters' );
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

                if ( $category_list = get_the_term_list( $post_id, 'uix_products_category', '', ', ', '' ) ) {
                    echo $category_list;
                } else {
                    echo '&mdash;';
                }

            break;	


            //------
            case "uix-products-type":

                $type = get_post_meta( get_the_ID(), 'uix_products_typeshow', true );
                if ( !empty( $type ) ) {
                    echo "[{$type}]";
                } else {
                    echo '&mdash;';
                }         
                

            break;			


            //------


        }
    }


   
}


