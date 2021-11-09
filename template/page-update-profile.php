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
$args = array(
  'author'        =>  $current_user->ID,
  'orderby' => 'post_date',
  'order'         =>  'ASC',
  'posts_per_page' => 1,
  'post_type' => 'restaurant',
  'post_status' => 'any'
);
$restaurant = get_posts($args)[0];
?>

<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="restaurant-registration bg-white my-12 max-w-6xl mx-auto py-12">
            <h2 class="text-pink text-center mb-16">Update Profile</h2>
            <form enctype="multipart/form-data" action="/profile-updated" method="POST">
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Email</label>
                  <input type="email" name="user_email" value="<?php echo $current_user->user_email; ?>" />
                </div>
                <div class="wp-block-column flex flex-col"">
                  <label class=" text-h5-grey uppercase text-xs font-bold">ClearCorrect User Number</label>
                  <input type="text" name="user_number" value="<?php echo $current_user->ID; ?>" />
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">First Name</label>
                  <input type="text" name="first_name" value="<?php echo $current_user->first_name; ?>" />

                </div>
                <div class="wp-block-column flex flex-col"">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Last Name</label>
                  <input type="text" name="last_name" value="<?php echo $current_user->last_name; ?>" />

                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Degree</label>
                  <div class="select">
                    <select name="degree">
                      <option <?php if (get_field('degree', $restaurant->ID) == 'Make Selection') echo 'selected'; ?> value="Make Selection">Make Selection</option>
                      <option <?php if (get_field('degree', $restaurant->ID) == 'One') echo 'selected'; ?>value="One">One</option>
                      <option <?php if (get_field('degree', $restaurant->ID) == 'Two') echo 'selected '; ?>value="Two">Two</option>
                    </select>
                  </div>
                </div>
                <div class="wp-block-column flex flex-col">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Specialty</label>
                  <div class="select">

                    <select name="specialty">
                      <option <?php if (get_field('specialty', $restaurant->ID) == 'Make Selection') echo 'selected '; ?> value="Make Selection">Make Selection</option>
                      <option <?php if (get_field('specialty', $restaurant->ID) == 'One') echo 'selected '; ?>value="One">One</option>
                      <option <?php if (get_field('specialty', $restaurant->ID) == 'Two') echo 'selected  '; ?>value="Two">Two</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="flex items-center max-w-4xl mx-auto avatar">
                <?php
                $photo = get_the_post_thumbnail_url($restaurant->ID);
                if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com/wp-content/uploads/2021/01/avatar.png';
                ?>
                <div class="edit-img-frame">
                  <img src="<?php echo $photo; ?>" />
                </div>
                <div class="flex flex-col">
                  <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
                  <label class="text-h5-grey uppercase text-xs font-bold">Profile Image (Optional)</label>
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Practice Country</label>
                  <?php $active_terms = (array) wp_get_object_terms($restaurant->ID, 'country')[0]; ?>
                  <div class="select">
                    <select name="term_country">
                      <?php foreach (get_terms('country', array('hide_empty' => false)) as $term) : ?>
                        <?php $selected = ''; ?>
                        <?php if (in_array($term->name, $active_terms, true)) : ?>
                          <?php $selected = 'selected '; ?>
                        <?php endif; ?>
                        <option value="<?php echo $term->slug; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="wp-block-column flex flex-col"">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Practice Province/State</label>
                  <div class="select">

                    <select name="practice-state">
                      <option <?php if (get_field('practice-state', $restaurant->ID) == 'Make Selection') echo 'selected '; ?> value="Make Selection">Make Selection</option>
                      <option <?php if (get_field('practice-state', $restaurant->ID) == 'One') echo 'selected '; ?>value="One">One</option>
                      <option <?php if (get_field('practice-state', $restaurant->ID) == 'Two') echo 'selected '; ?>value="Two">Two</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Address (Optional)</label>
                  <input type="text" name="address_1" value="<?php the_field('address_1', $restaurant->ID); ?>" />

                </div>
                <div class="wp-block-column flex flex-col"">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Second Address(Optional)</label>
                  <input type="text" name="address_2" value="<?php the_field('address_2', $restaurant->ID); ?>" />
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">City (Optional)</label>
                  <input type="text" name="city" value="<?php the_field('city', $restaurant->ID); ?>" />

                </div>
                <div class="wp-block-column flex flex-col"">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Zip/Postal Code (Optional)</label>
                  <input type="text" name="zip" value="<?php the_field('zip', $restaurant->ID); ?>" />
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Practice Email (Optional)</label>
                  <input type="email" name="practice_email" value="<?php the_field('practice_email', $restaurant->ID); ?>" />

                </div>
                <div class="wp-block-column flex flex-col"">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Phone (optional)</label>
                  <input type="text" name="phone" value="<?php the_field('phone', $restaurant->ID); ?>" />
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Website (Optional)</label>
                  <input type="text" name="website" value="<?php the_field('website', $restaurant->ID); ?>" />

                </div>
                <div class="wp-block-column flex flex-col">
                </div>
              </div>






          </div>


          </div>
          </div>
          <div class=" max-w-4xl w-full mx-auto flex flex-col">

            <input type="submit" class="w-full max-w-xs bg-pink text-white text-sm uppercase mx-auto rounded my-12 py-4 font-bold" value="SUBMIT" />
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