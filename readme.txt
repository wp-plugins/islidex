_____________________________________________
|
|iSlidex - A Wordpress Plugin
|
|Author: Jany L. Martelli @ Shambix - Design&Marketing Consulting
|Author URL: http://www.shambix.com
|Author email: info@shambix.com
|
|Plugin link:
|
|- [ITA] http://www.shambix.com/news/wordpress-plugin-islidex
|- [ENG] http://www.shambix.com/en/news/wordpress-plugin-islidex
|
|Credits to: 
|- Tutorialzine for the skin and base script
|- TimThumb for the resizing script
|
|Licensed under GPLv2
|____________________________________________


iSlidex is a Wordpress Plugin that will showcase, in an elegant and minimal way (the Apple way), images taken from posts in a specific category.
It is indeed a slideshow plugin, completely automated once you set the number of slides you would like to feature, the size and the category from where iSlidex will pull the images.

USAGE

The plugin has a simple settings page, it can be used with the shortode [islidex] directly in pages and posts, or using the php function <?php if (function_exists('show_islidex')) : show_islidex(); endif; ?>in your template code.

CUSTOMIZATION

Furthermore, if you would like to customize the look and feel of iSlidex, you can upload your own islidex.css to your own template folder and last but not least, you may also use 2 custom fields in your post, named "islidex_slide" and "islidex_thumb" to have full control over your slider.
Last but not least, iSlidex comes also with a widget, which can be set independently from the main slider, from the same settings page, however we do recommend the use of the plugin only inside big sidebars, in order to be displayed in the best way.

ABOUT SHAMBIX

Shambix can create any kind of plugin, template and widget for Wordpress, I guess that is why we are among Wordpress official Consultants for Europe :) so if you have any special request, feel free to contact us at info@shambix.com

ENJOY! :)


=== iSlidex ===
Contributors: Dukessa
Tags: slideshow, slider, featured, post slideshow, post slider, carousel
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: trunk

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

iSlidex is a Wordpress Plugin that will showcase, in an elegant and minimal way (the Apple way), images taken from posts in a specific category.
It is indeed a slideshow plugin, completely automated once you set the number of slides you would like to feature, the size and the category from where iSlidex will pull the images.
iSlidex comes also with a widget, which can be set independently from the main slider, from the same settings page, however we do recommend the use of the plugin only inside big sidebars, in order to be displayed in the best way.

For a demo, click here.

The plugin has a simple settings page, it can be used with the shortode [ islidex_page ] and [ islidex_post ] respectively in pages and posts (without spaces within the square brackets!), or using the php function if (function_exists(’show_islidex’)) : show_islidex(); endif; in your template code.
If you would like to customize the look and feel of iSlidex, you can upload your own islidex.css to your own template folder and last but not least, you may also use 2 custom fields in your post, named “islidex_slide” and “islidex_thumb” to have full control over your slider.

iSlidex uses the allmighty Timthumb script, so that every image is resized and cached automatically, and you dont have to worry about server load or manual size input every time.

Shambix can create any kind of plugin, template and widget for Wordpress, I guess that is why we are among Wordpress official Consultants for Europe :) so if you have any special request, feel free to contact us!news Wordpress Plugin: iSlidex

iSlidex is released with the GPLv2 license;, it is free of charge and downloadable from Wordpress official Plugin repository. Credits to TutorialZine for releasing the base script.



== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
