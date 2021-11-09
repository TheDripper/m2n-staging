<?php get_header(); ?>
<?php $display_name = $_POST['first_name'] . $_POST['last_name']; ?>
<?php $args = array(
  'user_login' => $_POST['email'],
  'user_email' => $_POST['email'],
  'user_pass' => $_POST['password'],
  // 'user_number'=>$_POST['user-number'],
  'first_name' => $_POST['first_name'],
  'last_name' => $_POST['last_name'],
  'role' => 'author',
  'display_name' => $display_name
); ?>
<?php
$new_doc = wp_insert_user($args);
$args = array(
  'post_type' => 'restaurant',
  'post_author' => $new_doc,
  'post_title' => $display_name
);
$restaurant = wp_insert_post($args);
unset($_POST['first_name']);
unset($_POST['last_name']);
unset($_POST['email']);
unset($_POST['user_number']);
unset($_POST['user_email']);
foreach ($_POST as $key => $value) {
  if (strpos($key, 'term_') === 0) {
      wp_set_object_terms($restaurant, $value, substr($key, 5));
  } else {
      update_field($key, $value, $restaurant);
  }
}
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
            <a href="/restaurant-login" class="button py-2 max-w-xs mx-auto invert">LOGIN</a>
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