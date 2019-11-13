<?php
/*
 * Creates functions for the front end Image galleries via Uix Custom Metaboxes
*/


// Retrieve attachment IDs
if ( !function_exists ( 'uix_products_get_gallery_ids' ) ) {
	function uix_products_get_gallery_ids() {
		global $post;
		$postid = $post->ID;
		if( ! isset( $postid ) ) return;
		$attachment_ids = get_post_meta( $postid, '_easy_image_gallery', true );
        
        
        
        //
        $image_ids = array();
        $_data = json_decode( $attachment_ids, true );

        if ( is_array( $_data ) && sizeof( $_data ) > 0 ) {
            //Parse JSON data from Editor
            foreach( $_data as $index => $value ) {
                if ( is_array( $value ) && sizeof( $value ) > 0 ) {
          
                    //Exclude lightbox fields
                    if ( ! array_key_exists( 'lightbox', $value ) ) {
                        $img_url = Uix_Products_Custom_Metaboxes::parse_json_data_from_editor( $value[ 'filePath' ] );

                        if ( !empty( $img_url ) ) {
                            $img_id = attachment_url_to_postid( $img_url );
                            array_push( $image_ids, $img_id );
                        }
                    }//endif array_key_exists( 'lightbox', $value )
                }//endif $value
            }//end foreach   
        }    
        
  
        //such as: 1239,1240,1233
        if ( !uix_products_is_json( $attachment_ids ) ) {
			$attachment_ids = explode( ',', $attachment_ids );
			$image_ids = array_filter( $attachment_ids );    
        }
        
        
        if ( sizeof( $image_ids ) == 0 ) {
            return '';
        } else {
            return $image_ids;
        }
        
        
		
	}
}

// Check If A String Is JSON
if ( !function_exists ( 'uix_products_is_json' ) ) {
	function uix_products_is_json( $string ) {
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
	}
}




// Get attachment data
if ( !function_exists ( 'uix_products_get_attachment' ) ) {
	function uix_products_get_attachment( $attachment_id ) {
		$attachment = get_post( $attachment_id );
		return array(
			'alt'			=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption'		=> $attachment->post_excerpt,
			'description'	=> $attachment->post_content,
			'href'			=> get_permalink( $attachment->ID ),
			'src'			=> $attachment->guid,
			'title'			=> $attachment->post_title
		);
	}
}


// Return gallery images count
if ( !function_exists ( 'uix_products_gallery_count' ) ) {
	function uix_products_gallery_count() {
		$images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
		$images = explode( ',', $images );
		$number = count( $images );
		return $number;
	}
}


// Check if lightbox is enabled
if ( !function_exists ( 'uix_products_gallery_is_lightbox_enabled' ) ) {
	function uix_products_gallery_is_lightbox_enabled() {
		global $post;
		$postid = $post->ID;
		if( ! isset( $postid ) ) return;
		$attachment_ids = get_post_meta( $postid, '_easy_image_gallery', true );
        
        
        $lightbox_enable = NULL;
        
        //
        $_data = json_decode( $attachment_ids, true );

        if ( is_array( $_data ) && sizeof( $_data ) > 0 ) {
            //Parse JSON data from Editor
            foreach( $_data as $index => $value ) {
                if ( is_array( $value ) && sizeof( $value ) > 0 ) {
          
                    //Exclude lightbox fields
                    if ( array_key_exists( 'lightbox', $value ) ) {
                        $lightbox_enable = esc_attr( Uix_Products_Custom_Metaboxes::parse_json_data_from_editor( $value[ 'lightbox' ] ) );
                        break;
                    }//endif array_key_exists( 'lightbox', $value )
                }//endif $value
            }//end foreach   
        }    
          
        if ( $lightbox_enable == 'on' ) {
            return true;
        } else {
            return 'empty';
        }
	}
}