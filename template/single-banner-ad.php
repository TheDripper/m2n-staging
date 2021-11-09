<?php get_header(); ?>

<main class="bg-back-grey pt-12" role="main" aria-label="Content">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    <?php endif ?>
  </section>
  <?php
$banner_ad = get_post(23);
$content = $banner_ad->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]>', $content);
echo $content;
?>
  <section class="banner-ad">
<?php echo $content; ?>
  </section>
</main>
<?php get_footer(); ?>