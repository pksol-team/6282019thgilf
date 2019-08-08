<?php
add_action('after_setup_theme', 'awward_setup');
function awward_setup()
{
    load_theme_textdomain('awward', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form'
    ));
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array(
        'main-menu' => esc_html__('Main Menu', 'awward'),
        'footer-menu' => esc_html__('Footer Menu', 'awward')
    ));

    add_theme_support( 'custom-logo', array(
    	'height'      => 25,
    	'width'       => 141,
    	'flex-width' => true,
    ) );

}
add_action('wp_enqueue_scripts', 'awward_load_scripts');
function awward_load_scripts()
{
    wp_enqueue_style('awward-style', get_stylesheet_uri());
    wp_enqueue_script('jquery');
}
add_action('wp_footer', 'awward_footer_scripts');
function awward_footer_scripts()
{
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter('document_title_separator', 'awward_document_title_separator');
function awward_document_title_separator($sep)
{
    $sep = '|';
    return $sep;
}
add_filter('the_title', 'awward_title');
function awward_title($title)
{
    if ($title == '') {
        return '...';
    } else {
        return $title;
    }
}
add_filter('the_content_more_link', 'awward_read_more_link');
function awward_read_more_link()
{
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">...</a>';
    }
}
add_filter('excerpt_more', 'awward_excerpt_read_more_link');
function awward_excerpt_read_more_link($more)
{
    if (!is_admin()) {
        global $post;
        return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">...</a>';
    }
}
add_filter('intermediate_image_sizes_advanced', 'awward_image_insert_override');
function awward_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    return $sizes;
}
add_action('widgets_init', 'awward_widgets_init');
function awward_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Footer-Right', 'awward'),
        'id' => 'footer-right',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
    ));
}
add_action('wp_head', 'awward_pingback_header');
function awward_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('comment_form_before', 'awward_enqueue_comment_reply_script');
function awward_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
function awward_custom_pings($comment)
{
?>
<li <?php
    comment_class();
?> id="li-comment-<?php
    comment_ID();
?>"><?php
    echo comment_author_link();
?></li>
<?php
}
add_filter('get_comments_number', 'awward_comment_count', 0);
function awward_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments     = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

add_filter('auto_update_plugin', '__return_false');

add_filter('auto_update_theme', '__return_false');

function remove_core_updates()
{
    global $wp_version;
    return (object) array(
        'last_checked' => time(),
        'version_checked' => $wp_version
    );
}
function wpsites_change_comment_form_submit_label($arg) {
$arg['label_submit'] = 'Post Review';
return $arg;
}
add_filter('comment_form_defaults', 'wpsites_change_comment_form_submit_label');

add_filter('pre_site_transient_update_core', 'remove_core_updates');
add_filter('pre_site_transient_update_plugins', 'remove_core_updates');
add_filter('pre_site_transient_update_themes', 'remove_core_updates');



function insert_and_update_airline() {

	$appId = '856acead';
	$appKey = '42227f258e3e30fa2bdbb1e572599d25';

	$airline_json = file_get_contents('https://api.flightstats.com/flex/airlines/rest/v1/json/all?appId='.$appId.'&appKey='.$appKey);

	$airline_array = json_decode($airline_json, true)['airlines'];


	$index = 0;
	foreach($airline_array as $airline) {

		$index++;
		
		// if($index == 20)  {
		// 	break;
		// }

		$airline_meta_array = [];

		foreach($airline as $airline_meta_key => $airline_meta) {

			$airline_meta_array[$airline_meta_key] = strval($airline_meta);

		}

		$airline_meta_array['average_ratings'] = '0';
		
		$args = array(
			'post_type' => 'airline',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'name',
					'value' => $airline['name'],
					'compare' => '=',
				),
				array(
					'key' => 'fs',
					'value' => $airline['fs'],
					'compare' => '=',
				)
			)
		);

		$check_title = new WP_Query($args);

		$insert = true;

		if ( $check_title->found_posts > 0 ) { 

			$insert = false; 

		}

		// echo $index;

		$status = ($airline['active']) ? 'publish' : 'pending';

		if($insert == true) {
			
			// echo ' - insert-' . $airline['name'] .'-'. $airline['fs'];
			// echo '<br>';

			wp_insert_post( array(
				'post_title'    => $airline['name'],
				'post_type'     => 'airline',
				'post_status' => $status,
				'meta_input'    => $airline_meta_array

			) ); 

		} else { // update post

			// echo '-update-' . $check_title->ID .'-'. $airline['name'] .'-'. $airline['fs'];
			// echo '<br>';

			wp_update_post( array(
				'ID' => $check_title->ID,
				'post_title'    => $airline['name'],
				'post_type'     => 'airline',
				'post_status' => $status,
				'meta_input'    => $airline_meta_array

			) );

		}

		$airline_meta_array = null;

	}

}






function insert_and_update_airport() {

	$appId = '856acead';
	$appKey = '42227f258e3e30fa2bdbb1e572599d25';

	$airport_json = file_get_contents('https://api.flightstats.com/flex/airports/rest/v1/json/all?appId='.$appId.'&appKey='.$appKey);

	$airport_array = json_decode($airport_json, true)['airports'];


	$index = 0;
	foreach($airport_array as $airport) {

		$index++;
		
		// if($index == 600)  {
		// 	break;
		// }

		$airport_meta_array = [];

		foreach($airport as $airport_meta_key => $airport_meta) {

			$airport_meta_array[$airport_meta_key] = strval($airport_meta);

		}

		$airport_meta_array['average_ratings'] = '0';
		
		$args = array(
			'post_type' => 'airport',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'name',
					'value' => $airport['name'],
					'compare' => '=',
				),
				array(
					'key' => 'fs',
					'value' => $airport['fs'],
					'compare' => '=',
				),
			)
		);

		$check_title = new WP_Query($args);

		$insert = true;


		$status = ($airport['active']) ? 'publish' : 'pending';


		if ( $check_title->found_posts > 0 ) { 

			$insert = false;

		}

		// echo $index;

		if($insert == true) {
			
			// echo ' - insert-' . $airport['name'] .'-'. $airport['fs'];
			// echo '<br>';

			wp_insert_post( array(
				'post_title'    => $airport['name'],
				'post_type'     => 'airport',
				'post_status' => $status,
				'meta_input'    => $airport_meta_array

			) ); 

		} else { // update post

			// echo '-update-' . $check_title->ID .'-'. $airport['name'] .'-'. $airport['fs'];
			// echo '<br>';

			wp_update_post( array(
				'ID' => $check_title->ID,
				'post_title'    => $airport['name'],
				'post_type'     => 'airport',
				'post_status' => $status,
				'meta_input'    => $airport_meta_array

			) );

		}

		$airport_meta_array = null;

	}

}


add_filter( 'init', function( $template ) {

    if ( isset( $_GET['airline'] )) {
        
		
		insert_and_update_airline();
        die;

	}
	
	if ( isset( $_GET['airport'] )) {
        
		
		
		insert_and_update_airport();
        die;

    }

    


} );


add_action( 'comment_post', 'show_message_function', 10, 2 );
function show_message_function( $comment_ID, $comment_approved ) {

    $comment_posted = get_comment( $comment_ID ); 
    $comment_post_id = $comment_posted->comment_post_ID ;

	$args = array(
		'post_id' => $comment_post_id,
		'status'  => 'approve'
	);

	$comments = get_comments( $args );
	$ratings  = array();
	$count    = 0;

	foreach ( $comments as $comment ) {

		$rating = get_comment_meta( $comment->comment_ID, 'rating', true );

		if ( ! empty( $rating ) ) {
			$ratings[] = absint( $rating );
			$count ++;
		}
	}

	$avg = 0;

	if ( 0 != count( $ratings ) ) {

		$avg = round( array_sum( $ratings ) / count( $ratings ) );

	}

	update_post_meta( $comment_post_id, 'average_ratings', $avg);

	
	
}

add_action( 'wp_ajax_update_airport_data', 'update_airport_data' );
add_action('wp_ajax_nopriv_update_airport_data', 'update_airport_data');
function update_airport_data() { 

	$title = $_POST['title'];
	$desc = $_POST['description'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$airport_id = $_POST['airport_id'];

	$airport_post = array();
	$airport_post['ID'] = $airport_id;
	$airport_post['post_title'] = $title;
	$airport_post['post_content'] = $desc;

	update_post_meta( $airport_id, 'latitude', $latitude);
	update_post_meta( $airport_id, 'longitude', $longitude);

	wp_update_post( $airport_post );
	wp_die();

}


add_action( 'wp_ajax_update_airline_data', 'update_airline_data' );
add_action('wp_ajax_nopriv_update_airline_data', 'update_airline_data');
function update_airline_data() { 

	$title = $_POST['title'];
	$desc = $_POST['description'];
	$airline_id = $_POST['airline_id'];

	$airline_post = array();
	$airline_post['ID'] = $airline_id;
	$airline_post['post_title'] = $title;
	$airline_post['post_content'] = $desc;

	wp_update_post( $airline_post );
	wp_die();

}




add_action( 'wp_ajax_delete_file', 'delete_file' );
add_action('wp_ajax_nopriv_delete_file', 'delete_file');
function delete_file() { 

	$global_id = $_POST['global_id'];
	$image_id = $_POST['upload_id'];

	$slider_meta = str_replace($image_id.'-', '', get_post_meta($global_id, 'slider_images', true));
	update_post_meta($global_id, 'slider_images', $slider_meta);

	wp_delete_attachment($image_id, true);
	wp_die();

}



add_action( 'wp_ajax_update_global_slider', 'update_global_slider' );
add_action('wp_ajax_nopriv_update_global_slider', 'update_global_slider');
function update_global_slider() { 


	if ( ! function_exists( 'wp_handle_upload' ) ) {
	    require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}
	
	$uploadedfile = $_FILES['file'];


	$upload_overrides = array( 'test_form' => false );
	$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

	// echo $movefile['url'];

	$url = $movefile['url'];
	$form_type = $_POST['form_type'];

	$title = $_POST[$form_type.'_name'];
	$alt_text = $_POST[$form_type.'_name'];

	require_once(ABSPATH . 'wp-admin/includes/media.php');
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// sideload the image --- requires the files above to work correctly
	$src = media_sideload_image( $url, null, null, 'src' );

	// convert the url to image id
	$image_id = attachment_url_to_postid( $src );

	if( $image_id ) {

		// make sure the post exists
		$image = get_post( $image_id );

		if( $image) {

			// Add title to image
			wp_update_post( array (
				'ID'         => $image->ID,
				'post_title' => "Some Image Title",
			) );

			// Add Alt text to image
			update_post_meta($image->ID, '_wp_attachment_image_alt', $alt_text);
		}
	}

	$global_id = $_POST[$form_type.'_id'];

	$slider_meta =  get_post_meta($global_id, 'slider_images', true);

	if($slider_meta) {
		
		$new_meta = $slider_meta. (string)$image->ID .'-'; 

	} else { 

		$new_meta = $image->ID.'-';

	}

	update_post_meta($global_id, 'slider_images', $new_meta);

	echo $image_id;
	wp_die();

}


function subscription_links() {


	$current_user_id = get_current_user_id();
	$airline = get_user_meta($current_user_id, 'airline_id', true);
	$airport = get_user_meta($current_user_id, 'airport_id', true);

	$links = '<table class="airport_meta_data table-striped table-bordered">';
	if($airline) {

		$links .= '<tr><td>
			Your Airline </td>
		';

		$airline_post = get_post($airline);
		$airline_url = get_post_permalink($airline);

		$links .= '<td><a href="'.$airline_url.'" >'. $airline_post->post_title .'</a> </td> </tr>';


	}

	if($airport) {

		$links .= '<tr><td>
			Your Airport </td>
		';

		$airport_post = get_post($airport);
		$airport_url = get_post_permalink($airport);

		$links .= '<td><a href="'.$airport_url.'" >'. $airport_post->post_title .'</a> </td> </tr>';

	}


	$links .= '</table>';
    

    return $links;

}

add_shortcode('airport_airline_links', 'subscription_links');


add_action( 'gform_post_update_entry_2', 'log_post_update_entry', 10, 2 );
function log_post_update_entry( $entry, $original_entry ) {
    

    $airport_id = $entry[3];
    $access = $entry[9];
    $user_id = $entry['created_by'];

    if($access == 'Yes') {

    	update_user_meta( $user_id, 'airport_id',  $airport_id);

    } else {

    	delete_user_meta($user_id, 'airport_id');

    }



}