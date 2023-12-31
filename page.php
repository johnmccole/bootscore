<?php



/**

 * The template for displaying all pages

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site may use a

 * different template.

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package Bootscore

 */

$id = get_the_ID();

$layouts = get_field('layouts');



get_header();

?>



  <div id="content" class="site-content <?php /* echo bootscore_container_class(); */ ?> mt-5">

    <div id="primary" class="content-area">



      <!-- Hook to add something nice -->

      <?php bs_after_primary(); ?>


      <?php 
      /*
      <div class="row">

        <div class="<?= bootscore_main_col_class(); ?>">
      */ ?>


          <main id="main" class="site-main">


            <?php /*

            <header class="entry-header">

              <?php the_post(); ?>

              <h1><?php the_title(); ?></h1>

              <?php bootscore_post_thumbnail(); ?>

            </header>

            */ ?>



            <div class="entry-content">

              <?php the_content(); ?>

              <?php

                // set up layout options.
                // layout include template partials.

                // Check layouts exist
                if( have_rows('layouts', $id) ):

                  // Loop through rows.
                  while ( have_rows('layouts', $id) ) : the_row();

                    get_template_part('partials/' . get_row_layout());

                  endwhile;

                endif;

              ?>

            </div>



            <footer class="entry-footer">

              <?php comments_template(); ?>

            </footer>



          </main>



        </div>

        <?php // get_sidebar(); ?>

      </div>



    </div>

  </div>



<?php

get_footer();

