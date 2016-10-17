( function($) {
    'use strict';
		
	
	$( function() {
		

		/*! 
		 * ************************************
		 * FlexSlider
		 *************************************
		 */
		$( '.custom-uix-products-flexslider' ).flexslider({
			namespace	      : 'custom-uix-products-flex-',
			animation         : 'slide',
			selector          : '.custom-uix-products-slides > div.item',
			controlNav        : true,
			smoothHeight      : true,
			prevText          : "<i class='custom-uix-products-flex-dir custom-uix-products-flex-dir-prev'></i>",
			nextText          : "<i class='custom-uix-products-flex-dir custom-uix-products-flex-dir-next'></i>",
			animationSpeed    : 600,
			slideshowSpeed    : 10000,
			slideshow         : true,
			animationLoop     : true,
		    start: initslidesLightbox, //Fires when the slider loads the first slide
			before: initslidesLightbox //Fires after each slider animation completes
		});
	
        function initslidesLightbox( slider ) {
			slider.slides.find( "a[rel^='uix-products-slider-prettyPhoto']" ).prettyPhoto({
				 animation_speed:    'normal',
				 theme:              'dark_rounded',
				 slideshow:          3000,
				 utoplay_slideshow:  false
			 });
        }
	
	
		/*! 
		 * ************************************
		 * Grid List
		 *************************************
		 */
		$( '.uix-products-container' ).each( function() {
			var type = $( this ).data( 'show-type' );
			
			// Masonry
			if ( type.indexOf( 'masonry' ) >= 0  ) {
				$( this ).addClass( 'masonry-container' );
				$( this ).find( '.uix-products-item' ).addClass( 'masonry-item' );
			}
			
			// Filterable
			if ( type.indexOf( 'filter' ) >= 0  ) {
				$( this ).addClass( 'filter-container' );
				$( this ).find( '.uix-products-item' ).addClass( 'filter-item' );	
			}	
		
		});
	
	    /*--  Function of Masonry  --*/
		var masonryObj = $( '.masonry-container .uix-products-tiles' );
		imagesLoaded( masonryObj ).on( 'always', function() {
			  masonryObj.masonry({
				itemSelector: '.masonry-item'
			  });  
		});
		
		
	    /*--  Function of Filterable  --*/
		if ( $( "[data-show-type]" ).length > 0 ) {
			if ( $( "[data-show-type]" ).data( 'show-type' ).indexOf( 'filter' ) >= 0 ) {
				
				$( '.uix-products-container' ).each( function() {
					var filterCat = $( this ).data( 'filter-id' ),
						$grid = $( this ).find( '.uix-products-tiles' ),
						$filterOptions = $( filterCat );
						
					imagesLoaded( $grid ).on( 'always', function() {
						
						 $grid.shuffle({
							itemSelector: '.filter-item',
							speed: 550, // Transition/animation speed (milliseconds).
							easing: 'ease-out', // CSS easing function to use.
							sizer: null // Sizer element. Use an element to determine the size of columns and gutters.
						  });
						  
						
						$filterOptions.find( 'li > a' ).on( 'click', function( e ) {
							
							  var $this = $( this ),
								  activeClass = 'current-cat',
								  isActive = $this.hasClass( activeClass ),
								  group = isActive ? 'all' : $this.data('group');
						
							  // Hide current label, show current label in title
							  if ( !isActive ) {
								$filterOptions.find( '.' + activeClass ).removeClass( activeClass );
							  }
						
							  $this.toggleClass( activeClass );
						
							  // Filter elements
							  $grid.shuffle( 'shuffle', group );
							  
							  return false;
							  
							  
						} ); 
					
			
					});
	
					
				} );
		
				
			} else {
				$( '[data-group="all"]' ).parent( 'li' ).hide();
			}
	
		}
		

		
		
		
		/*! 
		*************************************
		* Retina graphics for your website
		*************************************
		*/
		//Determine if you have retinal display
		var hasRetina  = false,
			rootRetina = (typeof exports === 'undefined' ? window : exports),
			mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';
	
		if ( rootRetina.devicePixelRatio > 1 || rootRetina.matchMedia && rootRetina.matchMedia( mediaQuery ).matches ) {
			hasRetina = true;
		} 

		if ( hasRetina ) {
			//do something
			$( '[data-retina]' ).each( function() {
				$( this ).attr( {
					'src'     : $( this ).data( 'retina' ),
				} );
			});
		
		} 
		
	
	} ); 

	
	
} ) ( jQuery );