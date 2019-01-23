 ( function($) { 
    "use strict";
	
	$( function(){  

		
		
		/*! 
		 * ************************************************
		 * Sets default screen options for Page Screen
		 *************************************************
		 */
		var $type  = $( '#uix-products-meta-typeshow-hide' ),
			$opt1  = $( '#uix-products-meta-artwork-settings-hide' ),
			$opt2  = $( '#uix-products-meta-themeplugin-settings-hide' );
		
		//Required, Used to determine the action of the plug-in itself
		//When the theme only needs "artwork" category, 
		//the HTML code in the admin panel needs to have the class name "uix-products-meta-theme-custom".
		if ( $( '.uix-products-meta-theme-custom' ).length == 0 ) {
			setTimeout( function() {
				if ( ! $type.is( ":checked" ) ) $type.prop( 'checked', true ).triggerHandler( 'click' );
				UixProducts_artwork_settings_show();
				
				//Switch post type
				$( '[data-target-id="uix_products_typeshow"] > [data-value]' ).each( function()  {
					var type   = $( this ).data( 'value' ),
						$radio = $( this ).find( '[type="radio"]' );

					if ( type == 'artwork' ) {
						if ( $radio.is( ":checked" ) ) {
							UixProducts_artwork_settings_show();
						}

					}

					if ( type == 'theme-plugin' ) {
						if ( $radio.is( ":checked" ) ) {
							UixProducts_themeplugin_settings_show();
						}	

					}	
				});	
				
			}, 100 );
			

			
		}

		
		$( '[data-target-id="uix_products_typeshow"] > [data-value]' ).on( 'click', function() {
			var type   = $( this ).data( 'value' ),
				$radio = $( this ).find( '[type="radio"]' );
			
			if ( type == 'artwork' ) {
				if ( $radio.is( ":checked" ) ) {
					UixProducts_artwork_settings_show();
				}
				
			}
			
			if ( type == 'theme-plugin' ) {
				if ( $radio.is( ":checked" ) ) {
					UixProducts_themeplugin_settings_show();
				}	
				
			}	
			

		});
		
		function UixProducts_artwork_settings_show() {
			$opt2.prop( 'checked', false ).triggerHandler( 'click' );
			$opt1.prop( 'checked', true ).triggerHandler( 'click' );
		}	
		
		function UixProducts_themeplugin_settings_show() {
			$opt1.prop( 'checked', false ).triggerHandler( 'click' );
			$opt2.prop( 'checked', true ).triggerHandler( 'click' );
		}

		
	
	
	});
	
 } )( jQuery );


