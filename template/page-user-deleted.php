<?php require_once(ABSPATH.'wp-admin/includes/user.php'); ?>
<?php get_header(); ?>
<?php wp_delete_user($_GET["id"]); ?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
    <!-- section -->
    <section>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32">
                        <p class="text-3xl text-center mb-6">The user has been deleted.</p>
                        <a href="/admin-dashboard" class="button py-2 max-w-xs mx-auto invert">RETURN TO DASHBOARD</a>
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