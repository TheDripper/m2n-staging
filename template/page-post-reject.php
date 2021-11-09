<?php get_header(); ?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php $id = $_GET["id"]; ?>
        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6 py-32 reject-post">
            <div class="max-w-4xl mx-auto">
              <p class="text-4xl text-center mb-6 font-body">You are rejecting restaurant post:</p>
              <h1 class="text-pink text-6xl text-center mb-6"><?php echo $id; ?></h1>
              <p class="text-center mb-6">Please enter your comments below for why this post is being rejected. Once completed the post will be rejected within the system and the message provided to the post submitter.</p>
              <form action="/case-rejected" method="POST">
              <label class="text-h5-grey uppercase text-xs font-bold cursor-pointer sorting">Message</label>
              <textarea class="mb-6 pt-2" name="reason_for_rejection" placeholder="Reason for rejection..."></textarea>
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="submit" class="w-full button py-2 mb-4 max-w-xs mx-auto " value="REJECT POST">
              <a href="/restaurant-dashboard" class="button py-2 max-w-xs mx-auto invert">CANCEL</a>
              </form>
            </div>
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