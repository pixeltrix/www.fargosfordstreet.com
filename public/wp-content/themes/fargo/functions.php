<?php

  function fargo_theme_setup() {
    register_nav_menus(array(
      'main' => 'Main Menu'
    ));

    wp_register_script('jquery-tools', get_bloginfo('template_directory') . '/jquery.tools.js', array('jquery'), '1.2.7');

    add_theme_support('post-thumbnails');
    add_image_size('gallery', 900, 326, true);
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

  function fargo_gallery() {
    $post_id = get_the_ID();

    $attachments = get_children(array(
      'post_parent' => $post_id,
      'post_status' => 'inherit',
      'post_type' => 'attachment',
      'post_mime_type' => 'image',
      'order' => 'ASC', 'orderby' => 'menu_order ID'
    ));

    if (empty($attachments)) { return ''; }

    $output = "<div id=\"gallery\">\n";
    $images = "<div class=\"images\">\n";
    $tabs = "<div class=\"tabs\">\n";

    foreach ($attachments as $id => $attachment) {
      $imgtag = wp_get_attachment_image($id, 'gallery');
      $images .= "<div class=\"image\">{$imgtag}</div>\n";
      $tabs .= "<a href=\"#\"></a>\n";
    }

    $images .= "</div>\n";
    $tabs .= "</div>\n";

    $interval = 4000;

    $output .= $images;
    $output .= $tabs;
    $output .= "<script type=\"text/javascript\">\n";
    $output .= "jQuery(function($) {\n";
    $output .= "  $('#gallery .tabs').tabs('.images > div', { effect: 'fade', fadeOutSpeed: 'slow', rotate: true }).slideshow({ autoplay: true, interval: {$interval}, clickable: false });\n";
    $output .= "});\n";
    $output .= "</script>\n";
    $output .= "</div>\n";

    echo $output;
  }

?>