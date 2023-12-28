<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $section_id = get_sub_field('section_id');

  $oembed = get_sub_field('video_url');

  $ratio = get_sub_field('aspect_ratio');

  $classes = get_sub_field('custom_css_classes');

?>

<section <?php if($section_id): echo 'id="'.$section_id.'"'; endif; ?>  class="oembed-section">
  <div class="<?= $container; ?>">
  	<div class="oembed ratio ratio-<?= $ratio ?> <?= $classes ?>">
        <?= $oembed ?>
    </div>
  </div>
</section>