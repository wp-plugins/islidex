<?php
/*
Plugin Name: iSlidex
Plugin URI: http://www.shambix.com/en/news/wordpress-plugin-islidex
Description: Cool slideshow for posts and pages, with different themes to choose from + Widget. Settings and documentation are under Plugin -> iSlidex. Official plugin page <a href="http://www.shambix.com/en/news/wordpress-plugin-islidex/">here</a>.
Version: 1.8.1
Author: Shambix
Author URI: http://www.shambix.com/
*/


if (! defined('WP_CONTENT_DIR'))
    define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

if (! defined('WP_CONTENT_URL'))
    define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');

if (! defined('WP_PLUGIN_DIR'))
    define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');

if (! defined('WP_PLUGIN_URL'))
    define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');

define ('ISLIDEX_PLUGIN_BASENAME', plugin_basename(dirname(__FILE__)));
define ('ISLIDEX_PLUGIN_PATH', WP_PLUGIN_DIR."/".ISLIDEX_PLUGIN_BASENAME);
define ('ISLIDEX_PLUGIN_URL', WP_PLUGIN_URL."/".ISLIDEX_PLUGIN_BASENAME);
define ('ISLIDEX_PLUGIN_CSS', ISLIDEX_PLUGIN_URL."/css");
define ('ISLIDEX_PLUGIN_JS', ISLIDEX_PLUGIN_URL."/js");
define ('ISLIDEX_PLUGIN_IMAGES', ISLIDEX_PLUGIN_URL."/img");

register_activation_hook( __FILE__, 'islidex_activate' );

// iSlidex options

function islidex_activate() {

	$islidex_options = array(
		"timthumb_path" => '',	
		"category_id" => '',
		"num_post" => '5',
		"slide_size_w" => '490',
		"slide_size_h" => '260',
		"widget_title" => '',
		"widget_size_w" => '230',
		"widget_size_h" => '200',
		"widget_num_post" => '3',
		"widget_cat" => '1',
		"use_widget" => 0,
		"use_caption" => 0,
		"theme" => 1

	);

	add_option("islidex_options", $islidex_options, '', 'yes');

}

// Add iSlidex Menu to WP

function islidex_add_menu() {
 if (function_exists('add_options_page')) {
    add_submenu_page('plugins.php', 'iSlidex - Cool slider for WordPress', 'iSlidex', 8, basename(__FILE__), 'islidex_options_page');
  }
}
add_action('admin_menu', 'islidex_add_menu');

function islidex_options_page() { ?>

<?php
	$islidex_options = get_option('islidex_options');
	
	if ($_POST['islidex_send']) {
			if (!empty($_POST['islidex_categoryid'])) {
			$islidex_options['timthumb_path'] = $_POST['islidex_timthumb'];
			$islidex_options['category_id'] = $_POST['islidex_categoryid'];
			$islidex_options['num_post'] = $_POST['islidex_numpost'];
			$islidex_options['slide_size_w'] = $_POST['islidex_sizew'];
			$islidex_options['slide_size_h'] = $_POST['islidex_sizeh'];
			$islidex_options['widget_title'] = $_POST['islidex_widgetitle'];
			$islidex_options['widget_cat'] = $_POST['islidex_widgetcat'];
			$islidex_options['widget_num_post'] = $_POST['islidex_widgetnumpost'];
			$islidex_options['widget_size_w'] = $_POST['islidex_widgetsizew'];
			$islidex_options['widget_size_h'] = $_POST['islidex_widgetsizeh'];
			$islidex_options['use_widget'] = $_POST['islidex_usewidget'];
			$islidex_options['use_caption'] = $_POST['islidex_usecaption'];
			$islidex_options['theme'] = $_POST['islidex_theme'];
			
			update_option('islidex_options', $islidex_options);
			echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><strong>Settings saved.</strong></p></div>';
		}		
	}


	function check_sel($number,$option) {
		$islidex_options = get_option('islidex_options');
		if ($option == 1) { $check = $islidex_options['theme']; }
		//elseif ($option == 2) { $check = $islidex_options['period']; }
		if ($number == $check) {
			echo 'selected="selected"';
		}
	}


 // The Settings Page ?>

<?php $logo_path = ISLIDEX_PLUGIN_IMAGES . '/poweredbyshambix.png'; ?>
<?php $wpcons_path = ISLIDEX_PLUGIN_IMAGES . '/wp_consultant.png'; ?>
<?php $instructions_path = ISLIDEX_PLUGIN_IMAGES . '/islidex_instructions.png'; ?>
<?php $faq_path = ISLIDEX_PLUGIN_IMAGES . '/islidex_faq.png'; ?>
<?php $support_path = ISLIDEX_PLUGIN_IMAGES . '/islidex_support.png'; ?>

<div class="wrap">
	<h2>iSlidex Settings</h2>
	<div style="background:none repeat scroll 0 0 #FFFFFF;border:3px dotted #AAAAAA;bottom:0;float:right;padding:10px;position:fixed;text-align:center;width:960px;">
	<a href="http://www.shambix.com" title="Shambix | Design&amp;Marketing Consulting" target="_blank"><img src="<?php echo $logo_path ?>" alt="Shambix | Design&amp;Marketing Consulting"></a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://codepoet.com/europe/" title="Look for Shambix @ CodePoet - Official Wordpress Consultants Listing" target="_blank"><img src="<?php echo $wpcons_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://wordpress.org/extend/plugins/islidex/installation/" title="Check the updated usage instructions here" target="_blank"><img src="<?php echo $instructions_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://wordpress.org/extend/plugins/islidex/faq/" title="Got a question? Maybe we already have an answer here!" target="_blank"><img src="<?php echo $faq_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://wordpress.org/tags/islidex?forum_id=10" title="Got any issues? Need help? Check the forums or post a new topic!" target="_blank"><img src="<?php echo $support_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>
	</div>
	<br />
	<div style="font-size:15px;">iSlidex is a Wordpress Plugin that will showcase, in a cool style, images taken from posts in a specific category.</div>
	<br />
	<div class="info" style="padding:10px;background-color:#E3F1FE;background-position:10px 10px;background-repeat:no-repeat;border-bottom:2px solid #7AA6D5;border-top:2px solid #7AA6D5;font-size:11px;width:960px;">
	<h2>What does iSlidex do exactly?</h2>
	iSlidex is NOT a gallery plugin, which means that if you want to use it as a simple gallery only for the images inside one single post/page, it will not work.
	<br />
	This kind of functionality is already done by so many other plugins that we felt like it was unnecessary to add yet another gallery plugin, however due to requests, it might be implemented in the next versions.
	<br />
	iSlidex is meant to show 1 image for each post from the category you set here. 1 slide = 1 image from 1 post. Which posts? The ones inside the category you set in this page.
	<br />
	<h2>Usage</h2>
	To customize exactly what slide/thumb to show, add inside each post and page these custom fields: <strong>islidex_slide</strong> and/or <strong>islidex_thumb</strong> as field names, and as value insert the direct link to the custom image.
	<br />
	If you don't add these fields, iSlidex will take a random image automatically from each post, so don't worry about it.
	<br /><br />
	<strong>Posts</strong>
	<br />
	<br />
	Copy and paste one of these codes inside your posts, to display the slideshow:
	<br />
	<strong>[islidex_post]</strong> (it will show on top of the post)
	<br />
	<strong>&lt;?php show_islidex(); ?&gt;</strong> or <strong>[php]show_islidex()[/php]</strong> directly in the post, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.
	<br /><br />
	<strong>Pages</strong>
	<br />
	<br />
	Copy and paste one of these codes inside your pages, to display the slideshow:
	<br />
	<strong>[islidex_page]</strong> (the slideshow will show on top of the page)
	<br />
	<strong>&lt;?php show_islidexpage(); ?&gt;</strong> or <strong>[php]show_islidexpage()[/php]</strong> directly in the page, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.
	<br /><br />
	<strong>Custom Sliders</strong>
	<br />
	This function lets you add as many sliders as you want, all with different settings, indipendent from this page and each other.
	<br />
	<strong>&lt;?php show_customislidex(93,3,450,200); ?&gt</strong>, to use directly inside the template code
	<br />
	<strong>[php]show_customislidex(92,3,450,200)[/php]</strong> to use in the content, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.
	<br />
	The numbers 93, 3, 450, 200 are only an example here, and represent in order: category (where to get the posts from), max number of posts/slides (to get from that category), width (of the slider), height (of the slider). Please replace them with the settings you prefer, each time you want to add a new slider in a different location.
	<br /><br />
	<strong>Themes</strong>
	<br />
	With version 1.8 we introduced multpiple themes for iSlidex that you can choose from:
	<br />
	- Apple Style (Credits to <a href="http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/" target="_blank">TutorialZine</a>)
	<br />
	- Nivo Slider (Credits to <a href="http://nivo.dev7studios.com/" target="_blank">Dev7Studios</a>)
	<br />
	More themes will be added in the future. Contact us if you would like us to add the theme YOU made!
	<br /><br />
	<strong>Support</strong>
	<br />
	If you have issues with iSlidex, or you can't make it work, BEFORE you report it as broken, take some time and read again the Usage and the plugin FAQ and Forum.<br />
	iSlidex works for many people, therefore if it doesn't work for YOU, it could be that your theme or other plugins are breaking iSlidex.
	You can leave a comment about the plugin, say thank you or add your piece of code on <a href="http://www.shambix.com/en/news/wordpress-plugin-islidex/" target="_blank">iSlidex official blog post</a>.
	<br />
	For any plugin requests, customizations, templates and anything to do with Wordpress, feel free to contact us at <a href="mailto:info@shambix.com">info@shambix.com</a>.
	</div>

	<form id="islidex" class="form-table" method="post" action="">
		<table class="form-table" style="width:960px;">
			<tbody>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_timthumb">The main url of your website</label>
					</th>
					<td>
						<input style="width:500px;" type="text" name="islidex_timthumb" id="islidex_timthumb" value="<?php echo $islidex_options['timthumb_path'] ?>" />
						<br />
						Simply put something like http://www.mysite.com. If your Wordpress installation is in a subfolder like http://www.mysite.com/blog it doesn't matter, you still have to put ONLY http://www.mysite.com
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="islidex_theme">iSlidex Theme</label>
					</th>
					<td>
						<select id="islidex_theme" name="islidex_theme">
							<option value="1" <?php check_sel(1,1); ?>>Apple Style</option>
							<option value="2" <?php check_sel(2,1); ?>>Nivo Slider</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="islidex_categoryid">The ID of the category you want to showcase in the slider</label>
					</th>
					<td>
						<input type="text" name="islidex_categoryid" id="islidex_categoryid" value="<?php echo $islidex_options['category_id'] ?>" />
						<br />
						To know the ID of the category, go to the Categories amin section and hover the mouse on the category. <br />You will see the ID in your browser bottom bar.
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="islidex_numpost">Number of slides to display </label>
					</th>
					<td>
						<input type="text" name="islidex_numpost" id="islidex_numpost" value="<?php echo $islidex_options['num_post'] ?>" />
						<br />
						Bear in mind that for a 490px wide slider, the optimal max number is 7.<br />
						This is because if you put too many into a small slider, the thumbnails at the bottom will not fit into the same line and will result in graphic issues.
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="islidex_sizew">The width of the slider AND of each slide</label>
					</th>
					<td>
						<input type="text" name="islidex_sizew" id="islidex_sizew" value="<?php echo $islidex_options['slide_size_w'] ?>" />
						<br />
						Default is 490px.
						<br />(only numbers do not add "px")
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_sizeh">The height of the slider AND of each slide</label>
					</th>
					<td>
						<input type="text" name="islidex_sizeh" id="islidex_sizeh" value="<?php echo $islidex_options['slide_size_h'] ?>" />
						<br />
						Default is 260px.
						<br />(only numbers do not add "px")
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_usecaption">Show caption for each slide with post title?</label>
					</th>
					<td>
						<input type="checkbox" name="islidex_usecaption" id="islidex_usecaption" value="1" <?php if ($islidex_options['use_caption'] == 1) { echo 'checked="checked"'; } ?> />
						<br />
						Default is yes.
					</td>
				</tr>
				</tbody> 
		</table>

		<input type="hidden" name="islidex_send" id="islidex_send" value="true" />
		<p class="submit"><input type="submit" value="Save Changes" /></p>

		<table class="form-table" style="width:960px;">
			<tbody>

			<tr valign="top">
					<th scope="row">
					<h3>Widget Settings</h3>
					</th>
					<td><br />Right now the only available theme for the Widget is the apple-style one.<br />In the next version we will add the Theme option for the Widget too.</td>
				</tr>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_usewidget">Do you want to use the widget?</label>
					</th>
					<td>
						<input type="checkbox" name="islidex_usewidget" id="islidex_usewidget" value="0" <?php if ($islidex_options['use_widget'] == 1) { echo 'checked="checked"'; } ?> />
						<br />
						Default is no.
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_widgetcat">The ID of the category you want to showcase in the widget slider</label>
					</th>
					<td>
						<input type="text" name="islidex_widgetcat" id="islidex_widgetcat" value="<?php echo $islidex_options['widget_cat'] ?>" />
						<br />
						To know the ID of the category, go to the Categories amin section and hover the mouse on the category. <br />You will see the ID in your browser bottom bar.
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="islidex_widgetnumpost">Number of slides to display in the widget</label>
					</th>
					<td>
						<input type="text" name="islidex_widgetnumpost" id="islidex_widgetnumpost" value="<?php echo $islidex_options['widget_num_post'] ?>" />
						<br />
						Bear in mind that for a 230px wide slider, the optimal max number is 3.<br />
						This is because if you put too many into a small slider, the thumbnails at the bottom will not fit into the same line and will result in graphic issues.
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="islidex_widgetsizew">The width of the widget AND of each slide</label>
					</th>
					<td>
						<input type="text" name="islidex_widgetsizew" id="islidex_widgetsizew" value="<?php echo $islidex_options['widget_size_w'] ?>" />
						<br />
						Default is 230px.<br />(only numbers do not add "px")
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_widgetsizeh">The height of the widget AND of each slide</label>
					</th>
					<td>
						<input type="text" name="islidex_widgetsizeh" id="islidex_widgetsizeh" value="<?php echo $islidex_options['widget_size_h'] ?>" />
						<br />
						Default is 200px.<br />(only numbers do not add "px")
					</td>
				</tr>
			</tbody> 
		</table>
		<input type="hidden" name="islidex_send" id="islidex_send" value="true" />
		<p class="submit"><input type="submit" value="Save Changes" /></p>
	</form>

</div>

<h2>Credits</h2>
	<br />
	<div class="info" style="border:1px dotted #aaa; padding:10px;width:960px;"><a href="http://www.shambix.com/en/" target="_blank">Shambix</a> team built this plugin thanks to these authors who created beautiful designs and code: 
	<a href="http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/" target="_blank">TutorialZine (Apple style slider)</a>, 
	<a href="http://www.darrenhoyt.com/2008/04/02/timthumb-php-script-released/" target="_blank">Tim McDaniels (TimThumb)</a>, 
	<a href="http://thirdroute.com/projects/captify/" target="_blank">Brian Reavis (Captify)</a>, 
	<a href="http://nivo.dev7studios.com/" target="_blank">Dev7Studios</a>.
	</div>
</div>

<?php }


// Lets wrap it up!

// The CSS - For custom CSS either upload a islidex.css to your template folder or edit the one in the plugin css folder. The template CSS would have the priority

function islidexcss() {

			$applecss_path = ISLIDEX_PLUGIN_CSS . '/islidex_apple.css';
			$nivocss_path = ISLIDEX_PLUGIN_CSS . '/islidex_nivo.css';
			$css_path =  get_template_directory_uri() . '/islidex.css';
		
		$islidex_options = get_option('islidex_options');

		if ($islidex_options['theme'] == 1) {

		echo '<link rel="stylesheet" type="text/css" href="'.$applecss_path.'" />';

		} elseif ($islidex_options['theme'] == 2) {

		echo '<link rel="stylesheet" type="text/css" href="'.$nivocss_path.'" />';
		
		}

		if ( file_exists( TEMPLATEPATH . '/islidex.css') ){
			
		echo '<link rel="stylesheet" type="text/css" href="'.$css_path.'" />';
		
		}
}

// add header hook for CSS
add_action('wp_head', 'islidexcss');


// the JS

function islidexjs() {

			$islidexjs_path = ISLIDEX_PLUGIN_JS . '/islidex.js';
			$captify_path = ISLIDEX_PLUGIN_JS . '/captify.tiny.js';
			$nivo_path = ISLIDEX_PLUGIN_JS . '/jquery.nivo.slider.js';
			$islidex_options = get_option('islidex_options');
			$numpost = $islidex_options['num_post'];

		// Get the captions ready or not

		if (($islidex_options['use_caption'] == 1) && ($islidex_options['theme'] == 1)) {

		$cap = "false";

		} elseif (($islidex_options['use_caption'] == 1) && ($islidex_options['theme'] == 2)) {

		$cap = "true"; // As the Nivo Slider style has its own captions, lets make it use them

		} else {

		$cap = "false";

		}

		// Check which js to load depending on the theme

		if ($islidex_options['theme'] == 1) {
			 
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="'.$islidexjs_path.'"></script>';

		} elseif ($islidex_options['theme'] == 2) {

		echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
		<script src="'.$nivo_path.'" type="text/javascript"></script>
		<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery("#slider").nivoSlider({
		
		caption:'.$cap.', // Added this option, as not everyone likes captions
	//	effect:"random",
		slices:'.$numpost.',
		animSpeed:350,
		pauseTime:5000,
	//	startSlide:0, //Set starting Slide (0 index)
		directionNav:true, //Next & Prev
		directionNavHide:true, //Only show on hover
	//	controlNav:true, //1,2,3...
	//	controlNavThumbs:false, //Use thumbnails for Control Nav
	//	controlNavThumbsSearch: ".jpg", //Replace this with...
	//	controlNavThumbsReplace: "_thumb.jpg", //...this in thumb Image src
	//	keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
	//	manualAdvance:false, //Force manual transitions
		captionOpacity:0.8 //Universal caption opacity
	//	beforeChange: function(){},
	//	afterChange: function(){},
	//	slideshowEnd: function(){} //Triggers after all slides have been shown
		
		});
});
</script>';


		}

		// Captify will only work the the Apple Style theme

		$islidex_options = get_option('islidex_options');

		if (($islidex_options['use_caption'] == 1) && ($islidex_options['theme'] == 1)) {

		echo '<script type="text/javascript" src="'.$captify_path.'"></script>';
		echo '<script type="text/javascript"> $(function(){ $("img.captify").captify({}); });</script>';

		}
				
}

// add header hook for JS - This was dismissed to prevent conflicts with other scripts
//add_action('wp_footer', 'islidexjs');


// Now the functions that actually retrieve the slides and thumbs

function islidex_thumb() {

$islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';

	global $post;
	$key1 = "islidex_thumb"; //in case you want your own thumb image and not taken from the post attachment
	$thumb = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($thumb == true) {
	echo '<li class="menuItem"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$thumb.'&w=32&h=32&zc=0&q=100" /></a></li>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<li class="menuItem"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$img_url.'&w=32&h=32&zc=0&q=100" /></a></li>'; 
		
		break;
	}
	
	} else {	}

} // end of islidex thumbs function


// Lets display iSlidex now! Use directly into the code
function show_islidex() {

$islidex_options = get_option("islidex_options");
$numpost = $islidex_options['num_post'];
$catid = $islidex_options['category_id'];

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<?php $islidex_options = get_option('islidex_options');
if ($islidex_options['theme'] == 1) { ?>

<div class="gallery" id="gallery" style="min-height:<?php echo $islidex_options['slide_size_h'] ?>px;min-width:<?php echo $islidex_options['slide_size_w'] ?>px;width:<?php echo $islidex_options['slide_size_w'] ?>px;">
<div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php } elseif ($islidex_options['theme'] == 2) { ?>

<div id="slider" style="min-height:<?php echo $islidex_options['slide_size_h'] ?>px;min-width:<?php echo $islidex_options['slide_size_w'] ?>px;width:<?php echo $islidex_options['slide_size_w'] ?>px;height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php } ?>

<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
$islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php'; 
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	if ($islidex_options['theme'] == 1) { 

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} elseif ($islidex_options['theme'] == 2) {

	echo '<a href="'.get_permalink($post->ID).'"><img src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>';
	
	}

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);

	if ($islidex_options['theme'] == 1) { 

	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
	
	} elseif ($islidex_options['theme'] == 2) {

	print '<a href="'.get_permalink($post->ID).'"><img src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>'; 
	
	} // nivo
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

</div>

<?php $islidex_options = get_option('islidex_options');
if ($islidex_options['theme'] == 1) { ?>

<div id="slides_menu"><ul><li class="fbar">&nbsp;</li>

<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post); ?>

<?php islidex_thumb(); ?>

<?php endforeach; ?>

</ul></div></div>

<?php } elseif ($islidex_options['theme'] == 2) {

// no thumbs for Nivo

} ?>

<?php }

// And here's the shortcode for it - USE IT ONLY IN SINGLE POSTS

add_shortcode('islidex_post', 'show_islidex');




// PAGE VERSION ONLY


function show_islidexpage() {

$islidex_options = get_option("islidex_options");
$numpost = $islidex_options['num_post'];
$catid = $islidex_options['category_id'];
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<?php $islidex_options = get_option('islidex_options');
if ($islidex_options['theme'] == 1) { ?>

<div class="gallery" id="gallery" style="min-height:<?php echo $islidex_options['slide_size_h'] ?>px;min-width:<?php echo $islidex_options['slide_size_w'] ?>px;width:<?php echo $islidex_options['slide_size_w'] ?>px;">
<div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php } elseif ($islidex_options['theme'] == 2) { ?>

<div id="slider" style="min-height:<?php echo $islidex_options['slide_size_h'] ?>px;min-width:<?php echo $islidex_options['slide_size_w'] ?>px;width:<?php echo $islidex_options['slide_size_w'] ?>px;height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php } ?>

<?php $slideposts = get_posts('showposts=1&cat='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);

	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	if ($islidex_options['theme'] == 1) { 

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} elseif ($islidex_options['theme'] == 2) {

	echo '<a href="'.get_permalink($post->ID).'"><img src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>';
	
	}

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);

	if ($islidex_options['theme'] == 1) { 

	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
	
	} elseif ($islidex_options['theme'] == 2) {

	print '<a href="'.get_permalink($post->ID).'"><img src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>'; 
	
	} // nivo
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

<?php $slideposts = get_posts('showposts='.$numpost.'&cat='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$islidex_options = get_option('islidex_options');
	$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	
	if ($slide == true) {

	if ($islidex_options['theme'] == 1) { 

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} elseif ($islidex_options['theme'] == 2) {

	echo '<a href="'.get_permalink($post->ID).'"><img src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>';
	
	}

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	
	if ($islidex_options['theme'] == 1) { 

	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
	
	} elseif ($islidex_options['theme'] == 2) {

	print '<a href="'.get_permalink($post->ID).'"><img src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>'; 
	
	} // nivo
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

</div>

<?php $islidex_options = get_option('islidex_options');
if ($islidex_options['theme'] == 1) { ?>

<div id="slides_menu"><ul><li class="fbar">&nbsp;</li>

<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post); ?>

<?php islidex_thumb(); ?>

<?php endforeach; ?>

</ul></div></div>

<?php } elseif ($islidex_options['theme'] == 2) {

// no thumbs for Nivo

} ?>

<?php }

// And here's the shortcode for it - USE IT ONLY IN PAGES

add_shortcode('islidex_page', 'show_islidexpage');


// Add iSlidex Widget

function widget_islidex_init() {
	
	if (!function_exists('register_sidebar_widget')) {
		return;
	}
	
	function widget_islidex($args) {
	    extract($args);
		$islidex_options = get_option('islidex_options');
		$widgcat = $islidex_options['widget_cat'];
		$title = $islidex_options['widget_title'];
		$widgw = $islidex_options['widget_size_w'];
		$widgh = $islidex_options['widget_size_h'];
		$widgnum = $islidex_options['widget_num_post'];
		?>
		
		<?php echo $before_widget; ?>
			<?php echo $before_title
                . $title
                . $after_title; 

?>

<div class="gallery" id="gallery" style="width:<?php echo $islidex_options['widget_size_w']; ?>px;"><div id="slides" style="height:<?php echo $islidex_options['widget_size_h']; ?>px;">

<?php $slideposts = get_posts('showposts=1&category='.$widgcat.'');
foreach($slideposts as $post) :
setup_postdata($post);

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<?php $islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';

	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['widget_size_h'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['widget_size_h'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>
    
<?php $slideposts = get_posts('showposts='.$widgnum.'&category='.$widgcat.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

</div><div id="slides_menu"><ul><li class="fbar">&nbsp;</li>

<?php $slideposts = get_posts('showposts='.$widgnum.'&category='.$widgcat.'');
foreach($slideposts as $post) :
setup_postdata($post);
?>

<?php islidex_thumb(); ?>

<?php endforeach; ?>
		
</ul></div></div>

<?php
// the actual function is done

 echo $after_widget; ?>
	<?php	} 
	register_sidebar_widget('iSlidex', 'widget_islidex');
	
	function widget_islidex_control() {
		$islidex_options = get_option('islidex_options');
		$title = $islidex_options['widget_title'];
		
		if (!empty($_POST['islidex_widgetitle'])) {
			$title = strip_tags(stripslashes($_POST['islidex_widgetitle']));
			$islidex_options['widget_title'] = $title;
			update_option('islidex_options', $islidex_options);
		}
		
		$title = htmlspecialchars($title, ENT_QUOTES);
		?>
			
			<p>
				<label for="islidex_widget_title">
					Title:
					<input type="text" id="islidex_widget_title" name="islidex_widget_title" value="<?php echo $title; ?>" />
				</label>
			</p>
			
		<?php
		
	}

	register_widget_control('iSlidex', 'widget_islidex_control',200, 50);

}

$islidex_options = get_option('islidex_options');
if ($islidex_options['use_widget'] == 1) {
add_action('widgets_init', 'widget_islidex_init');
}

//} // end of if use_widget

// Make CUSTOM islidex sliders with all different args

function show_customislidex ($customcatid,$customnumpost,$width,$height) {

?>

<div class="gallery" id="gallery" style="width:<?php echo $width ?>px;"><div id="slides" style="height:<?php echo $height ?>px;">

<?php $slideposts = get_posts('showposts=1&category='.$customcatid.'');
foreach($slideposts as $post) :
setup_postdata($post);

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<?php $islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';

global $post;

	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$slide.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
		else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  


<?php $slideposts = get_posts('showposts='.$customnumpost.'&category='.$customcatid.'');
foreach($slideposts as $post) :
setup_postdata($post);
?> 

<?php $islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';

	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$slide.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

</div><div id="slides_menu"><ul><li class="fbar">&nbsp;</li>

<?php $slideposts = get_posts('showposts='.$customnumpost.'&category='.$customcatid.'');
foreach($slideposts as $post) :
setup_postdata($post);
?> 

<?php islidex_thumb(); ?>

<?php endforeach; ?>

</ul></div></div>

<?php 



} // end of custom islidex


// NEED MORE POST/PAGE FUNCTIONS, AS IN SOME CASES THE PREVIOUS ONES WONT WORK

function show_islidexaltern() {

$islidex_options = get_option("islidex_options");
$numpost = $islidex_options['num_post'];
$catid = $islidex_options['category_id'];
$timthumb_path = $islidex_options['timthumb_path'];

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<div class="gallery" id="gallery" style="width:<?php echo $islidex_options['slide_size_w'] ?>px;"><div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">
 
<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

</div><div id="slides_menu"><ul><li class="fbar">&nbsp;</li>

<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);
?>

<?php islidex_thumb(); ?>

<?php endforeach; ?>

</ul></div></div>

<?php }

// And here's the shortcode for it - USE IT ONLY if the normal ones dont work

add_shortcode('islidex_special', 'show_islidexaltern');
add_shortcode('islidex_altern', 'show_islidexaltern');

// One for Marc and Thesis theme users

function show_islidexthesis() {

$islidex_options = get_option("islidex_options");
$numpost = $islidex_options['num_post'];
$catid = $islidex_options['category_id'];
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<div class="gallery" id="gallery" style="width:<?php echo $islidex_options['slide_size_w'] ?>px;"><div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php $slideposts = get_posts('numberposts=1&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

<?php $slideposts = get_posts('numberposts='.$numpost.'&offset=1&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

</div><div id="slides_menu"><ul><li class="fbar">&nbsp;</li>

<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);
?>

<?php islidex_thumb(); ?>

<?php endforeach; ?>

</ul></div></div>

<?php }

// And here's the shortcode for it - USE IT ONLY if the normal ones dont work

add_shortcode('islidex_thesis', 'show_islidexthesis'); ?>

<?php

// One for Alexandre from Portugal!

// NEED MORE POST/PAGE FUNCTIONS, AS IN SOME CASES THE PREVIOUS ONES WONT WORK

function show_islidexaltern2() {

$islidex_options = get_option("islidex_options");
$numpost = $islidex_options['num_post'];
$catid = $islidex_options['category_id'];
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
$timthumb_path2 = $islidex_options['timthumb_path'];

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<div class="gallery" id="gallery" style="width:<?php echo $islidex_options['slide_size_w'] ?>px;"><div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php $slideposts = get_posts('showposts=1&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  
 
<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);
	$title = __($post->post_title);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

</div><div id="slides_menu"><ul><li class="fbar">&nbsp;</li>

<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);
?>

<?php islidex_thumb(); ?>

<?php endforeach; ?>

</ul></div></div>

<?php }

// And here's the shortcode for it - USE IT ONLY if the normal ones dont work

add_shortcode('islidex_altern2', 'show_islidexaltern2');

?>