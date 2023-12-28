<?php

  // This field is to check for chosen layout only.
  $layout = get_sub_field('global_layout');
  $post_id = $layout->ID;
  $slug = $layout->post_name;

?>

<?php 

  /*
  ** Gets chosen layout and matching file partial name.
  */
  switch($slug):
    case $slug:
      get_template_part('global-layouts/'. $slug, null, array('ID' => $post_id));
      break;
  endswitch;
 ?>