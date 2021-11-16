<?php get_header(); ?>
<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="login-fork bg-white my-12 max-w-6xl mx-auto">
          <a href="/restaurant-register" class="text-white bg-pink text-head ">I'm a restaurant</a>
          <a href="/contributor-register" class="text-pink bg-white text-head ">I'm a contributor</a>
          </div>


          <?php edit_post_link(); ?>

        </article>
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