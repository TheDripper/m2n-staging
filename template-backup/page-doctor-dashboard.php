<?php get_header(); ?>
<?php $current_user = wp_get_current_user(); ?>
<?php
$args = array(
  'author'        =>  $current_user->ID,
  'orderby' => 'post_date',
  'order'         =>  'ASC',
  'posts_per_page' => -1,
  'post_type' => 'case',
  'post_status' => 'any'
);
$cases = get_posts($args);
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php if(get_field('first_login','user_'.$current_user->ID)): ?>
      <div class="restaurant-modal modal">
      <?php the_content(); ?>
      </div>
      <?php endif; ?>
        <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6">
          <div class="flex justify-between w-full items-center">
            <h2 class="text-pink mb-6">Dashboard</h2>

            <a class="button p-2 invert min-w-0" href="/restaurant-submission">CREATE SUBMISSION</a>
          </div>
          <div class="select relative">
            <select id="filter-cases" class="border border-border-grey rounded px-2 absolute z-10">
              <?php foreach (get_terms('gender', array('hide_empty' => false)) as $term) : ?>
                <option value="<?php echo $term->slug; ?>" data-tax="<?php echo 'gender'; ?>"><?php echo $term->name; ?></option>
              <?php endforeach; ?>
              <?php foreach (get_terms('classification', array('hide_empty' => false)) as $term) : ?>
                <option><?php echo $term->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="table-wrap">
            <table class="datatable w-full">
              <thead>
                <tr>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Submission ID</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Date Submitted</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">contributor</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Classification</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</th>
                  <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cases as $case) : ?>
                  <?php $id = $case->ID; ?>
                  <?php $contributor = wp_get_post_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
                  <tr class="border-b border-border-grey">
                    <td class="p-4 text-center"><?php echo $id; ?></td>
                    <td class="p-4 text-center"><?php echo $case->post_date; ?></td>
                    <td class="p-4 text-center"><?php echo $contributor; ?></td>
                    <td class="p-4 text-center"><?php echo wp_get_post_terms($id, 'classification')[0]->name; ?></td>
                    <td class="p-4 text-center"><?php echo $case->post_status; ?></td>
                    <td class="p-4 text-center"><a class="text-sm mx-2" href="/submission-edit?id=<?php echo $id; ?>">EDIT</a>|<a class="text-sm mx-2 delete" href="/submission-delete?id=<?php echo $id; ?>">DELETE</a>
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
          </div>
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