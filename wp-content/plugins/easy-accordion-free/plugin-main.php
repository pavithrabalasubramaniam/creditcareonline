<?php
/*
Plugin Name: Easy Accordion Free
Plugin URI: http://shapedplugin.com/plugin/easy-accordion-pro
Description: This plugin will enable accordion features in your wordpress site. 
Author: ShapedPlugin
Author URI: http://shapedplugin.com
Version: 1.2
*/

/* Adding Latest jQuery from Wordpress */
function lazy_p_wp_accordion_free_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'lazy_p_wp_accordion_free_jquery');

/*Some Set-up*/
define('LAZY_P_WP_ACCORDION_FREE', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );



/* Including all files */
function lazy_p_wp_accordion_free_files() {
wp_enqueue_script('lazy-p-accordion-main-js', LAZY_P_WP_ACCORDION_FREE.'js/jquery.beefup.min.js', array('jquery'), 1.0, true);
wp_enqueue_style('lazy--p-accordion-main-css', LAZY_P_WP_ACCORDION_FREE.'css/style.css');
}
add_action( 'wp_enqueue_scripts', 'lazy_p_wp_accordion_free_files' );



function easy_accordion_free_wrapper( $atts, $content = null  ) {

	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

	
	
	return '
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(".easy_accordion_single'.$id.' .single_accordion").beefup({
					openSingle : true,
					trigger: ".ea-item-head",
					content: ".ea-item-body",
					openClass : "ea-item-expand",
					animation : "slide",
					openSpeed : "200",
					closeSpeed : "200",
					scroll : false
				});
			});
		</script>
		
		<div id="ea_one" class="easy_accordion_wrapper easy_accordion_single'.$id.' '.$id.'">'.do_shortcode($content).'</div>
		
	';
}	
add_shortcode('efaccordion', 'easy_accordion_free_wrapper');

function easy_accordion_free_items( $atts, $content = null  ) {

	extract( shortcode_atts( array(
		'title' => '',
		'text' => '',
	), $atts ) );

	return '
	<div class="single_accordion">
		<h2 class="ea-item-head">'.$title.'</h2>
		<div class="ea-item-body">'.$text.'</div>		
	</div>
	';
}	
add_shortcode('efitems', 'easy_accordion_free_items');



// Registering Custom post
add_action( 'init', 'wap_accordion_free_create_custom_post' );
function wap_accordion_free_create_custom_post() {
	register_post_type( 'eaf-items',
		array(
			'labels' => array(
				'name' => __( 'Accordion Items' ),
				'singular_name' => __( 'Accordion Item' ),
				'add_new_item' => __( 'Add New Accordion Item' )
			),
			'public' => true,
			'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'accordion-item'),
		)
	);
	
}




// Accordion form shortcode
function wap_accordion_items_shortcode($atts){
	extract( shortcode_atts( array(
		'id' => '01',		
		'items' => '10',		
	), $atts, 'wcp_testimonial' ) );
	
    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => 'eaf-items')
        );	

			
	$list = '
	
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(".easy_accordion_single'.$id.' .single_accordion").beefup({
					openSingle : true,
					trigger: ".ea-item-head",
					content: ".ea-item-body",
					openClass : "ea-item-expand",
					animation : "slide",
					openSpeed : "200",
					closeSpeed : "200",
					scroll : false
				});
			});
		</script>		
	
		<div id="ea_one" class="easy_accordion_wrapper easy_accordion_single'.$id.'">	
		
	';
	while($q->have_posts()) : $q->the_post();
		$idd = get_the_ID();
		$content_main = do_shortcode(get_the_content());
		$content_autop = wpautop(trim($content_main));
		

		
		$list .= '
		
		
		<div class="single_accordion">
			<h2 class="ea-item-head">' .do_shortcode( get_the_title() ). '</h2>
			<div class="ea-item-body">' .do_shortcode( $content_autop ). '</div>		
		</div>	
		

		'; 		

 		
	endwhile;
	$list.= '</div>';
	
	
	wp_reset_query();
	return $list;
}
add_shortcode('eaf_items', 'wap_accordion_items_shortcode');	



// Hooks your functions into the correct filters
function eaf_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'eadf_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'eaff_register_mce_button' );
	}
}
add_action('admin_head', 'eaf_add_mce_button');

// Declare script for new button
function eadf_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['my_mce_button'] = plugin_dir_url( __FILE__ ) .'/js/mce-button.js';
	return $plugin_array;
}

// Register new button in the editor
function eaff_register_mce_button( $buttons ) {
	array_push( $buttons, 'my_mce_button' );
	return $buttons;
}






function add_eafree_options_framwrork()  
{  
	add_options_page('Purchase Easy Accordion Pro for cool features', '', 'manage_options', 'eaf-settings','eaf_options_framwrork');  
}  
add_action('admin_menu', 'add_eafree_options_framwrork');



if ( is_admin() ) : // Load only if we are viewing an admin page



// Function to generate options page
function eaf_options_framwrork() {
?>


	
<div class="wrap">
	<style type="text/css">
		.welcome-panel-column p{padding-right:20px}
		.installing_message h2{background: none repeat scroll 0 0 green;
color: #fff;
line-height: 30px;
padding: 20px;
text-align: center;}
	</style>
	<div class="installing_message">
		<h2>Thank you for installing our free plugin</h2>
	</div>
	

	<div class="welcome-panel" id="welcome-panel">
		
		<div class="welcome-panel-content">
			<h3>Want some cool features of this plugin?</h3>
			<p class="about-description">We've added more features in our premium version of this plugin. Let see some amazing features.</p>
	<div class="welcome-panel-column-container">
		<div class="welcome-panel-column">
			<h4>Accordion from post & it’s category</h4>
			<p>You can insert accordion from general post. Also, you can embed accordion from custom category too. You can limit how many items will show.</p>
			<a href="http://shapedplugin.com/demo/easy-accordion-pro/" target="_blank" class="button button-primary">See Demo</a>
		</div>
		
		<div class="welcome-panel-column">
			<h4>Accordion from custom post & its taxonomy</h4>
			<p>You can insert accordion in any custom post too! Like WooCommerce product or contact forms. You can embed them from custom taxonomy too!</p>
			<a href="http://shapedplugin.com/demo/easy-accordion-pro/" target="_blank" class="button button-primary">See Demo</a>
		</div>
		
		<div class="welcome-panel-column welcome-panel-last">
			<h4>Three amazing themes</h4>
			<p>In premium version of this plugin, you are ready to use three amazing theme for accordion. We are planning to add more theme in that premium version.</p>
			<a href="http://shapedplugin.com/demo/easy-accordion-pro/" target="_blank" class="button button-primary">See Demo</a>
		</div>
	</div>
	
	<div class="welcome-panel-column-container">
		
		<div class="welcome-panel-column">
			<h4>UNLIMITED colors Supported</h4>
			<p>Match the accordion with your website’s color scheme without any problem. You can add colors in accordion. Its very easy to add your theme color scheme in your accordion. You can use color name or HEX code.</p>
			<a href="http://shapedplugin.com/demo/easy-accordion-pro/" target="_blank" class="button button-primary">See Demo</a>
		</div>
		
		<div class="welcome-panel-column">
			<h4>Accordion timer & other settings</h4>
			<p>You can control accordion time & it’s effect. Currently supported fade & slide effect. You can change accordion time as well. Its very easy to add.</p>
			<a href="http://shapedplugin.com/demo/easy-accordion-pro/" target="_blank" class="button button-primary">See Demo</a>
		</div>
		
		<div class="welcome-panel-column welcome-panel-last">
			<h4>& more ....</h4>
			<p>There are many more function in premium version. Why you so late? Just purchase premium version & Enable awesome features in your wordpress website.</p>
			<a href="http://shapedplugin.com/plugin/easy-accordion-pro" target="_blank" class="button button-primary">Buy Premium Version Now.</a>
		</div>
		
	</div>

	<br/><br/>
		
		<div class="pr-eap-button" style="text-align: center; margin-bottom: 20px; margin-top: 140px; ">
			<h3>Cool! you are ready to enable those features in only $15. </h3>
			<p class="about-description">Watch demo before purchase. I know you like the demos. Thanks for reading features. Good luck with creating accordions in your wordpress site.</p>

			<a href="http://shapedplugin.com/plugin/easy-accordion-pro/" class="button button-primary button-hero">Buy Premium Version Now. Only $15</a><br/><br/>
		</div>
	
	
		</div>
	</div>


</div>
	


	<?php
}



endif;  // EndIf is_admin()


register_activation_hook(__FILE__, 'easy_accordion_free_activate');
add_action('admin_init', 'easy_accordion_free_redirect');

function easy_accordion_free_activate() {
    add_option('easy_accordion_free_do_activation_redirect', true);
}

function easy_accordion_free_redirect() {
    if (get_option('easy_accordion_free_do_activation_redirect', false)) {
        delete_option('easy_accordion_free_do_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("options-general.php?page=eaf-settings");
        }
    }
}

?>