=== iSlidex ===
Contributors: Dukessa
Donate link: http://www.shambix.com/en/news/wordpress-plugin-islidex/
Tags: slideshow, slider, featured, post slideshow, post slider, carousel, showcase, islidex, captions
Requires at least: 2.8
Tested up to: 2.9.2
Stable tag: 1.7

== Description ==

* The new v.1.8 is on its way with a new cool add-on! *
* If you can't make the plugin work, check out the Usage instructions and ask in the forums so we can help you! *

iSlidex is a Wordpress Plugin that will showcase, in an elegant and minimal way (the Apple way), images taken from posts in a specific category.
It is indeed a slideshow plugin, completely automated once you set the number of slides you would like to feature, the size and the category from where iSlidex will pull the images.
You can decide also whether to have nice semi-transparent captions on mouse over, with the title of the post for each slide.
iSlidex comes also with a widget, which can be set independently from the main slider, from the same settings page, however we do recommend the use of the plugin only inside big sidebars, in order to be displayed in the best way.

For a demo, [click here](http://demo.tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/demo.html).

iSlidex uses the allmighty Timthumb script, so that every image is resized and cached automatically, and you dont have to worry about server load or manual size input every time.

Credits to [TutorialZine](http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/) for the slider script.

Credits to [Brian Reavis](http://thirdroute.com/projects/captify/) for the captions script.

= About =

Shambix can create any kind of plugin and template for Wordpress, so if you have any special request, feel free to contact us at info@shambix.com

== Installation ==

You can get the latest version directly [HERE](http://plugins.trac.wordpress.org/browser/islidex/trunk)

= Instructions =

1. Upload the folder `islidex` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set up the slider and widget through the iSlides settings page, that you can reach through the left 'Plugin' box
4. If you would like to customize the look and feel of iSlidex, you can upload your own `islidex.css` to your own template folder
5. To customize exactly what slide/thumb to show add the custom fields `islidex_slide` and `islidex_thumb` + the direct link to the images

= Posts =

Use these:

* `[islidex_post]` (it will show on top of the post content)
* `<?php show_islidex(); ?>` or `[php]show_islidex()[/php]` directly in the post, if you use also the plugin [PHP Shortcode](http://wordpress.org/extend/plugins/php-shortcode)

= Pages =

Use these:

* `[islidex_page]` (it will show on top of the page content)
* `<?php show_islidexpage(); ?>` or `[php]show_islidexpage()[/php]` directly in the page, if you use also the plugin [PHP Shortcode](http://wordpress.org/extend/plugins/php-shortcode)

If all the above codes don't work, it could be because specific settings and templates can influence Wordpress behaviour, therefore the plugins too, so we have made 3 more options you can try:
`[islidex_altern]`, `[islidex_altern2]` and `[islidex_thesis]`
Try to use one of these and hopefully everything will work.


= Custom different slideshows =

This functionality was added in v.1.2 to let you have several slideshows, in different pages and posts, with all different values if you want (rather than having only the one you set from the admin panel).

* `<?php show_customislidex(93,3,450,200); ?>`, to use directly inside the template code
* `[php]show_customislidex(93,3,450,200);[/php]` to use in the content, if you use also the plugin [PHP Shortcode](http://wordpress.org/extend/plugins/php-shortcode)

The function parameters here are only as an example, this is what they represent in order:
* $customcatid = the category you want to showcase
* $customnumpost = the number of slides you want
* $width = of the slider, without "px"
* $height = of the slider, without "px"


== Frequently Asked Questions ==

Feel free to [open a new thread](http://wordpress.org/tags/islidex) in Wordpress Forums with tag `islidex`.
You can also leave a comment in the official plugin post on [Shambix](http://www.shambix.com/news/wordpress-plugin-islidex) site.

= Is there a way to have more than one slideshow (eg. a different category for each slider on different pages)? =

Functionality added with version 1.2

= Why images are not showing? =

There could be 3 likely reasons: 
* The images in your post are taken from another website, and in that case the script TimThumb that resizes and caches images for iSlidex will NOT render them (resulting in a red error cross or empty space) to prevent bandwith theft
* You did not upload that image from that post, but you are relinking it from another post. iSlidex specifically retrieves images that are attached/uploaded directly to/from a post, and not linked from somewhere else
* Make sure that the `cache` folder in islidex->js plugin folders is writable, in case you are not sure set the `cache` folder to permission 777 

= The slides are all over the place! =

If you see all the images/slides across the page, it means that another plugin is interfering with iSlidex. To make sure of this, please deactivate all plugins but iSlidex, flush the cache and reload the page, if you can see iSlidex now, please try to figure out which plugin is causing the issue and contact the author. We made iSlidex in a way so that it loads scripts ONLY when strictly needed, which is in the page/post it's actually used, so that it wouldn't conflict with other plugins, but of course if other authors have not the same, or if you need two plugins to co-exist in the same page and they conflict, you will need to fix the specific issue on your own.

= I can't see the thumbnails =

Check your style.css and see if maybe the general rules for `ul` and `li` are not messing up the ones for iSlidex. It shouldn't happen after v.6, but if it does, please report it in the appropriate forum.

== Screenshots ==

1. Quick overview of the slider
2. How to add the custom fields inside posts

== Changelog ==

= 1.7 =
* Added  Captify, to show a caption for every slide with post title
* Minor changes in Settings page

= 1.6 =
* Bugfix for posts
* Added [islidex_altern], [islidex_altern2] and [islidex_thesis] in case the normal shortcodes don't work
* Fixed the css as in some cases the template css would brake iSlidex

= 1.5 =
* Bugfix for more than 5 sliders in pages

= 1.4 =
* Bugfix on post slides

= 1.3 =
* Settings page fixes + more instructions
* Javascript only loads when iSlidex is actually in use (to prevent conflicts)
* Javascript now loads in the footer to speed up page load
* Quick fix for messed up alt attributes when the plugin qTranslate is active

= 1.2 =
* Settings page fixes
* Added custom different slideshows functionality

= 1.1 =
* Bugfix for pages shortcode

= 1.0 =
* Plugin release

== About ==

You can get the latest version directly [HERE](http://plugins.trac.wordpress.org/browser/islidex/trunk)

= Who are we? =

Shambix can create any kind of plugin, template and widget for Wordpress, I guess that is why we are among Wordpress official Consultants for Europe on CodePoet :) so if you have any special request, feel free to contact us at info@shambix.com

ENJOY! :)