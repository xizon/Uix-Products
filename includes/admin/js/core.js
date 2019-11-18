 ( function($) { 
    "use strict";
	
	$( function(){  

		/*! 
		 * ************************************************
		 * Sets default screen options for Uix Products
		 *************************************************
		 */
		var productsType         = 'uix-products-meta-typeshow',
			productsOpt1         = ['uix-products-meta-artwork-settings'],
			productsOpt2         = ['uix-products-meta-themeplugin-settings'],
            productsOpt3         = [];
		
		//Required, Used to determine the action of the plug-in itself
		//When the theme only needs "artwork" category, 
		//the HTML code in the admin panel needs to have the class name "uix-products-meta-theme-custom".
        if ( $( '.uix-products-meta-theme-custom' ).length == 0 ) {
            setTimeout( function() {
                var $type = $( '#' + productsType + '-hide' );
                if ( ! $type.is( ":checked" ) ) $type.prop( 'checked', true ).triggerHandler( 'click' );
                uix_products_artwork_settings_show();

                //Switch post type
                $( '[data-target-id="uix_products_typeshow"] > [data-value]' ).each( function()  {
                    uix_products_change_settings( $( this ).data( 'value' ), $( this ).find( '[type="radio"]' ) );
                });	

            }, 100 );    
        }


		
		$( '[data-target-id="uix_products_typeshow"] > [data-value]' ).on( 'click', function() {
			uix_products_change_settings( $( this ).data( 'value' ), $( this ).find( '[type="radio"]' ) );
		});


		function uix_products_change_settings( type, radio ) {
            switch( type ) {
                case 'artwork':
                    if ( radio.is( ":checked" ) ) { uix_products_artwork_settings_show() };
                    break;

                case 'theme-plugin':
                    if ( radio.is( ":checked" ) ) { uix_products_themeplugin_settings_show() };
                    break;
             

            }   
		}	
		
		function uix_products_artwork_settings_show() {
            //merge multiple array
            var hideArr = productsOpt2.concat( productsOpt3 );
            hideArr.forEach( function( element ) {
                $( '#' + element + '-hide' ).prop( 'checked', false ).triggerHandler( 'click' );
            });  
            
            //display target
            productsOpt1.forEach( function( element ) {
                $( '#' + element + '-hide' ).prop( 'checked', true ).triggerHandler( 'click' );
            });
			
		}	
		
		function uix_products_themeplugin_settings_show() {
            //merge multiple array
            var hideArr = productsOpt1.concat( productsOpt3 );
            hideArr.forEach( function( element ) {
                $( '#' + element + '-hide' ).prop( 'checked', false ).triggerHandler( 'click' );
            });  
            
            //display target
            productsOpt2.forEach( function( element ) {
                $( '#' + element + '-hide' ).prop( 'checked', true ).triggerHandler( 'click' );
            });
		}
		
	
	
	});
	
 } )( jQuery );


