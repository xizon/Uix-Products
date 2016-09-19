<?php
/**
 * Template part for displaying products.
 *
 * 
 */

$layout            = get_option( 'uix_products_opt_layout', 'standard' );
$cat_termlist      = get_the_term_list( get_the_ID(), 'uix_products_category', '', ', ', '' );
$attachments       = get_gallery_ids(); 

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


    <div <?php post_class(); ?>  id="uix-products-item-<?php the_ID(); ?>">
    
        <?php if ( $attachments && is_array( $attachments ) ) { ?>
            <div class="custom-uix-products-flexslider">
                <div class="custom-uix-products-slides">
					<?php foreach ( $attachments as $attachment ) :
                                $img_url	= wp_get_attachment_url( $attachment );
                                $img_alt	= get_post_meta( $attachment, '_wp_attachment_image_alt', true );
                                $img_echo	= UixProducts::remove_thumbnail_str( wp_get_attachment_image( $attachment, 'post-thumbnail-large' ) );
                    ?>
                        <?php if ( !empty( $img_echo ) ) { ?>
                                    <div class="item">
                                        <?php if (  'on' == gallery_is_lightbox_enabled() ) { ?>
                                            <a href="<?php echo esc_url( $img_url ); ?>" title="<?php echo esc_attr( $img_alt ); ?>" rel="uix-products-slider-prettyPhoto[<?php the_ID(); ?>]">
                                                <?php echo wp_kses( $img_echo, wp_kses_allowed_html( 'post' ) ); ?>
                                            </a>
                                        <?php } else { ?>
                                            <?php echo wp_kses( $img_echo, wp_kses_allowed_html( 'post' ) ); ?>
                                        <?php } ?>    
                                    </div>			
                                        
                        <?php } ?>
                    <?php endforeach; ?>
                </div>
                <!-- .custom-uix-products-slides end -->
            </div>
            <!-- .custom-uix-products-flexslider end -->
            
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
    <div <?php post_class( array( 'uix-products-item', UixProducts::cat_class( $cat_termlist ), ( ( !has_post_thumbnail() ) ? esc_attr( 'no-featured-img' ) : '' ) ) ); ?> id="uix-products-item-<?php the_ID(); ?>" <?php echo UixProducts::cat_class_filter( $cat_termlist ); ?>>
        <a href="<?php the_permalink(); ?>" class="image" >
            <div class="cover">
                <?php if ( has_post_thumbnail() ) { ?>
					<?php
                        the_post_thumbnail( $thumbnail_size, array(
                            'alt'         => esc_attr( get_the_title() ),
							'class'	      => 'uix-products-entry-img',
                            'data-retina' => esc_url( wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumbnail_retina_size )[0] ),
                            
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
