<?php

if ( !is_admin() && !class_exists('ACF') ) {
  echo '<a href="https://www.advancedcustomfields.com/pro/" target="_blank"><strong>ACF PRO</strong></a> must be installed and active to use this theme.';
  die();
}

// Add page slug to body class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . ' ' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


// Admin styles
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/css/admin-style.css', false );
}

// Customise login page
function custom_login_stylesheet() {
  wp_enqueue_style( 'login_css', get_stylesheet_directory_uri() . '/css/login-style.css', false );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );

function custom_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'custom_logo_url' );

/**
* Filter the upload size limit for administrators.
*
* @param string $size Upload size limit (in bytes).
* @return int (maybe) Filtered size limit.
*/
add_filter( 'upload_size_limit', function ( $size ) {
  // Set the upload size limit to 4.5 MB for users lacking the 'manage_options' capability.
  if ( current_user_can( 'manage_options' ) ) {
    $size = 4500000;
  }
  return $size;
}, 20 );


// Show ACF to Admins only.
// Check plugin is active first.
if( function_exists('ACF')) {
  add_filter('acf/settings/show_admin', 'acf_show_admin');

  function acf_show_admin( $show ) {
      return current_user_can('manage_options');
  }
}

// Add Custom Fields to Menu Items
add_filter('wp_nav_menu_objects', 'menu_wp_nav_menu_objects', 10, 2);

function menu_wp_nav_menu_objects( $items, $args ) {
    
    // loop
    foreach( $items as &$item ) { 

      // vars
      $icon = get_field('icon', $item);
      
      // append icon
      if( $icon ) {
        $item->title = '<img class="menu-icon" src="'.$icon["url"].'" title="'.$item->title.'"><span class="title">'.$item->title.'</span>';
      } 
    }

    // return
    return $items;
    
}

// ACF Pro Options Page(s)
if( function_exists('acf_add_options_page') ) {
  $option_page = acf_add_options_page(array(
    'page_title' 	=> 'Theme Settings',
    'menu_title' 	=> 'Theme Settings',
    'menu_slug' 	=> 'theme-settings',
    'capability' 	=> 'edit_posts',
    'icon_url'    => 'dashicons-welcome-view-site',
    'redirect'    => false,
    'position'    => 2,
    'capability'  => 'manage_options',
	));

  $option_page = acf_add_options_page(array(
    'page_title'  => 'Developer Settings',
    'menu_title'  => 'Developer Settings',
    'menu_slug'   => 'developer-settings',
    'capability'  => 'edit_posts',
    'icon_url'    => 'dashicons-admin-settings',
    'redirect'    => false,
    'position'    => 3,
    'capability'  => 'manage_options',
  ));

  // Deactive Block Editor
  if(get_field('disable_block_editor', 'option')) {
    add_filter('gutenberg_can_edit_post', '__return_false', 5);
    add_filter('use_block_editor_for_post', '__return_false', 5);
  } else {

    // De-Register all Core Blocks.
    if(get_field('de_register_core_blocks', 'option')) {
      function remove_default_blocks($allowed_blocks){
   
          // Get all registered blocks
          $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
          
          // Remove all blocks that are prefixed with core/
          $filtered_blocks = array();
          foreach($registered_blocks as $block) {
           
            if(strpos($block->name , 'core/') === false) { 
              array_push($filtered_blocks, $block->name);
            }
          }
          
          return $filtered_blocks;
      }
       
      add_filter('allowed_block_types', 'remove_default_blocks');
    }
    
    // Block functions
    require_once( dirname(__FILE__).'/../blocks/block-functions.php' );

    // Add after theme setup
    add_action( 'after_setup_theme', function () {
      // Add extra Gutenberg alignment
      add_theme_support( 'align-wide' );
      // Disable custom font sizes
      // add_theme_support( 'disable-custom-font-sizes' );
      // Add custom line height
      add_theme_support( 'custom-line-height' );
      // Add responsive embeds support
      add_theme_support( 'responsive-embeds' );
      // Add custom padding
      add_theme_support( 'custom-spacing' );
      // Add appearance tools
      add_theme_support( 'appearance-tools' );
    } );
  }

  function acf_load_color_field_choices( $field ) {
    // Reset choices
    $field['choices'] = array();

    // Check to see if Repeater has rows of data to loop over
    if( have_rows('colours', 'option') ) {
        // Execute repeatedly as long as the below statement is true
        while( have_rows('colours', 'option') ) {

            // Return an array with all values after the loop is complete
            the_row();

            // Variables
            $value = get_sub_field('colour');
            $label = get_sub_field('name');

            // Append to choices
            $field['choices'][ $value ] = $label;
        }
    }
    // Return the field
    return $field;
  }

  add_filter('acf/load_field/name=colour_select', 'acf_load_color_field_choices');
}

/*
 * Allow svg files to be uploaded
 */
add_filter('upload_mimes', function ($mimes) {
  if ( is_admin() ) {
    $mimes['svg'] = 'image/svg+xml';
  }

  return $mimes;
});

// Slicker Slider assets
add_action('wp_enqueue_scripts', function () {

  // Bootstrap Icons
  wp_enqueue_style('bootstrap-icons.css', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css', false, null);

  // Slick
	wp_enqueue_style('slick.min.css', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', false, null);
	wp_enqueue_script('slick.min.js', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], null, true);

  // Isotope
  wp_enqueue_script('isotope.min.js', '//unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', ['jquery'], null, true);

  // Animate.css
  wp_enqueue_style('animate.min.css', '//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', false, null);
}, 100);

/*
 * Wrap iframe and embed in div
 */
add_filter('the_content', function ($content) {
   // match any iframes
   $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
   preg_match_all($pattern, $content, $matches);

   foreach ($matches[0] as $match) {
       // wrap matched iframe with div
       $wrappedframe = '<div class="ratio 16x9">' . $match . '</div>';

       //replace original iframe with new in content
       $content = str_replace($match, $wrappedframe, $content);
   }

   return $content;
  }
);

// Remove Category: from title
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );