<?php
/*
 * Creates functions for the front end Image galleries
*/


// Retrieve attachment IDs
if ( !function_exists ( 'get_gallery_ids' ) ) {
	function get_gallery_ids() {
		global $post;
		$id_array = '';
		$postid = $post->ID;
		if( ! isset( $postid ) ) return;
		$attachment_ids = get_post_meta( $postid, '_easy_image_gallery', true );
		$link_images = get_post_meta( $postid, '_easy_image_gallery_link_images', true );
		if ( $attachment_ids ) {
			$attachment_ids = explode( ',', $attachment_ids );
			$id_array = array_filter( $attachment_ids );
		}
		return $id_array;
	}
}

// Get attachment data
if ( !function_exists ( 'get_attachment' ) ) {
	function get_attachment( $attachment_id ) {
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
if ( !function_exists ( 'gallery_count' ) ) {
	function gallery_count() {
		$images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
		$images = explode( ',', $images );
		$number = count( $images );
		return $number;
	}
}


// Check if lightbox is enabled
if ( !function_exists ( 'gallery_is_lightbox_enabled' ) ) {
	function gallery_is_lightbox_enabled() {
		$link_images = get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true );
		if ( $link_images == '' ) return 'empty';
		if ( 'on' == $link_images ) return true;
	}
}