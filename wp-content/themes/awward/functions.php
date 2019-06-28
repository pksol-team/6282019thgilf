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
