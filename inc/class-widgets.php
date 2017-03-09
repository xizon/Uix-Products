<?php
/**
 * Custom Widget for displaying recent products
 *
 * @link https://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 */

class Uix_Products_Recent_Products_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_uix_products_recentposts',
			'description' => __( 'Use this widget to list your recent products.', 'uix-products' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'uix_products_recentposts', __( 'Uix Products: Recent Products', 'uix-products' ), $widget_ops );
	}
	

	/**
	 * Output the HTML for this widget.
	 *
	 */
	public function widget( $args, $instance ) {

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
		if ( ! $number )
			$number = 2;
		
		$title  = apply_filters( 'widget_title', !isset( $instance['title'] ) ? __( 'Recent Products', 'uix-products' ) : $instance['title'], $instance, $this->id_base );
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_artwork = isset( $instance['show_artwork'] ) ? $instance['show_artwork'] : false;
		$show_theme = isset( $instance['show_theme'] ) ? $instance['show_theme'] : false;
		$show_plugin = isset( $instance['show_plugin'] ) ? $instance['show_plugin'] : false;
		
		
		$recent_products_arg = '';
		if ( !$show_artwork ) {
		    $qv = array();
			if ( $show_theme ) array_push( $qv, 'theme' );
			if ( $show_plugin ) array_push( $qv, 'plugin' );
			
			$recent_products_arg = array(
									'post_type'           => 'uix_products',
									'posts_per_page'      => $number,
									'no_found_rows'       => true,
									'post_status'         => 'publish',
									'ignore_sticky_posts' => true,
									'meta_query'          => array(
																array(
																		'key'     => 'uix_products_themeplugin_type',
																		'value'   => $qv,
																		'compare' => 'IN',
																   ),
															 ),
									
									);
			
		} else {
			$recent_products_arg = array(
									'post_type'           => 'uix_products',
									'posts_per_page'      => $number,
									'no_found_rows'       => true,
									'post_status'         => 'publish',
									'ignore_sticky_posts' => true,
									'meta_query'          => array(
																array(
																		'key'     => 'uix_products_typeshow',
																		'value'   => 'artwork',
																		'compare' => 'IN',
																   ),
															 ),
									
									);
		}
		
		if ( ( !$show_artwork && !$show_theme && !$show_plugin ) || ( $show_artwork && $show_theme && $show_plugin ) ) {
			$recent_products_arg = array(
									'post_type'           => 'uix_products',
									'posts_per_page'      => $number,
									'no_found_rows'       => true,
									'post_status'         => 'publish',
									'ignore_sticky_posts' => true
							      );
		}
		
		if ( $show_artwork && $show_theme && !$show_plugin ) {
			$recent_products_arg = array(
									'post_type'           => 'uix_products',
									'posts_per_page'      => $number,
									'no_found_rows'       => true,
									'post_status'         => 'publish',
									'ignore_sticky_posts' => true,
									'meta_query'          => array(
									                            'relation' => 'OR',
																array(
																		'key'     => 'uix_products_typeshow',
																		'value'   => 'artwork',
																		'compare' => 'IN',
																 ),
																array(
																		'key'     => 'uix_products_themeplugin_type',
																		'value'   => 'theme',
																		'compare' => 'IN',
																 ), 
															 ),
									
									);
		}
		
		
		if ( $show_artwork && !$show_theme && $show_plugin ) {
			$recent_products_arg = array(
									'post_type'           => 'uix_products',
									'posts_per_page'      => $number,
									'no_found_rows'       => true,
									'post_status'         => 'publish',
									'ignore_sticky_posts' => true,
									'meta_query'          => array(
									                            'relation' => 'OR',
																array(
																		'key'     => 'uix_products_typeshow',
																		'value'   => 'artwork',
																		'compare' => 'IN',
																 ),
																array(
																		'key'     => 'uix_products_themeplugin_type',
																		'value'   => 'plugin',
																		'compare' => 'IN',
																 ), 
															 ),
									
									);
		}
		
				

		$recent_products = new WP_Query( $recent_products_arg );

		if ( $recent_products->have_posts() ) :
	
			echo $args['before_widget'];
			?>
			 <?php
             if ( !empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
             }
             ?>
			<ul class="uix-products-widget">

				<?php
					while ( $recent_products->have_posts() ) :
						$recent_products->the_post();
						
						$info_class      = '';
						
						if ( !has_post_thumbnail() ) $info_class = 'no-image';
						
						// Echo themes
						if ( $show_theme )
							
						
				?>
				<li class="uix-products-recent-item">
                      
						  <?php if ( has_post_thumbnail() ) { ?>
                           <div class="item-thumb">
                               <a href="<?php the_permalink(); ?>">
                           <?php
								$imgarr = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'uix-products-retina-entry' );
                                the_post_thumbnail( 'uix-products-entry', array(
                                    'alt' => esc_attr( get_the_title() ),
									'data-retina' => esc_url( $imgarr[0] ),
                                ) ); 
							?>
                                </a>
                            </div>
                            <?php } ?>
                       
                       <div class="item-info <?php echo esc_attr( $info_class ); ?>">
                           <div class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                           <?php if ( $show_date ) { ?>
                               <div class="item-date"><?php echo get_the_date(); ?></div>
                           <?php } ?>

                       </div>
                     
    
				</li>
				<?php endwhile; ?>

			</ul>
			
			<?php

			echo $args['after_widget'];

			// Reset the post globals as this query will have stomped on it.
			wp_reset_postdata();


		endif; // End check for recent_productsl posts.
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_artwork'] = isset( $new_instance['show_artwork'] ) ? (bool) $new_instance['show_artwork'] : false;
		$instance['show_theme'] = isset( $new_instance['show_theme'] ) ? (bool) $new_instance['show_theme'] : false;
		$instance['show_plugin'] = isset( $new_instance['show_plugin'] ) ? (bool) $new_instance['show_plugin'] : false;
		
		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 */
	function form( $instance ) {
		$instance  = wp_parse_args( (array) $instance, array( 'title' => __( 'Recent Products', 'uix-products' ), 'number' => 2 ) );
		$title     = sanitize_text_field( $instance['title'] );
		$number    = absint( $instance['number'] );
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_artwork = isset( $instance['show_artwork'] ) ? (bool) $instance['show_artwork'] : false;
		$show_theme = isset( $instance['show_theme'] ) ? (bool) $instance['show_theme'] : false;
		$show_plugin = isset( $instance['show_plugin'] ) ? (bool) $instance['show_plugin'] : false;
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'uix-products' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of products to show:', 'uix-products' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        
		<p><input class="checkbox" type="checkbox"<?php checked( $show_artwork ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_artwork' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_artwork' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_artwork' ) ); ?>"><?php _e( 'Only display artworks?', 'uix-products' ); ?></label>
        </p>    
        
        
		<p><input class="checkbox" type="checkbox"<?php checked( $show_theme ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_theme' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_theme' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_theme' ) ); ?>"><?php _e( 'Only display themes?', 'uix-products' ); ?></label>
        </p> 
        
		<p><input class="checkbox" type="checkbox"<?php checked( $show_plugin ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_plugin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_plugin' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_plugin' ) ); ?>"><?php _e( 'Only display plugins?', 'uix-products' ); ?></label>
        </p>  

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php _e( 'Display post date?', 'uix-products' ); ?></label>
        </p>
  

		<?php
	}
}
