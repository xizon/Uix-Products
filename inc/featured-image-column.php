<?php
/**
 *
 * @copyright 2009 - 2015
 * @author Austin Passy
 * @link http://frostywebdesigns.com/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package Featured_Image_Column
 */

if ( !class_exists( 'Featured_Image_Column' ) ) {
	
	class Featured_Image_Column {
		
		const domain  = 'featured-image-column';
		const version = '0.2.3';
		
		/**
		 * Ensures that the rest of the code only runs on edit.php pages
		 *
		 * @since 	0.1
		 */
		function __construct() {
			
			add_action( 'admin_menu',									array( $this, 'admin_menu' ) );
			add_action( 'admin_init',									array( $this, 'register_setting' ) );
			add_action( 'load-edit.php',								array( $this, 'load' ) );
		}
		
		/**
		 * Register our settings page.
		 *
		 * @since	0.2.2
		 */
		function admin_menu() {
			add_theme_page( 'Featured Image Column Settings', 'Featured Image Col', 'manage_options', self::domain, array( $this, 'settings_page' ) );
		}
	
		/**
		 * Output our settings.
		 *
		 * @since	0.2.2
		 */
		function settings_page() {
			
			if ( false === $post_types = get_option( 'featured_image_column', false ) ) {
				$post_types = array();
				foreach ( self::get_post_types() as $key => $label ) {
					if ( post_type_supports( $label, 'thumbnail' ) ) {
						$post_types[$label] = $label;
					}
				}
				update_option( 'featured_image_column', $post_types );
			}
			?>
			<div class="wrap">
			
				<h2><?php _e( 'Featured Image Column', 'uix-products' ); ?>
				<small><?php printf( __( 'by <a href="%s">Austin Passy</a>', 'uix-products' ), 'http://austin.passy.co' ); ?></small></h2>
				
				<form method="post" action="options.php">
				
					<?php settings_fields( 'featured_image_column_post_types' ); ?>
					
					<table class="form-table">
						<tbody>
							<tr valign="top">	
								<th scope="row" valign="top">
									<?php _e( 'Allowed Post Types', 'uix-products' ); ?>
								</th>
								<td>								
									<div class="checkbox-wrap">
										<ul>
										<?php foreach ( self::get_post_types() as $key => $label ) {											
											$checked = isset( $post_types[$label] ) ? $post_types[$label] : '0';
											printf( '<li><label for="%1$s[%3$s]" title="%2$s">',
												'featured_image_column', $label, $label );
											printf( '<input type="checkbox" class="checkbox" id="%1$s[%3$s]" name="%1$s[%3$s]" value="%3$s"%4$s> %2$s</label></li>',
												'featured_image_column', $label, $label, checked( $checked, $label, false ) );
										} ?>
										</ul>
									</div>
									<span class="description"><?php _e( 'By default all post types that support "thumbnails" are selected.', 'uix-products' ); ?></span>
								</td>
							</tr>
						</tbody>
					</table>
					
					<?php submit_button(); ?>
				
				</form>
				
			</div>
			<?php
		}
		
		/**
		 * Register our setting.
		 *
		 * @since	0.2.2
		 */
		function register_setting() {
			register_setting( 'featured_image_column_post_types', 'featured_image_column', array( $this, 'sanitize_callback' ) );
		}
		
		/**
		 * Sanitize our setting.
		 *
		 * @since	0.2.2
		 */
		function sanitize_callback( $input ) {
			
			$input = array_map( 'sanitize_key', (array) $input );
			
			return $input;
		}
		
		/**
		 * Since the load-edit.php hook is too early for checking the post type, hook the rest
		 * of the code to the wp action to allow the query to be run first
		 *
		 * @since 	0.1.6
		 */
		function load() {			
			add_action( 'wp',										array( $this, 'init' ) );
		}
		
		/**
		 * Sets up the Featured_Image_Column plugin and loads files at the appropriate time.
		 *
		 * @since 	0.1.6
		 */
		function init() {
			
			do_action( 'featured_image_column_init' );
			
			/**
			 * Sample filter to remove post type
			add_filter( 'featured_image_column_post_types',		array( $this, 'remove_post_type' ), 99 ); //*/
			add_filter( 'featured_image_column_post_types',			array( $this, 'add_setting_post_types' ) );
			
			$post_type = get_post_type();
			
			/* Bail early if $post_type isn't supported */
			if ( !self::included_post_types( $post_type ) )
				return;
			
			/* Print style */
			add_action( 'admin_enqueue_scripts',						array( $this, 'style' ), 0 );
			
			/* Column manager */
			add_filter( "manage_edit-{$post_type}_columns",			array( $this, 'columns' ) );
		//	add_filter( "manage_{$post_type}_posts_columns",		array( $this, 'columns' ) );
			add_action( "manage_{$post_type}_posts_custom_column",	array( $this, 'column_data' ), 10, 2 );
			
			do_action( 'featured_image_column_loaded' );
		}
		
		/**
		 * Sample function to remove featured image from specific post type
		 *
		 * @since 	0.2
		 */
		function remove_post_type( $post_types ) {	
							
			foreach( $post_types as $key => $post_type ) {
				if ( 'page' === $post_type )
					unset( $post_types[$key] );
			}
			
			return $post_types;
		}
		
		/**
		 * Filter our settings into our $post_type array and add our new Post Types.
		 *
		 * @since 	0.2.2
		 */
		function add_setting_post_types( $post_types ) {
			
			$setting_post_types = get_option( 'featured_image_column', array() );
			$post_types = array_merge( $post_types, array_keys( $setting_post_types ) );
			
			return $post_types;
		}
		
		/**
		 * Enqueue stylesheaet
		 * @since 	0.1
		 */
		function style() {
			//wp_register_style( 'featured-image-column', apply_filters( 'featured_image_column_css', plugin_dir_url( __FILE__ ) . 'css/column.css' ), null, self::version );
			//wp_enqueue_style( 'featured-image-column' );
		}
		
		/**
		 * Filter the image in before the 'title'
		 */
		function columns( $columns ) {
			
			if ( !is_array( $columns ) )
				$columns = array();
			
			$new = array();
			
			foreach( $columns as $key => $title ) {
				if ( $key == 'title' ) // Put the Thumbnail column before the Title column
					$new['featured-image'] = __( 'Image', 'uix-products' );
				
				$new[$key] = $title;
			}
			
			return $new;
		}
		
		/**
		 * Output the image
		 */
		function column_data( $column_name, $post_id ) {
			
			if ( 'featured-image' != $column_name )
				return;			
			
			$image_src = self::get_the_image( $post_id );
						
			if ( empty( $image_src ) ) {
				echo "&nbsp;"; // This helps prevent issues with empty cells
				return;
			}
			
			echo '<img alt="' . esc_attr( get_the_title() ) . '" src="' . esc_url( $image_src ) . '" />';
		}
		
		/**
		 * Allowed post types
		 *
		 * @since 	0.2
		 * @ref		http://wordpress.org/support/topic/plugin-featured-image-column-filter-for-post-types?replies=5
		 */
		private static function included_post_types( $post_type ) {
			
			$post_types = array();
			$get_post_types = self::get_post_types();
			
			foreach ( $get_post_types as $type )
				if ( post_type_supports( $type, 'thumbnail' ) )
					$post_types[] = $type;
			
			$post_types = apply_filters( 'featured_image_column_post_types', $post_types );
						
			if ( in_array( $post_type, $post_types ) )
				return true;
			
			return false;
		}
		
		/**
		 * Function to get the image
		 *
		 * @since		0.1
		 * @updated	0.1.3 - Added wp_cache_set()
		 * @updated 	0.1.9 - fixed persistent cache per post_id
		 * @ref			http://www.ethitter.com/slides/wcmia-caching-scaling-2012-02-18/#slide-11
		 */
		function get_the_image( $post_id = false ) {
			
			$post_id	= (int) $post_id;
			$cache_key	= "featured_image_post_id-{$post_id}-_thumbnail";
			$cache		= wp_cache_get( $cache_key, null );
			
			if ( !is_array( $cache ) )
				$cache = array();
		
			if ( !array_key_exists( $cache_key, $cache ) ) {
				if ( empty( $cache) || !is_string( $cache ) ) {
					$output = '';
						
					if ( has_post_thumbnail( $post_id ) ) {
						$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), array( 36, 32 ) );
						
						if ( is_array( $image_array ) && is_string( $image_array[0] ) )
							$output = $image_array[0];
					}
					
					if ( empty( $output ) ) {
						$output = plugins_url( 'images/default.png', __FILE__ );
						$output = apply_filters( 'featured_image_column_default_image', $output );
					}
					
					$output = esc_url( $output );
					$cache[$cache_key] = $output;
					
					wp_cache_set( $cache_key, $cache, null, 60 * 60 * 24 /* 24 hours */ );
				}
			}
			
			// Make sure we're returning the cached image HT: https://wordpress.org/support/topic/do-not-display-image-from-cache?replies=1#post-6773703
			return isset( $cache[$cache_key] ) ? $cache[$cache_key] : $output;
		}
		
		/**
		 * Helper function to return all public post types
		 *
		 * @since	0.2.2
		 */
		private static function get_post_types() {			
			return get_post_types( array( 'public' => true ) );
		}
		
		/**
		 * Helper function to test post_type against its support
		 *
		 * @since	0.2.2
		 */
		private static function post_type_supports( $supports = 'thumbnail' ) {
			
			$post_types = array();
			
			foreach ( self::get_post_types() as $key => $label ) {
				if ( post_type_supports( $label, $supports ) ) {
					$post_types[] = $label;
				}
			}
			
			return $post_types;
		}
		
	}
	
	$featured_image_column = new Featured_Image_Column;
	
};