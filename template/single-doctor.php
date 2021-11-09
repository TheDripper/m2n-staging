<?php get_header(); ?>

<main class="bg-back-grey py-12" role="main" aria-label="Content">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php $id = get_the_ID(); ?>
        <div class="flex bg-white rounded max-w-6xl mx-auto p-6 my-8
        ">
          <div class="profile-photo mr-6" style="flex:25%">
            <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" />
          </div>
          <div class="flex flex-col" style="flex:75%;">
            <div class="restaurant-details">
              <h2 class="text-pink text-profile-head"><?php the_title(); ?></h2>
              <p><?php the_field('position'); ?></p>
            </div>
            <div class="restaurant-contact my-4 w-full">
              <div class="wp-block-columns">
                <div class="wp-block-column" style="flex:50%;">
                  <h4 class="font-bold">Location</h4>
                    <?php the_field('location'); ?>
                </div>
                <div class="wp-block-column" style="flex:50%;">
                  <h4 class="font-bold">Contact</h4>
                  <?php the_field('contact'); ?>
                </div>
              </div>
            </div>
            <h4 class="font-bold">About <?php the_title(); ?></h4>
            <div class="about">
              <?php the_content(); ?>
            </div>
            <h4 class="font-bold mt-6">Education & Training</h4>
            <div class="education">
              <?php the_field('education'); ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
    <?php get_template_part('content', 'case-list'); ?>
  </section>
</main>
<?php get_footer(); ?>