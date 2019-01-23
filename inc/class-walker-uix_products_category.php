<?php
/**
 * Output products categories for dropdown styles
 *
 */

class Uix_Products_Dropdown_Walker_Products_Category extends Walker_Category {

    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

			$cat_name = esc_attr( $category->name );
			$cat_slug = esc_attr( $category->slug );
			$cat_name = apply_filters( 'list_cats', $cat_name, $category );
			$aclass = '';
	
			// ---	
			$termchildren = get_term_children( $category->term_id, $category->taxonomy );
	
			if( count( $termchildren ) > 0 ){
				$aclass =  ' class="parent" ';
			}
			

	
			$link = '<a '.$aclass.' data-group="'.$cat_slug.'" href="' . esc_url( get_term_link( $category ) ) . '" ';
	
	
			// ---
			if ( empty($category->description) ) {
				$link .= 'title="'.$cat_name.'"';
			} else {
				$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
			}

           $link .= '>';
           $link .= $cat_name . '</a>';



			if ( !empty($show_count) ) $link .= ' (' . intval($category->count) . ')';
			

			if ( 'list' == $args['style'] ) {
		
					$output           .= "\t<li";
					$class             = 'cat-item cat-item-' . $category->term_id;
					$current_category  = $args[ 'current_category' ];
		
					if ( !empty( $current_category ) ) {
		
							$_current_category = get_term( $current_category, $category->taxonomy );
							if ( $category->term_id == $current_category ) {
									$class .=  ' current-cat';
							} elseif ( $category->term_id == $_current_category->parent ) {
									$class .=  ' current-cat-parent';
							}
		
					}
		
					$output .=  ' class="' . $class . '"';
					$output .= ">$link".PHP_EOL;
		
			} else {
		
					$output .= "\t$link<br />".PHP_EOL;
		
			}
				
			

      }

}
	
