<?php get_header(); ?>
<?php if (current_user_can('administrator')) {
  update_field('reason_for_rejection', $_POST["reason_for_rejection"], $_POST["id"]);
}
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
        <p class="text-3xl text-center mb-6">The following submission has been rejected:</p>
        <div class="max-w-4xl w-full mx-auto">
          <h1 class="text-pink text-center mb-6"><?php echo $_POST['id']; ?></h1>
          <div class="max-w-4xl mx-auto mb-4">
          <p class="-bold">Reason for rejection:</p>
          <p class="mb-6"><?php echo $_POST['reason_for_rejection']; ?></p>
          </div>
        </div>
        <?php if (current_user_can('author')) : ?>
          <a href="/restaurant-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
        <?php elseif (current_user_can('contributor')) : ?>
          <a href="/contributor-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
        <?php else : ?>
          <a href="/admin-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
        <?php endif; ?>
      </div>
    </article>
  </section>


</main>
<?php get_footer(); ?>