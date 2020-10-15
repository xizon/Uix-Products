<?php
/**
 * Template part for displaying products.
 *
 * 
 */

$layout            = get_option( 'uix_products_opt_layout', 'standard' );
$cat_termlist      = get_the_term_list( get_the_ID(), 'uix_products_category', '', ', ', '' );
$gallery           = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
$lightbox_enable   = NULL;

// Thumbnail size
if ( $layout == 'masonry' ) { 
    $thumbnail_size        = 'uix-products-autoheight-entry';
	$thumbnail_retina_size = 'uix-products-autoheight-retina-entry';
} else {
	$thumbnail_size        = 'uix-products-entry';
	$thumbnail_retina_size = 'uix-products-retina-entry';
}

?>

<?php  if ( is_singular() ) {  ?>


    <div id="uix-products-item-<?php the_ID(); ?>">
		
		
		 <?php
			$custom_slideshow_opt_animation       = 'slide';  //slide,scale,none
			$custom_slideshow_opt_auto            = true;
			$custom_slideshow_opt_effect_duration = 600;
			$custom_slideshow_opt_speed           = 10000;
			$custom_slideshow_opt_paging_nav      = true;
			$custom_slideshow_opt_arr_nav         = true;
			$custom_slideshow_opt_animloop        = true;
			$custom_slideshow_opt_drag            = false;


			$translation_array = array(
				'animation'        =>  $custom_slideshow_opt_animation,
				'auto'             =>  ( $custom_slideshow_opt_auto ) ? 'true' : 'false',
				'duration'         =>  $custom_slideshow_opt_effect_duration,
				'speed'            =>  $custom_slideshow_opt_speed,
				'paging_nav'       =>  ( $custom_slideshow_opt_paging_nav ) ? 'true' : 'false',
				'arr_nav'          =>  ( $custom_slideshow_opt_arr_nav ) ? 'true' : 'false',
				'animloop'         =>  ( $custom_slideshow_opt_animloop ) ? 'true' : 'false',
				'draggable'        =>  ( $custom_slideshow_opt_drag ) ? 'true' : 'false'
			);


		?>



			<div role="banner" class="uix-products-slideshow__wrapper">
			   <div data-uix-products-slideshow="1" class="uix-products-slideshow__outline uix-products-slideshow uix-products-slideshow--eff-<?php echo esc_attr( $translation_array[ 'animation' ] ); ?>" 
				  data-draggable="<?php echo esc_attr( $translation_array[ 'draggable' ] ); ?>"
				  data-draggable-cursor="move"	   
				  data-auto="<?php echo esc_attr( $translation_array[ 'auto' ] ); ?>"
				  data-loop="<?php echo esc_attr( $translation_array[ 'animloop' ] ); ?>"
				  data-speed="<?php echo esc_attr( $translation_array[ 'duration' ] ); ?>"
				  data-timing="<?php echo esc_attr( $translation_array[ 'speed' ] ); ?>" 
				  data-count-total="false"
				  data-count-now="false"
				  data-controls-pagination=".my-a-slider-pagination-<?php the_ID(); ?>" 
				  data-controls-arrows=".my-a-slider-arrows-<?php the_ID(); ?>">
				   <div class="uix-products-slideshow__inner">

						<?php             
						$_data = json_decode( $gallery, true );

						if ( is_array( $_data ) && sizeof( $_data ) > 1 ) {

							//----------
							foreach( $_data as $index => $value ) {
								if ( is_array( $value ) && sizeof( $value ) > 0 ) {

									//Exclude lightbox fields
									if ( array_key_exists( 'lightbox', $value ) ) {
										$lightbox_enable = esc_attr( Uix_Products_Custom_Metaboxes::parse_json_data_from_editor( $value[ 'lightbox' ] ) );
										break;
									}//endif array_key_exists( 'lightbox', $value )
								}//endif $value
							}//end foreach      


							//----------
							foreach( $_data as $index => $value ) :

								if ( is_array( $value ) && sizeof( $value ) > 0 ) {
									//Exclude lightbox fields
									if ( ! array_key_exists( 'lightbox', $value ) ) {
										
										$img_url = Uix_Products_Custom_Metaboxes::parse_json_data_from_editor( $value[ 'filePath' ] );
										
										if ( !empty( $img_url ) ) {

								?>
					   
					   
									<?php if (  'on' == $lightbox_enable ) { ?>
										<a href="<?php echo esc_url( $img_url ); ?>" rel="uix-products-slider-prettyPhoto[<?php the_ID(); ?>]">
									<?php } ?>    
					   
									<div class="uix-products-slideshow__item uix-products-portfolio-type-<?php echo esc_attr( Uix_Products_Custom_Metaboxes::parse_json_data_from_editor( $value[ 'type' ] ) ); ?>">
										<img src="<?php echo esc_url( $img_url ); ?>" alt="">
										<?php echo UixProducts::kses( Uix_Products_Custom_Metaboxes::parse_json_data_from_editor( $value[ 'value' ] ) ); ?>
									</div>   
					   
					   
									<?php if (  'on' == $lightbox_enable ) { ?>
										</a>
									<?php } ?>    
					   
					   
								<?php
											
										}//endif !empty( $img_url )	

									}//endif array_key_exists( 'lightbox', $value )

								}//endif $value


							endforeach;

						?> 




				   </div>
				  <!-- /.uix-products-slideshow__inner -->

				</div>
			   <!-- /.uix-products-slideshow__outline -->


			   <?php if ( $custom_slideshow_opt_paging_nav ) { ?>
				   <div class="uix-products-slideshow__pagination my-a-slider-pagination-<?php the_ID(); ?>"></div>
			   <?php } ?>
			   <?php if ( $custom_slideshow_opt_arr_nav ) { ?>
				   <div class="uix-products-slideshow__arrows my-a-slider-arrows-<?php the_ID(); ?>">
						<a href="#" class="uix-products-slideshow__arrows--prev"></a>
						<a href="#" class="uix-products-slideshow__arrows--next"></a>
				   </div>
			   <?php } ?>

		   </div>
		   <!-- /.uix-products-slideshow__wrapper -->

        <?php } else { ?>  
            <?php if ( has_post_thumbnail() ) { ?> 
				<?php
                    the_post_thumbnail( 'uix-products-gallery-post', array(
                        'alt'   => esc_attr( get_the_title() ),
                        'class'	=> 'uix-products-gallery-img'
                    ) ); 
                ?> 
            <?php } ?>
        <?php } ?> 
        
      
    
    
    </div>   
    
<?php } else { ?>


    <!-- Product Item -->
    <div class="uix-products-item <?php echo UixProducts::cat_class( $cat_termlist ); ?> <?php echo ( !has_post_thumbnail() ? esc_attr( 'no-featured-img' ) : '' ); ?>" id="uix-products-item-<?php the_ID(); ?>" <?php echo UixProducts::cat_class_filter( $cat_termlist ); ?>>
        <a href="<?php the_permalink(); ?>" class="image" >
            <div class="cover">
                <?php if ( has_post_thumbnail() ) { ?>
					<?php
	                    $imgarr = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumbnail_retina_size );
                        the_post_thumbnail( $thumbnail_size, array(
                            'alt'         => esc_attr( get_the_title() ),
							'class'	      => 'uix-products-entry-img',
                            'data-retina' => esc_url( $imgarr[0] ),
                            
                        ) ); 
                    ?>
                <?php } else { ?>
                    <img src="<?php echo esc_url( UixProducts::plug_directory() . 'assets/images/placeholder-image.png' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" >
                <?php } ?>
            </div>
			<?php if ( has_excerpt() ) {  ?>
                <div class="desc">
                    <?php the_excerpt(); ?>
                </div>
            <?php } ?>
            
        </a>
        
        <h3 class="title">
            <?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
        </h3>
        <h4 class="category"><?php echo wp_strip_all_tags( wp_kses( $cat_termlist, wp_kses_allowed_html( 'post' ) ) ); ?></h4>

        

    </div>
    <!--  .uix-products-item  end -->  
    
<?php } ?>
