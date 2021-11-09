<?php get_header(); ?>
<?php if (current_user_can('administrator')) {
  wp_publish_post($_GET['id']);
}
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
        <p class="text-3xl text-center mb-6">The following submission has been sent for approval:</p>
        <h1 class="text-pink text-center mb-6"><?php echo $_GET['id']; ?></h1>
        <div class="max-w-xl mx-auto text-center mb-6"><?php the_content(); ?></div>
        <?php if (current_user_can('author')) : ?>
          <a href="/restaurant-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
        <?php elseif(current_user_can('contributor')) : ?>
          <a href="/contributor-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
          <?php else: ?>
          <a href="/admin-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
        <?php endif; ?>
      </div>
    </article>
  </section>


</main>
<?php get_footer(); ?>