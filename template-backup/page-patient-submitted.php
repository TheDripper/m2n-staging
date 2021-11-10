<?php
if (!function_exists('wp_handle_upload')) {
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/media.php');
}
?>
<?php get_header(); ?>
<?php $current_user = wp_get_current_user(); ?>
<?php
$submitted = wp_insert_post(array(
  'post_type' => 'post',
  'post_author' => $current_user->ID,
  'post_status' => 'draft',
  'post_title' => $_POST['post_title']
));
if($_POST['post_message']) {
  update_field('post_message',$_POST['post_message'],$submitted);
}
if($_POST['contributor_number']) {
  update_field('contributor_number',$_POST['contributor_number'],$submitted);
}
if ($_FILES['avatar']) {
  $photo = media_handle_upload('avatar', $submitted);
  set_post_thumbnail($submitted,$photo);
}
?>
<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
        <p class="text-3xl text-center mb-6">The following submission has been sent for approval:</p>
        <h1 class="text-pink text-center mb-6"><?php echo $submitted; ?></h1>
        <div class="max-w-xl mx-auto text-center mb-6"><?php the_content(); ?></div>
        <a href="/contributor-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>