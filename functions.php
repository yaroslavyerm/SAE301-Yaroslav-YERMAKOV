<?php
add_theme_support( 'post-thumbnails' );

function register_my_menu(){
    register_nav_menus( array(
        'home-menu' => __( 'Menu De Accueil'),
        'graph-menu' => __( 'Menu De Graphs'),
    ) );
}
add_action( 'init', 'register_my_menu' );