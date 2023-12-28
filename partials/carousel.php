<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $random_id = rand(0, 99999);

  $slides = get_sub_field('carousel_slides');

  $autoplay = get_sub_field('autoplay');

  $crossfade = get_sub_field('cross_fade');

  $controls = get_sub_field('include_controls');

  $indicators = get_sub_field('show_indicators');

  $fill_viewport = get_sub_field('fill_viewport');

  $classes = get_sub_field('custom_css_classes');

?>
<section class="carousel-section">
  <div class="<?= $container; ?>">
    <div id="carousel-<?= $random_id ?>" class="carousel slide <?php if($crossfade): echo 'carousel-fade'; endif; ?> <?= $classes ?>" <?php if($autoplay): echo 'data-bs-ride="carousel"'; endif;?>>
      <div class="carousel-indicators">
        <?php $i = 0; foreach($slides as $slide): ?>
          <button type="button" data-bs-target="#carousel-<?= $random_id ?>" data-bs-slide-to="<?= $i; ?>" <?php if($i == 0): echo 'class="active" aria-current="true"'; endif; ?> aria-label="Slide <?= ($i + 1) ?>"></button>
      <?php $i++;  endforeach; ?>
      </div>
      <div class="carousel-inner">
        <?php $i = 0; foreach($slides as $slide): ?>
        <div class="carousel-item <?php if($i == 0): echo 'active'; endif; ?>">
          <?php if($slide['image']): ?>
            <img src="<?= $slide['image']['url'] ?>" class="d-block w-100 <?php if($fill_viewport): echo 'vh-100 object-fit-cover'; endif; ?>" alt="<?= $slide['image']['alt'] ?>">
          <?php endif; ?>
          <div class="carousel-caption d-none d-md-block">
            <h5><?= $slide['title'] ?></h5>
            <?= $slide['content'] ?>
            <?php if($slide['call_to_action']['url']): ?>
              <a href="<?= $slide['call_to_action']['url'] ?>" class="btn btn-primary"><?= $slide['call_to_action']['title'] ?></a>
            <?php endif; ?>
          </div>
        </div>
        <?php $i++;  endforeach; ?>
      </div>
      <?php if($controls): ?>
      <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $random_id ?>" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $random_id ?>" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <?php endif; ?>
    </div>
  </div>
</section>