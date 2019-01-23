<?php
/**
 * Template Name: Uix Products
 *
 * The template for displaying products pages.
 *
 */
 
 
if ( !class_exists( 'UixProducts' ) ) {
    return;
}

$layout              = get_option( 'uix_products_opt_layout', 'standard' );
$filter              = get_option( 'uix_products_opt_filterable', false );
$numeric_pagination  = get_option( 'uix_products_opt_pagination', true );
$per                 = ( $filter ? -1 : intval( get_option( 'uix_products_show', 10 ) ) );

get_header(); ?>

    <section class="uix-products-section">
        <div class="container">
        
            <?php the_title( '<h2>', '</h2>' ); ?>
            
            <div class="uix-products-cat-list" id="nav-filters-<?php the_ID(); ?>">
                <ul>
                    <li class="current-cat"><a href="javascript:" data-group="all"><?php esc_html_e( 'All', 'uix-products'); ?></a></li>
                    <?php
                        wp_list_categories(array(
                        
                            'show_option_all'    => '', 
                            'orderby'            => 'id', 
                            'order'              => 'asc',
                            'style'              => 'list', 
                            'show_count'         => 0,
                            'hide_empty'         => 1,
                            'use_desc_for_title' => 1,
                            'child_of'           => 0,
                            'feed'               => '',
                            'feed_type'          => '', 
                            'feed_image'         => '',
                            'exclude'            => '',
                            'exclude_tree'       => '',
                            'include'            => '',
                            'hierarchical'       => 0,
                            'title_li'           => '',
                            'show_option_none'   => __( 'No categories', 'uix-products' ),
                            'number'             => null,
                            'echo'               => 1,
                            'depth'              => 0,
                            'current_category'   => 0,
                            'pad_counts'         => 1,
                            'taxonomy'           => 'uix_products_category',
                            'walker'             => new Uix_Products_Dropdown_Walker_Products_Category
                        
                        ));
                    
                    ?>
                </ul>
            </div>
            <!-- .uix-products-cat-list  end --> 
        
            <div class="uix-products-container meduim" data-show-type="<?php echo esc_attr( $layout ); ?><?php echo esc_attr( ( $filter ? '|filter' : '' ) ); ?>" data-filter-id="<?php echo esc_attr( ( $filter ? '#nav-filters-'.get_the_ID() : '' ) ); ?>">
                <div class="uix-products-tiles">
                    <?php    
                        $wp_query = new WP_Query(
                            array(
                                'post_type'      => 'uix_products',
								'posts_per_page' => $per, 
								'paged'          => $paged
                            )
                        );
                        
                            
                        if ( $wp_query->have_posts() ) { 
                            while ($wp_query->have_posts()) : $wp_query->the_post(); 
                                get_template_part( 'content', 'uix_products' );
                            endwhile; 
                            
                            wp_reset_postdata();	
                            
                        } else { 
                            get_template_part( 'content', 'none' );
                        } 
                      ?>
                </div>
            </div>
            <!-- .uix-products-container end -->
            
            
            <div class="uix-products-pagination-container">
                <?php 
                 if ( $numeric_pagination ) {
                        //Use numeric Paginate
                        UixProducts::pagination( 3, '&larr;', '&rarr;', true );	 
                 } else {
                        //Only "next" and "previous" button
                        UixProducts::pagejump( '&larr;', '&rarr;', true ); 
                 }
                ?>
            </div>

        
        
        
        </div>
        <!-- .container end -->
    </section>

<?php get_footer(); ?>


