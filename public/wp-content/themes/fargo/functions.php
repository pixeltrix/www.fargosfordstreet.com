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

  function fargo_breadcrumbs() {
    if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb('','');
    }
  }

  function fargo_page_menu() {
    global $post;

    if($post->post_parent) {
      $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
    } else {
      $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
    }

    if ($children) {
      echo "<ul class=\"page-menu\">\n{$children}\n</p>\n";
    }
  }

?>