<?php

// Global Layouts
add_action( 'init', function () {
  $labels = array(
    "name" => __( 'Global Layouts', '' ),
    "all_items" => __( 'Global Layouts', '' ),
    "singular_name" => __( 'Global Layout', '' ),
    "add_new" => __( 'Add Global Layout', '' ),
    "add_new_item" => __( 'Add Global Layout', '' ),
  );
 
  $args = array(
    "label" => __( 'Global Layouts', '' ),
    "labels" => $labels,
    "description" => "Global Layouts post type, used to create reusable blocks with consistent content",
    "supports" => array( "title", "slug", "revisions", "editor" ),
    "public" => false,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "has_archive" => false,
    "show_in_menu" => true,
    "menu_icon" => 'dashicons-screenoptions',
    "menu_position" => 3,
    "exclude_from_search" => true,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
  );
  register_post_type( "gloabal_layouts", $args );
});