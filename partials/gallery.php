<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $section_id = get_sub_field('section_id');

  $content = get_sub_field('content');

  $classes = get_sub_field('custom_css_classes');

?>

<section id="<?= $section_id ?>" class="gallery <?= $classes ?>">
	<div class="<?= $container; ?>">
		<?php if($content['title']): ?>
		<h2 class="h2 mb-3"><?= $content['title'] ?></h2>
		<?php endif; ?>
		<div class="d-flex flex-wrap justify-content-evenly">
		<?php if($content['gallery']): foreach($content['gallery'] as $g): ?>
			<img class="mb-3" src="<?= $g['sizes']['medium'] ?>" alt="<?= $g['alt'] ?>">
		<?php endforeach; endif; ?>
		</div>
	</div>
</section>