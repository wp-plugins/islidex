<?php
/*
Plugin Name: iSlidex
Plugin URI: http://www.shambix.com/en/news/wordpress-plugin-islidex
Description: Apple-style slideshow for Wordpress. Settings and documentation are under Plugin -> iSlidex. Official plugin page <a href="http://www.shambix.com/en/news/wordpress-plugin-islidex/">here</a>. Based on a <a href="http://tutorialzine.com/2009/11/beautiful-apple-gallery-slideshow/">TutorialZine</a> script.
Version: 1.6
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
		"category_id" => '1',
		"num_post" => '5',
		"slide_size_w" => '490',
		"slide_size_h" => '260',
		"widget_title" => '',
		"widget_size_w" => '230',
		"widget_size_h" => '200',
		"widget_num_post" => '3',
		"widget_cat" => '1'
	);

	add_option("islidex_options", $islidex_options, '', 'yes');

}

// Add iSlidex Menu to WP

function islidex_add_menu() {
 if (function_exists('add_options_page')) {
    add_submenu_page('plugins.php', 'iSlidex - Apple-style slider for WordPress', 'iSlidex', 8, basename(__FILE__), 'islidex_options_page');
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
				
			update_option('islidex_options', $islidex_options);
			echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><strong>Settings saved.</strong></p></div>';
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
	<!-- <div style="border:3px dotted #AAAAAA;float:right;padding:10px;position:fixed;right:20px;text-align:center;top:100px;width:300px;"> -->
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
	<div style="font-size:15px;">iSlidex is a Wordpress Plugin that will showcase, in an elegant and minimal way (the Apple way), images taken from posts in a specific category.</div>
	<br />
	<div class="info" style="border:1px dotted #aaa; padding:10px;width:960px;">
	If you would like to customize the look and feel of iSlidex, you can upload your own <strong>islidex.css</strong> to your own template folder
	<br />
	To customize exactly what slide/thumb to show add the custom fields <strong>islidex_slide</strong> and <strong>islidex_thumb</strong> + the direct link to the images.
	<br /><br />
	<strong>= Posts =</strong>
	<br />
	Use these:
	<br />
	<strong>[islidex_post]</strong> (it will show on top of the post content)
	<br />
	<strong>&lt;?php show_islidex(); ?&gt;</strong> or <strong>[php]show_islidex()[/php]</strong> directly in the post, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.
	<br /><br />
	<strong>= Pages =</strong>
	<br />
	Use these:
	<br />
	<strong>[islidex_page]</strong> (it will show on top of the page content)
	<br />
	<strong>&lt;?php show_islidexpage(); ?&gt;</strong> or <strong>[php]show_islidexpage()[/php]</strong> directly in the page, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.
	<br /><br />
	<strong>= Custom Sliders =</strong>
	<br />
	This function lets you add as many sliders as you want, all with different settings, indipendent from this page and each other.
	<br />
	<strong>&lt;?php show_customislidex(93,3,450,200); ?&gt</strong>, to use directly inside the template code
	<br />
	<strong>[php]show_customislidex(92,3,450,200)[/php]</strong> to use in the content, if you use also the plugin <a href="http://wordpress.org/extend/plugins/php-shortcode" target="_blank">PHP Shortcode</a>.
	<br />
	The numbers 93, 3, 450, 200 are only an example here, and represent in order: category (where to get the posts from), max number of posts/slides (to get from that category), width (of the slider), height (of the slider). Please replace them with the settings you prefer, each time you want to add a new slider in a different location.
	</div>

	<form id="islidex" class="form-table" method="post" action="">
		<table class="form-table" style="width:960px;">
			<tbody>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_timthumb">The main url of your website</label>
					</th>
					<td>
						<input type="text" name="islidex_timthumb" id="islidex_timthumb" value="<?php echo $islidex_options['timthumb_path'] ?>" />
						<br />
						Simply put something like http://www.mysite.com. If your Wordpress installation is in a subfolder like http://www.mysite.com/blog it doesn't matter, you still have to put ONLY http://www.mysite.com
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
						<label for="islidex_sizew">The width of the slider AND of each slide<br />(only numbers do not add "px")</label>
					</th>
					<td>
						<input type="text" name="islidex_sizew" id="islidex_sizew" value="<?php echo $islidex_options['slide_size_w'] ?>" />
						<br />
						Default is 490px.
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_sizeh">The height of the slider AND of each slide<br />(only numbers do not add "px")</label>
					</th>
					<td>
						<input type="text" name="islidex_sizeh" id="islidex_sizeh" value="<?php echo $islidex_options['slide_size_h'] ?>" />
						<br />
						Default is 260px.
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">
					<h3>Widget Settings</h3>
					</th>
					<td></td>
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
						<label for="islidex_widgetsizew">The width of the widget AND of each slide<br />(only numbers do not add "px")</label>
					</th>
					<td>
						<input type="text" name="islidex_widgetsizew" id="islidex_widgetsizew" value="<?php echo $islidex_options['widget_size_w'] ?>" />
						<br />
						Default is 230px.
					</td>
				</tr>
			<tr valign="top">
					<th scope="row">
						<label for="islidex_widgetsizeh">The height of the widget AND of each slide<br />(only numbers do not add "px")</label>
					</th>
					<td>
						<input type="text" name="islidex_widgetsizeh" id="islidex_widgetsizeh" value="<?php echo $islidex_options['widget_size_h'] ?>" />
						<br />
						Default is 200px.
					</td>
				</tr>
			</tbody> 
		</table>
		<input type="hidden" name="islidex_send" id="islidex_send" value="true" />
		<p class="submit"><input type="submit" value="Save Changes" /></p>
	</form>
	
	<h2>iSlidex Support</h2>
	<br />
	<div class="info" style="border:1px dotted #aaa; padding:10px;width:960px;">You can leave a comment about the plugin or say thank you on <a href="http://www.shambix.com/en/news/wordpress-plugin-islidex/" target="_blank">iSlidex official blog post</a>, on Shambix site.
	<br />
	<br />
	For any plugin requests, customizations, templates and anything to do with Wordpress, feel free to contact us at <a href="mailto:info@shambix.com">info@shambix.com</a>.
	</div>

</div>

<?php }


// Lets wrap it up!

// The CSS - For custom CSS either upload a islidex.css to your template folder or edit the one in the plugin css folder. The template CSS would have the priority

function islidexcss() {
		if ( file_exists( TEMPLATEPATH . '/islidex.css') ){
			$css_path =  get_template_directory_uri() . '/islidex.css';
		}else{
			$css_path = ISLIDEX_PLUGIN_CSS . '/islidex.css';
			$islidexjs_path = ISLIDEX_PLUGIN_JS . '/islidex.js';
			 }
		echo '<link rel="stylesheet" type="text/css" href="'.$css_path.'" />';
		
	}

// add header hook for CSS
add_action('wp_head', 'islidexcss');


// the JS

function islidexjs() {

			$islidexjs_path = ISLIDEX_PLUGIN_JS . '/islidex.js';
			 
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="'.$islidexjs_path.'"></script>';
		
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

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($thumb == true) {

	echo '<li class="menuItem"><a href="" title="'.$clean_title.'"><img src="'.$timthumb_path.'?src='.$thumb.'&w=32&h=32&zc=0&q=100" alt="'.$clean_title.'" /></a></li>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	print '<li class="menuItem"><a href="" title="'.$clean_title.'"><img src="'.$timthumb_path.'?src='.$img_url.'&w=32&h=32&zc=0&q=100" alt="'.$clean_title.'" /></a></li>'; 
		
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

<div class="gallery" id="gallery" style="width:<?php echo $islidex_options['slide_size_w'] ?>px;"><div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php /*
$slideposts = get_posts('showposts=1&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);
*/
?> 

<?php /*$islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php'; 

	
	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
	}
	
	} else {	} */?>

<?php //endforeach; ?>  
    
<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
$islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php'; 
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
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

// And here's the shortcode for it - USE IT ONLY IN SINGLE POSTS

add_shortcode('islidex_post', 'show_islidex');




// PAGE VERSION ONLY


function show_islidexpage() {

$islidex_options = get_option("islidex_options");
$numpost = $islidex_options['num_post'];
$catid = $islidex_options['category_id'];
?>

<div class="gallery" id="gallery" style="width:<?php echo $islidex_options['slide_size_w'] ?>px;"><div id="slides" style="height:<?php echo $islidex_options['slide_size_h'] ?>px;">

<?php $slideposts = get_posts('showposts=1&cat='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);

// add header hook for JS
add_action('wp_footer', 'islidexjs');?>

<?php $islidex_options = get_option("islidex_options");
$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';

	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  
	
<?php $slideposts = get_posts('showposts='.$numpost.'&cat='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
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

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['widget_size_h'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['widget_size_h'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>
    
<?php $slideposts = get_posts('showposts='.$widgnum.'&category='.$widgcat.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><img width="'.$islidex_options['widget_size_w'].'" height="'.$islidex_options['widget_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['widget_size_w'].'&h='.$islidex_options['widget_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></div>'; 
		
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
add_action('widgets_init', 'widget_islidex_init');


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

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );

	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$slide.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
		else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
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

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);

	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$slide.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
		else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$width.'" height="'.$height.'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$width.'&h='.$height.'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
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
//$timthumb_path = ISLIDEX_PLUGIN_JS . '/timthumb.php';
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

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
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

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  

<?php $slideposts = get_posts('numberposts='.$numpost.'&offset=1&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
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

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
	}
	
	} else {	} ?>

<?php endforeach; ?>  
 
<?php $slideposts = get_posts('showposts='.$numpost.'&category='.$catid.'');
foreach($slideposts as $post) :
setup_postdata($post);


	global $post;
	$key1 = "islidex_slide"; //in case you want your own slide image and not taken from the post attachment
	$slide = get_post_meta($post->ID, $key1, true);

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'rand', 'numberposts' => 1) );
	
	$qtrcrap = array("<!--:it-->", "<!--:-->", "<!--:en-->", "<!--:de-->", "<!--:pt-->", "<!--:cn-->", "<!--:fr-->", "<!--:es-->", "<!--:se-->", "<!--:no-->","<!--:pl-->");
	$clean_title = str_replace($qtrcrap , "", $post->post_title);
	
	if ($slide == true) {

	echo '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$slide.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>';

	} 
	
	else if ($attachments == true) {

	foreach($attachments as $id => $attachment) {
	$img = wp_get_attachment_image_src($id, 'full');
	$img_url = parse_url($img[0], PHP_URL_PATH);
	print '<div class="slide"><a href="'.get_permalink($post).'" title="'.$clean_title.'"><img width="'.$islidex_options['slide_size_w'].'" height="'.$islidex_options['slide_size_h'].'" src="'.$timthumb_path.'?src='.$timthumb_path2.''.$img_url.'&w='.$islidex_options['slide_size_w'].'&h='.$islidex_options['slide_size_h'].'&zc=1&q=100" alt="'.$clean_title.'" /></a></div>'; 
		
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