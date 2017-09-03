<?php
/**
 * The Template for displaying your single products posts
 *
 */

if ( !class_exists( 'UixProducts' ) ) {
    return;
}

$project_cat           = UixProducts::list_post_terms( 'uix_products_category', false );
$project_date          = get_post_meta( get_the_ID(), 'uix_products_artwork_date', true );
$project_client_URL    = get_post_meta( get_the_ID(), 'uix_products_artwork_client_URL', true );
$project_client        = ( !empty( $project_client_URL ) ? '<a href="'.esc_url( $project_client_URL ).'" target="_blank">'.esc_html( get_post_meta( get_the_ID(), 'uix_products_artwork_client', true ) ).'</a>' : esc_html( get_post_meta( get_the_ID(), 'uix_products_artwork_client', true ) ) );
$project_URL           = get_post_meta( get_the_ID(), 'uix_products_artwork_project_url', true );
$project_author        = get_post_meta( get_the_ID(), 'uix_products_artwork_author', true );
$project_artwork_attrs = json_decode( get_post_meta( get_the_ID(), 'uix_products_artwork_attrs', true ), true );

// Theme or Plugin
$project_type            = get_post_meta( get_the_ID(), 'uix_products_typeshow', true );
$project_tp_type         = get_post_meta( get_the_ID(), 'uix_products_themeplugin_type', true );
$project_tp_price        = intval( get_post_meta( get_the_ID(), 'uix_products_themeplugin_price', true ) );
$project_tp_name         = get_post_meta( get_the_ID(), 'uix_products_themeplugin_name', true );
$project_tp_title        = get_post_meta( get_the_ID(), 'uix_products_themeplugin_title', true );
$project_tp_previewURL   = get_post_meta( get_the_ID(), 'uix_products_themeplugin_previewURL', true );
$project_tp_fileURL      = get_post_meta( get_the_ID(), 'uix_products_themeplugin_fileURL', true );
$project_tp_version      = get_post_meta( get_the_ID(), 'uix_products_themeplugin_version', true );
$project_tp_dep          = get_post_meta( get_the_ID(), 'uix_products_themeplugin_dep', true );
$project_tp_browsers     = get_post_meta( get_the_ID(), 'uix_products_themeplugin_browsers', true );
$project_tp_include      = get_post_meta( get_the_ID(), 'uix_products_themeplugin_include', true );
$project_tp_layout       = get_post_meta( get_the_ID(), 'uix_products_themeplugin_layout', true );
$project_tp_addinfo      = get_post_meta( get_the_ID(), 'uix_products_themeplugin_addinfo', true );
$project_tp_install      = get_post_meta( get_the_ID(), 'uix_products_themeplugin_install', true );
$project_tp_tags         = get_post_meta( get_the_ID(), 'uix_products_themeplugin_tags', true );
$project_tp_updated_date = get_post_meta( get_the_ID(), 'uix_products_themeplugin_updated_date', true );
$project_tp_attrs        = json_decode( get_post_meta( get_the_ID(), 'uix_products_themeplugin_attrs', true ), true );

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php
$arg_prevnext = array(
	'post_type'           => 'uix_products',
	'posts_per_page'      => -1,
	'no_found_rows'       => true,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'meta_query'          => array(
								array(
										'key'     => 'uix_products_themeplugin_type',
										'value'   => $project_tp_type,
										'compare' => 'IN',
								   ),
							 ),
	
);

if ( $project_type == 'artwork' ) {
	$arg_prevnext = array(
		'post_type'           => 'uix_products',
		'posts_per_page'      => -1,
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
$items_prevnext = new WP_Query( $arg_prevnext );
?>



    <section class="uix-products-section">
        <div class="container">
            
            <?php get_template_part( 'content', 'uix_products' ); ?>
            
            <div class="uix-products-single-main">
            
    
                <?php       
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages: ', 'uix-products' ) . '',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                  ?>
                  
                  <?php edit_post_link( __( 'Edit', 'uix-products' ), '<p class="edit-link">', '</p>' ); ?>
        
           
            </div> 
            <!-- .uix-products-single-main end -->
            
            
             <div class="uix-products-single-side">
             
                <?php if ( $project_type == 'artwork' ) { ?>
					<?php the_title( '<h1>', '</h1>' ); ?>
                    
                    <?php if ( !empty( $project_date ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Date', 'uix-products' ); ?></strong>
                            <?php echo esc_html( UixProducts::date_show( $project_date ) ); ?>
                        </p>
                    <?php } ?>
                     
                     <?php if ( !empty( $project_client ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Client', 'uix-products' ); ?></strong>
                            <?php echo wp_kses( $project_client, wp_kses_allowed_html( 'post' ) ); ?>
                        </p>
                    <?php } ?> 
                     
                    <?php if ( !empty( $project_cat ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Category', 'uix-products' ); ?></strong>
                            <?php echo wp_strip_all_tags( wp_kses( $project_cat, wp_kses_allowed_html( 'post' ) ) ); ?>
                        </p> 
                    <?php } ?> 
                    
					<?php if ( !empty( $project_URL ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Project URL', 'uix-products' ); ?></strong>
                            <a href="<?php echo esc_url( $project_URL ); ?>" target="_blank"><?php echo esc_url( $project_URL ); ?></a>
                        </p>
					<?php } ?> 								 	 

					<?php if ( !empty( $project_author ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Author', 'uix-products' ); ?></strong>
                            <?php echo esc_html( $project_author ); ?>
                        </p>
					<?php } ?> 	 
                    
                    
					<?php 
					if ( is_array( $project_artwork_attrs ) && sizeof( $project_artwork_attrs ) > 0 ) {

						foreach( $project_artwork_attrs as $value ) {
						?>
							<p>
								<strong class="title"><?php echo esc_html( $value[ 'name' ] ); ?></strong>
								<?php echo esc_html( $value[ 'value' ] ); ?>
							</p>
						<?php
						}
					} 
					?> 
        
        
                    <?php if ( has_excerpt() ) {  ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Description', 'uix-products' ); ?></strong>
                            <?php the_excerpt(); ?>
                        </p>
                    <?php } ?>      
           
                
                <?php } else { ?>
                
					<h1><?php echo esc_html( $project_tp_name ); ?><?php echo ( !empty( $project_tp_title ) ? esc_html( ' - '.$project_tp_title ) : '' ); ?></h1>
                    
                                  
                    <?php if ( !empty( $project_tp_previewURL ) ) { ?>
                        <p>
                            <a class="uix-products-button" href="<?php UixProducts::product_preview( $project_tp_name, $project_tp_previewURL, $project_tp_type ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'uix-products' ); ?></a>
                        </p>
                    <?php } ?>                
                             
                    <?php if ( !empty( $project_tp_fileURL ) ) { ?>
                        <p> 
                            <?php if ( $project_tp_price > 0 ) { ?>
                                <a class="uix-products-button" href="<?php echo esc_url( $project_tp_fileURL ); ?>" target="_blank"><?php esc_html_e( 'Buy Now for $', 'uix-products' ); ?><?php echo esc_html( $project_tp_price ); ?></a>
                            <?php } else { ?>  
                                <a class="uix-products-button" href="<?php echo esc_url( $project_tp_fileURL ); ?>" target="_blank"><?php esc_html_e( 'Free Download', 'uix-products' ); ?></a>
                            <?php } ?>  
                        </p>
                    <?php } ?>   
                    
                    <hr>  
                    
                    <p>
                        <strong class="title"><?php esc_html_e( 'Created', 'uix-products' ); ?></strong>
						<?php
                            $time_string = '<time class="post-date" datetime="%1$s">%2$s</time>';
                            printf( $time_string,
                                esc_attr( get_the_date( 'c' ) ),
                                get_the_date()
                            );
                        ?>
                    </p>
                    
                    <?php if ( !empty( $project_tp_updated_date ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Updated', 'uix-products' ); ?></strong>
                            <?php echo esc_html( UixProducts::date_show( $project_tp_updated_date ) ); ?>
                        </p>
                    <?php } ?>
                    
                    <?php if ( !empty( $project_cat ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Category', 'uix-products' ); ?></strong>
                            <?php echo wp_strip_all_tags( wp_kses( $project_cat, wp_kses_allowed_html( 'post' ) ) ); ?>
                        </p> 
                    <?php } ?> 
                    

                    <?php if ( !empty( $project_tp_version ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Version', 'uix-products' ); ?></strong>
                            <?php echo esc_html( $project_tp_version ); ?>
                        </p>
                    <?php } ?>
                    
                    <?php if ( !empty( $project_tp_dep ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Compatible With', 'uix-products' ); ?></strong>
                            <?php echo esc_html( $project_tp_dep ); ?>
                        </p>
                    <?php } ?>
                    
                    <?php if ( !empty( $project_tp_browsers ) && is_array( $project_tp_browsers ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Compatible Browsers', 'uix-products' ); ?></strong>
                            <?php 
							$browsers_echo = '';
							foreach ( $project_tp_browsers as $value ) :
							    $browsers_echo .= $value.', ';
							endforeach; 
							echo esc_html( UixProducts::strip_laststr( $browsers_echo, ',' ) );
							?>
                        </p>
                    <?php } ?>
                    
                    <?php if ( !empty( $project_tp_include ) && is_array( $project_tp_include ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Files Included', 'uix-products' ); ?></strong>
                            <?php 
							$include_echo = '';
							foreach ( $project_tp_include as $value ) :
							    $include_echo .= $value.', ';
							endforeach; 
							echo esc_html( UixProducts::strip_laststr( $include_echo, ',' ) );
							?>
                        </p>
                    <?php } ?>                 
                    
                    <?php if ( !empty( $project_tp_layout ) && $project_tp_layout != 'null' ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Layout', 'uix-products' ); ?></strong>
                            <?php echo esc_html( $project_tp_layout ); ?>
                        </p>
                    <?php } ?>    
                    
                    <?php if ( !empty( $project_tp_addinfo ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Additional Info', 'uix-products' ); ?></strong>
                            <?php echo esc_html( $project_tp_addinfo ); ?>
                        </p>
                    <?php } ?>    
                    
                    <?php if ( !empty( $project_tp_install ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Installation', 'uix-products' ); ?></strong>
                            <?php echo esc_html( $project_tp_install ); ?>
                        </p>
                    <?php } ?>  
                    
                    <?php if ( !empty( $project_tp_tags ) ) { ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Tags', 'uix-products' ); ?></strong>
                            <?php echo esc_html( $project_tp_tags ); ?>
                        </p>
                    <?php } ?>        
                    
					<?php 
					if ( is_array( $project_tp_attrs ) && sizeof( $project_tp_attrs ) > 0 ) {

						foreach( $project_tp_attrs as $value ) {
						?>
							<p>
								<strong class="title"><?php echo esc_html( $value[ 'name' ] ); ?></strong>
								<?php echo esc_html( $value[ 'value' ] ); ?>
							</p>
						<?php
						}
					} 
					?> 
                    
                    <?php if ( has_excerpt() ) {  ?>
                        <p>
                            <strong class="title"><?php esc_html_e( 'Description', 'uix-products' ); ?></strong>
                            <?php the_excerpt(); ?>
                        </p>
                    <?php } ?>  
                             

                <?php } ?>
             

				<hr>

				<div class="uix-products-pagination uix-products-pagination-single">
					<ul>
						<?php previous_post_link( '<li class="previous">%link</li>', wp_kses( __( '&larr;', 'uix-products' ), wp_kses_allowed_html( 'post' ) ) ); ?>
						<?php next_post_link( '<li class="next">%link</li>', wp_kses( __( '&rarr;', 'uix-products' ), wp_kses_allowed_html( 'post' ) ) ); ?>
					</ul>
				</div>

                
                
            </div> 
            <!-- .uix-products-single-side  end -->
            
        
        </div>
        <!-- .container end -->
    </section>

	
<?php endwhile; ?>    
<?php get_footer(); ?>
