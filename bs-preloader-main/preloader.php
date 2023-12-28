<?php $logo = get_field('logo_main', 'option'); ?>

<div id="preloader" class="align-items-center justify-content-center position-fixed top-0 end-0 bottom-0 start-0 zi-1070">
  <div id="status" class="text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
    <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" class="logo">
  </div>
</div>