=== iSlidex ===
Contributors: Dukessa
Donate link: http://www.shambix.com/en/news/wordpress-plugin-islidex/
Tags: slideshow, slider, featured, post slideshow, post slider, carousel, showcase, islidex, captions
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: 1.9.5

== Description ==

= iSlidex is a Wordpress Plugin that will showcase, in a cool style, images taken from posts in a specific category. =

This is not a gallery plugin! If you want a gallery inside a post or page to show images take from 1 single post or page, do not use this. This plugin shows 1 image taken from each post inside a category, not all the images inside 1 post or page!

It is indeed a slideshow plugin, completely automated once you set the number of slides you would like to feature, the size and the category from where iSlidex will pull the images from.
You can decide also whether to have nice semi-transparent captions, with the title of the post for each slide.
iSlidex comes with a widget, which can be set independently from the main slider, from the same settings page, however we do recommend the use of the plugin only inside big sidebars, in order to be displayed in the best way.
Every image is resized and cached automatically, and you dont have to worry about server load or manual image editing.
Also, we optimized the code for better SEO, so that every image has its alt and titles attributes and we have added compatibility with qTranslate plugin.
Islidex also comes with different slideshow themes to choose from!

Cross-browser compliant: Internet Explorer 7, Internet Explorer 8, FireFox 3+, Safari 4+, Chrome 4+, Opera 10+.

Wordpress 3+ compatible.

For a demo of one of the sytles, [click here](http://demo.tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/demo.html).

= Problems making it work? =

If you can't make the plugin work, please read the Usage instructions and FAQ, ask in the forums so we can help you, instead of reporting it as broken. iSlidex works for many people, so if it doesn't work for you, maybe you are not doing something right!
Ask for support and we will help you.


Credits to [TutorialZine](http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/) for the Apple slider.
Credits to [Brian Reavis](http://thirdroute.com/projects/captify/) for Captify.
Credits to [Tim McDaniels](http://www.darrenhoyt.com/2008/04/02/timthumb-php-script-released/) for TimThumb.
Credits to [Dev7Studios](http://nivo.dev7studios.com/) for the Nivo slider.

== Installation ==

You can get the latest version directly [HERE](http://plugins.trac.wordpress.org/browser/islidex/trunk)

= Instructions =

1. Upload the folder `islidex` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set up the slider and widget through the iSlides settings page, that you can reach through the left 'Plugin' box

= Posts & Pages =

Copy and paste one of these codes inside your posts/pages, to display the slideshow:

* `[islidex]` (it will show on top of the post content)
* `<?php show_islidex(); ?>` inside your template, or `[php]show_islidex()[/php]` directly in the post, if you use also the plugin [PHP Shortcode](http://wordpress.org/extend/plugins/php-shortcode)

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

= Can we use the featured image as the slider? =

Yes with v.1.9.5
However you can still use `islidex_slide` and `islidex_thumb` with the full link to the image, to achieve the same purpose and to keep retrocompatibility.

= Is there a way to have more than one slideshow (eg. a different category for each slider on different pages)? =

Functionality added with version 1.2

= Why images are not showing? =

There could be 4 likely reasons: 
* The images in your post are taken from another website, and in that case the script TimThumb that resizes and caches images for iSlidex will NOT render them (resulting in a red error cross or empty space) to prevent bandwith theft
* You did not upload that image from that post, but you are relinking it from another post. iSlidex specifically retrieves images that are attached/uploaded directly to/from a post, and not linked from somewhere else
* Make sure that the `cache` folder in islidex->js plugin folders is writable, in case you are not sure set the `cache` folder to permission 777 
* Another plugin is messing with jQuery, try to deactivate your plugin one by one to see which one is causing the issue.

= The slides are all over the place! =

If you see all the images/slides across the page, it means that another plugin is interfering with iSlidex, either because of the CSS or the Javascript.
To make sure of this, please deactivate all plugins but iSlidex, flush the cache and reload the page, if you can see iSlidex now, please try to figure out which plugin is causing the issue and contact the author. We made iSlidex in a way so that it loads scripts ONLY when strictly needed, which is in the page/post it's actually used, so that it wouldn't conflict with other plugins, but of course if other authors have not the same, or if you need two plugins to co-exist in the same page and they conflict, you will need to fix the specific issue on your own.

= I can't see the thumbnails =

Check your style.css and see if maybe the general rules for `ul` and `li` are not messing up the ones for iSlidex. It shouldn't happen after v.1.6, but if it does, please report it in the appropriate forum. Always bear in mind that some themes for Wordpress might affect iSlidex look, as well as other plugins you may have installed and that's not something we can control.

= Can I change the effects of the Nivo theme? =

Yes. Save the style as Nivo, then you will see the effect options.

== Screenshots ==

1. Quick overview of the slider in Apple Style mode
2. How to add the custom fields inside posts

== Changelog ==

= 1.9.5 =
* NEW! Added "Featured Image" as slide
* NEW! Widget can follow the main slider style
* NEW! Widget and main slider can co-exist on the same page
* NEW! If post doesnt have any image at all, a Wordpress logo will be shown
* Fixed an permission issue in settings page
* Removed direction arrows in Nivo theme

= 1.9 =
* Fixed slide order misbehaviour
* Fixed whitespaces
* Added Nivo effect selection
* Fixed Apple style CSS
* Fixed Widget activation

= 1.8.1 =
* Fixed closing ?>

= 1.8 =
* Added Themes capability
* Added Nivo Slider style
* Added support for qTranslate titles
* Fixed alt and title attribute
* iSlidex is now fully compatible with IE7, IE8, FF3, Safari4, Chrome4, Opera4.

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

Shambix is a Design & Marketing Consulting firm.

We can create any kind of plugin, template and widget for Wordpress, among lots of other cool stuff.

This is a free plugin, so please be patient and kind, we will try to update it as much as we can.
If you have any special request, feel free to contact us at info@shambix.com

ENJOY! :)