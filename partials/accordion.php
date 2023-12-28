<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $accordion = get_sub_field('accordion');

  $first_card = get_sub_field('first_card_open');

  $flush = get_sub_field('flush_accordion');
  $flush_class = '';
  if($flush) {
    $flush_class = 'accordion-flush';
  }

  $open = get_sub_field('always_open');

  $random_id = rand(0, 99999);

  $classes = get_sub_field('custom_css_classes');

?>
<section class="accordion-section">
  <div class="<?= $container; ?>">
    <div class="accordion <?= $flush_class; ?> <?= $classes ?>" id="accordion-<?= $random_id; ?>">
      <?php if($accordion): $i = 0; foreach($accordion as $acc): ?>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button <?php if($i != 0): echo 'collapsed'; endif; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $random_id .'-'. $i ?>"  aria-controls="collapse-<?= $random_id .'-'. $i ?>" <?php if($i == 0): echo 'aria-expanded="true"'; else: echo 'aria-expanded="false"'; endif; ?>>
            <?= $acc['accordion_header'] ?>
          </button>
        </h2>
        <div id="collapse-<?= $random_id .'-'. $i ?>" class="accordion-collapse collapse <?php if($first_card && $i == 0): echo 'show'; endif; ?>" <?php if(!$open): echo 'data-bs-parent="#accordion-' . $random_id . '"'; endif; ?>>
          <div class="accordion-body">
            <?= $acc['accordion_body'] ?>
          </div>
        </div>
      </div>
      <?php $i++; endforeach; endif; ?>
    </div>
  </div>
</section>