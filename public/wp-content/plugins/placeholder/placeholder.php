<?php
/*
Plugin Name: Placeholder Page
Description: Display placeholder page for guests.
Author: Pixeltrix Ltd
Version: 1.0
Author URI: http://www.pixeltrix.co.uk/
*/

  function placeholder_template_include($template) {
    $placeholder = get_template_directory() . '/placeholder.php';

    if (!is_user_logged_in() && is_file($placeholder)) {
      return $placeholder;
    } else {
      return $template;
    }
  }

	add_filter('template_include', 'placeholder_template_include');

?>