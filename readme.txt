=== Uix Products ===
Contributors: uiuxlab
Donate link: https://uiux.cc
Author URI: https://uiux.cc
Plugin URL: https://uiux.cc/wp-plugins/uix-products/
Tags: products, portfolio, work, work show, product, post type, artwork, artworks, showcase, image, images
Requires at least: 4.2
Tested up to: 6.1
Requires PHP: 5.6
Stable tag: 1.6.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Readily organize & present your artworks, themes, plugins with Uix Products template files. Convenient for theme customization. 

== Description ==

This plugin enables a products post type and taxonomies. You can add a new artwork, theme or plugin item to appear in your theme. It also registers separate products taxonomies for tags and categories. If featured images are selected, they will be displayed in the column view.

**Using this plugin require with Uix Products template files. Convenient for theme customization.**


https://www.youtube.com/watch?v=1tqTc6kW7_g


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

> There is a second way, make a new Cascading Style Sheet (CSS) document which name to **"uix-products-custom.css"** to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/css/" ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Products will use it as a default style sheet to your WordPress Theme. Of course, Uix Products's function of "Custom CSS" is still valid.

> Note: Making a new javascrpt (.js) document which name to **"uix-products-custom.js"** to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/js/" ). Once you have created an existing JS file, Uix Products will use it as a default script to your WordPress Theme.



= Custom Uix Products Metaboxes =

Occasionally you may wish to edit one of the meta boxes that come with Uix Products. Instead of editing the templates right in the plugin you should move them to your theme, so that your changes aren't lost when you update the Uix Products plugin. This document will show you how to safely custom meta boxes to your theme. You could Go to **"Uix Products -> Settings -> For Theme Developer"** to check out.





== Installation ==

1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to "Appearance -> Install Plugins".
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

2. You need to create Uix Products template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Products template files path (/wp-content/plugins/uix-products/theme_templates/) and upload files to your theme templates directory (/wp-content/themes/{your-theme}/).  

	Please check if you have the 4 template files **'content-uix_products.php'**, **'tmpl-uix_products.php'**, **'single-uix_products.php'**  and **'taxonomy-uix_products_category.php'** in your templates directory. If you can't find these files, then just copy them from the directory '/wp-content/plugins/uix-products/theme_templates/' to your templates directory.

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

= FAQ 1: How to customize the Uix Products templates by your theme location? =

Occasionally you may wish to edit one of the templates that come with Uix Products. Instead of editing the templates right in the plugin you should move them to your theme, so that your changes aren\'t lost when you update the Uix Products plugin. As a workaround you can use FTP, access the Uix Products template files path (/wp-content/plugins/uix-products/theme_templates/) and upload files to your theme templates directory (/wp-content/themes/{your-theme}/).  

= FAQ 2: How to customize page options and stylesheets? =

Go to **"Uix Products -> Settings -> General Settings"** or **"Uix Products -> Settings -> Custom CSS"**

= FAQ 3: Custom meta boxes of Uix Products to your theme. =

Occasionally you may wish to edit one of the meta boxes that come with Uix Products. Instead of editing the templates right in the plugin you should move them to your theme, so that your changes aren't lost when you update the Uix Products plugin. This document will show you how to safely custom meta boxes to your theme. Go to **"Uix Products -> Settings -> For Theme Developer"**.



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

= 1.6.1 (November 12, 2022) =

* Tweak: Enhance the functionality of the uix custom metabox.


= 1.6.0 (April 20, 2022) =

* New: Added Types filter to admin panel.
* Tweak: Optimized the categories filter of the admin panel.
* Tweak: Language update.
* Tweak: Compatible with version 5.9.x.


= 1.5.17 (July 5, 2021) =

* Tweak: Performance optimization of dynamic forms (use virtual tree to update dom) for Custom Meta Boxes.
* Tweak: Optimized the escape compatibility issue of the editor control for Custom Meta Boxes.



= 1.5.15 (December 8, 2020) =

* Tweak: Upgraded the uploading control.


= 1.5.12 (October 30, 2020) =

* Tweak: update demo config for options.



= 1.5.1 (October 28, 2020) =

* Tweak: Optimized the output of categories in each column in the admin panel.
* Tweak: Modified API tutorial document.



= 1.5.0 (October 26, 2020) =

* Fix: Fixed an issue where the title of the custom post type was empty and could not be published when publishing.


= 1.4.10 (October 25, 2020) =

* New: Add taxonomy filters to the products admin page.


= 1.4.9 (October 23, 2020) =

* Fix: Fixed the column problem of categories display in the admin panel.


= 1.4.8 (October 23, 2020) =

* Tweak: Refactored the trigger script for custom metabox switching.


= 1.4.7 (October 21, 2020) =

* Fix: Optimized the color transparency control, compatible with WP 5.5.0 and above.
* Tweak: Expand and optimize Uix Custom Meta Boxes.

= 1.4.5 (October 13, 2020) =

* New: Use `Muuri` plug-in to make filtering and masonry effects.
* Remove: Remove Flexslider plugin.
* Remove: Remove shuffle.js and modernizr.js.


= 1.4.4 (October 13, 2020) =

* Tweak: Optimized the language support and media insertion of the editor for Uix Custom Meta Boxes.


= 1.4.3 (September 25, 2020) =

* Tweak: Compatible with WP 5.5.*.
* Fix: Modified the style display of the module.


= 1.4.2 (April 2, 2020) =

* Fix: Fixed undefined index of post_type in version 5.4.


= 1.4.1 (January 19, 2020) =

* New: Custom column sorting and filtering for custom post type in admin panel.



= 1.4.0 (January 18, 2020) =

* New: Added Custom Meta Boxes API documentation to admin menu.


= 1.3.95 (December 19, 2019) =

* New: Added support for video formats.


= 1.3.85 (November 19, 2019) =

* New: Added zh_CN language support.
* Fix: Correct the path error of Setting after the corresponding theme.


= 1.3.7 (November 19, 2019) =

* New: Add drag sorting for Uix Custom Metaboxes' Image Gallery.



= 1.3.6 (November 18, 2019) =

* Fix: Fixed Type display of item list in admin panel.
* Tweak: Optimized category switching script.


= 1.3.4 (November 11, 2019) =

* Fix: Fixed button trigger event for uploading image control.
* Dev: New loop fields control for richer release types.
* Remove: Remove the gallery metabox and replace it with uix custom metaboxes.
* Tweak: Optimized scalability for components such as uploads.



= 1.3.3 (September 24, 2019) =

* Dev: Added filter `add_filter( 'uix_products_custom_metaboxes_vars', 'mytheme_modify_vars' );` for current Custom Metaboxes.


= 1.3.2 (September 18, 2019) =

* Tweak: Enhance the functionality of the uix custom metabox.
* Tweak: MCEEditor upgrade in form component.


= 1.3.1 (February 20, 2019) =

* New: Add live demo page to this plugin. (/live-demo)

= 1.3.0 (February 14, 2019) =

* Fix: Fixed a bug for plugin.


= 1.2.9 (November 30, 2018) =

* Fix: Fixed a bug for create_function() is deprecated in PHP 7.2.


= 1.2.8 (November 17, 2018) =

* Fix: Fixed some style compatibility issues with the Flexslider plugin.



= 1.2.7 (July 13, 2018) =

* Fix: Fixed an issue when your theme uses more meta boxes.


= 1.2.6 (July 11, 2018) =

* Fix: Fixed issue where color picker does not display.


= 1.2.5 (May 3, 2018) =

* Fix: Fixed a bug with custom styles and child themes that if site uses a child theme when you create a custom css/js file in child theme folder, the plugin tries to connect style with path located in the parent theme folder.
* Tweak: Updated some third-party plugins to the latest version.



= 1.2.4 (September 17, 2017) =

* Optimized the directory and file structure, delete the unnecessary files and codes.
* Improve the Uix Products assistant(helper) experience in admin panel.
* Resolved the possible permissions issues to create a template files.



= 1.2.3 (September 2, 2017) =

* Optimize the default paging function.
* Optimize the default front end style.
* Optimize the default page templates.



= 1.2.2 (July 11, 2017) =

* Remove the "CMB" classes and files.
* Using "Uix_Products_Uix_Custom_Metaboxes" class instead of "CMB" class. (More fast, simple and compatible).
* Remove the "CMB" classes and files.
* Rebuild part of the background file directory.


= 1.1.4 (July 9, 2017) =

* Rename the page templates so that they do not start with "page-".



= 1.1.3 (April 8, 2017) =

* Optimized core stylesheets for front-end.
* Optimized admin panel of Custom CSS.


= 1.1.2 (March 25, 2017) =

* Compatible with low version PHP (5.3+)
* Fixed some minor errors in the low version of PHP.


= 1.1.1 (March 11, 2017) =

* Optimized front-end style.
* Add dynamic form fields, meet the needs of custom fields.
* Enhanced API compatibility for themes.


= 1.1.0 (March 4, 2017) =

* Fixed an online preview error.
* Add a responsive preview component.


= 1.0.7 (March 1, 2017) =

* Optimized binding theme picker.


= 1.0.6 (January 5, 2017) =

* Optimized gallery selector.


= 1.0.5 (December 28, 2016) =

* WordPress 4.7 compatible.
* Enhanced scalability structure.
* Enhanced the user experience of templates admin panel.
* Supports custom Uix Products core stylesheet and script based on "/wp-content/themes/{your-theme}/" and "/wp-content/themes/{your-theme}/" directories  for your theme.
* Supports custom Uix Products core stylesheet and script based on "/wp-content/themes/{your-theme}/assets/css/" and "/wp-content/themes/{your-theme}/assets/js/" directories  for your theme.



= 1.0.3 (November 22, 2016) =

* Optimized enqueue scripts for front-end.
* Fixed some bugs.


= 1.0.2 (October 19, 2016) =

* Fixed some bugs.


= 1.0.1 (October 17, 2016)  =

* Optimized for tablet display.
* Improved event binding from the plugin main JavaScript file.
* Improved the main CSS file.


= 1.0.0  (September 23, 2016)  =

* First release.

