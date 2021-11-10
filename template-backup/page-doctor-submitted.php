<?php
if (!function_exists('wp_handle_upload')) {
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/media.php');
}
?>
<?php get_header(); ?>
<?php
$submitted = wp_insert_post(array(
  'post_type' => 'case',
  'post_author' => $current_user->ID,
  'post_status' => 'draft',
  'post_title' => $_POST['contributor_case_number']
));
if (!empty($_FILES)) {
  foreach ($_FILES as $field => $file) {
    if ($file["name"]) {
      $photo = media_handle_upload($field, $submitted);
      update_field($field, $photo, $submitted);
    }
  }
}
foreach ($_POST as $key => $value) {
  if (strpos($key, 'term_') === 0) {
    wp_set_object_terms($submitted, $value, substr($key, 5));
  } else {
    update_field($key, $value, $submitted);
  }
}
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
        <p class="text-3xl text-center mb-6">The following submission has been sent for approval:</p>
        <h1 class="text-pink text-center mb-6"><?php echo $submitted; ?></h1>
        <div class="max-w-xl mx-auto text-center mb-6"><?php the_content(); ?></div>
        <?php if(current_user_can('author')): ?>
          <a href="/restaurant-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
          <?php else: ?>
            <a href="/contributor-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
            <?php endif; ?>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>