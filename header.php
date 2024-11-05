<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php the_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <?php wp_head(); ?>
  </head>
  <body x-data="{menuIsOpen: false}" :class="{noscroll:menuIsOpen,}">
    <nav class="menu_overlay"
     x-show="menuIsOpen"
        x-transition.duration.800ms>
      <?php
      wp_nav_menu ( array ( 'theme_location' => 'header-menu') ); ?>
    </nav>


