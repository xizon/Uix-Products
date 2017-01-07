=== Uix Products ===
Contributors: uiuxlab
Donate link: https://uiux.cc
Author URI: https://uiux.cc
Plugin URL: https://uiux.cc/wp-plugins/uix-products/
Tags: products, portfolio, work, work show, product, post type, artwork, artworks, showcase, image, images
Requires at least: 4.2
Tested up to: 4.7
Stable tag: 1.0.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Readily organize & present your artworks, themes, plugins with Uix Products template files. Convenient for theme customization. 

== Description ==

This plugin enables a products post type and taxonomies. You can add a new artwork, theme or plugin item to appear in your theme. It also registers separate products taxonomies for tags and categories. If featured images are selected, they will be displayed in the column view.

**Using this plugin require with Uix Products template files. Convenient for theme customization.**

= Features =

* 3 Product types for choice
* List of retina-ready
* Full responsive design
* Using template files to customize your theme & display all product items
* Regenerate thumbnails after changing their size.
* Adding categories support to a custom post type in WordPress
* Support gallery
* There are some simple options to the theme customizer
* Filterable to display product items to your site
* Masonry grid style support
* Support widgets to the spot you wish it to appear


= Custom Usage =

You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original .css files. Go to "Uix Products" in the WordPress Administration Screens, then link to a specific tab like "Custom CSS".

> There is a second way, make a new Cascading Style Sheet (CSS) document which name to <strong>"uix-products-custom.css"</strong> to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/css/" ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Products will use it as a default style sheet to your WordPress Theme. Of course, Uix Products's function of "Custom CSS" is still valid.

> Note: Making a new javascrpt (.js) document which name to <strong>"uix-products-custom.js"</strong> to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/js/" ). Once you have created an existing JS file, Uix Products will use it as a default script to your WordPress Theme.





== Installation ==

1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to "Appearance -> Install Plugins".
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

2. You need to create Uix Products template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Products template files path (/wp-content/plugins/uix-products/theme_templates/) and upload files to your theme templates directory (/wp-content/themes/{your-theme}/).  

	Please check if you have the 4 template files **'content-uix_products.php'**, **'page-uix_products.php'**, **'single-uix_products.php'**  and **'taxonomy-uix_products_category.php'** in your templates directory. If you can't find these files, then just copy them from the directory '/wp-content/plugins/uix-products/theme_templates/' to your templates directory.

3. Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Enter page title like "Product". Save the page and hit "Preview" to see how it looks. ( You should specify the template name, in this case I used **"Uix Products"**. The "Template Name: Uix Products" tells WordPress that this will be a custom page template. )

4. In your dashboard go to Appearance and select Menus. You’ll be able to add items to the menu. On the left you have your products pages.

5. Or use the Uix Products Widget to add it to a sidebar. Go to "Appearance -> Widgets" in the WordPress Administration Screens. Find the "Recent Products (Uix Products Widget)" in the list of Widgets and click and drag the Widget to the spot you wish it to appear.

6. Create uix products item and publish products then.

7. You can pretty much custom every aspect of the look and feel of this page by modifying the "*.php" template files (Access the path to the themes directory) . Best Practices for Editing WordPress Template Files:

  (1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to "Appearance > Editor" from your sidebar.

  (2) You can connect to your site via an FTP client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.

8. The Uix Products plugin allows users to easily enable a "Customizer Page" to themes. Go to "Uix Products -> Settings -> General Settings".

9. You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original ".css" files. Go to "Uix Products -> Settings -> Custom CSS".




== Frequently Asked Questions ==

= What's with the version numbers? =

The version number is the date of the revision of the [guidelines](https://make.wordpress.org/themes/handbook/review/) used to create it.


== Screenshots ==
1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg
4. screenshot-4.jpg
5. screenshot-5.jpg
6. screenshot-6.jpg
7. screenshot-7.jpg
8. screenshot-8.jpg


== Upgrade Notice ==


* Bug fixes and improvements.


== Changelog ==

= 1.0.7 =

* Optimized binding theme picker.


= 1.0.6 =

* Optimized gallery selector.


= 1.0.5 =

* WordPress 4.7 compatible.
* Enhanced scalability structure.
* Enhanced the user experience of templates admin panel.
* Supports custom Uix Products core stylesheet and script based on "/wp-content/themes/{your-theme}/" and "/wp-content/themes/{your-theme}/" directories  for your theme.
* Supports custom Uix Products core stylesheet and script based on "/wp-content/themes/{your-theme}/assets/css/" and "/wp-content/themes/{your-theme}/assets/js/" directories  for your theme.



= 1.0.3 =

* Optimized enqueue scripts for front-end.
* Fixed some bugs.


= 1.0.2 =

* Fixed some bugs.


= 1.0.1 =

* Optimized for tablet display.
* Improved event binding from the plugin main JavaScript file.
* Improved the main CSS file.


= 1.0.0 =

* First release.

