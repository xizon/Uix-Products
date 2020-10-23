 ( function($) { 
    "use strict";
	
	$( function(){  

	
		/*! 
		 * ************************************************
		 * Sets default screen options for Uix Products Screen in Admin Panel
		 *************************************************
		 */
		var productsType         = 'uix-products-meta-typeshow',
			productsOpt1         = [
									'uix-products-meta-artwork-settings',
									'uix-products-meta-gallery-settings',
									'postimagediv',
									'uix_products_categorydiv'
								   ],
			productsOpt2         = [
									'uix-products-meta-themeplugin-settings',
				                    'uix-products-meta-gallery-settings',
									'postimagediv',
									'uix_products_categorydiv'
								   ];
		
		
		
		
		//Required, Used to determine the action of the plug-in itself
		//When the theme only needs "artwork" category, 
		//the HTML code in the admin panel needs to have the class name "uix-products-meta-theme-custom".
        var $type = $( '#' + productsType + '-hide' );
        setTimeout( function() {
            if ( ! $type.is( ":checked" ) ) $type.prop( 'checked', true ).triggerHandler( 'click' );
			
			//init first target
            uix_products_target( productsOpt1 );

            //Switch post type
            $( '[data-target-id="uix_products_typeshow"] > [data-value]' ).each( function()  {
                uix_products_change_settings( $( this ).data( 'value' ), $( this ).find( '[type="radio"]' ) );
            });	

        }, 100 );

		
		$( '[data-target-id="uix_products_typeshow"] > [data-value]' ).on( 'click', function() {
			uix_products_change_settings( $( this ).data( 'value' ), $( this ).find( '[type="radio"]' ) );
		});


		function uix_products_change_settings( type, radio ) {
            switch( type ) {
                case 'artwork':
                    if ( radio.is( ":checked" ) ) { uix_products_target( productsOpt1 ) };
                    break;

                case 'theme-plugin':
                    if ( radio.is( ":checked" ) ) { uix_products_target( productsOpt2 ) };
                    break;
	

            }   
		}	
		
		
		function uix_products_target( targetArr ) {
			
            //merge multiple array
			var hideArr = [];
			hideArr= hideArr
						.concat(productsOpt1)
						.concat(productsOpt2);

			
			//hide all
            hideArr.forEach( function( element ) {
                $( '#' + element + '-hide' ).prop( 'checked', false ).triggerHandler( 'click' );
            });  
            
			
            //display target
            targetArr.forEach( function( element ) {
                $( '#' + element + '-hide' ).prop( 'checked', true ).triggerHandler( 'click' );
            });	
		}
		
	
	
	});
	
 } )( jQuery );


