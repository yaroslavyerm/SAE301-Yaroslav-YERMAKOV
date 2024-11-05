<?php
add_theme_support( 'post-thumbnails' );

function register_my_menu(){
    register_nav_menus( array(
        'header-menu' => __( 'Menu De Header'),
        'footer-menu-1' => __( 'Menu De Footer 1'),
        'footer-menu-2' => __( 'Menu De Footer 2'),
    ) );
}
add_action( 'init', 'register_my_menu' );

function enqueue_alpine_js() {
    // Enqueue Alpine.js
    wp_enqueue_script(
        'alpine-js', // Handle for this script
        'https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.min.js', // CDN URL for Alpine.js
        [], // Dependencies (none needed)
        '3.10.2', // Version of Alpine.js being used
        true // Load in footer for better performance
    );
}
add_action('wp_enqueue_scripts', 'enqueue_alpine_js');