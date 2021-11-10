<?php get_header(); ?>
<?php 
  $created = wp_insert_user(array(
    'user_email'=>$_POST['email'],
    'user_login'=>$_POST['email'],
    'user_pass'=>$_POST['password'],
    'role'=>'contributor'
  ));
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
          <p class="text-3xl text-center mb-6">Your account has been created.</p>
          <p class="max-w-xl mx-auto text-center mb-6">Please login to create a new submission.</p>
          <a href="/contributor-login" class="button py-2 max-w-xs mx-auto invert">LOGIN</a>
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