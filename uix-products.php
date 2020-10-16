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
 * Version:     1.4.5
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
		
		add_action( 'init', array( __CLASS__, 'register_scripts' ) );
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
		add_action( 'after_setup_theme', array( __CLASS__, 'add_featured_image_support' ), 11 );
		add_filter( 'init', array( __CLASS__, 'taxonomy_archive_init' ) );
		add_filter( 'next_posts_link_attributes', array( __CLASS__, 'next_post_link_attributes' ) );
		add_filter( 'previous_posts_link_attributes', array( __CLASS__, 'previous_post_link_attributes' ) );	

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
		
		//Add custom meta boxes API. 
		//Provides a compatible solution for some personalized themes that require Uix Products.
		require_once UIX_PRODUCTS_PLUGIN_DIR.'includes/admin/uix-custom-metaboxes/init.php';
		require_once UIX_PRODUCTS_PLUGIN_DIR.'includes/admin/uix-custom-metaboxes/controller-upload.php';
		
        
		//Custom post type function initialization
		require_once UIX_PRODUCTS_PLUGIN_DIR.'includes/admin/post-type-init.php';
        
		//Options for custom meta boxes
		require_once UIX_PRODUCTS_PLUGIN_DIR.'includes/admin/options.php';
		
	}
	
	
	
	/*
	 * Register scripts and styles.
	 *
	 *
	 */
	public static function register_scripts() {
		
		
		//Add-ons
		//--------------------
		// prettyPhoto
		wp_register_script( 'prettyPhoto', self::plug_directory() .'assets/add-ons/prettyPhoto/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.5', true );	
		wp_register_style( 'prettyPhoto', self::plug_directory() .'assets/add-ons/prettyPhoto/jquery.prettyPhoto.css', false, '3.1.5', 'all' );
	
		// Muuri
		wp_register_script( 'muuri', self::plug_directory() .'assets/add-ons/muuri/muuri.min.js', false, '0.8.0', true );
		
		
		
		//Core
		//--------------------
		if ( self::core_css_file_exists() ) {
			//Add shortcodes style to Front-End
			wp_register_style( self::PREFIX . '-products', self::core_css_file(), false, self::ver(), 'all');
			
		}
		
		//Main stylesheets and scripts to Front-End
		wp_register_script( self::PREFIX . '-products', self::core_js_file(), array( 'jquery' ), self::ver(), true );	

	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {

		//Add-ons
		//--------------------
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'muuri' ); //Use with `imagesloaded`
		wp_enqueue_script( 'prettyPhoto' );
		wp_enqueue_style( 'prettyPhoto' );
		
		//Core
		//--------------------
		wp_enqueue_script( self::PREFIX . '-products' );
		wp_enqueue_style( self::PREFIX . '-products' );
		
		

	}
	
	

	
	/*
	 * Enqueue scripts and styles  in the backstage
	 *
	 *
	 */
	public static function backstage_scripts() {
	
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();
		  
		 if ( 
			 self::inc_str( $currentScreen->id, 'uix_products' ) || 
			 self::inc_str( $currentScreen->id, 'uix-products' ) || 
			 self::inc_str( $currentScreen->base, '_page_' )
		 ) 
		 {
				  
		     wp_enqueue_style( self::PREFIX . '-products-admin', self::plug_directory() .'includes/admin/css/style.min.css', false, self::ver(), 'all' );
			 wp_enqueue_script( self::PREFIX . '-products-admin', self::plug_directory() .'includes/admin/js/core.min.js', array( 'jquery' ), self::ver(), true );	
	  
		  }
		

	}
	
	
	
	/**
	 * Internationalizing  Plugin
	 *
	 */
	public static function tc_i18n() {
	
	
        load_plugin_textdomain('uix-products', false, dirname(plugin_basename(__FILE__)).'/languages/');

        //move language files to System folder "languages/plugins/yourplugin-<locale>.po"
        global $wp_filesystem;

        if ( empty( $wp_filesystem ) ) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        $filenames = array();
        $filepath = UIX_PRODUCTS_PLUGIN_DIR.'languages/';
        $systempath = WP_CONTENT_DIR . '/languages/plugins/';

        if ( !$wp_filesystem->is_dir( $systempath ) ) {
            $wp_filesystem->mkdir( $systempath, FS_CHMOD_DIR );
        }//endif is_dir( $systempath ) 
            
        if ( $wp_filesystem->is_dir( $systempath ) ) {
            
            //Only execute one-time scripts
            $transient = self::PREFIX . '-products-lang_files_onetime_check';
            if ( !get_transient( $transient ) ) {

                set_transient( $transient, 'locked', 1800 ); // lock function for 30 Minutes


                foreach(glob(dirname(__FILE__)."/languages/*.po") as $file) {
                    $filenames[] = str_replace(dirname(__FILE__)."/languages/", '', $file);
                }

                foreach(glob(dirname(__FILE__)."/languages/*.mo") as $file) {
                    $filenames[] = str_replace(dirname(__FILE__)."/languages/", '', $file);
                }

                foreach ($filenames as $filename) {

                    // Copy
                    $dir1 = $wp_filesystem->find_folder($filepath);
                    $file1 = trailingslashit($dir1).$filename;

                    $dir2 = $wp_filesystem->find_folder($systempath);
                    $file2 = trailingslashit($dir2).$filename;

                    $filecontent = $wp_filesystem->get_contents($file1);

                    $wp_filesystem->put_contents($file2, $filecontent, FS_CHMOD_FILE);  

                }
                



            }//endif get_transient( $transient )   
            
        }//endif is_dir( $systempath ) 
        


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

         
//		$hook = add_submenu_page(
//			'edit.php?post_type=uix_products',
//			__( 'Uix Products Settings', 'uix-products' ),
//			__( 'Settings', 'uix-products' ),
//			'manage_options',
//			'uix-products-custom-submenu-page',
//			array( __CLASS__, 'uix_products_options_page' )
//		);
//		
//		add_action("load-{$hook}", function( $caps ) {
//			header( "Location: " . admin_url( "admin.php?page=".self::HELPER."&tab=general-settings" ) );
//			exit;
//        });
		 
		 
	
        //Add sub links
		add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'Settings', 'uix-products' ),
			__( 'Settings', 'uix-products' ),
			'manage_options',
            'admin.php?page='.self::HELPER.'&tab=general-settings'
		);	    
         
		add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'How to use?', 'uix-products' ),
			__( 'How to use?', 'uix-products' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=usage'
		);	  
		 
		add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'Template Files', 'uix-products' ),
			__( 'Template Files', 'uix-products' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=temp'
		);	  
		 
		 
		add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'Custom CSS', 'uix-products' ),
			__( 'Custom CSS', 'uix-products' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=custom-css'
		);
		 
         
		add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'For Theme Developer', 'uix-products' ),
			__( 'For Theme Developer', 'uix-products' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=for-developer'
		);
           
		 
		add_submenu_page(
			'edit.php?post_type=uix_products',
			__( 'Helper', 'uix-products' ),
			__( 'About', 'uix-products' ),
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

		  if ( 
			  ( self::inc_str( $currentScreen->id, 'uix_products' ) || 
			    self::inc_str( $currentScreen->id, 'uix-products' ) ) && 
			    !self::inc_str( $currentScreen->id, '_page_' ) 
		  ) 
		  {

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

	      if( !file_exists( get_stylesheet_directory() . '/tmpl-uix_products.php' ) && !file_exists( get_stylesheet_directory() . '/page-uix_products.php' ) ) {
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
	
	public static function templates( $nonceaction, $nonce, $remove = false, $ajax = false ){
	
		  global $wp_filesystem;
			
		  $filenames = array();
		  $filepath  = UIX_PRODUCTS_PLUGIN_DIR. 'theme_templates/';
		  $themepath = get_stylesheet_directory() . '/';

	      foreach ( glob( dirname(__FILE__). "/theme_templates/*.php") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		  }	
		  
		 
			/*
			* To perform the requested action, WordPress needs to access your web server. 
			* Please enter your FTP credentials to proceed. If you do not remember your credentials, 
			* you should contact your web host.
			*
			*/
		   if ( $ajax ) {
				ob_start();

					self::wpfilesystem_read_file( $nonceaction, $nonce, self::get_theme_template_dir_name().'/', 'tmpl-uix_products.php', 'plugin' );
					$out = ob_get_contents();
				ob_end_clean();
				
				if ( !empty( $out ) ) {
					ob_start();

						self::wpfilesystem_read_file( $nonceaction, $nonce, self::get_theme_template_dir_name().'/', 'page-uix_products.php', 'plugin' );
						$out = ob_get_contents();
					ob_end_clean();

				
				}
				

				if ( !empty( $out ) ) {
					return 0;
					exit();
				}  
			   
		   }

			/*
			* File batch operation
			*
			*/
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
			
		  } 
		
		
		
			/*
			* Returns the system information.
			*
			*/
			$div_notice_info_before    = '<p class="uix-bg-custom-info-msg"><strong><i class="dashicons dashicons-warning"></i> ';
			$div_notice_success_before = '<p class="uix-bg-custom-success-msg"><strong><i class="dashicons dashicons-yes"></i> ';
			$div_notice_error_before   = '<p class="uix-bg-custom-error-msg"><strong><i class="dashicons dashicons-no"></i> ';
		    $div_notice_after  = '</strong></p>';
			$notice                    = '';    
			$echo_ok_status            = '<span data-ok="1"></span>';

			if ( $ajax ) {
				$div_notice_info_before      = '';   
				$div_notice_success_before   = '';   
				$div_notice_error_before     = '';
				$div_notice_after            = '';
			}

			if ( !$remove ) {
				if ( self::tempfile_exists() ) {
					$info   = $echo_ok_status.__( 'Operation successfully completed!', 'uix-products' );
					$notice = $div_notice_success_before.$info.$div_notice_after;
					echo '<script type="text/javascript">
							   setTimeout( function(){
								   window.location = "'.admin_url( 'admin.php?page='.self::HELPER.'&tab=temp' ).'";
							   }, 1000 );

						  </script>';
					
				} else {
					$info   = __( '<strong>There was a problem copying your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.', 'uix-products' );
					$notice = $div_notice_error_before.$info.$div_notice_after;
				}
				
				

			} else {
				if ( self::tempfile_exists() ) {
					$info   = __( '<strong>There was a problem removing your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.', 'uix-products' );
					$notice = $div_notice_error_before.$info.$div_notice_after;
				} else {
					$info   = $echo_ok_status.__( 'Remove successful!', 'uix-products' );
					$notice = $div_notice_success_before.$info.$div_notice_after;
					echo '<script type="text/javascript">
							   setTimeout( function(){
								   window.location = "'.admin_url( 'admin.php?page='.self::HELPER.'&tab=temp' ).'";
							   }, 1000 );

						  </script>';
				}	

			}
		
		
			return $notice;
		    
		    
			
	}	 



	/**
	 * Initialize the WP_Filesystem
	 * 
	 * Example:
	        
            $output = "";
			
            if ( !empty( $_POST ) && check_admin_referer( 'custom_action_nonce') ) {
				
				
                  $output = UixProducts::wpfilesystem_write_file( 'custom_action_nonce', 'admin.php?page='.UixProducts::HELPER.'&tab=???', UIX_PRODUCTS_PLUGIN_DIR.'helper/', 'debug.txt', 'This is test.', 'plugin' );
				  echo $output;
			
            } else {
				
				wp_nonce_field( 'custom_action_nonce' );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Files', 'uix-products' ).'"  /></p>';
				
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
	
	public static function wpfilesystem_write_file( $nonceaction, $nonce, $path, $pathname, $text, $type = 'plugin' ){
		  global $wp_filesystem;
		  
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_PRODUCTS_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_stylesheet_directory() ).$path; 
		  } 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				$wp_filesystem->put_contents( $file, $text, FS_CHMOD_FILE );
			
				return true;
				
		  } else {
			  return false;
		  }
	}	
	
	 
	public static function wpfilesystem_read_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_PRODUCTS_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_stylesheet_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
				    return $wp_filesystem->get_contents( $file );
	
				} else {
					return false;
				}
		
		
		  } 
	}	 	
	
	
	public static function wpfilesystem_del_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_PRODUCTS_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_stylesheet_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
					$wp_filesystem->delete( $file, false, FS_CHMOD_FILE );
					return true;
	
				} else {
					return false;
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
	
		require_once UIX_PRODUCTS_PLUGIN_DIR.'includes/classes-frontend/class-walker-uix_products_category.php';
		
	}
	
	
	/**
	 *  Register widget area.
	 */
	public static function register_my_widget( $links ) {
		// Recent products widget
		require 'includes/classes-frontend/class-widgets.php';
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
	 *  Get gallery
	 *
	 *
	 */
	
	public static function gallery_app() {
		require_once UIX_PRODUCTS_PLUGIN_DIR.'includes/admin/gallery/front-display.php';
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
	 * Use numeric Paginate
	 *
	 *
	 */
	public static function pagination( $show = 3, $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false ) {
	

		//static front page & custom page @https://codex.wordpress.org/Pagination
		if ( get_query_var( 'paged' ) ) { 
			$paged = get_query_var( 'paged' ); 
		} elseif ( get_query_var( 'page' ) ) { 
			$paged = get_query_var( 'page' ); 
		} else { 
			$paged = 1; 
		}

		the_posts_pagination( array(
			'mid_size'           => $show,
			'prev_text'          => $custom_prev,
			'next_text'          => $custom_next,
		) ); 

	}


	/*
	 * Only "next" and "previous" button
	 *
	 *
	 */
	public static function pagejump( $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false, $pages = '' ) {
	
		//static front page & custom page @https://codex.wordpress.org/Pagination
		if ( get_query_var( 'paged' ) ) { 
			$paged = get_query_var( 'paged' ); 
		} elseif ( get_query_var( 'page' ) ) { 
			$paged = get_query_var( 'page' ); 
		} else { 
			$paged = 1; 
		}

		ob_start();
			the_posts_pagination( array(
				'prev_text'          => $custom_prev,
				'next_text'          => $custom_next,
			) ); 
			$out = ob_get_contents();
		ob_end_clean();	

		$out = str_replace( 'next page-numbers page-numbers-hide', 'next page-numbers', 
			   str_replace( 'prev page-numbers page-numbers-hide', 'prev page-numbers', 
			   str_replace( 'page-numbers', 'page-numbers page-numbers-hide',
			   $out ) ) );

		echo $out;
	

	}
	


	/*
	 * Add class to links generated by WordPress “next_post_link” and “previous_post_link” functions
	 *
	 *
	 */
	public static function next_post_link_attributes( $output ) {
		return 'class="next page-numbers"';
	}
	
	public static function previous_post_link_attributes( $output ) {
		return 'class="prev page-numbers"';
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
					
					if ( !empty( $theme_slug ) ) {
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
	
	
	
	/**
	 * Determine whether the css core file exists
	 *
	 */
	public static function core_css_file_exists() {
		  $FilePath     = self::plug_filepath() .'assets/css/uix-products.css';
		  if ( self::theme_core_css_file_exists() || file_exists( $FilePath ) ) {
			  return true;
		  } else {
			  return false;
		  }	
	}
	
	/**
	 * Determine whether the css core file exists in your theme
	 *
	 */
	public static function theme_core_css_file_exists() {
		  $FilePath      = get_stylesheet_directory() . '/uix-products-custom.css';
	      $FilePath2     = get_stylesheet_directory() . '/assets/css/uix-products-custom.css';
		  if ( file_exists( $FilePath ) || file_exists( $FilePath2 ) ) {
			  return true;
		  } else {
			  return false;
		  }	
	}
	
	
	/**
	 * Determine whether the javascript core file exists in your theme
	 *
	 */
	public static function theme_core_js_file_exists() {
		  $FilePath      = get_stylesheet_directory() . '/uix-products-custom.js';
	      $FilePath2     = get_stylesheet_directory() . '/assets/js/uix-products-custom.js';
		  if ( file_exists( $FilePath ) || file_exists( $FilePath2 ) ) {
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
		$newFilePath  = get_stylesheet_directory() . '/uix-products-custom.css';
		$newFilePath2 = get_stylesheet_directory() . '/assets/css/uix-products-custom.css';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_stylesheet_directory_uri() . '/uix-products-custom.css';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_stylesheet_directory_uri() . '/assets/css/uix-products-custom.css';
		}
		
		
		if ( $type == 'name' ) {
			if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
				$validPath = 'uix-products-custom.css';
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
	public static function core_js_file( $type = 'uri' ) {
		
		$validPath    = self::plug_directory() .'assets/js/uix-products.js';
		$newFilePath  = get_stylesheet_directory() . '/uix-products-custom.js';
		$newFilePath2 = get_stylesheet_directory() . '/assets/js/uix-products-custom.js';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_stylesheet_directory_uri() . '/uix-products-custom.js';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_stylesheet_directory_uri() . '/assets/js/uix-products-custom.js';
		}
		
		
		if ( $type == 'name' ) {
			if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
				$validPath = 'uix-products-custom.js';
			} else {
				$validPath = 'uix-products.js';
			}
		}
		
		return $validPath;
		
	}
			
	/**
	 * Filters content and keeps only allowable HTML elements.
	 *
	 */
	public static function kses( $html ){
		
		return wp_kses( $html, wp_kses_allowed_html( 'post' ) );

	}
	
	
	
}

add_action( 'plugins_loaded', array( 'UixProducts', 'init' ) );
