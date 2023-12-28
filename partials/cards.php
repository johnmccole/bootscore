<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $section_id = get_sub_field('section_id');

  $cards = get_sub_field('cards');

  $random_id = rand(0, 99999);

  $classes = get_sub_field('custom_css_classes');

?>

<section <?php if($section_id): echo 'id="'.$section_id.'"'; endif; ?>  class="cards-section">
  <div class="<?= $container; ?>">
  	<div class="cards d-flex <?= $classes ?>">
    <?php if($cards): foreach($cards as $card): ?>
    	<div class="card" style="width: 18rem;">
      <?php if($card['image']): ?>
		    <img src="<?= $card['image']['url']; ?>" class="card-img-top" alt="<?= $card['image']['alt']; ?>">
      <?php endif; ?>
		  <div class="card-body">
		    <h5 class="card-title"><?= $card['title']; ?></h5>
		    <p class="card-text"><?= $card['text']; ?></p>
		    <?php if($card['button']['url']): ?>
		    <a href="<?= $card['button']['url']; ?>" class="btn btn-primary" target="<?= $card['button']['target']; ?>"><?= $card['button']['title']; ?></a>
			<?php endif; ?>
		  </div>
		</div>
    <?php endforeach; endif; ?>
	</div>
  </div>
</section>