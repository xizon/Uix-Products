<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'usage' ) {
?>


        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to <strong>"Appearance -> Install Plugins"</strong>.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)</h4>', 'uix-products' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/plug.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">2. You need to create Uix Products template files in your templates directory. You can create the files on the WordPress admin panel.</h4>', 'uix-products' ); ?>
     
        </p>  
        <p>
           &nbsp;&nbsp;&nbsp;&nbsp;<a class="button button-primary" href="<?php echo admin_url( "admin.php?page=".UixProducts::HELPER."&tab=temp" ); ?>"><?php _e( 'Create now!', 'uix-products' ); ?></a>
     
        </p>  
         <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;As a workaround you can use FTP, access the Uix Products template files path <code>/wp-content/plugins/uix-products/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-products' ); ?>
   
        </p>         
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;Please check if you have the 4 template files <code>"content-uix_products.php"</code>, <code>"tmpl-uix_products.php"</code>, <code>"single-uix_products.php"</code> and <code>"taxonomy-uix_products_category.php"</code> in your templates directory. If you can"t find these files, then just copy them from the directory "/wp-content/plugins/uix-products/theme_templates/" to your templates directory.', 'uix-products' ); ?>
           
          
        </p>  
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/temp.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">3. Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Enter page title like "Product". Save the page and hit "Preview" to see how it looks. ( You should specify the template name, in this case I used "Uix Products". The "Template Name: Uix Products" tells WordPress that this will be a custom page template. )</h4>', 'uix-products' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/menu.jpg" alt=""> <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/add-page.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">4. In your dashboard go to <strong>"Appearance -> Menus"</strong>. You’ll be able to add items to the menu. On the left you have your products pages.</h4>', 'uix-products' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/add-menu-1.jpg" alt=""> <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/add-menu-2.jpg" alt="">
        </p> 
        
        
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">5. Or use the Uix Products Widget to add it to a sidebar. Go to <strong>"Appearance -> Widgets"</strong> in the WordPress Administration Screens. Find the <strong>"Recent Products (Uix Products Widget)"</strong> in the list of Widgets and click and drag the Widget to the spot you wish it to appear.</h4>', 'uix-products' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/widget-1.jpg" alt=""> <br>           
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/widget-2.jpg" alt="">
        </p> 
        
        
        
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">6. Create uix products item and publish products then.</h4>', 'uix-products' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/add-item.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">7. You can pretty much custom every aspect of the look and feel of this page by modifying the <code>*.php</code> template files <strong>(Access the path to the themes directory)</strong> . Best Practices for Editing WordPress Template Files:</h4>', 'uix-products' ); ?>
        </p> 
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to <strong>"Appearance > Editor"</strong> from your sidebar.', 'uix-products' ); ?>
        </p>   
          
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/editor.jpg" alt="">
        </p> 
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(2) You can connect to your site via an <strong>FTP</strong> client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.', 'uix-products' ); ?>
        </p>  
        
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">8. The Uix Products plugin allows users to easily enable a "Customizer Page" to themes. Go to <strong>"Uix Products -> Settings -> General Settings"</strong>.</h4>', 'uix-products' ); ?>
        </p>   
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/customize.jpg" alt="">
        </p>      
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">9. You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files. Go to <strong>"Uix Products -> Settings -> Custom CSS"</strong>.</h4>', 'uix-products' ); ?>
        </p> 
        <blockquote class="uix-bg-custom-blockquote">
			<p class="uix-bg-custom-desc">
			   <?php _e( 'There is a second way, make a new Cascading Style Sheet (CSS) document which name to <strong>uix-products-custom.css</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/css/</code> ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Products will use it as a default style sheet to your WordPress Theme. Of course, Uix Products\'s function of "Custom CSS" is still valid.', 'uix-products' ); ?>

			</p>    
			<p class="uix-bg-custom-desc">
			   <?php _e( '<b>Note:<b> Making a new javascrpt (.js) document which name to <strong>uix-products-custom.js</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/js/</code> ). Once you have created an existing JS file, Uix Products will use it as a default script to your WordPress Theme.', 'uix-products' ); ?>

			</p>
        </blockquote>      
        <p>
           <img src="<?php echo UixProducts::plug_directory(); ?>helper/img/css.jpg" alt="">
        </p>   

        
        
        
<?php } ?>