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
          <div class="flex justify-between w-full items-center mb-6">
            <h2 class="text-pink mb-6">Dashboard</h2>
            <a class="button p-2 invert min-w-0" href="/contributor-submission">CREATE SUBMISSION</a>
          </div>
          <?php if (empty($cases)) : ?>
            <p>You haven't created any submissions yet.</p>
          <?php else : ?>
            <table class="datatable w-full">
              <thead>
                <tr>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Submission ID</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Date Submitted</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Title</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cases as $case) : ?>
                  <?php $id = $case->ID; ?>
                  <?php $contributor = wp_get_post_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
                  <tr class="border-b border-border-grey">
                    <td class="py-4"><?php echo $id; ?></td>
                    <td class="py-4"><?php echo $case->post_date; ?></td>
                    <td class="py-4"><?php echo $case->post_title; ?></td>
                    <td class="py-4"><?php echo $case->post_status; ?></td>
                    <td class="py-4"><a class="text-sm mx-2" href="/contributor-edit?id=<?php echo $id; ?>">EDIT</a>|<a class="text-sm mx-2 delete" href="/submission-delete?id=<?php echo $id; ?>">DELETE</a>
                      <div class="modal message p-8">
                        <div class="flex flex-col justify-center text-center">
                          <p class="text-xl">Are you sure you want to delete the following submission?</p>
                          <h1 class="text-pink my-12"><?php echo $case->ID; ?></h1>
                          <p class="w-full max-w-lg mx-auto mb-6">Once deleted there is no way to recover this submission from our system. If it was previously published to the ClearCorrect case gallery it will be removed within 24 hours. </p>
                          <a class="button py-2 w-full max-w-md mx-auto mb-2" href="/submission-delete?id=<?php echo $id; ?>">Delete Submission</a>
                          <a class="button py-2 w-full max-w-md mx-auto invert" href="/submission-delete">Cancel</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
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