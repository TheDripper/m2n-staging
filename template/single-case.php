<?php get_header(); ?>

<main class="bg-back-grey pt-12" role="main" aria-label="Content">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php $id = get_the_ID(); ?>
        <?php $classification = get_the_terms($id, 'classification')[0]->name; ?>
        <?php $aligner_wear_schedule = get_the_terms($id, 'aligner_wear_schedule')[0]->name; ?>
        <?php $level_of_difficulty = get_the_terms($id, 'level_of_difficulty')[0]->name; ?>
        <?php $treatment_technique = get_the_terms($id, 'treatment_technique'); ?>
        <?php $conditions = get_the_terms($id, 'technical_condition'); ?>
        <?php $user = get_current_user_id(); ?>
        <?php $saved = json_decode(get_field('saved', 'user_' . $user)); ?>
        <?php $saved = json_decode(json_encode($saved), true); ?>
        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('pt-12'); ?>>
          <div class="bg-white rounded p-4 pb-24 max-w-6xl mx-auto case-information">
            <div class="flex items-center justify-end w-full py-2">
              <div class="saves flex relative" data-id="<?php the_ID(); ?>">
                <p class="flex">SAVES: <?php echo get_field('saves'); ?></p>
                <?php if ($saved && in_array($id, $saved)) : ?>
                  <img class="drop-save ml-2" src="<?php echo get_template_directory_uri() . '/build/images/HeartActive.svg '; ?>" />
                  <img class="absolute ml-2 save" style="opacity:0;pointer-events:none;" src="<?php echo get_template_directory_uri() . '/build/images/Heart.svg '; ?>" />
                <?php else : ?>
                  <img class="drop-save ml-2" style="opacity:0;pointer-events:none;" src="<?php echo get_template_directory_uri() . '/build/images/HeartActive.svg '; ?>" />
                  <img class="absolute ml-2 save" src="<?php echo get_template_directory_uri() . '/build/images/Heart.svg '; ?>" />
                <?php endif; ?>
              </div>
              <div id="share" class="ml-4 flex relative" data-id="<?php the_ID(); ?>">
                <p class="flex">SHARE</p>
                <img class="ml-2" src="<?php echo get_template_directory_uri() . '/build/images/Share.svg '; ?>" />
              </div>
            </div>
            <div class="wp-block-columns">

              <div class="wp-block-column" style="flex:33.333%">
                <div class="case-images flex flex-col">
                  <div class="hidden active flex items-center justify-center">
                    <img src="<?php the_post_thumbnail_url(); ?>" />
                  </div>
                  <div class="active flex items-center justify-start mb-6">
                    <div class="wp-block-group before-after-slider">
                      <div class="wp-block-group__inner-container">
                        <figure class="wp-block-image size-full is-resized"><img loading="lazy" src="<?php echo get_field('after_image'); ?>" alt="" class="wp-image-60" width="592" height="392"></figure>
                        <figure class="wp-block-image size-full is-resized"><img loading="lazy" src="<?php echo get_field('before_image'); ?>" alt="" class="wp-image-60" width="592" height="392" style="max-width: none; width: 492px; height: 325.781px;"></figure>
                      </div>
                    </div>
                  </div>
                  <div class="thumbs flex justify-start items-center ml-2" style="flex: 16.66666%">
                    <?php if (get_field('case_images')) : ?>
                      <?php foreach (get_field('case_images') as $case_image) : ?>
                        <div class="case-image w-1/5 flex items-center mx-2 rounded">
                          <img class="cursor-pointer" src="<?php echo $case_image['url']; ?>" />
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="resources p-4">
                  <h3 class="mb-6">Resources</h3>
                  <h4>Before Photos</h4>
                  <ul>
                    <li><a href="<?php echo get_field('before_occluded_buccal_view_of_anterior')['url']; ?>">Occluded buccal view of anterior</a></li>
                    <li><a href="<?php echo get_field('before_occluded_buccal_view_of_right_lateral')['url']; ?>">Occluded buccal view of right lateral</a></li>
                    <li><a href="<?php echo get_field('before_occluded_buccal_view_of_left_lateral')['url']; ?>">Occluded buccal view of left lateral</a></li>
                    <li><a href="<?php echo get_field('before_occlusal_view_of_upper')['url']; ?>">Occlusal view of upper</a></li>
                    <li><a href="<?php echo get_field('before_occlusal_view_of_lower')['url']; ?>">Occlusal view of lower</a></li>
                  </ul>
                  <h4>After Photos</h4>
                  <ul>
                    <li><a href="<?php echo get_field('after_occluded_buccal_view_of_anterior')['url']; ?>">Occluded buccal view of anterior</a></li>
                    <li><a href="<?php echo get_field('after_occluded_buccal_view_of_right_lateral')['url']; ?>">Occluded buccal view of right lateral</a></li>
                    <li><a href="<?php echo get_field('after_occluded_buccal_view_of_left_lateral')['url']; ?>">Occluded buccal view of left lateral</a></li>
                    <li><a href="<?php echo get_field('after_occlusal_view_of_upper')['url']; ?>">Occlusal view of upper</a></li>
                    <li><a href="<?php echo get_field('after_occlusal_view_of_lower')['url']; ?>">Occlusal view of lower</a></li>
                  </ul>
                  <h4>Progress Photos</h4>
                  <ul>
                    <li><a href="<?php echo get_field('progress_occluded_buccal_view_of_anterior')['url']; ?>">Occluded buccal view of anterior</a></li>
                    <li><a href="<?php echo get_field('progress_occluded_buccal_view_of_right_lateral')['url']; ?>">Occluded buccal view of right lateral</a></li>
                    <li><a href="<?php echo get_field('progress_occluded_buccal_view_of_left_lateral')['url']; ?>">Occluded buccal view of left lateral</a></li>
                    <li><a href="<?php echo get_field('progress_occlusal_view_of_upper')['url']; ?>">Occlusal view of upper</a></li>
                    <li><a href="<?php echo get_field('progress_occlusal_view_of_lower')['url']; ?>">Occlusal view of lower</a></li>
                  </ul>
                  <h4>Radiographs</h4>
                  <ul>
                    <li><a href="<?php echo get_field('before_panoramic_x-ray')['url']; ?>">Before - Panoramic X-ray</a></li>
                    <li><a href="<?php echo get_field('before_cephalometric_x-ray')['url']; ?>">Before - Cephalometric X-ray</a></li>
                    <li><a href="<?php echo get_field('after_panoramic_x-ray')['url']; ?>">After - Panoramic X-ray</a></li>
                    <li><a href="<?php echo get_field('after_cephalometric_x-ray')['url']; ?>">After - Cephalometric X-ray</a></li>
                  </ul>
                  <h4>Downloads</h4>
                  <ul>
                    <li><a href="<?php echo get_field('downloads'); ?>">Downloads</a></li>
                  </ul>


                  <div class="modal">
                    <h2 class="text-pink ml-2">Before Treatment</h2>
                    <div class="flex flex-wrap mb-12">
                      <img src="<?php echo get_field('before_occluded_buccal_view_of_anterior')['url']; ?>" />
                      <img src="<?php echo get_field('before_occluded_buccal_view_of_right_lateral')['url']; ?>" />
                      <img src="<?php echo get_field('before_occluded_buccal_view_of_left_lateral')['url']; ?>" />
                      <img src="<?php echo get_field('before_occlusal_view_of_upper')['url']; ?>" />
                      <img src="<?php echo get_field('before_occlusal_view_of_lower')['url']; ?>" />
                    </div>
                    <h2 class="text-pink ml-2">Progress - 2 weeks</h2>
                    <div class="flex flex-wrap mb-12">

                      <img src="<?php echo get_field('progress_occluded_buccal_view_of_anterior')['url']; ?>" />
                      <img src="<?php echo get_field('progress_occluded_buccal_view_of_right_lateral')['url']; ?>" />
                      <img src="<?php echo get_field('progress_occluded_buccal_view_of_left_lateral')['url']; ?>" />
                      <img src="<?php echo get_field('progress_occlusal_view_of_upper')['url']; ?>" />
                      <img src="<?php echo get_field('progress_occlusal_view_of_lower')['url']; ?>" />
                    </div>

                    <h2 class="text-pink ml-2">After Treatment</h2>
                    <div class="flex flex-wrap mb-12">

                      <img src="<?php echo get_field('after_occluded_buccal_view_of_anterior')['url']; ?>" />
                      <img src="<?php echo get_field('after_occluded_buccal_view_of_right_lateral')['url']; ?>" />
                      <img src="<?php echo get_field('after_occluded_buccal_view_of_left_lateral')['url']; ?>" />
                      <img src="<?php echo get_field('after_occlusal_view_of_upper')['url']; ?>" />
                      <img src="<?php echo get_field('after_occlusal_view_of_lower')['url']; ?>" />
                    </div>


                    <h2 class="text-pink ml-2">Treatment Setup</h2>
                    <video src="<?php the_field('treatment_setup'); ?>"></video>

                    <div class="cephalometric">
                      <h2 class="text-pink ml-2">Cephalometric Radiographs</h2>
                      <div class="flex justify-center">
                        <div class="flex flex-col justify-start">
                          <p class="font-bold mb-1 text-h5-grey ml-2">Before</p>
                          <img src="<?php echo get_field('before_cephalometric_x-ray')['url']; ?>" />
                        </div>
                        <div class="flex flex-col justify-start">
                          <p class="font-bold mb-1 text-h5-grey ml-2">After</p>
                          <img src="<?php echo get_field('after_cephalometric_x-ray')['url']; ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="panoramic">
                      <h2 class="text-pink ml-2 mt-12">Panoramic Radiographs</h2>
                      <p class="font-bold mb-1 text-h5-grey ml-2">Before</p>
                      <img class="ml-2" src="<?php echo get_field('before_panoramic_x-ray')['url']; ?>" />
                      <p class="font-bold mb-1 mt-4  ml-2 text-h5-grey">After</p>
                      <img class="ml-2" src="<?php echo get_field('after_panoramic_x-ray')['url']; ?>" />
                    </div>

                  </div>

                </div>
              </div>
              <div class="wp-block-column" style="flex:66.666%">
                <h2 class="text-pink mb-4 mt-6">Case Information</h2>
                <?php $id = get_the_ID(); ?>
                <?php $author = get_the_author_meta('id'); ?>
                <?php $age = get_field("age", "user_$author"); ?>
                <?php $gender = get_field("gender", "user_$author"); ?>
                <div class="case-details">
                  <div class="case-detail">
                    <label class="text-h5-grey uppercase text-xs font-bold">contributor</label>
                    <p><?php echo $age . ', ' . $gender; ?></p>
                  </div>
                  <div class="case-detail">

                    <label class="text-h5-grey uppercase text-xs font-bold"># of Aligner Sets</label>
                    <p>5 sets</p>
                  </div>

                  <div class="case-detail">

                    <label class="text-h5-grey uppercase text-xs font-bold">Submission ID</label>
                    <p><?php the_ID(); ?></p>
                  </div>

                  <div class="case-detail">
                    <label class="text-h5-grey uppercase text-xs font-bold">Wear Schedule</label>
                    <p><?php echo $aligner_wear_schedule; ?></p>
                  </div>
                  <div class="case-detail">
                    <label class="text-h5-grey uppercase text-xs font-bold">Total Treatment Time</label>
                    <p>6.5 months</p>
                  </div>
                  <div class="case-detail">

                    <label class="text-h5-grey uppercase text-xs font-bold">Classification</label>
                    <p><?php echo $classification; ?></p>
                  </div>

                  <div class="case-detail">

                    <label class="text-h5-grey uppercase text-xs font-bold">Submitted</label>
                    <p><?php echo get_the_date(); ?></p>
                  </div>

                  <div class="case-detail">

                    <label class="text-h5-grey uppercase text-xs font-bold">Level of Difficulty</label>
                    <p><?php echo $level_of_difficulty; ?></p>
                  </div>

                  <div class="case-detail">
                    <label class="text-h5-grey uppercase text-xs font-bold">Treatment Option</label>
                    <p><?php echo $treatment_technique[0]->name; ?>
                  </div>

                </div>
                <label class="text-h5-grey uppercase text-xs font-bold">Clinical Conditions</label>
                <ul class="list">
                  <?php if ($conditions) : ?>
                    <?php foreach ($conditions as $condition) : ?>
                      <li><?php echo $condition->name; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <?php if (get_field('restaurant')) : ?>
                  <div class="restaurant-card border border-grey rounded mt-6">
                    <?php get_template_part('content', 'restaurant'); ?>
                  </div>
                <?php endif;  ?>
                <?php
                $user = wp_get_current_user();
                if (in_array('administrator', (array) $user->roles)) :
                ?>
                  <div class="treatment-details">
                    <h3 class="text-pink mt-12">Treatment Details</h3>
                    <label class="text-h5-grey uppercase text-xs font-bold">Clinical Conditions</label>
                    <ul class="list">
                      <?php foreach ($conditions as $condition) : ?>
                        <li><?php echo $condition->name; ?>
                        <?php endforeach; ?>
                    </ul>
                    <label class="text-h5-grey uppercase text-xs font-bold">Treatment Techniques</label>
                    <ul class="list">
                      <?php foreach ($treatment_technique as $technique) : ?>
                        <li><?php echo $technique->name; ?>
                        <?php endforeach; ?>
                    </ul>
                    <label class="text-h5-grey uppercase text-xs font-bold">Aligner Material</label>
                    <p><?php the_field('aligner_material'); ?></p>
                    <label class="text-h5-grey uppercase text-xs font-bold">Submission materials</label>
                    <p><?php the_field('submissions_materials'); ?></p>

                    <label class="text-h5-grey uppercase text-xs font-bold">Comments</label>
                    <p><?php the_field('comments'); ?></p>

                    <label class="text-h5-grey uppercase text-xs font-bold"># of Revisions</label>
                    <p><?php the_field('#_of_revisions'); ?></p>

                    <label class="text-h5-grey uppercase text-xs font-bold">Reason for revision(s)</label>
                    <p><?php the_field('reason_for_revisions'); ?></p>

                    <label class="text-h5-grey uppercase text-xs font-bold">Reason for revision(s)</label>
                    <p><?php the_field('other_products_used'); ?></p>

                    <label class="text-h5-grey uppercase text-xs font-bold">Type of Retention</label>
                    <p><?php the_field('type_of_retention'); ?></p>

                    <label class="text-h5-grey uppercase text-xs font-bold">Results Achieved</label>
                    <p><?php the_field('results_achieved'); ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php
          $banner_ad = get_post(324);
          $content = $banner_ad->post_content;
          $content = apply_filters('the_content', $content);
          $content = str_replace(']]>', ']]>', $content);
          ?>
          <section class="banner-ad max-w-6xl mx-auto my-6">
            <?php echo $content; ?>
          </section>
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