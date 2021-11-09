<?php
if (!function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
}
$args = array(
    'author'        =>  $current_user->ID,
    'orderby' => 'post_date',
    'order'         =>  'ASC',
    'posts_per_page' => 1,
    'post_type' => 'restaurant',
    'post_status' => 'any'
);
$restaurant = get_posts($args)[0];
if ($_FILES['avatar'] && isset($_FILES['avatar']['name'])) {
    $photo = media_handle_upload('avatar', $restaurant->ID);
    set_post_thumbnail($restaurant->ID, $photo);
}
?>
<?php
if ($_POST['first_name'] || $_POST['last_name'] || $_POST['user_email']) {
    wp_update_user(array(
        'ID' => $current_user->ID,
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'user_email' => $_POST['user_email']
    ));
}
$updated_user = get_user_by('ID', $current_user->ID);
unset($_POST['first_name']);
unset($_POST['last_name']);
unset($_POST['email']);
unset($_POST['user_number']);
unset($_POST['user_email']);
foreach ($_POST as $key => $value) {
    if (strpos($key, 'term_') === 0) {
        wp_set_object_terms($restaurant->ID, $value, substr($key, 5));
    } else {
        update_field($key, $value, $restaurant->ID);
    }
}
?>
<?php get_header(); ?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
    <!-- section -->
    <section>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
                        <p class="text-3xl text-center mb-6">Your profile information has been saved.</p>
                        <?php if (current_user_can('author')) : ?>
                            <a href="/restaurant-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
                        <?php else : ?>
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