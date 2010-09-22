<?php
/*
Plugin Name: iSlidex
Plugin URI: http://www.shambix.com/en/news/wordpress-plugin-islidex
Description: Cool slideshow for posts and pages, with different themes to choose from + Widget. Settings and documentation are under Plugin -> iSlidex. Official plugin page <a href="http://www.shambix.com/en/news/wordpress-plugin-islidex/">here</a>.
Version: 1.9.1
Author: Shambix
Author URI: http://www.shambix.com/
*/
define ('ISLIDEX_PLUGIN_BASENAME', 	plugin_basename(dirname(__FILE__)));
define ('ISLIDEX_PLUGIN_PATH', 		WP_PLUGIN_DIR		."/".ISLIDEX_PLUGIN_BASENAME);
define ('ISLIDEX_PLUGIN_URL', 		WP_PLUGIN_URL		."/".ISLIDEX_PLUGIN_BASENAME);
define ('ISLIDEX_PLUGIN_CSS', 		ISLIDEX_PLUGIN_URL	."/css");
define ('ISLIDEX_PLUGIN_JS', 		ISLIDEX_PLUGIN_URL	."/js");
define ('ISLIDEX_PLUGIN_IMAGES', 	ISLIDEX_PLUGIN_URL	."/img");
define ('ISLIDEX_PLUGIN_WIDGET', 	ISLIDEX_PLUGIN_URL	."/widget");

	// iSlidex options

function islidex_activate() { 
	$islidex_options = array(
	"timthumb_path" => ''.ISLIDEX_PLUGIN_JS.'/timthumb.php',
	"category_id" => '',
	"num_post" => '5',
	"slide_size_w" => '490',
	"slide_size_h" => '260',
	"widget_title" => 'iSlidex',
	"widget_size_w" => '230',
	"widget_size_h" => '200',
	"widget_num_post" => '3',
	"widget_cat" => '1',
	"usewidget" => '1',
	"usecaption" => '1',
	"effect" => '8',
	"theme" => '1'
	);
	add_option("islidex_options", $islidex_options, '', 'yes');
}

register_activation_hook( __FILE__, 'islidex_activate' );

	// Add iSlidex Menu to WP
	
function islidex_add_menu() {
	add_options_page('iSlidex Settings', 'iSlidex', 'manage_options', 'islidex', 'islidex_options'); 
}

add_action('admin_menu', 'islidex_add_menu');
	
	// Options Page

function islidex_options() {
	$islidex_options = get_option('islidex_options');
		if (isset($_POST['islidex_send'])) {
			if (!empty($_POST['islidex_categoryid'])) {
			//$islidex_options['timthumb_path'] = $_POST['islidex_timthumb'];
			$islidex_options['category_id'] = $_POST['islidex_categoryid'];
			$islidex_options['num_post'] = $_POST['islidex_numpost'];
			$islidex_options['slide_size_w'] = $_POST['islidex_sizew'];
			$islidex_options['slide_size_h'] = $_POST['islidex_sizeh'];
			if (isset($_POST['islidex_widgetitle'])) { $islidex_options['widget_title'] = $_POST['islidex_widgetitle']; }
			$islidex_options['widget_cat'] = $_POST['islidex_widgetcat'];
			$islidex_options['widget_num_post'] = $_POST['islidex_widgetnumpost'];
			$islidex_options['widget_size_w'] = $_POST['islidex_widgetsizew'];
			$islidex_options['widget_size_h'] = $_POST['islidex_widgetsizeh'];
			$islidex_options['usewidget'] = $_POST['islidex_usewidget']; 
			$islidex_options['usecaption'] = $_POST['islidex_usecaption'];
			$islidex_options['theme'] = $_POST['islidex_theme'];
			if (isset($_POST['islidex_effect'])) { $islidex_options['effect'] = $_POST['islidex_effect']; }
			update_option('islidex_options', $islidex_options);
			echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><strong>Settings saved.</strong></p></div>';
			} elseif (empty($_POST['islidex_categoryid'])) {
			echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><strong>Settings NOT saved. You forgot to type in the ID (a number) of the category with the posts you want to pull the images from.</strong></p></div>';
			}
	}
		function check_sel($number,$option) {
			$islidex_options = get_option('islidex_options');
			if ($option == 1) { $check = $islidex_options['theme']; }
			elseif ($option == 2) { $check = $islidex_options['effect']; }
			elseif ($option == 3) { $check = $islidex_options['usecaption']; }
			elseif ($option == 4) { $check = $islidex_options['usewidget']; }
			if ($number == $check) {
				echo 'selected="selected"';
			}
		}
		
		$logo_path 			= ISLIDEX_PLUGIN_IMAGES . '/poweredbyshambix.png';
		$wpcons_path 		= ISLIDEX_PLUGIN_IMAGES . '/wp_consultant.png';
		$instructions_path 	= ISLIDEX_PLUGIN_IMAGES . '/islidex_instructions.png';
		$faq_path 			= ISLIDEX_PLUGIN_IMAGES . '/islidex_faq.png';
		$support_path 		= ISLIDEX_PLUGIN_IMAGES . '/islidex_support.png'; 
		?>
		
<div class="wrap">
<h2>iSlidex Settings</h2>
	<div style="background:none repeat scroll 0 0 #FFFFFF;border:3px dotted #AAAAAA;bottom:0;float:right;padding:10px;position:fixed;text-align:center;width:960px;">
	<a href="http://www.shambix.com" title="Shambix | Design&amp;Marketing Consulting" target="_blank"><img src="<?php echo $logo_path ?>" alt="Shambix | Design&amp;Marketing Consulting"></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://codepoet.com/europe/" title="Look for Shambix @ CodePoet - Official Wordpress Consultants Listing" target="_blank"><img src="<?php echo $wpcons_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://wordpress.org/extend/plugins/islidex/installation/" title="Check the updated usage instructions here" target="_blank"><img src="<?php echo $instructions_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://wordpress.org/extend/plugins/islidex/faq/" title="Got a question? Maybe we already have an answer here!" target="_blank"><img src="<?php echo $faq_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://wordpress.org/tags/islidex?forum_id=10" title="Got any issues? Need help? Check the forums or post a new topic!" target="_blank"><img src="<?php echo $support_path ?>" alt="Look for Shambix | Design&amp;Marketing Consulting"></a>
	</div>
	<br />
	<div style="font-size:15px;">iSlidex is a Wordpress Plugin that will showcase, with cool styles, images taken from posts in a specific category.
	</div>
	<br />
	<div class="info" style="padding:10px;background-color:#E3F1FE;background-position:10px 10px;background-repeat:no-repeat;border-bottom:2px solid #7AA6D5;border-top:2px solid #7AA6D5;font-size:11px;width:960px;">
	<h2>Usage</h2>
	<p>To customize exactly what slide/thumb to show, add inside each post and page these custom fields: <code>islidex_slide</code> and/or <code>islidex_thumb</code> as field names, and as value insert the direct link to the custom image.
	<br />
	If you don't add these fields, iSlidex will take a random image automatically from each post, so don't worry about it.</p>
	<h3>Posts &amp; Pages</h3>
	<p>Copy and paste one of these codes inside your posts or pages, to display the slideshow:
	<br />
	<code>[islidex]</code> (it will show on top of the post)<br />
	<code>&lt;?php show_islidex(); ?&gt;</code> inside the template or <code>[php]show_islidex()[/php]</code> directly in the post, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.</p>
	<h3>Custom iSlidex</h3>
	<p>This function lets you add as many sliders as you want, all with different settings, indipendent from this page and each other.
	<br />
	<code>&lt;?php show_customislidex(93,3,450,200); ?&gt;</code>, to use directly inside the template code
	<br />
	<code>[php]show_customislidex(92,3,450,200)[/php]</code> to use in the content, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.
	<br />
	The numbers 93, 3, 450, 200 are only an example here, and represent in order: category (where to get the posts from), max number of posts/slides (to get from that category), width (of the slider), height (of the slider). Please replace them with the settings you prefer, each time you want to add a new slider in a different location.<p>
	<h3>Themes</h3>
	- Apple Style (Credits to <a href="http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/" target="_blank">TutorialZine</a>)
	<br />
	- Nivo Slider (Credits to <a href="http://nivo.dev7studios.com/" target="_blank">Dev7Studios</a>)
	<!-- <br />
	- Horizontal Accordion (Credits to <a href="http://www.portalzine.de/index?/Horizontal_Accordion" target="_blank">PortalZine.de</a>) -->
	<br />More themes will be added in the next versions. Contact us at info@shambix.com if you would like us to add YOUR theme!</p>
	<br />
	<h3>Support</h3>
	<p>If you have issues with iSlidex, or you can't make it work, BEFORE you report it as broken, take some time and read again the Usage and the plugin FAQ and Forum.
	<br />You can leave a comment about the plugin, ask questions, say thank you or add your piece of code at <a href="http://www.shambix.com/en/news/wordpress-plugin-islidex/" target="_blank">iSlidex official blog post</a>.
	<br />For any plugin requests, customizations, templates and anything to do with Wordpress, feel free to contact us at <a href="mailto:info@shambix.com">info@shambix.com</a>.</p>
	</div>

	<form id="islidex" class="form-table" method="post" action="">
	<table class="form-table" style="width:960px;">
	<tbody>
	<!-- <tr valign="top">
		<th scope="row">
		<label for="islidex_timthumb">The main url of your website</label>
		</th>
		<td>
		<input style="width:500px;" type="text" name="islidex_timthumb" id="islidex_timthumb" value="<?php //echo $islidex_options['timthumb_path'] ?>" /><br />Simply put something like http://www.mysite.com. If your Wordpress installation is in a subfolder like http://www.mysite.com/blog it doesn't matter, you still have to put ONLY http://www.mysite.com
		</td>
	</tr> -->
	<tr valign="top">
		<th scope="row"><label for="islidex_theme">iSlidex Theme</label></th>
		<td><select id="islidex_theme" name="islidex_theme">
		<option value="1" <?php check_sel(1,1); ?>>Apple Style</option>
		<option value="2" <?php check_sel(2,1); ?>>Nivo Slider</option>
		<!-- <option value="3" <?php check_sel(3,1); ?>>xxx</option> -->
		</select></td>
	</tr>
<?php if ($islidex_options['theme'] == 2) { ?>
	<tr valign="top">
		<th scope="row"><label for="islidex_effect">Effect of the Nivo Style</label></th>
		<td><select id="islidex_effect" name="islidex_effect">
		<option value="1" <?php check_sel(1,2); ?>>sliceDown</option>
		<option value="2" <?php check_sel(2,2); ?>>sliceDownLeft</option>
		<option value="3" <?php check_sel(3,2); ?>>sliceUp</option>
		<option value="4" <?php check_sel(4,2); ?>>sliceUpLeft</option>
		<option value="5" <?php check_sel(5,2); ?>>sliceUpDown</option>
		<option value="6" <?php check_sel(6,2); ?>>sliceUpDownLeft</option>
		<option value="7" <?php check_sel(7,2); ?>>fold</option>
		<option value="8" <?php check_sel(8,2); ?>>fade</option>
		<option value="9" <?php check_sel(9,2); ?>>random</option>
		</select></td>
	</tr>
<?php } ?>
	<tr valign="top">
		<th scope="row">
		<label for="islidex_categoryid">The ID of the category you want to showcase in the slider</label></th>
		<td><input type="text" name="islidex_categoryid" id="islidex_categoryid" value="<?php echo $islidex_options['category_id'] ?>" /><br />To know the ID of the category, go to the Categories amin section and hover the mouse on the category. <br />You will see the ID in your browser bottom bar.</td>
	</tr>
	<tr valign="top">
		<th scope="row">
		<label for="islidex_numpost">Number of slides to display </label></th>
		<td><input type="text" name="islidex_numpost" id="islidex_numpost" value="<?php echo $islidex_options['num_post'] ?>" /><br />Bear in mind that for a 490px wide slider, the optimal max number is 7.<br />This is because if you put too many into a small slider, the thumbnails at the bottom will not fit into the same line and will result in graphic issues.</td>
	</tr>
	<tr valign="top">
		<th scope="row">
		<label for="islidex_sizew">The width of the slider AND of each slide</label></th>
		<td><input type="text" name="islidex_sizew" id="islidex_sizew" value="<?php echo $islidex_options['slide_size_w'] ?>" /><br />Default is 490px.<br />(only numbers do not add "px")</td>
	</tr>
	<tr valign="top">
		<th scope="row">
		<label for="islidex_sizeh">The height of the slider AND of each slide</label></th>
		<td><input type="text" name="islidex_sizeh" id="islidex_sizeh" value="<?php echo $islidex_options['slide_size_h'] ?>" /><br />Default is 260px.<br />(only numbers do not add "px")</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="islidex_usecaption">Show caption for each slide with post title?</label></th>
		<td><select id="islidex_usecaption" name="islidex_usecaption">
		<option value="1" <?php check_sel(1,3); ?>>No</option>
		<option value="2" <?php check_sel(2,3); ?>>Yes</option>
		</select>
		<br />Default is no.</td>
	</tr>
</tbody>
</table>

	<input type="hidden" name="islidex_send" id="islidex_send" value="true" />
	<p class="submit"><input type="submit" value="Save Changes" /></p>

	<table class="form-table" style="width:960px;">
	<tbody>
	<tr valign="top">
		<th scope="row"><h3>Widget Settings</h3></th>
		<td><br />Right now the only available theme for the Widget is the apple-style one.<br />In the next versions we will add the Theme option for the Widget too.</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="islidex_usewidget">Do you want to use the widget?</label></th>
		<td><select id="islidex_usewidget" name="islidex_usewidget">
		<option value="1" <?php check_sel(1,4); ?>>No</option>
		<option value="2" <?php check_sel(2,4); ?>>Yes</option>
		</select>
		<br />Default is no.</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="islidex_widgetcat">The ID of the category you want to showcase in the widget slider</label></th>
		<td><input type="text" name="islidex_widgetcat" id="islidex_widgetcat" value="<?php echo $islidex_options['widget_cat'] ?>" /><br />To know the ID of the category, go to the Categories amin section and hover the mouse on the category. <br />You will see the ID in your browser bottom bar.</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="islidex_widgetnumpost">Number of slides to display in the widget</label></th>
		<td><input type="text" name="islidex_widgetnumpost" id="islidex_widgetnumpost" value="<?php echo $islidex_options['widget_num_post'] ?>" /><br />Bear in mind that for a 230px wide slider, the optimal max number is 3.<br />This is because if you put too many into a small slider, the thumbnails at the bottom will not fit into the same line and will result in graphic issues.</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="islidex_widgetsizew">The width of the widget AND of each slide</label></th>
		<td><input type="text" name="islidex_widgetsizew" id="islidex_widgetsizew" value="<?php echo $islidex_options['widget_size_w'] ?>" /><br />Default is 230px.<br />(only numbers do not add "px")</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="islidex_widgetsizeh">The height of the widget AND of each slide</label></th>
		<td><input type="text" name="islidex_widgetsizeh" id="islidex_widgetsizeh" value="<?php echo $islidex_options['widget_size_h'] ?>" /><br />Default is 200px.<br />(only numbers do not add "px")</td>
	</tr>
	</tbody>
	</table>
	
	<input type="hidden" name="islidex_send" id="islidex_send" value="true" />
	<p class="submit"><input type="submit" value="Save Changes" /></p>
				
	</form>

</div>

	<h2>Credits</h2><br />
	<div class="info" style="border:1px dotted #aaa; padding:10px;width:960px;">
	<a href="http://www.shambix.com/en/" target="_blank">Shambix</a> team built this plugin thanks to these authors who created beautiful designs and code:
	<a href="http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/" target="_blank">TutorialZine (Apple style slider)</a>,
	<a href="http://www.darrenhoyt.com/2008/04/02/timthumb-php-script-released/" target="_blank">Tim McDaniels (TimThumb)</a>,
	<a href="http://thirdroute.com/projects/captify/" target="_blank">Brian Reavis (Captify)</a>,
	<a href="http://nivo.dev7studios.com/" target="_blank">Dev7Studios</a>, <a href="http://www.portalzine.de/" target="_blank">PortalZine.de</a>.
	</div>
<?php }
		
		// iSlidex CSS 
		// For custom CSS either upload a islidex.css to your template folder or edit the one in the plugin css folder.
		// The template CSS would have the priority

function islidexcss() {
		$applecss_path = ISLIDEX_PLUGIN_CSS . '/islidex_apple.css';
		$nivocss_path = ISLIDEX_PLUGIN_CSS . '/islidex_nivo.css';
		$css_path =  get_template_directory_uri() . '/islidex.css';
		$islidex_options = get_option('islidex_options');
		if ($islidex_options['theme'] == 1) {
			echo '<!-- iSlidex CSS Dependencies -->
			<link rel="stylesheet" type="text/css" href="'.$applecss_path.'" />';
		} elseif ($islidex_options['theme'] == 2) {
			echo '<!-- iSlidex CSS Dependencies -->
			<link rel="stylesheet" type="text/css" href="'.$nivocss_path.'" />';
		} elseif ($islidex_options['theme'] == 3) {
			echo '<!-- iSlidex CSS Dependencies -->
			<link rel="stylesheet" type="text/css" href="'.$hozaccss_path.'" />';
		}
		if ( file_exists( TEMPLATEPATH . '/islidex.css') ){
			echo '<!-- iSlidex CSS Dependencies -->
			<link rel="stylesheet" type="text/css" href="'.$css_path.'" />';
		}
	}
	/* add header hook for CSS */
	add_action('wp_head', 'islidexcss');
	/* the JS */
	function islidexjs() {
		$islidexjs_path = ISLIDEX_PLUGIN_JS . '/islidex.js';
		$applewjs_path = ISLIDEX_PLUGIN_WIDGET . '/apple_w.js';
		$captify_path = ISLIDEX_PLUGIN_JS . '/captify.tiny.js';
		$nivo_path = ISLIDEX_PLUGIN_JS . '/jquery.nivo.slider.js';
		$nivowjs_path = ISLIDEX_PLUGIN_WIDGET . '/nivo_w.js';
		$hozac_path = ISLIDEX_PLUGIN_JS . '/jquery.hrzAccordion.js';
		$hozac_easing_path = ISLIDEX_PLUGIN_JS . '/jquery.easing.1.3';
		$islidex_options = get_option('islidex_options');
		$numpost = $islidex_options['num_post'];
		$slider_width = $islidex_options['slide_size_w'];
		// Get the captions ready or not
		if (($islidex_options['usecaption'] == 2) && ($islidex_options['theme'] == 1)) {
			$cap = "false";
		} elseif (($islidex_options['usecaption'] == 2) && ($islidex_options['theme'] == 2)) {
			$cap = "true"; // As the Nivo Slider style has its own captions, lets make it use them
		} else {
			$cap = "false";
		}
		// Nivo Effects?
		if (($islidex_options['effect'] == 1)) {
		$effect = "sliceDown";
		} elseif (($islidex_options['effect'] == 2)) {
		$effect = "sliceDownLeft";
		} elseif (($islidex_options['effect'] == 3)) {
		$effect = "sliceUp";
		} elseif (($islidex_options['effect'] == 4)) {
		$effect = "sliceUpLeft";
		} elseif (($islidex_options['effect'] == 5)) {
		$effect = "sliceUpDown";
		} elseif (($islidex_options['effect'] == 6)) {
		$effect = "sliceUpDownLeft";
		} elseif (($islidex_options['effect'] == 7)) {
		$effect = "fold";
		} elseif (($islidex_options['effect'] == 8)) {
		$effect = "fade";
		} elseif (($islidex_options['effect'] == 9)) {
		$effect = "random";
		} 
		
		// Check which js to load depending on the theme
		
		if ($islidex_options['theme'] == 1 ) { // the Apple theme
			echo '<!-- iSlidex JS Dependencies -->
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
			<script type="text/javascript" src="'.$islidexjs_path.'"></script>';
		
		} elseif ($islidex_options['theme'] == 2) { // the Nivo theme
			echo '<!-- iSlidex JS Dependencies -->
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
			<script src="'.$nivo_path.'" type="text/javascript"></script>
			<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery("#slider").nivoSlider({
				caption:'.$cap.', // Added this option, as not everyone likes captions
				effect: "'.$effect.'",
				slices:'.$numpost.',
				animSpeed:350,
				pauseTime:5000,
			//	startSlide:0, //Set starting Slide (0 index)
				directionNav:false, //Next & Prev
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

		// Captify
		$islidex_options = get_option('islidex_options');
		if (($islidex_options['usecaption'] == 2)) {
			echo '<script type="text/javascript" src="'.$captify_path.'"></script>';
			echo '<script type="text/javascript"> $(function(){ $("img.captify").captify({}); });</script>';
		}

		// Widget
		if (($islidex_options['usewidget'] == 2) && ($islidex_options['theme'] == 1)) {
		echo '<!-- iSlidex Widget JS Dependencies --><br />
		<script type="text/javascript" src="'.$applewjs_path.'"></script>';
		} elseif (($islidex_options['usewidget'] == 2) && ($islidex_options['theme'] == 2)) {
		echo '<!-- iSlidex Widget JS Dependencies --><br />
		<script type="text/javascript" src="'.$nivowjs_path.'"></script>
		<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery("#sliderw").nivoSliderw({
				caption:'.$cap.', // Added this option, as not everyone likes captions
				effect: "'.$effect.'",
				slices:'.$numpost.',
				animSpeed:350,
				pauseTime:5000,
			//	startSlide:0, //Set starting Slide (0 index)
				directionNav:false, //Next & Prev
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
	}
	
	// THUMBS ISLIDEX
	
function islidex_thumb() {

	$islidex_options = get_option("islidex_options");
	$numpost = $islidex_options['num_post'];
	$catid = $islidex_options['category_id'];
	$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
	$slideposts = get_posts('numberposts='.$numpost.'&cat='.$catid.'');
	foreach($slideposts as $islidex_thumbs) {
		$key1 = "islidex_thumb"; 
		$thumb = get_post_meta($islidex_thumbs->ID, $key1, true);
		$title = __($islidex_thumbs->post_title);
		$attachments = get_children( array('post_parent' => $islidex_thumbs->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
		if (function_exists('has_post_thumbnail') && has_post_thumbnail($islidex_thumbs->ID)) {
			$image_id = get_post_thumbnail_id($islidex_thumbs->ID);
			$feat = wp_get_attachment_image_src($image_id,'large', true);
			echo '<li class="menuItem"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$feat[0].'&w=32&h=32&zc=0&q=100" /></a></li>'; // the featured image
		} elseif ($thumb == true) { //in case you want your own thumb image (indipendent from the featured image or post image)
			echo '<li class="menuItem"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$thumb.'&w=32&h=32&zc=0&q=100" /></a></li>';
		} elseif ($attachments == true) { //if you simply want islidex to get a random image you uploaded in the post
			foreach($attachments as $id => $attachment) {
				$img = wp_get_attachment_image_src($id, 'full');
				$img_url = parse_url($img[0], PHP_URL_PATH);
				print '<li class="menuItem"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$img_url.'&w=32&h=32&zc=0&q=100" /></a></li>';
			}
		} else {
		print '<li class="menuItem"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.ISLIDEX_PLUGIN_IMAGES.'/wp_small.png&w=32&h=32&zc=0&q=100" /></a></li>';
		}
	} wp_reset_query();
} /* end of islidex thumbs function */

	 // ISLIDEX

function show_islidex() {

	$islidex_options = get_option("islidex_options");
	$numpost = $islidex_options['num_post'];
	$catid = $islidex_options['category_id'];
	$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
	add_action('wp_footer', 'islidexjs');
	//global $wp_query;
	//$theID = $wp_query->post->ID;

	if ($islidex_options['theme'] == 1) {  // THEME 1 - APPLE ?>
	<div class="gallery" id="gallery" style="min-height:<?php echo $islidex_options['slide_size_h'] ?>px;min-width:<?php echo $islidex_options['slide_size_w'] ?>px;width:<?php echo $islidex_options['slide_size_w'] ?>px;">
	<div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">
	
	<?php
	$slideposts = get_posts('numberposts='.$numpost.'&cat='.$catid.'');
	foreach($slideposts as $islidex_post) {
		$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
		$slide = get_post_meta($islidex_post->ID, $key1, true);
		$title = __($islidex_post->post_title);
		$attachments = get_children( array('post_parent' => $islidex_post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
		if (function_exists('has_post_thumbnail') && has_post_thumbnail($islidex_post->ID)) {
			$image_id = get_post_thumbnail_id($islidex_post->ID);
			$feat = wp_get_attachment_image_src($image_id,'large', true);
			echo '<div class="slide"><a href="'.get_permalink($islidex_post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$feat[0].'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>'; // the featured image
		} elseif ($slide == true) {
			echo '<div class="slide"><a href="'.get_permalink($islidex_post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';
		} else if ($attachments == true) {
			foreach($attachments as $id => $attachment) {
			$img = wp_get_attachment_image_src($id, 'full');
			$img_url = parse_url($img[0], PHP_URL_PATH);
			print '<div class="slide"><a href="'.get_permalink($islidex_post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';
			}
		} else {
		print '<div class="slide" style="height: '.$islidex_options['slide_size_h'].'px; width: '.$islidex_options['slide_size_w'].'px;"><a href="'.get_permalink($islidex_post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.ISLIDEX_PLUGIN_IMAGES.'/wp_big.png&w=250&h=250&zc=0&q=100" alt="'.$title.'" title="'.$title.'" class="captify" style="padding-top:15%;" /></a></div>';
		}
	} 
	wp_reset_query(); ?>
	</div>
	<div id="slides_menu">
	<ul>
	<li class="fbar">&nbsp;</li>
	<?php islidex_thumb(); ?>
	</ul>
	</div>
</div>

	<?php // THEME 2 - NIVO

	} elseif ($islidex_options['theme'] == 2) { ?>
	<div id="slider" style="min-height:<?php echo $islidex_options['slide_size_h'] ?>px;min-width:<?php echo $islidex_options['slide_size_w'] ?>px;width:<?php echo $islidex_options['slide_size_w'] ?>px;height:<?php echo $islidex_options['slide_size_h'] ?>px;">
	
	<?php
	$slideposts = get_posts('numberposts='.$numpost.'&cat='.$catid.'');
	foreach($slideposts as $islidex_post) {
		$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
		$slide = get_post_meta($islidex_post->ID, $key1, true);
		$title = __($islidex_post->post_title);
		$attachments = get_children( array('post_parent' => $islidex_post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
		if (function_exists('has_post_thumbnail') && has_post_thumbnail($islidex_post->ID)) {
			$image_id = get_post_thumbnail_id($islidex_post->ID);
			$feat = wp_get_attachment_image_src($image_id,'large', true);
			echo '<a href="'.get_permalink($islidex_post->ID).'"><img src="'.$timthumb_path.'?src='.$feat[0].'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" /></a>'; // the featured image
		} elseif ($slide == true) {
			echo '<a href="'.get_permalink($islidex_post->ID).'"><img src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" /></a>';
		} else if ($attachments == true) {
			foreach($attachments as $id => $attachment) {
			$img = wp_get_attachment_image_src($id, 'full');
			$img_url = parse_url($img[0], PHP_URL_PATH);
			print '<a href="'.get_permalink($islidex_post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>';
			}
		} else {
		print '<<a href="'.get_permalink($islidex_post->ID).'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.ISLIDEX_PLUGIN_IMAGES.'/wp_big.png&w=250&h=250&zc=0&q=100" alt="'.$title.'" title="'.$title.'" class="captify" style="padding-top:15%;" /></a>';
		}
	} 
	wp_reset_query(); ?>
	</div>
	
	<?php // THEME 3 - SURPRISE :D soon in v.2
	} elseif ($islidex_options['theme'] == 3) { ?>

<?php }
wp_reset_query();

} // end of function

		// Shortcode

add_shortcode('islidex', 'show_islidex'); 

		// CUSTOM ISLIDEX *only for apple style - for now*
		
function show_customislidex ($customcatid,$customnumpost,$width,$height) {
	
	$islidex_options = get_option("islidex_options");
	$numpost = $islidex_options['num_post'];
	$catid = $islidex_options['category_id'];
	$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
	add_action('wp_footer', 'islidexjs'); ?>
	
	<div class="gallery" id="gallery" style="width:<?php echo $width ?>px;">
		<div id="slides" style="height:<?php echo $height ?>px;">
		
		<?php 
		$slideposts = get_posts('numberposts='.$customnumpost.'&cat='.$customcatid.'');
		foreach($slideposts as $islidex_custom) {
	//	setup_postdata($post);
	//	global $post;
			$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
			$slide = get_post_meta($islidex_custom->ID, $key1, true);
			$title = __($islidex_custom->post_title);
			$attachments = get_children( array('post_parent' => $islidex_custom->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
			if ($slide == true) {
			echo '<div class="slide"><a href="'.get_permalink($islidex_custom->ID).'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$slide.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';
			} else if ($attachments == true) {
				foreach($attachments as $id => $attachment) {
				$img = wp_get_attachment_image_src($id, 'full');
				$img_url = parse_url($img[0], PHP_URL_PATH);
				print '<div class="slide"><a href="'.get_permalink($islidex_custom->ID).'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';
				} 
			} else {
			print '<li class="menuItem"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.ISLIDEX_PLUGIN_IMAGES.'/wp_big.png&w=250&h=250&zc=0&q=100" /></a></li>';
			}   
		}
wp_reset_query(); ?>
	</div>
	<div id="slides_menu">
	<ul>
	<li class="fbar">&nbsp;</li>
	<?php islidex_thumb(); ?>
	</ul>
	</div>
</div>

<?php } /* end of custom islidex */ 

	// Shortcode

add_shortcode('islidex_custom', 'show_customislidex'); 

 // WIDGET ISLIDEX

function islidex_thumb_widget() {

	$islidex_options = get_option("islidex_options");
	$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
	$widgcat = $islidex_options['widget_cat'];
	$widgnum = $islidex_options['widget_num_post'];
	
	$slideposts = get_posts('numberposts='.$widgnum.'&cat='.$widgcat.'');
	foreach($slideposts as $islidex_widget_thumb) {
	//	setup_postdata($post);
	//	global $post;
		$key1 = "islidex_thumb"; //in case you want your own thumb image and not taken from the post attachment
		$thumb = get_post_meta($islidex_widget_thumb->ID, $key1, true);
		$title = __($islidex_widget_thumb->post_title);
		$attachments = get_children( array('post_parent' => $islidex_widget_thumb->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
		if (function_exists('has_post_thumbnail') && has_post_thumbnail($islidex_widget_thumb->ID)) {
			$image_id = get_post_thumbnail_id($islidex_widget_thumb->ID);
			$feat = wp_get_attachment_image_src($image_id,'large', true);
			echo '<li class="menuItemw"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$feat[0].'&w=32&h=32&zc=0&q=100" /></a></li>'; // the featured image
		} elseif ($thumb == true) {
			echo '<li class="menuItemw"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$thumb.'&w=32&h=32&zc=0&q=100" /></a></li>';
		} else if ($attachments == true) {
			foreach($attachments as $id => $attachment) {
				$img = wp_get_attachment_image_src($id, 'full');
				$img_url = parse_url($img[0], PHP_URL_PATH);
				print '<li class="menuItemw"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$img_url.'&w=32&h=32&zc=0&q=100" /></a></li>';
			}
		} else {
		  print '<li class="menuItemw"><a href=""><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.ISLIDEX_PLUGIN_IMAGES.'/wp_small.png&w=32&h=32&zc=0&q=100" /></a></li>';
		} 
	}
wp_reset_query();
} /* end of islidex thumbs widget function */

function widget_islidex_init() {

	function widget_islidex($args) {
		extract($args);
		$islidex_options = get_option("islidex_options");
		$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
		$widgcat = $islidex_options['widget_cat'];
		$widgtitle = $islidex_options['widget_title'];
		$widgw = $islidex_options['widget_size_w'];
		$widgh = $islidex_options['widget_size_h'];
		$widgnum = $islidex_options['widget_num_post'];
		add_action('wp_footer', 'islidexjs');
		echo $before_widget; 
		echo $before_title . $widgtitle . $after_title;
		
		if ($islidex_options['theme'] == 1) { // APPLE WIDGET THEME ?>
		
		<div class="gallery" id="gallery" style="width:<?php echo $islidex_options['widget_size_w']; ?>px;">
			<div id="slidesw" style="height:<?php echo $islidex_options['widget_size_h']; ?>px;">
			
		<?php
		$slideposts = get_posts('numberposts='.$widgnum.'&cat='.$widgcat.'');
		foreach($slideposts as $islidex_widget) {
			$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
			$slide = get_post_meta($islidex_widget->ID, $key1, true);
			$title = __($islidex_widget->post_title);
			$attachments = get_children( array('post_parent' => $islidex_widget->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
			if (function_exists('has_post_thumbnail') && has_post_thumbnail($islidex_widget->ID)) {
			$image_id = get_post_thumbnail_id($islidex_widget->ID);
			$feat = wp_get_attachment_image_src($image_id,'large', true);
			echo '<div class="slidew"><a href="'.get_permalink($islidex_widget->ID).'"><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.$feat[0].'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=0&q=100" /></a></div>'; // the featured image
			} elseif ($slide == true) {
				echo '<div class="slidew"><a href="'.get_permalink($islidex_widget->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['widget_size_h'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';
			} else if ($attachments == true) {
					foreach($attachments as $id => $attachment) {
					$img = wp_get_attachment_image_src($id, 'full');
					$img_url = parse_url($img[0], PHP_URL_PATH);
					print '<div class="slidew"><a href="'.get_permalink($islidex_widget->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['widget_size_h'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a></div>';
					}
			} else {
			print 'div class="slidew"><a href="'.get_permalink($islidex_widget->ID).'"><img alt="'.$title.'" title="'.$title.'" src="'.$timthumb_path.'?src='.ISLIDEX_PLUGIN_IMAGES.'/wp_big.png&w=250&h=250&zc=0&q=100" /></a></div>';
			}
		}	
wp_reset_query(); ?>
	</div>
	<div id="slidesw_menu">
	<ul>
	<li class="fbar">&nbsp;</li>
	
<?php islidex_thumb_widget() ?>

	</ul>
	</div>
</div>

	<?php // NIVO WIDGET THEME

	} elseif ($islidex_options['theme'] == 2) { ?>

	<div id="sliderw" style="min-height:<?php echo $widgh ?>px;min-width:<?php echo $widgw ?>px;width:<?php echo $widgw ?>px;height:<?php echo $widgh ?>px;">
	
	<?php
	$slideposts = get_posts('numberposts='.$widgnum.'&cat='.$widgcat.'');
	foreach($slideposts as $islidex_widget) {
		$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
		$slide = get_post_meta($islidex_widget->ID, $key1, true);
		$title = __($islidex_widget->post_title);
		$attachments = get_children( array('post_parent' => $islidex_widget->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
		if (function_exists('has_post_thumbnail') && has_post_thumbnail($islidex_widget->ID)) {
			$image_id = get_post_thumbnail_id($islidex_widget->ID);
			$feat = wp_get_attachment_image_src($image_id,'large', true);
			echo '<a href="'.get_permalink($islidex_widget->ID).'"><img src="'.$timthumb_path.'?src='.$feat[0].'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" /></a>'; // the featured image
		} elseif ($slide == true) {
			echo '<a href="'.get_permalink($islidex_widget->ID).'"><img src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" /></a>';
		} else if ($attachments == true) {
			foreach($attachments as $id => $attachment) {
			$img = wp_get_attachment_image_src($id, 'full');
			$img_url = parse_url($img[0], PHP_URL_PATH);
			print '<a href="'.get_permalink($islidex_widget->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$title.'" title="'.$title.'" class="captify" /></a>';
			}
		} else {
		print '<a href="'.get_permalink($islidex_post->ID).'"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.ISLIDEX_PLUGIN_IMAGES.'/wp_big.png&w=250&h=250&zc=0&q=100" alt="'.$title.'" title="'.$title.'" style="padding-top:5%;" /></a>';
		}
	} 
	wp_reset_query(); ?>
	</div>

	<?php } // end of Nivo theme - no elseif


echo $after_widget;
} // end of function

wp_register_sidebar_widget('islidex_widget', 'iSlidex', 'widget_islidex');

function widget_islidex_control() {
	
	$islidex_options = get_option('islidex_options');
	$title = $islidex_options['widget_title'];
	
	if (!empty($_POST['islidex_widgetitle'])) {
	$title = strip_tags(stripslashes($_POST['islidex_widgetitle']));
	$islidex_options['widget_title'] = $title;
	update_option('islidex_options', $islidex_options);
	}
	$title = htmlspecialchars($title, ENT_QUOTES); ?>
	<p><label for="islidex_widget_title">Title: <input type="text" id="islidex_widget_title" name="islidex_widget_title" value="<?php echo $title; ?>" /></label></p>
	
	<?php 	} wp_register_widget_control('iSlidex', 'widget_islidex_control',200, 50);
}
	$islidex_options = get_option('islidex_options');
	if ($islidex_options['usewidget'] == 2) {
	add_action('widgets_init', 'widget_islidex_init');
	}
?>