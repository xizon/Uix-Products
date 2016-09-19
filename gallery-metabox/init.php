<?php
/**
 * Creates a gallery metabox for WordPress
 *
 * http://wordpress.org/plugins/easy-image-gallery/
 * https://github.com/woothemes/woocommerce
 *
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.uixplorer.com
 * @version     1.0.0
 * @link        https://github.com/uixplorer/gallery-metabox
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Start Class
if ( ! class_exists( 'gallery_metabox' ) ) {
    class gallery_metabox {

        /**
         * Vars
         *
         * @since 1.6.0
         */
        protected $dir = '';
		
		/**
		 * Defaults
		 * @var   array
		 */
		protected static $mb_defaults = array(
			'id'         => 'gallery-metabox',
			'title'      => 'Image Gallery',
		);

        /**
         * Initialize the class and set its properties.
         *
         * @since   1.0.0
         */
        public function __construct( $meta_box ) {
			
			//var
			$meta_box = self::set_mb_defaults( $meta_box );
			$this->_meta_box = $meta_box;
			
			
            add_action( 'add_meta_boxes', array( $this, 'add_meta' ) );
            add_action( 'save_post', array( $this, 'save_meta' ) );
            add_action( 'admin_head', array( $this, 'css' ) );
            $this->dir  = get_template_directory_uri() . '/inc/add-ons/gallery-metabox/';
            $this->dir  = apply_filters( 'gallery_metabox_dir_uri', $this->dir );
        }
		
			
		/**
		 * Fills in empty metabox parameters with defaults
		 * @since  1.0.1
		 * @param  array $meta_box Metabox config array
		 * @return array           Modified Metabox config array
		 */
		public static function set_mb_defaults( $meta_box ) {
			return wp_parse_args( $meta_box, self::$mb_defaults );
		}
	

        /**
         * Adds the gallery metabox
         *
         * @link    http://codex.wordpress.org/Function_Reference/add_meta_box
         * @since   1.0.0
         */
        function add_meta() {
            $types  = array( 'post' );
            $types  = apply_filters( 'gallery_metabox_post_types', $types );
            foreach ( $types as $type ) {
                add_meta_box(
                    $this->_meta_box['id'],         // ID
                    $this->_meta_box['title'],      // Title
                    array( $this, 'render' ),       // Callback
                    $type,                          // Post type
                    'normal',                       // Cotext
                    'high'                          // Priority
                );
            }
        }

        /**
         * Render the gallery metabox
         *
         * @since 1.0.0
         */
        function render() {
            global $post; ?>
            <div id="gallery_images_container">
                <ul class="gallery_images">
                    <?php
                    $image_gallery = get_post_meta( $post->ID, '_easy_image_gallery', true );
                    $attachments = array_filter( explode( ',', $image_gallery ) );
                    if ( $attachments ) {
                        foreach ( $attachments as $attachment_id ) {
                            if ( wp_attachment_is_image ( $attachment_id  ) ) {
                                echo '<li class="image" data-attachment_id="' . $attachment_id . '"><div class="attachment-preview"><div class="thumbnail">
                                            ' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</div>
                                            <a href="#" class="uix-gmb-remove" title="' . __( 'Remove image', 'uix-products' ) . '"><div class="media-modal-icon"></div></a>
                                        </div></li>';
                            }
                        }
                    } ?>
                </ul>
                <input type="hidden" id="image_gallery" name="image_gallery" value="<?php echo esc_attr( $image_gallery ); ?>" />
                <?php wp_nonce_field( 'easy_image_gallery', 'easy_image_gallery' ); ?>
            </div>
            <p class="add_gallery_images hide-if-no-js">
                <a href="#" class="button-primary"><?php _e( 'Add/Edit Images', 'uix-products' ); ?></a>
            </p>
            <?php $checked = checked( get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true ), 'on', 1 ); ?>
            <p>
                <label for="easy_image_gallery_link_images">
                    <input type="checkbox" id="easy_image_gallery_link_images" value="on" name="easy_image_gallery_link_images"<?php echo $checked; ?> /> <?php _e( 'Enable Lightbox for this gallery?', 'uix-products' )?>
                </label>
            </p>
            <?php // Props to WooCommerce for the following JS code ?>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    // Uploading files
                    var image_gallery_frame;
                    var $image_gallery_ids  = $( '#image_gallery' );
                    var $gallery_images    = $( '#gallery_images_container ul.gallery_images' );
                    jQuery( '.add_gallery_images' ).on( 'click', 'a', function( event ) {
                        var $el = $(this);
                        var attachment_ids = $image_gallery_ids.val();
                        event.preventDefault();
                        // If the media frame already exists, reopen it.
                        if ( image_gallery_frame ) {
                            image_gallery_frame.open();
                            return;
                        }
                        // Create the media frame.
                        image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                            // Set the title of the modal.
                            title: "<?php _e( 'Add Images to Gallery', 'uix-products' ); ?>",
                            button: {
                                text: "<?php _e( 'Add to gallery', 'uix-products' ); ?>",
                            },
                            multiple: true
                        });
                        // When an image is selected, run a callback.
                        image_gallery_frame.on( 'select', function( ) {
                            var selection = image_gallery_frame.state().get('selection');
                            selection.map( function( attachment ) {
                                attachment = attachment.toJSON();
                                if ( attachment.id ) {
                                    attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
                                     $gallery_images.append('\
                                        <li class="image" data-attachment_id="' + attachment.id + '">\
                                            <div class="attachment-preview">\
                                                <div class="thumbnail">\
                                                    <img src="' + attachment.url + '" />\
                                                </div>\
                                               <a href="#" class="uix-gmb-remove" title="<?php esc_attr_e( 'Remove image', 'uix-products' ); ?>"><div class="media-modal-icon"></div></a>\
                                            </div>\
                                        </li>');
                                }
                            } );
                            $image_gallery_ids.val( attachment_ids );
                        });
                        // Finally, open the modal.
                        image_gallery_frame.open();
                    });
                    // Image ordering
                    $gallery_images.sortable({
                        items                   : 'li.image',
                        cursor                  : 'move',
                        scrollSensitivity       : 40,
                        forcePlaceholderSize    : true,
                        forceHelperSize         : false,
                        helper                  : 'clone',
                        opacity                 : 0.65,
                        placeholder             : 'wc-metabox-sortable-placeholder',
                        start:function( event,ui ) {
                            ui.item.css( 'background-color', '#f6f6f6' );
                        },
                        stop:function( event,ui ){
                            ui.item.removeAttr( 'style' );
                        },
                        update: function( event, ui ) {
                            var attachment_ids = '';
                            $( '#gallery_images_container ul li.image' ).css( 'cursor', 'default' ).each( function( ) {
                                var attachment_id   = jQuery(this).attr( 'data-attachment_id' );
                                attachment_ids      = attachment_ids + attachment_id + ',';
                            });
                            $image_gallery_ids.val( attachment_ids );
                        }
                    });
                    // Remove images
                    $( '#gallery_images_container' ).on( 'click', 'a.uix-gmb-remove', function( ) {
                        $( this ).closest( 'li.image' ).remove();
                        var attachment_ids = '';
                        $( '#gallery_images_container ul li.image' ).css( 'cursor', 'default' ).each( function( ) {
                            var attachment_id   = jQuery( this ).attr( 'data-attachment_id' );
                            attachment_ids      = attachment_ids + attachment_id + ',';
                        } );
                        $image_gallery_ids.val( attachment_ids );
                        return false;
                    } );
                });
            </script>
        <?php
        }

        function save_meta( $post_id ) {
            // Check nonce
            if ( ! isset( $_POST[ 'easy_image_gallery' ] ) || ! wp_verify_nonce( $_POST[ 'easy_image_gallery' ], 'easy_image_gallery' ) ) {
                return;
            }
            // Check auto save
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }
            // Check user permissions
            $post_types = array( 'post' );
            if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return;
                }
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
                }
            }
            if ( isset( $_POST[ 'image_gallery' ] ) && !empty( $_POST[ 'image_gallery' ] ) ) {
                $attachment_ids = sanitize_text_field( $_POST['image_gallery'] );
                // Turn comma separated values into array
                $attachment_ids = explode( ',', $attachment_ids );
                // Clean the array
                $attachment_ids = array_filter( $attachment_ids  );
                // Return back to comma separated list with no trailing comma. This is common when deleting the images
                $attachment_ids =  implode( ',', $attachment_ids );
                update_post_meta( $post_id, '_easy_image_gallery', $attachment_ids );
            } else {
                // Delete gallery
                delete_post_meta( $post_id, '_easy_image_gallery' );
            }
            // link to larger images
            if ( isset( $_POST[ 'easy_image_gallery_link_images' ] ) ) {
                update_post_meta( $post_id, '_easy_image_gallery_link_images', $_POST[ 'easy_image_gallery_link_images' ] );
            } else {
                update_post_meta( $post_id, '_easy_image_gallery_link_images', 'off' );
            }
            // Add action
            do_action( 'save_gallery_metabox', $post_id );
        }

        function css() { ?>
            <style>
                .gallery_images .details.attachment { box-shadow: none }
                .gallery_images .image > div { width: 80px; height: 80px; box-shadow: none; }
                .gallery_images .attachment-preview { position: relative; padding: 4px; }
                .gallery_images .attachment-preview .thumbnail { cursor: move }    
                .gallery_images .wc-metabox-sortable-placeholder{width: 80px;height: 80px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;border:4px dashed #ddd;background:#f7f7f7 url("<?php echo $this->dir; ?>watermark.png") no-repeat center}      
                .gallery_images .uix-gmb-remove {background: #eee url("<?php echo $this->dir; ?>delete.png") center center no-repeat;position: absolute;top: 2px;right: 2px;border-radius: 2px;padding: 2px;display: none;width: 10px;height: 10px;margin: 0;display: none;overflow: hidden;} 
                .gallery_images .image div:hover .uix-gmb-remove { display: block }
                .gallery_images:after, #gallery_images_container:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
                #gallery_images_container ul { margin: 0 !important }
                .gallery_images > li { float: left; cursor: move; margin: 9px 9px 0 0; }
                .gallery_images li.image img { width: 80px; height: 80px; }
                .gallery_images .attachment-preview:before { display: none !important; }
            </style>    
            <?php
        }
    }
}

// Class needed only in the admin
if ( is_admin() ) {
    $gallery_metabox = new gallery_metabox(
		array(
			'id'         => 'gallery-metabox',
			'title'      => __( 'Image Gallery', 'uix-products' )
		)
	);
}


/**
 * Retrieve attachment IDs
 *
 * @since   1.0.0
 * @return  bool
 */
if ( ! function_exists ( 'get_gallery_ids' ) ) {
    function get_gallery_ids() {
        $attachment_ids = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
        $attachment_ids = explode( ',', $attachment_ids );
        return array_filter( $attachment_ids );
    }
}

/**
 * Retrieve attachment data
 *
 * @since   1.0.0
 * @return  array
 */
if ( ! function_exists ( 'get_attachment' ) ) {
    function get_attachment( $id ) {
        $attachment = get_post( $id );
        return array(
            'alt'           => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'caption'       => $attachment->post_excerpt,
            'description'   => $attachment->post_content,
            'href'          => get_permalink( $attachment->ID ),
            'src'           => $attachment->guid,
            'title'         => $attachment->post_title,
        );
    }
}

/**
 * Return gallery count
 *
 * @since   1.0.0
 * @return  bool
 */
if ( ! function_exists ( 'gallery_count' ) ) {
    function gallery_count() {
        $ids = get_gallery_ids();
        return count( $ids );
    }
}

/**
 * Check if lightbox is enabled
 *
 * @since   1.0.0
 * @return  bool
 */
if ( ! function_exists ( 'gallery_is_lightbox_enabled' ) ) {
    function gallery_is_lightbox_enabled() {
        if ( 'on' == get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true ) ) {
            return true;
        }
    }
}