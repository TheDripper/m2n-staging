<?php get_header(); ?>


<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="restaurant-registration bg-white my-12 max-w-6xl mx-auto py-12">
            <h2 class="text-pink text-center mb-16">restaurant Registration</h2>
            <form action="/restaurant-created" method="POST">
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Email</label>
                  <input type="email" name="email" />
                  <label class="text-h5-grey uppercase text-xs font-bold">Password</label>
                  <input type="password" name="password" />
                  <label class="text-h5-grey uppercase text-xs font-bold">Repeat Password</label>

                  <input type="password" name="repeat-password" />
                  <label class="text-h5-grey uppercase text-xs font-bold">ClearCorrect User Number</label>

                  <input type="text" name="user-number" />
                  <label class="text-h5-grey uppercase text-xs font-bold">Practice Country</label>
                  <div class="select">
                    <select name="term_country">
                      <?php foreach (get_terms('country', array('hide_empty' => false)) as $term) : ?>
                        <option value=<?php $term->slug; ?>><?php echo $term->name; ?></option>
                      <?php endforeach;  ?>
                    </select>
                  </div>
                </div>

                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">First Name</label>
                  <input type="text" name="first_name" />
                  <label class="text-h5-grey uppercase text-xs font-bold">Last Name</label>
                  <input type="text" name="last_name" />
                  <label class="text-h5-grey uppercase text-xs font-bold">Degree</label>
                  <div class="select">
                    <select name="degree">
                      <option value="Make Selection">Make Selection</option>
                      <option value="One">One</option>
                      <option value="Two">Two</option>
                    </select>
                  </div>
                  <label class="text-h5-grey uppercase text-xs font-bold">Specialty</label>
                  <div class="select">
                    <select name="specialty">
                      <option value="Make Selection">Make Selection</option>
                      <option value="One">One</option>
                      <option value="Two">Two</option>
                    </select>
                  </div>
                  <label class="text-h5-grey uppercase text-xs font-bold">Practice State or Province</label>
                  <div class="select">

                    <select name="practice-state">
                      <option>Make Selection</option>
                      <option>One</option>
                      <option>Two</option>
                    </select>
                  </div>

                </div>
              </div>
              <div class="max-w-4xl w-full mx-auto flex flex-col">
                <div class="flex items-center mb-4">
                  <div class="check-style-wrap">

                    <input class="checkbox" type="checkbox" name="terms-conditions" />
                  </div>

                  <div class="flex">
                    <div class="checkbox"></div>
                    <div class="flex flex-col">
                      <p>I confirm that I have read and agree to the ClearCorrect Case Gallery <a class="block" href="/terms-conditions">Terms & Conditions</a></p>
                    </div>
                  </div>
                </div>
                <div class="flex items-center">
                  <div class="check-style-wrap">
                    <input class="checkbox" type="checkbox" name="terms-conditions" />
                  </div>
                  <div class="flex">
                    <div class="checkbox"></div>
                    <div class="flex flex-col">
                      <p>I confirm that I have read and agree to the ClearCorrect Case Gallery <a class="block" href="/restaurant-consent-agreement">restaurant Consent Agreement</a></p>
                    </div>
                  </div>
                </div>
                <input type="submit" class="w-full max-w-xs bg-pink text-white text-sm uppercase mx-auto rounded my-12 py-4 font-bold" value="SUBMIT" />
                <a class="text-center mb-4" href="/login">I already have an account.</a>
                <a class="text-center" href="/contributor-register">Switch to contributor login.</a>
              </div>

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