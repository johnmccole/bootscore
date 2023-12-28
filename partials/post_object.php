<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $section_id = get_sub_field('section_id');

  $selected_posts = get_sub_field('selected_posts');

  $slick = get_sub_field('use_slick');

  $isotope = get_sub_field('use_isotope');

  $classes = get_sub_field('custom_css_classes');

?>

<section <?php if($section_id): echo 'id="'.$section_id.'"'; endif; ?>  class="post-objects-section">
  <div class="<?= $container; ?>">
    <?php if($isotope): ?>
    <?php get_template_part('partials/category-filters-sort'); ?>
    <?php endif; ?>
  	<div class="posts <?php if($isotope): echo 'grid'; endif; ?> d-flex justify-content-evenly <?= $classes ?>" <?php if($slick): echo 'data-id="slick-post-objects"'; endif; ?>>
    <?php if($selected_posts): foreach($selected_posts as $post): setup_postdata($post); ?>
      <?php $terms = get_the_category($post->ID); ?>
    	<div class="card <?php foreach($terms as $term): echo ' ' . $term->slug; endforeach; ?>" style="width: 18rem;">
		  <img src="<?= the_post_thumbnail_url() ?>" class="card-img-top" alt="<?= the_title() ?> Featured Image">
		  <div class="card-body">
		    <h5 class="card-title"><?= the_title() ?></h5>
		    <p class="card-text"><?= the_excerpt($post->ID); ?></p>
		    <a href="<?= the_permalink() ?>" class="btn btn-primary stretched-link">View Post</a>
		  </div>
		</div>
    <?php endforeach; wp_reset_postdata(); endif; ?>
	</div>
  </div>
</section>