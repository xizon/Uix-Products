# Uix Products
This is a WordPress Plugin. Readily organize & present your artworks, themes, plugins with Uix Products template files. Convenient for theme customization.

Copyright (c) 2016 UIUX Lab [@uiux_lab](https://twitter.com/uiux_lab)

[Donate Me](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PYZLU7UZNQ6CE)

[Plugin for Wordpress at WordPress.org Repository](https://wordpress.org/plugins/uix-products/)

[Plugin URI](https://uiux.cc/wp-plugins/uix-products/)

### Licensing

Licensed under the [GPL3.0](http://www.gnu.org/licenses/gpl-3.0.en.html).

### Description


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




### Updates

#### = 1.1.1 =

* Optimized front-end style.
* Add dynamic form fields, meet the needs of custom fields.
* Enhanced API compatibility for themes.


#### = 1.1.0 =

* Fixed an online preview error.
* Add a responsive preview component.



#### = 1.0.7 =

* Optimized binding theme picker.


#### = 1.0.6 =

* Optimized gallery selector.


#### = 1.0.5 =

* WordPress 4.7 compatible.
* Enhanced scalability structure.
* Enhanced the user experience of templates admin panel.
* Supports custom Uix Products core stylesheet and script based on "/wp-content/themes/{your-theme}/" and "/wp-content/themes/{your-theme}/" directories  for your theme.
* Supports custom Uix Products core stylesheet and script based on "/wp-content/themes/{your-theme}/assets/css/" and "/wp-content/themes/{your-theme}/assets/js/" directories  for your theme.



#### = 1.0.3 =

* Optimized enqueue scripts for front-end.
* Fixed some bugs.


#### = 1.0.2 =

* Fixed some bugs.


#### = 1.0.1 =

* Optimized for tablet display.
* Improved event binding from the plugin main JavaScript file.
* Improved the main CSS file.


#### = 1.0.0 =

* First release.



### Tested under

- WP 4.2.*
- WP 4.3.*
- WP 4.4.1
- WP 4.4.2
- WP 4.5.*
- WP 4.6.*
- WP 4.7


###Screenshot

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-1.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-2.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-3.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-4.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-5.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-6.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-7.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/assets/screenshot-8.jpg)



###Credits

#####I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:

- [Gallery Metabox](https://github.com/uixplorer/gallery-metabox)
- [Custom Metaboxes and Fields](https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress)
- [Flexslider](https://github.com/woothemes/FlexSlider)
- [Shuffle](https://github.com/Vestride/Shuffle)
- [Switcheroo](https://github.com/OriginalEXE/Switcheroo)


###How to use?

1.After activating your theme, you can see a prompt pointed out as absolutely critical. Go to **"Appearance -> Install Plugins"**.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/plug.jpg)

2.You need to create Uix Products template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Products template files path (`/wp-content/plugins/uix-products/theme_templates/`) and upload files to your theme templates directory (`/wp-content/themes/{your-theme}/`).  


Please check if you have the **4** template files `content-uix_products.php`, `page-uix_products.php`, `single-uix_products.php` and `taxonomy-uix_products_category.php` in your templates directory. If you can't find these files, then just copy them from the directory **"/wp-content/plugins/uix-products/theme_templates/"** to your templates directory.

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/temp.jpg)


3.Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the **"Template"** for this page from the **"Attributes"** section. Enter page title like **"Product"**. Save the page and hit **"Preview"** to see how it looks. ( You should specify the template name, in this case I used `Uix Products`. The "Template Name: Uix Products" tells WordPress that this will be a custom page template. )

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/menu.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/add-page.jpg)

4.In your dashboard go to Appearance and select Menus. You’ll be able to add items to the menu. On the left you have your products pages.

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/add-menu-1.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/add-menu-2.jpg)


5.Or use the Uix Products Widget to add it to a sidebar. Go to **"Appearance -> Widgets"** in the WordPress Administration Screens. Find the **"Recent Products (Uix Products Widget)"** in the list of Widgets and click and drag the Widget to the spot you wish it to appear.

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/widget-1.jpg)

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/widget-2.jpg)



6.Create uix products item and publish products then.

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/add-item.jpg)


7.You can pretty much custom every aspect of the look and feel of this page by modifying the `*.php` template files **(Access the path to the themes directory)**. **Best Practices for Editing WordPress Template Files:**

　(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to **"Appearance > Editor"** from your sidebar.
  
  ![](https://github.com/xizon/Uix-Products/blob/master/helper/img/editor.jpg)

　(2) You can connect to your site via an **FTP** client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.



8.The Uix Products plugin allows users to easily enable a "Customizer Page" to themes. Go to **"Uix Products -> Settings -> General Settings"**.

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/customize.jpg)


9.You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original `.css` files. Go to **"Uix Products -> Settings -> Custom CSS"**.

![](https://github.com/xizon/Uix-Products/blob/master/helper/img/css.jpg)

> There is a second way, make a new Cascading Style Sheet (CSS) document which name to **uix-products-custom.css** to your **templates directory** (`/wp-content/themes/{your-theme}/` or `/wp-content/themes/{your-theme}/assets/css/`). You can connect to your site via an **FTP** client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Products will use it as a default style sheet to your WordPress Theme. Of course, Uix Products's function of "Custom CSS" is still valid.


> Note: Making a new javascrpt (.js) document which name to **uix-products-custom.js** to your templates directory (`/wp-content/themes/{your-theme}/` or `/wp-content/themes/{your-theme}/assets/js/`). Once you have created an existing JS file, Uix Products will use it as a default script to your WordPress Theme.




