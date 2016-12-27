<?php
/**
 * Uix Products
 *
 * @author UIUX Lab <uiuxlab@gmail.com>
 *
 *
 * Plugin name: Uix Products
 * Plugin URI:  https://uiux.cc/wp-plugins/uix-products/
 * Description: Readily organize & present your artworks, themes, plugins with Uix Products template files. Convenient for theme customization.  
 * Version:     1.0.5
 * Author:      UIUX Lab
 * Author URI:  https://uiux.cc
 * License:     GPLv2 or later
 * Text Domain: uix-products
 * Domain Path: /languages
 */

class UixProducts {
	
	const PREFIX = 'uix';
	const HELPER = 'uix-products-helper';
	const NOTICEID = 'uix-products-helper-tip';

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
		self::setup_constants();
		self::includes();
		
		global $products_prefix;
		$products_prefix = 'custom-products';
		
		
		add_action( 'admin_print_scripts-edit.php', array( __CLASS__, 'check_current_post_type' ) );
		add_action( 'admin_print_scripts-post-new.php', array( __CLASS__, 'check_current_post_type' ) );
		add_action( 'admin_print_scripts-post.php', array( __CLASS__, 'check_current_post_type' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'print_custom_stylesheet' ) ); 
		add_action( 'current_screen', array( __CLASS__, 'usage_notice' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_init', array( __CLASS__, 'nag_ignore' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_action( 'wp_head', array( __CLASS__, 'cat' ) );
		add_action( 'wp_head', array( __CLASS__, 'gallery_app' ) );
		add_filter( 'body_class', array( __CLASS__, 'new_class' ) );
		add_action( 'widgets_init', array( __CLASS__, 'register_my_widget' ) );
		add_filter( 'post_thumbnail_html', array( __CLASS__, 'remove_thumbnail_dimensions' ), 10, 4 );
		add_filter( 'featured_image_column_default_image', array( __CLASS__, 'custom_featured_image_column_image' ) );
		add_action( 'featured_image_column_init', array( __CLASS__, 'custom_featured_image_column_init' ) );
		add_action( 'after_setup_theme', array( __CLASS__, 'add_featured_image_support' ), 11 );
		add_filter( 'init', array( __CLASS__, 'taxonomy_archive_init' ) );
		
		
	}
	
	
	/**
	 * Setup plugin constants.
	 *
	 */
	public static  function setup_constants() {

		// Plugin Folder Path.
		if ( ! defined( 'UIX_PRODUCTS_PLUGIN_DIR' ) ) {
			define( 'UIX_PRODUCTS_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'UIX_PRODUCTS_PLUGIN_URL' ) ) {
			define( 'UIX_PRODUCTS_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
		}

		// Plugin Root File.
		if ( ! defined( 'UIX_PRODUCTS_PLUGIN_FILE' ) ) {
			define( 'UIX_PRODUCTS_PLUGIN_FILE', trailingslashit( __FILE__ ) );
		}
	}	
	
	/*
	 * Include required files.
	 *
	 *
	 */
	public static function includes() {
		
		if ( ! class_exists( 'cmb_Meta_Box' ) ) {
			require_once UIX_PRODUCTS_PLUGIN_DIR.'post-extensions/custom-metaboxes-and-fields/init.php';
		}
		
		require_once UIX_PRODUCTS_PLUGIN_DIR.'inc/featured-image-column.php';
	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
	
		// flexslider
		wp_enqueue_script( 'flexslider', self::plug_directory() .'assets/js/jquery.flexslider.min.js', array( 'jquery' ), '2.6.2', true );	
		wp_enqueue_style( 'flexslider', self::plug_directory() .'assets/css/flexslider.css', false, '2.6.2', 'all' );
		
		// prettyPhoto
		wp_enqueue_script( 'prettyPhoto', self::plug_directory() .'assets/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.5', true );	
		wp_enqueue_style( 'prettyPhoto', self::plug_directory() .'assets/css/jquery.prettyPhoto.css', false, '3.1.5', 'all' );
	
		// Easing
		wp_enqueue_script( 'jquery-easing', self::plug_directory() .'assets/js/jquery.easing.js', array( 'jquery' ), '1.3', false );	
		
		// Shuffle
		wp_enqueue_script( 'shuffle', self::plug_directory() .'assets/js/jquery.shuffle.js', array( 'jquery', 'modernizr' ), '3.1.1', true );
		
		// Shuffle.js requires Modernizr..
		wp_enqueue_script( 'modernizr', self::plug_directory() .'assets/js/modernizr.min.js', false, '3.3.1', false );	
		
		// imagesloaded
		wp_enqueue_script( 'uix-imagesloaded', self::plug_directory() .'assets/js/imagesloaded.min.js', array( 'jquery' ), '4.1.0', true );	
		
		// imagesloaded
		wp_enqueue_script( 'uix-masonry', self::plug_directory() .'assets/js/masonry.js', array( 'jquery', 'imagesloaded' ), '3.3.2', true );	
		
		
		if ( self::core_css_file_exists() ) {
			//Add shortcodes style to Front-End
			wp_enqueue_style( self::PREFIX . '-products', self::core_css_file(), false, self::ver(), 'all');
			
		}
		
		//Main stylesheets and scripts to Front-End
		wp_enqueue_script( self::PREFIX . '-products', self::core_js_file(), array( 'jquery' ), self::ver(), true );	


	}
	
	

	
	/*
	 * Enqueue scripts and styles  in the backstage
	 *
	 *
	 */
	public static function backstage_scripts() {
	
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();
		  
		 if( self::inc_str( $currentScreen->id, 'uix_products' ) || self::inc_str( $currentScreen->id, 'uix-products' ) || self::inc_str( $currentScreen->base, '_page_' )) {
				  
					if ( is_admin()) {
							wp_enqueue_style( self::PREFIX . '-products-main', self::plug_directory() .'style.css', false, self::ver(), 'all');	
					}
	  
		  }
		

	}
	
	
	
	/**
	 * Internationalizing  Plugin
	 *
	 */
	public static function tc_i18n() {
	
	
	    load_plugin_textdomain( 'uix-products', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
		

	}
	
	/*
	 * The function finds the position of the first occurrence of a string inside another string.
	 *
	 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
	 *
	 */
	public static function inc_str( $str, $incstr ) {
		
		$incstr = str_replace( '(', '\(',
				  str_replace( ')', '\)',
				  str_replace( '|', '\|',
				  str_replace( '*', '\*',
				  str_replace( '+', '\+',
			      str_replace( '.', '\.',
				  str_replace( '[', '\[',
				  str_replace( ']', '\]',
				  str_replace( '?', '\?',
				  str_replace( '/', '\/',
				  str_replace( '^', '\^',
			      str_replace( '{', '\{',
				  str_replace( '}', '\}',	
				  str_replace( '$', '\$',
			      str_replace( '\\', '\\\\',
				  $incstr 
				  )))))))))))))));
			
		if ( !empty( $incstr ) ) {
			if ( preg_match( '/'.$incstr.'/', $str ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}


	}


	
	
	/*
	 * Create customizable menu in backstage  panel
	 *
	 * Add a submenu page
	 *
	 */
	 public static function options_admin_menu() {
	
	    //settings
		$hook = add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'Uix Products Settings', 'uix-products' ),
			__( 'Settings', 'uix-products' ),
			'manage_options',
			'uix-products-custom-submenu-page',
			array( __CLASS__, 'uix_products_options_page' )
		);
		
		add_action("load-{$hook}", create_function('','
			header( "Location: ' . admin_url( "admin.php?page=".self::HELPER."&tab=general-settings" ) . '" );
			exit;
		'));
	
	
        //helper
		add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'Helper', 'uix-products' ),
			__( 'Helper', 'uix-products' ),
			'manage_options',
			self::HELPER,
			'uix_products_options_page' 
		);
		
		

	
		
	 }
	 
	public static function uix_products_options_page(){
		
	}
	
	
	
	/*
	 * Load helper
	 *
	 */
	 public static function load_helper() {
		 
		 require_once UIX_PRODUCTS_PLUGIN_DIR.'helper/settings.php';
	 }
	
	
	
	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=general-settings" ) . '">' . __( 'Settings', 'uix-products' ) . '</a>';
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-products' ) . '</a>';
		return $links;
	}
	

	
	
	/*
	 * Get plugin slug
	 *
	 *
	 */
	public static function get_slug() {

         return dirname( plugin_basename( __FILE__ ) );
	
	}

	
	/*
	 *  Add admin one-time notifications
	 *
	 *
	 */
	public static function usage_notice() {
		
		
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();

		  if( ( self::inc_str( $currentScreen->id, 'uix_products' ) || self::inc_str( $currentScreen->id, 'uix-products' ) ) && !self::inc_str( $currentScreen->id, '_page_' ) ) {
			  add_action( 'admin_notices', array( __CLASS__, 'usage_notice_app' ) );
			  add_action( 'admin_notices', array( __CLASS__, 'template_notice_required' ) );
		  }
		
	
	}	
	
	public static function usage_notice_app() {
		
		global $current_user ;
		$user_id = $current_user->ID;
		
		/* Check that the user hasn't already clicked to ignore the message */
		if ( ! get_user_meta( $user_id, self::NOTICEID ) ) {
			echo '<div class="updated"><p>
				'.__( 'Do you want to create a products website with WordPress?  Learn how to add products to your themes.', 'uix-products' ).'
				<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-products' ) . '</a>
				 | 
			';
			printf( __( '<a href="%1$s">Hide Notice</a>' ), '?post_type=uix_products&'.self::NOTICEID.'=0');
			
			echo "</p></div>";
		}
	
	}	
	
	public static function template_notice_required() {
		
		if( !self::tempfile_exists() ) {
			echo '
				<div class="error notice">
					<p>' . __( '<strong>You need to create Uix Products template files in your templates directory. You can create the files on the WordPress admin panel.</strong>', 'uix-products' ) . ' <a class="button button-primary" href="' . admin_url( "admin.php?page=".self::HELPER."&tab=temp" ) . '">' . __( 'Create now!', 'uix-products' ) . '</a><br>' . __( 'As a workaround you can use FTP, access the Uix Products template files path <code>/wp-content/plugins/uix-products/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-products' ) . '</p>
				</div>
			';
	
		}
	
	}	
	
	
	public static function nag_ignore() {
		    global $current_user;
			$user_id = $current_user->ID;
			
			/* If user clicks to ignore the notice, add that to their user meta */
			if ( isset( $_GET[ self::NOTICEID ]) && '0' == $_GET[ self::NOTICEID ] ) {
				 add_user_meta( $user_id, self::NOTICEID, 'true', true);

				if ( wp_get_referer() ) {
					/* Redirects user to where they were before */
					wp_safe_redirect( wp_get_referer() );
				} else {
					/* This will never happen, I can almost gurantee it, but we should still have it just in case*/
					wp_safe_redirect( home_url() );
				}
		    }
	}
	
	/*
	 * Checks whether a template file or directory exists
	 *
	 *
	 */
	public static function tempfile_exists() {

	      if( !file_exists( get_stylesheet_directory() . '/page-uix_products.php' ) ) {
			  return false;
		  } else {
			  return true;
		  }

	}
	

	/*
	 * Callback the plugin directory URL
	 *
	 *
	 */
	public static function plug_directory() {

	  return UIX_PRODUCTS_PLUGIN_URL;

	}
	
	/*
	 * Callback the plugin directory
	 *
	 *
	 */
	public static function plug_filepath() {

	  return UIX_PRODUCTS_PLUGIN_DIR;

	}
	
	
	/*
	 * Returns template files directory
	 *
	 *
	 */
	public static function list_templates_name( $show = 'plug' ){
	
		
		$filenames = array();
		$filepath = UIX_PRODUCTS_PLUGIN_DIR. 'theme_templates/';
		$themepath = get_stylesheet_directory() . '/';
		
		foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
		    $filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		}	
		
		echo '<ul>';
		
		foreach ( $filenames as $filename ) {
			$file1 = trailingslashit( $filepath ) . $filename;
			
			$file2 = trailingslashit( $themepath ) . $filename;	
			
			if ( $show == 'plug' ) {
				echo '<li>'.trailingslashit( $filepath ) . $filename.'</li>';
			} else {
				echo '<li>'.trailingslashit( $themepath ) . $filename.' &nbsp;&nbsp;'.sprintf( __( '<a target="_blank" href="%1$s"><i class="dashicons dashicons-welcome-write-blog"></i> Edit this template</a>', 'uix-products' ), admin_url( 'theme-editor.php?file='.$filename ) ).'</li>';
			}
			
		}	
		
		echo '</ul>';
			
	}	 

	
	
	/*
	 * Copy/Remove template files to your theme directory
	 *
	 *
	 */
	
	public static function templates( $nonceaction, $nonce, $remove = false ){
	
		  global $wp_filesystem;
			
		  $filenames = array();
		  $filepath = UIX_PRODUCTS_PLUGIN_DIR. 'theme_templates/';
		  $themepath = get_stylesheet_directory() . '/';

	      foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		  }	
		  

		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = $filepath; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
	
				foreach ( $filenames as $filename ) {
					
				    // Copy
					if ( ! file_exists( $themepath . $filename ) ) {
						
						$dir1 = $wp_filesystem->find_folder( $filepath );
						$file1 = trailingslashit( $dir1 ) . $filename;
						
						$dir2 = $wp_filesystem->find_folder( $themepath );
						$file2 = trailingslashit( $dir2 ) . $filename;
									
						$filecontent = $wp_filesystem->get_contents( $file1 );
	
						$wp_filesystem->put_contents( $file2, $filecontent, FS_CHMOD_FILE );
						
			
					} 
					
					// Remove
					if ( $remove ) {
						if ( file_exists( $themepath . $filename ) ) {
							
							$dir = $wp_filesystem->find_folder( $themepath );
							$file = trailingslashit( $dir ) . $filename;
							
							$wp_filesystem->delete( $file, false, FS_CHMOD_FILE );
							
				
						} 
						
	
					}
				}
				
				if ( !$remove ) {
					if ( self::tempfile_exists() ) {
						return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-products' );
					} else {
						return __( '<div class="notice notice-error"><p><strong>There was a problem copying your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-products' );
					}
	
				} else {
					if ( self::tempfile_exists() ) {
						return __( '<div class="notice notice-error"><p><strong>There was a problem removing your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-products' );
						
					} else {
						return __( '<div class="notice notice-success"><p>Remove successful!</p></div>', 'uix-products' );
					}	
					
				}
				
		
				
				
		  } 
	}	 



	/**
	 * Initialize the WP_Filesystem
	 * 
	 * Example:
	 
            $output = "";
			
            if ( !empty( $_POST ) && check_admin_referer( 'custom_action_nonce') ) {
				
				
                  $output = UixProducts::wpfilesystem_write_file( 'custom_action_nonce', 'admin.php?page='.UixProducts::HELPER.'&tab=???', 'helper/', 'debug.txt', 'This is test.' );
				  echo $output;
			
            } else {
				
				wp_nonce_field( 'custom_action_nonce' );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Files', 'uix-pagebuilder' ).'"  /></p>';
				
			}
			
			
	 *
	 */
	public static function wpfilesystem_connect_fs( $url, $method, $context, $fields = null) {
		  global $wp_filesystem;
		  if ( false === ( $credentials = request_filesystem_credentials( $url, $method, false, $context, $fields) ) ) {
			return false;
		  }
		
		  //check if credentials are correct or not.
		  if( !WP_Filesystem( $credentials ) ) {
			request_filesystem_credentials( $url, $method, true, $context);
			return false;
		  }
		
		  return true;
	}
	
	public static function wpfilesystem_write_file( $nonceaction, $nonce, $path, $pathname, $text ){
		  global $wp_filesystem;
		  
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = UIX_PRODUCTS_PLUGIN_DIR.$path; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				$wp_filesystem->put_contents( $file, $text, FS_CHMOD_FILE );
			
				return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-products' );
				
		  } 
	}	
	
	 
	public static function wpfilesystem_read_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_PRODUCTS_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_template_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
				    return $wp_filesystem->get_contents( $file );
	
				} else {
					return '';
				}
		
		
		  } 
	}	 
	
	
	

	/*
	 * Returns current plugin version.
	 *
	 *
	 */
	public static function ver() {
	
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_folder = get_plugins( '/' . self::get_slug() );
		$plugin_file = basename( ( __FILE__ ) );
		return $plugin_folder[$plugin_file]['Version'];


	}

	/*
	 * Print Custom Stylesheet
	 *
	 *
	 */
	public static function print_custom_stylesheet( $uix_products_frontend_css = null ) {
	
		$custom_css = get_option( 'uix_products_opt_cssnewcode' );
		
		if ( !empty( $uix_products_frontend_css ) ) {
			$custom_css = $custom_css.$uix_products_frontend_css;
		}
		wp_add_inline_style( self::PREFIX . '-products', $custom_css );
		
		return $uix_products_frontend_css;

	}
	
	
	/*
	 *  Output products categories for dropdown styles
	 *
	 *
	 */
	public static function cat() {
	
		require_once UIX_PRODUCTS_PLUGIN_DIR.'inc/class-walker-uix_products_category.php';
		
	}
	
	
	/**
	 *  Register widget area.
	 */
	public static function register_my_widget( $links ) {
		// Recent products widget
		require 'inc/class-widgets.php';
		register_widget( 'Uix_Products_Recent_Products_Widget' );
		
		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'uix-products' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Appears on posts and pages in the sidebar.', 'uix-products' ),
			'before_widget' => '<div id="%1$s" class="widget side %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
	
	
	
	/**
	 * List categories for specific taxonomy
	 * 
	 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
	 * @usage   if ( UixProducts::list_post_terms( 'uix_products_category', false ) ) { ... }
	 */
	public static function list_post_terms( $taxonomy = 'uix_products_category', $echo = true ) {
	
		$list_terms = array();
		$terms      = wp_get_post_terms( get_the_ID(), $taxonomy );
		
		if ( is_array ( $terms ) ) {
			
			foreach ( $terms as $term ) {
				$permalink      = get_term_link( $term->term_id, $taxonomy );
				$list_terms[]   = '<a href="'. $permalink .'" title="'. $term->name .'">'. $term->name .'</a>';
			}
			if ( ! $list_terms ) {
				return;
			}
			$list_terms = implode( ', ', $list_terms );
			if ( $echo ) {
				echo $list_terms;
			} else {
				return $list_terms;
			}
			
			
		}

	}
	
	
	/*
	 *  Gallery metabox
	 *
	 *
	 */
	public static function gallery() {
		
		
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();

		  if( $currentScreen->id === "uix_products" ) {
			  require_once UIX_PRODUCTS_PLUGIN_DIR.'gallery-metabox/init.php';
		  }
		
	
	}	
	
	public static function gallery_app() {
		
		require_once UIX_PRODUCTS_PLUGIN_DIR.'gallery-metabox/front-display.php';
	
	}
	
	/*
	 * Extend the default WordPress body classes.
	 *
	 *
	 */
	public static function new_class( $classes ) {
	
	    global $uix_products_temp;
        if ( $uix_products_temp === true ) { 
			$classes[] = 'uix-products-body';
		}
		
		return $classes;

	}
	
	
	/*
	 * Check the post type of the current page in wp-admin
	 * 
	 */
	public static function check_current_post_type() {
		global $typenow;
		if ( 'uix_products' == $typenow ) {
			//do something
		} 
	}
	
	
	
	/*
	 * Featured Image
	 * Add support for a custom default image
	 */
	public static function custom_featured_image_column_image( $image ) {
		if ( !has_post_thumbnail() ) {
			return self::plug_directory() .'assets/images/featured-image.png';
		}
	}
	
	
	public static function custom_featured_image_column_init() {
		add_filter( 'featured_image_column_post_types', array( __CLASS__, 'custom_featured_image_column_remove_post_types' ), 11 ); // Remove
	}
	
	
	public static function custom_featured_image_column_remove_post_types( $post_types ) {
		foreach( $post_types as $key => $post_type ) {
			if ( 'page' === $post_type ) // Post type you'd like removed. Ex: 'post' or 'page'
				unset( $post_types[$key] );
		}
		return $post_types;
	}
	

	public static function add_featured_image_support() {
		
		
		$supportedTypes = get_theme_support( 'post-thumbnails' );
		$thePostType = 'uix_products';
		
		if( $supportedTypes === false ) {
			add_theme_support( 'post-thumbnails', array( $thePostType ) ); 
		} elseif ( is_array( $supportedTypes ) ) {
			$supportedTypes[0][] = $thePostType;
			add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		}
	
	
		//---
		$uix_products_opt_cover_width         = get_option( 'uix_products_opt_cover_width', 400 );
		$uix_products_opt_cover_height        = get_option( 'uix_products_opt_cover_height', 300 );
		$uix_products_opt_cover_single_width  = get_option( 'uix_products_opt_cover_single_width', 1920 );	
		$uix_products_opt_cover_single_height = get_option( 'uix_products_opt_cover_single_height', 15000 );	
		
		
		add_image_size( 'uix-products-entry', $uix_products_opt_cover_width, $uix_products_opt_cover_height, true );
		add_image_size( 'uix-products-autoheight-entry', $uix_products_opt_cover_width, 15000, false );
		add_image_size( 'uix-products-gallery-post', $uix_products_opt_cover_single_width, $uix_products_opt_cover_single_height, false );
		
		//--- Add image sizes for retina
		add_image_size( 'uix-products-retina-entry', $uix_products_opt_cover_width*2, $uix_products_opt_cover_height*2, true );
		add_image_size( 'uix-products-autoheight-retina-entry', $uix_products_opt_cover_width*2, 15000, false );
	
	}
	

	
	/*
	 * Remove image dimension attributes
	 *
	 *
	 */
	public static function remove_thumbnail_str( $str ) {
	
		return preg_replace( '/(width|height)=\"\d*\"\s/', "", $str );

	}

	
	/*
	 * Returns category class
	 *
	 *
	 */
	public static function cat_class( $str ) {
	
		return str_replace( ',', ' ', str_replace( ',-', ' ', strtolower( strip_tags( str_replace( ' ', '-', $str ) ) ) ) )	;

	}	
	
	/*
	 * Returns Category Filter
	 *
	 *
	 */
	public static function cat_class_filter( $str ) {
	
		$v = self::cat_class( $str );
		$nv = str_replace( ' ', '","', $v );
		
		return 'data-groups=\'["'.$nv.'"]\'';

	}	
		
	/**
	 * Get URL of first image in a post
	 * 
	 */
	public static function getfirstpic() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		if( count( $matches[1] ) > 0 ) { 
		    return $matches [1] [0];
		} else {
			return '';
		}
	
	}
			

	/*
	 * Load more button
	 *
	 *
	 */
	public static function loadmore() {
	
		echo '<div class="pagination-more">';
		next_posts_link( __( 'Load More', 'uix-products' ) );
		echo '</div>';

	}
	
	

	/*
	 * Numbered Pagination
	 *
	 *
	 */
	public static function pagination( $show=3, $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false, $custom_query = '' ) {
	
		
		$pagehtml        = '';
		$pageshow        = '';
		$pagehtml_before = '<ul>';
		$pagehtml_after  = '</ul>';
		

		// Get currect number of pages and define total var
		if ( $custom_query ) {
			$total = $custom_query->max_num_pages;
		} else {
			global $wp_query;
			$total = $wp_query->max_num_pages;
		}
		

		// Display pagination if total var is greater then 1 ( current query is paginated )
		if ( $total > 1 )  {

			// Set current page if not defined
			if ( ! $current_page = get_query_var( 'paged') ) {
				 $current_page = 1;
			 }

			// Get currect format
			if ( get_option( 'permalink_structure') ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}

			// Display pagination
			$paginate = paginate_links(array(
				'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'    => $format,
				'current'   => max( 1, get_query_var( 'paged') ),
				'total'     => $total,
				'mid_size'  => 2,
				'end_size'  => $show,//How many numbers on either the start and the end list edges.
				'type'      => 'list',
				'prev_text' => $custom_prev,
				'next_text' => $custom_next,
			) );
			
			foreach ((array)$paginate as $value) {
				
				if ($li === true){
					if ( strpos( $value, 'prev') ){
						$pagehtml .= '<li class="previous">'.$value.'</li>';
					}elseif ( strpos( $value, 'next' ) ){
						$pagehtml .= '<li class="next">'.$value.'</li>';
					}elseif ( strpos( $value, 'current' ) ){
						$pagehtml .= '<li class="active">'.$value.'</li>';
					}else{
						$pagehtml .= '<li>'.$value.'</li>';	
					}
					
	
				}else{
					
					$pagehtml_before = '';
					$pagehtml_after  = '';
					$pagehtml       .= $value;
	
					
				}
				
				
			}
			
			$pageshow = $pagehtml_before.$pagehtml.$pagehtml_after;
			
			
			//Use Infinite Scroll
			if ( $inf_enable == true ) $pageshow = '';

			
			echo $pageshow;
			
			
			
			
		}
	}


	/*
	 * Load more button
	 *
	 *
	 */
	public static function pagejump( $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false, $pages = '' ) {
	
		// Set correct paged var
		global $paged;
		

		$pageshow = '';
		
		
		if ( empty( $paged ) ) {
			$paged = 1;
		}

		// Get pages var
		if ( ! $pages ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}

		// Display next/previous pagination
		if ( 1 != $pages ) {
			
			if ($li === true){
              
				$pageshow .= '<ul><li class="previous">';
				$pageshow .= get_previous_posts_link( '&larr; ' . __( 'Newer Posts', 'uix-products' ) );
				$pageshow .= '</li><li class="next">';
				$pageshow .= get_next_posts_link( __( 'Older Posts', 'uix-products' ) .' &rarr;' );
				$pageshow .= '</li></ul>';
	

			}else{
				
				$pageshow .= get_previous_posts_link( '&larr; ' . __( 'Newer Posts', 'uix-products' ) );
				$pageshow .= get_next_posts_link( __( 'Older Posts', 'uix-products' ) .' &rarr;' );
				
			}
				
			
		}
		

		//Use Infinite Scroll
		if ( $inf_enable == true ) $pageshow = '';
	
		
		echo $pageshow;

	}
	
	
	/*
	 * Date Format
	 *
	 *
	 */
	public static function date_show( $str ) {
		$the_date = mysql2date( get_option( 'date_format', 'F j, Y' ), $str );	
		return $the_date;
	}	
	
	
	/*
	 * Filter to remove image dimension attributes 
	 *
	 * 
	 */
	public static function remove_thumbnail_dimensions( $html, $post_id, $post_image_id, $post_thumbnail ) {
	
		if ( $post_thumbnail == 'uix-products-entry' || $post_thumbnail == 'uix-products-retina-entry' ){
			$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		}
		return $html;

	}
	
	
	/* 
	 * Taxonomy Archive Pagination 404
	 *
	 * The filter attaches to the posts_per_page filter hook. It then returns a '1' for one post per page if it’s the taxonomy archive I'm concerned about, 
	 * otherwise it returns the default value.
	 *
	 */
	public static function add_tax_filter_posts_per_page( $value ) {
		return ( is_tax('uix_products_category') ) ? 1 : $value;
	}
	
	public static function taxonomy_archive_init() {
		add_filter( 'option_posts_per_page', array( __CLASS__, 'add_tax_filter_posts_per_page' ) );
	}
	
	
	/*
	 * Remove Last Character
	 *
	 *
	 */
	public static function strip_laststr( $str, $rep = ',' ) {
		$str = rtrim( $str );
	    $strnow = substr( $str, -1 );
		if ( $strnow == $rep ){
			return substr( $str, 0, -1 );
		} else {
			return $str;
		}
	}
	
	
	
	/*
	 * Theme Preview With Iframe ( You can delete the folder "/live-demo" )
	 *
	 *
	 */
	public static function product_preview( $name, $link, $type, $value = true ) {
		
		$project_tp_preview_folder = UIX_PRODUCTS_PLUGIN_DIR.'live-demo';
		
		if ( $value ) {
			
			if ( $type == 'theme' ) {
				// If theme
				if ( is_dir( $project_tp_preview_folder ) ) {
					echo esc_url( self::plug_directory().'live-demo/#'.str_replace( '-', '_', sanitize_title( $name ) ) );
				} else {
					echo esc_url( $link );
				}
	
			} else {
				// If plugin
				echo esc_url( $link );
			}
	
			
		} else {
			if ( is_dir( $project_tp_preview_folder ) ) {
				return true;
			} else {
				return false;
			}	
		}
		
		
	}
	
	
	/*
	 * Theme list
	 *
	 *
	 */
	public static function theme_list() {
		
		$themes = new WP_Query( array(
			'post_type'           => 'uix_products',
			'posts_per_page'      => -1,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
			
		) );
		
		$item = '';
		
		if ( $themes->have_posts() ) {
		
			while ( $themes->have_posts() ) :
				$themes->the_post();
				
				$project_type = get_post_meta( get_the_ID(), 'uix_products_themeplugin_type', true );
				
				// Slug
				$theme_slug = str_replace( '-', '_', sanitize_title( get_post_meta( get_the_ID(), 'uix_products_themeplugin_name', true ) ) );
				
				// Theme Name
				$theme_name = get_post_meta( get_the_ID(), 'uix_products_themeplugin_name', true );
				
				// Theme Title
				$theme_title = get_post_meta( get_the_ID(), 'uix_products_themeplugin_title', true );
				
				// Preview URL
				$theme_previewURL = get_post_meta( get_the_ID(), 'uix_products_themeplugin_previewURL', true );
			
				// Purchase or Download URL
				//$theme_fileURL = get_post_meta( get_the_ID(), 'uix_products_themeplugin_fileURL', true );
				$theme_fileURL = esc_url( get_permalink() );
			
				// Thumbnail URL
				if ( has_post_thumbnail() ) {
					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'uix-products-entry', true );
					$theme_thumbnail = $thumb_url[0];
				} else {
					$theme_thumbnail = UixProducts::plug_directory() . 'assets/images/placeholder-image.png';
				}
				
				if ( $project_type == 'theme' ) {
					$item .= '
						'.$theme_slug.' : {
							name     : "'.esc_attr( $theme_name ).'",
							tag      : "WP",
							img      : "'.esc_url( $theme_thumbnail ).'",
							url      : "'.esc_url( $theme_previewURL ).'",
							purchase : "'.esc_url( $theme_fileURL ).'",
							tooltip  : "'.esc_attr( $theme_title ).'"
						},
					';
					
			
				}
				
			endwhile;
			wp_reset_postdata();
		
		}
		
		$theme_js_content = '
			var $products,
				$current_product = "";
			
			$products = {
				'.UixProducts::strip_laststr( $item, ',' ).'
			};
		
		';	
		
		return $theme_js_content;
		
	}
	

	/*
	 * Custom post extensions
	 *
	 *
	 */
	public static function post_ex() {
	
		require_once 'post-extensions/post-extensions-init.php';

		
	}	
	
	
	/**
	 * Determine whether the css core file exists
	 *
	 */
	public static function core_css_file_exists() {
		  $FilePath      = get_stylesheet_directory() . '/uix-products-style.css';
	      $FilePath2     = get_stylesheet_directory() . '/assets/css/uix-products-style.css';
		  $FilePath3     = self::plug_filepath() .'assets/css/uix-products.css';
		  if ( file_exists( $FilePath ) || file_exists( $FilePath2 ) || file_exists( $FilePath3 ) ) {
			  return true;
		  } else {
			  return false;
		  }	
	}
	
	/**
	 * Returns .css file name of custom script 
	 *
	 */
	public static function core_css_file( $type = 'uri' ) {
		
		$validPath    = self::plug_directory() .'assets/css/uix-products.css';
		$newFilePath  = get_stylesheet_directory() . '/uix-products-style.css';
		$newFilePath2 = get_stylesheet_directory() . '/assets/css/uix-products-style.css';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_template_directory_uri() . '/uix-products-style.css';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_template_directory_uri() . '/assets/css/uix-products-style.css';
		}
		
		
		if ( $type == 'name' ) {
			if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
				$validPath = 'uix-products-style.css';
			} else {
				$validPath = 'uix-products.css';
			}
		}
		
		return $validPath;
		
	}
		
	/**
	 * Returns .js file name of custom script 
	 *
	 */
	public static function core_js_file() {
		
		$validPath    = self::plug_directory() .'assets/js/uix-products.js';
		$newFilePath  = get_stylesheet_directory() . '/uix-products-custom.js';
		$newFilePath2 = get_stylesheet_directory() . '/assets/js/uix-products-custom.js';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_template_directory_uri() . '/uix-products-custom.js';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_template_directory_uri() . '/assets/js/uix-products-custom.js';
		}
		
		return $validPath;
		
	}
			
	
	
}

add_action( 'plugins_loaded', array( 'UixProducts', 'init' ) );
UixProducts::post_ex();
