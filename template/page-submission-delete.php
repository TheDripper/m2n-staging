<?php get_header(); ?>
<?php if(get_current_user_id() == get_post($_GET['id'])->post_author) {
  wp_delete_post($_GET['id']);
}
 ?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
          <p class="text-3xl text-center mb-6">Your submission has been deleted.</p>
          <p class="max-w-xl mx-auto text-center mb-6">If the submission is currently on the ClearCorrect website 
it will be removed within 2 business days.</p>
          <?php if(current_user_can('author')): ?>
          <a href="/restaurant-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
          <?php else: ?>
            <a href="/contributor-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
            <?php endif; ?>
        </div>
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