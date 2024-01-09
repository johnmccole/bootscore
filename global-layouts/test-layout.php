<?php 

	// Get the post ID
	$part_id = $args['ID'];

	/* Register ACF Fields here.
	** Since this isn't part of Page Builder
	** use get_field() for field names.
	** $part_id MUST be used as an argument
	** to get the fields from the correct post.
	** Duplicate and update this partial as required
	*/ 
	$content = get_field('content', $part_id);
	$custom_classes = get_field('custom_classes', $part_id);

	// Setup any hardcoded classes required.
	$classes = array(
		'test-1',
		'test-2',
	);
	$classes[] = $custom_classes;
	$c = implode(' ', $classes);

?>

<section id="test-layout" class="test-layout <?= $c ?>">
	<div class="container">
		<?= $content; ?>
	</div>
</section>