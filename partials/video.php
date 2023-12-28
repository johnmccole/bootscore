<?php

  /* include any ACF fields before the markup.
    ** Remember to use get_sub_field, these are sub-fields
    ** of the layout.
    */

  $container = get_sub_field('container_style');

  $section_id = get_sub_field('section_id');

  $classes = get_sub_field('custom_css_classes');

  $inline = get_sub_field('inline_video');
  $inline_options = '';

  if($inline) {
    $inline_options = 'controls';
  } else {
    $inline_options = 'autoplay muted loop preload';
  }

  $video_source = get_sub_field('video_source');

  $local_video = get_sub_field('local_video');
  $hosted_video = get_sub_field('hosted_video');
  $embeded_video = get_sub_field('embeded_video');

  $video_code = '';

  switch($video_source) {
    case 'local':
      $video_code = '<video class="local-video" playsinline disablePictureInPicture ' .$inline_options.'>
      <source src="'.$local_video['url'].'" type="video/mp4">
      </video>';
      break;
    case 'hosted':
      $video_code = '<video class="hosted-video" playsinline disablePictureInPicture ' .$inline_options.'>
      <source src="'.$hosted_video.'" type="video/mp4">
      </video>';
      break;
    case 'embed':
      // use preg_match to find iframe src
      preg_match('/src="(.+?)"/', $embeded_video, $matches);
      $src = $matches[1];

      $raw_video = get_sub_field('embeded_video', false, false);

      $video_id['v'] = parse_str( parse_url( $raw_video, PHP_URL_QUERY ), $video_id );

      // add extra params to iframe src
      $params = array(
        'autoplay'      => 1,
        'mute'          => 1,
        'controls'      => 0,
        'loop'          => 1,
        'playlist'      => $video_id['v'],
        'playsinline'   => 1,
        'rel'           => 0,
        'background'    => 1
      );

      $new_src = add_query_arg($params, $src);

      $embeded_video = str_replace($src, $new_src, $embeded_video);

      // add extra attributes to iframe html
      $attributes = '';

      $embeded_video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $embeded_video);

      $video_code = '<div class="iframe-holder position-relative d-flex vh-100 w-100 align-items-center justify-content-center" style="overflow: clip; pointer-events: none;">'.$embeded_video.'</div>';
      break;
  }

?>
<style>
  .iframe-holder iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    min-width: 100%;
    max-width: unset;
    height: 120vh;
  }
</style>
<section <?php if($section_id): echo 'id="'.$section_id.'"'; endif; ?> class="video-section">
  <div class="<?= $container; ?> <?= $classes ?>">
    <?= $video_code; ?>
  </div>
</section>