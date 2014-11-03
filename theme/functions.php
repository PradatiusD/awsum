<?php

if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  // For Debugging on Localhost
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  // For live reloading
  wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
  wp_enqueue_script('livereload');
}

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'ISSST' ),
));


// Register our sidebars and widgetized areas.

function add_widgets() {
  register_sidebar( array(
    'name' => 'Right Sidebar',
    'id' => 'right_sidebar',
    'before_widget' => '<article>',
    'after_widget' =>  '</article>',
    'before_title' =>  '<h3>',
    'after_title' =>   '</h3>',
  ) );
}
add_action( 'widgets_init', 'add_widgets' );