<?php
/**
 * Test Block template.
 *
 * @param array $block The block settings and attributes.
 */

 // Support custom "anchor" values.
  $anchor = '';
  if ( ! empty( $block['anchor'] ) ) {
  $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
  }

  // Create class attribute allowing for custom "className" and "align" values.
  $class_name = 'slick-slider';
  if ( ! empty( $block['className'] ) ) {
      $class_name .= ' ' . $block['className'];
  }
  if ( ! empty( $block['align'] ) ) {
      $class_name .= ' align' . $block['align'];
  }
  if ( $background_color || $text_color ) {
      $class_name .= ' has-custom-acf-color';
  }

?>

<div id="<?= $block['id'] ?>" class="test-block custom-block">
	<p class="title"></p>
</div>
