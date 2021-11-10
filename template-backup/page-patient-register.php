<?php get_header(); ?>


<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="restaurant-registration bg-white my-12 max-w-6xl mx-auto py-12">
            <h2 class="text-pink text-center mb-16">contributor Registration</h2>
            <form id="contributor-register" action="/contributor-created" method="POST">
              <label class="text-h5-grey uppercase text-xs font-bold">Email</label>
              <input type="email" name="email" />
              <label class="text-h5-grey uppercase text-xs font-bold">Password</label>
              <input type="password" name="password" />
              <label class="text-h5-grey uppercase text-xs font-bold">Repeat Password</label>
              <input type="password" name="repeat-password" />
              <div class="flex items-center max-w-xl">
                <div class="check-style-wrap">
                  <input class="checkbox" type="checkbox" name="terms-conditions" />
                </div>
                <div class="flex">
                  <div class="checkbox"></div>
                  <div class="flex flex-col">
                    <p>I confirm that I have read and agree to the ClearCorrect Case Gallery <a href="/restaurant-consent-agreement">restaurant Consent Agreement</a></p>
                  </div>
                </div>
              </div>
              <input type="submit" class="w-full max-w-xs bg-pink text-white text-sm uppercase mx-auto rounded my-12 py-4 font-bold" value="SUBMIT" />
              <a class="text-center mb-4" href="/login">I already have an account.</a>
              <a class="text-center" href="/restaurant-register">Switch to restaurant registration.</a>
            </form>
          </div>


          <?php edit_post_link(); ?>

        </article>
        <!-- /article -->

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