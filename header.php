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
        <div class="hero_top menu_top">
          <a href="http://localhost/sae301/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.174 18.7798L19.8297 27.125L16.6037 23.899L25.4816 15.0164L30.8453 15L48 32.1547L47.9051 32.2505H41.6446L28.174 18.7798ZM19.826 29.8511L28.1703 21.5068L31.3963 24.7319L22.5184 33.6154L17.1547 33.6309L0 16.4762L0.0948834 16.3813H6.35536L19.826 29.8511Z" fill="#ECE8E0"/>
                </svg>
                </a>
            <button aria-controls="menu" @click="menuIsOpen = false">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 26 26" fill="none">
              <path d="M1.00002 25L25 1" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M25 25L1.00002 1" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
            </button>
        </div>
      <?php wp_nav_menu ( array ( 'theme_location' => 'header-menu') ); ?>
    </nav>
