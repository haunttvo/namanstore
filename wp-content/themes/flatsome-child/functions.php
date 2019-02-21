<?php
// Add custom Theme Functions here

add_action('wp_enqueue_scripts', 'my_script_hautvo');

function my_script_hautvo(){
    wp_enqueue_style( 'custom_stylesheet', get_stylesheet_directory_uri() . '/asset/css/style.css' );
}