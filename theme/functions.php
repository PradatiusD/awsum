<?php

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'awsum studio' );
define( 'CHILD_THEME_URL', 'http://github.com/PradatiusD/awsum' );
define( 'CHILD_THEME_VERSION', '1.0.0' );


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );
//* Add support for custom background
add_theme_support( 'custom-background' );
//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

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
// move Secondary Sidebar to .content-sidebar-wrap
remove_action('genesis_after_content_sidebar_wrap','genesis_get_sidebar_alt');
add_action('genesis_after_content','genesis_get_sidebar_alt' );
// $hook_name = 'genesis_after_content_sidebar_wrap';
// global $wp_filter;
// var_dump( $wp_filter[$hook_name] );



// Header Scripts
function header_scripts () {
  wp_enqueue_style('custom_fonts', 'http://fonts.googleapis.com/css?family=Merriweather:400,700,300italic,400italic,700italic,300', array(), '1.0');
  wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '4.0.3');
}
add_action('wp_enqueue_scripts','header_scripts');


// Twitter Scripts for Team Members
function twitter_scripts() {
  if (is_singular('team-member')) {
    wp_enqueue_script('angular','//ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js',array('jquery'), '3.2.0', true);
    wp_enqueue_script('angular-sanitize','//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.3/angular-sanitize.min.js', array('angular'), '1.3.3', true);
    wp_enqueue_script('twitter-angular', get_stylesheet_directory_uri().'/js/twitter.js',array('angular', 'jquery'), '1.0.0', true);
  }
}

add_action( 'wp_enqueue_scripts', 'twitter_scripts');


function team_member_title () {
 ob_start();
 $job_title = types_render_field( "official-title", array());
 ?>

 <?php if (strlen($job_title) > 0): ?>
    <h4 class="official-title">
      <?php echo $job_title; ?>
    </h4>   
 <?php endif; ?>

 <?php
 $output = ob_get_clean();
 echo $output;
}
add_action('genesis_entry_content', 'team_member_title', 0);

// Extra content
function team_member_view () {
  if (is_singular('team-member')) {
    $googleScholarLink = types_render_field("google-scholar-link", array('output'=>'raw'));
    
    if (strlen($googleScholarLink) > 0 ) {
      get_template_part('google-scholar');     
    }
  }
}

add_action( 'genesis_entry_footer', 'team_member_view');

// Sidebar

function team_member_pic() {
  ?>
  <?php 

    the_post_thumbnail('thumbnail', array(
      'class'=>'img-responsive member-pic',
      'style'=>'display:block;margin:0 auto;')
    );

    $twitterHandle = types_render_field("twitter", array());
    $linkedInUrl   = types_render_field("linkedin-public-url", array('output'=>'raw'));
  ?>

  <section class="text-center">
    <?php if (strlen($twitterHandle) > 0): ?>
    <div>
      <a href="<?php echo 'http://twitter.com/'.$twitterHandle;?>" target="_blank">
        <i class="fa fa-twitter"></i>
        @<?php echo $twitterHandle; ?>
      </a>
    </div>  
    <?php endif;?>

  <?php if (strlen($linkedInUrl)): ?>
      <div>
        <a href="<?php echo $linkedInUrl;?>" target="_blank">
          <i class="fa fa-linkedin"></i>
          View Profile
        </a>
      </div>    
    </section>  
  <?php endif; ?>

  <?php
    include('twitter.php');
}

add_action('genesis_before_sidebar_widget_area', 'team_member_pic');