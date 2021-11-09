<?php get_header(); ?>
<?php $current_user = wp_get_current_user(); ?>
<?php
$args = array(
  'author'        =>  $current_user->ID,
  'orderby' => 'post_date',
  'order'         =>  'ASC',
  'posts_per_page' => -1,
  'post_type' => 'post',
  'post_status' => 'any'
);
$cases = get_posts($args);
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6">
          <h2 class="text-pink mb-6">Messages</h2>
          <table class="datatable w-full">
            <thead>
              <tr>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Received</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Subject</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Message</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cases as $case) : ?>
                <?php $id = $case->ID; ?>
                <?php $status = "Pending";
                $message = "Your submission is pending approval."
                ?>
                <?php if ($case->post_status == "publish") {
                  $status = "Approved";
                  $message = "Thank you for your submission!";
                } else if (get_field('rejected', $case->ID)) {
                  $status = "Rejected";
                  $message = "Please update treatment info with certain...";
                }
                ?>
                <?php $contributor = wp_get_post_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
                <tr class="border-b border-border-grey">
                  <td class="p-4 text-center"><?php echo $case->post_date; ?></td>
                  <td class="p-4 text-center"><?php echo $id; ?></td>
                  <td class="p-4 text-center"><?php echo $status; ?></td>
                  <td class="p-4 text-center"><?php echo $message; ?></td>
                  <td class="p-4 text-center"><a class="text-sm mx-2 delete" href="#">VIEW</a>
                    <div class="modal p-8">
                      <div class="flex message p-12 rounded">
                        <div class="flex flex-col items-end">
                          <label class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Received</label>
                          <label class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Subject</label>
                          <label class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</label>
                          <label class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Message</label>
                        </div>
                        <div class="flex flex-col items-start">
                          <p><?php echo $case->post_date; ?></p>
                          <p class="text-green font-bold"><?php echo $case->ID; ?></p>
                          <p><?php echo $status; ?></p>
                          <p><?php echo $message; ?></p>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
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