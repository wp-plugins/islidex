=== iSlidex ===
Contributors: Dukessa
Tags: slideshow, slider, featured, post slideshow, post slider, carousel, islidex
Requires at least: 2.8
Tested up to: 2.9.2
Stable tag: 1.1

== Description ==

iSlidex is a Wordpress Plugin that will showcase, in an elegant and minimal way (the Apple way), images taken from posts in a specific category.
It is indeed a slideshow plugin, completely automated once you set the number of slides you would like to feature, the size and the category from where iSlidex will pull the images.
iSlidex comes also with a widget, which can be set independently from the main slider, from the same settings page, however we do recommend the use of the plugin only inside big sidebars, in order to be displayed in the best way.

For a demo, [click here](http://demo.tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/demo.html).

The plugin has a simple settings page, it can be used with the shortcodes [islidex_page] and [islidex_post] respectively in pages and posts, or using the php functions `<?php show_islidex(); ?>` and `<?php show_islidexpage(); ?>`, respectively in your template code or using the plugin [PHP Shortcode](http://wordpress.org/extend/plugins/php-shortcode).
If you would like to customize the look and feel of iSlidex, you can upload your own islidex.css to your own template folder and last but not least, you may also use 2 custom fields in your post, named `islidex_slide` and `islidex_thumb` to have full control over your slider.

iSlidex uses the allmighty Timthumb script, so that every image is resized and cached automatically, and you dont have to worry about server load or manual size input every time.

Credits to [TutorialZine](http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/) for releasing the base script.

= About =

Shambix can create any kind of plugin, template and widget for Wordpress, I guess that is why we are among Wordpress official Consultants for Europe on CodePoet :) so if you have any special request, feel free to contact us at info@shambix.com

ENJOY! :)


== Installation ==

1. Upload the folder `islidex` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. If you would like to customize the look and feel of iSlidex, you can upload your own `islidex.css` to your own template folder
4. To customize exactly what slide/thumb to show add the custom fields `islidex_slide` and `islidex_thumb` + the direct link to the images

= Posts =

Use these:

* `[islidex_post]` (it will show on top of the post content)
* `<?php show_islidex(); ?>` or `[php]show_islidex()[/php]` directly in the post, if you use also the plugin [PHP Shortcode](http://wordpress.org/extend/plugins/php-shortcode).

= Pages =

Use these:

* `[islidex_page]` (it will show on top of the page content)
* `<?php show_islidexpage(); ?>` or `[php]show_islidex()[/php]` directly in the page, if you use also the plugin [PHP Shortcode](http://wordpress.org/extend/plugins/php-shortcode).


== Frequently Asked Questions ==

Feel free to open a new thread in Wordpress Forums with tag `islidex`.
You can also leave a comment in the official plugin post on [Shambix](http://www.shambix.com/news/wordpress-plugin-islidex) site.

= Is there a way to have more than one slideshow (eg. a different category for each slider on different pages)? =

Working on it :)
will be released with the next version.

== Screenshots ==

1. screenshot-1.jpg

== Changelog ==

= 1.1 =
* Bugfix for pages shortcode

= 1.0 =
* Plugin release


== About ==

Shambix can create any kind of plugin, template and widget for Wordpress, I guess that is why we are among Wordpress official Consultants for Europe on CodePoet :) so if you have any special request, feel free to contact us at info@shambix.com

ENJOY! :)