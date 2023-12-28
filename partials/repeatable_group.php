<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $section_id = get_sub_field('section_id');

  $repeater = get_sub_field('repeating_group');

  $random_id = rand(0, 99999);

?>

<section <?php if($section_id): echo 'id="'.$section_id.'"'; endif; ?>  class="repeating-groups-section">
  <div class="<?= $container; ?>">
    <?php if($repeater): ?>
      <div class="d-flex justify-content-evenly">
      <?php foreach($repeater as $row): ?>
        <div class="card" style="width: 18rem;">
          <img src="<?= $row['content_group']['image']['url'] ?>" class="card-img-top" alt="<?= $row['content_group']['image']['alt'] ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $row['content_group']['title'] ?></h5>
            <p class="card-text"><?= $row['content_group']['copy'] ?></p>
            <hr>
            <img src="<?= $row['extras_group']['image']['url'] ?>" class="card-img-top" alt="<?= $row['extras_group']['image']['alt'] ?>">
            <h5 class="card-title"><?= $row['extras_group']['title'] ?></h5>
            <p class="card-text"><?= $row['extras_group']['copy'] ?></p>
            <a href="<?= $row['content_group']['call-to-action']['url'] ?>" class="btn btn-primary"><?= $row['content_group']['call-to-action']['title'] ?></a>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
    <?php endif;?>
  </div>
</section>