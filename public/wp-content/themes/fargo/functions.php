<?php

  function fargo_theme_setup() {
    register_nav_menus(array(
      'main' => 'Main Menu'
    ));
  }

  add_action('after_setup_theme', 'fargo_theme_setup');

  function fargo_main_menu() {
    wp_nav_menu(array('theme_location' => 'main', 'container' => false, 'fallback_cb' => false, 'depth' => 2));
  }

?>