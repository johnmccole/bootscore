<?php

// style and scripts
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

  // custom.js
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', false, '', true);
}

// External functions
require_once( get_stylesheet_directory() . '/inc/custom-functions.php' );
require_once( get_stylesheet_directory() . '/inc/global-layouts.php' );

if(get_field('disable_comments', 'option')) {
	require_once( get_stylesheet_directory() . '/inc/disable-comments.php' );
}

// Disable environment check
add_filter('bootscore_scss_skip_environment_check', '__return_true');
