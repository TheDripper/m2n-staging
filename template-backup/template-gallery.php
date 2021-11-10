<?php // Template Name: Case Gallery 
?>
<?php get_header(); ?>

<main role="main" aria-label="Content">
  <!-- section -->

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <!-- article -->
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_content(); ?>
        <section class="cases-masonry max-w-6xl mx-auto mt-32 flex flex-wrap" data-offset="12">

          <?php $args = array(
            'post_type' => 'post',
            'posts_per_page' => 12,
            'post_status' => 'publish'
          );
          global $post;
          $q = new WP_Query($args);
          while ($q->have_posts()) : $q->the_post(); ?>
            <div class="card feather w-1/4 px-8 mb-6">
              <div class="no-modal">
                <img src="<?php the_post_thumbnail_url(); ?>" />
              </div>
              <div class="modal">
                <img src="<?php the_post_thumbnail_url(); ?>" />
                <div class="flex flex-col items-start p-12">
                  <h1 class="my-6"><?php the_title(); ?></h1>
                  <?php the_content(); ?>
                  <a class="wp-block-button__link mt-6">FIND A PROVIDER</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
          <?php edit_post_link(); ?>
        </section>
        <div id="load-more" class="wp-block-button hollow mb-24 max-w-sm mx-auto"><a class="wp-block-button__link">LOAD MORE</a></div>
      </article>
      <!-- /article -->

    <?php endwhile; ?>

  <?php else : ?>

    <!-- article -->
    <article>

      <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>

    </article>
    <!-- /article -->

  <?php endif; ?>

  </section>
  <!-- /section -->
</main>
<?php get_footer(); ?>