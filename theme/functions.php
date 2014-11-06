<?php

if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  // For Debugging on Localhost
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  // For live reloading

  function local_livereload(){
    wp_register_script('livereload', 'http://localhost:35729/livereload.js', null, false, true);
    wp_enqueue_script('livereload');    
  }
  add_action( 'wp_enqueue_scripts', 'local_livereload');
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

  register_sidebar( array(
    'name' => 'Footer Area',
    'id' => 'footer_widgets',
    'before_widget' => '<article class="col-md-3">',
    'after_widget' =>  '</article>',
    'before_title' =>  '<h3>',
    'after_title' =>   '</h3>',
  ) );
}
add_action( 'widgets_init', 'add_widgets' );


// Header Scripts
function header_scripts () {
  wp_enqueue_script('jquery');
  wp_enqueue_style('theme-style', get_stylesheet_uri());
  wp_enqueue_style('custom_fonts', '//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Montserrat:400,700', array(), '1.0');
  wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '4.0.3');
}
add_action('wp_enqueue_scripts','header_scripts');

// Footer Scripts
function footer_scripts() {
  wp_enqueue_script('bootstrapJS','https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js',array('jquery'), '3.2.0', true);
}
add_action( 'wp_enqueue_scripts', 'footer_scripts');