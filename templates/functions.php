<?php
function youtube_video_galley_add_styles() {
	wp_enqueue_script('jquery');
    wp_register_script( 'script', plugins_url('script.js', __FILE__) );
    wp_enqueue_script( 'script', array('jquery') );
    wp_register_style( 'style', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'style' );
}
add_action('wp_enqueue_scripts', 'youtube_video_galley_add_styles');
?>