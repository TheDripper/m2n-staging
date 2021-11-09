<?php get_header(); ?>
<?php $current_user = wp_get_current_user(); ?>
<?php
$args = array(
  'orderby' => 'post_date',
  'order'         =>  'ASC',
  'posts_per_page' => -1,
  'post_type' => 'case',
  'post_status' => 'any'
);
$contributor_args = array(
  'orderby' => 'post_date',
  'order'         =>  'ASC',
  'posts_per_page' => -1,
  'post_type' => 'post',
  'post_status' => 'any'
);
$cases = get_posts($args);
$contributor_posts = get_posts($contributor_args);
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>
    <article>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php if (get_field('first_login', 'user_' . $current_user->ID)) : ?>
            <div class="restaurant-modal modal">
              <?php the_content(); ?>
            </div>
          <?php endif; ?>
          <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6">
            <h2 class="text-pink mb-6">Admin Dashboard</h2>
            <div class="select relative before-tabs">
              <select id="admin-filter-cases" class="border border-border-grey rounded px-2 absolute z-10">
                <option>All Posts</option>
                <?php foreach (get_terms('gender', array('hide_empty' => false)) as $term) : ?>
                  <option value="<?php echo $term->slug; ?>" data-tax="<?php echo 'gender'; ?>"><?php echo $term->name; ?></option>
                <?php endforeach; ?>
                <?php foreach (get_terms('classification', array('hide_empty' => false)) as $term) : ?>
                  <option value="<?php echo $term->slug; ?>" data-tax="<?php echo 'classification'; ?>"><?php echo $term->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="tabs admin-tabs">
              <ul>
                <li class="uppercase"><a href="#submissions" data-tab-slug="submissions">Submissions</a></li>
                <li class="uppercase"><a href="#contributor-posts" data-tab-slug="contributor-posts">contributor Posts</a></li>
                <li class="uppercase"><a href="#users" data-tab-slug="user">Users</a></li>
                <li class="uppercase"><a href="#assignments" data-tab-slug="staff">Assignments</a></li>
              </ul>
              <div id="submissions">
                <div class="table-wrap">
                  <table class="datatable w-full submissions-table">
                    <thead>
                      <tr>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Submission ID</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Date Submitted</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">restaurant</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">User #</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">contributor ID</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Region</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($cases as $case) : ?>
                        <?php $id = $case->ID; ?>
                        <?php $contributor = wp_get_object_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
                        <tr class="border-b border-border-grey">
                          <td class="py-4"><?php echo $id; ?></td>
                          <td class="py-4"><?php echo wp_date('m/d/Y', get_post_timestamp()); ?></td>
                          <?php $restaurant = get_user_by('id', get_post($id)->post_author); ?>
                          <?php $restaurant_email = $restaurant->user_email; ?>
                          <?php $restaurant_ID = $restaurant->ID; ?>
                          <td class="py-4"><?php echo $restaurant_email; ?></td>
                          <td class="py-4"><?php echo $restaurant_ID; ?></td>
                          <td class="py-4"><?php echo $case->post_title ?></td>
                          <?php $region = wp_get_object_terms($case->ID, 'region')[0]->name; ?>
                          <td class="py-4"><?php echo $region; ?></td>
                          <td class="py-4"><?php echo $case->post_status; ?>
                          <td class="py-4">
                            <a class="publish text-sm mx-2" href="#">PUBLISH</a>|<a class="text-sm mx-2" href="/case-reject?id=<?php echo $id; ?>">REJECT</a>
                            <div class="modal publish-modal message p-8">
                              <div class="flex flex-col justify-center text-center">
                                <p class="text-xl">Are you sure you want to publish the following submission?</p>
                                <h1 class="text-pink my-12"><?php echo $case->ID; ?></h1>
                                <a class="button py-2 w-full max-w-md mx-auto mb-2" href="/case-published?id=<?php echo $id; ?>">Publish</a>
                                <a class="button py-2 w-full max-w-md mx-auto invert" href="#">Cancel</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="contributor-posts">
                <div class="table-wrap">
                  <table class="datatable w-full">
                    <thead>
                      <tr>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Submission ID</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Date Submitted</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Email</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">contributor ID</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Region</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($contributor_posts as $case) : ?>
                        <?php $id = $case->ID; ?>
                        <?php $contributor = get_user_by('id', get_post($id)->post_author); ?>
                        <?php $contributor_email = $contributor->user_email; ?>
                        <?php $contributor_ID = $contributor->ID; ?>
                        <?php $contributor = wp_get_object_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
                        <tr class="border-b border-border-grey" data-author=<?php echo $contributor_ID; ?>>
                          <td class="py-4"><?php echo $id; ?></td>
                          <td class="py-4"><?php echo wp_date('m/d/Y', get_post_timestamp($id)); ?></td>
                          <td class="py-4"><?php echo $contributor_email; ?></td>
                          <td class="py-4"><?php echo $contributor_ID; ?></td>
                          <?php $region = get_field('country', 'user_' . $contributor_ID); ?>
                          <td class="py-4"><?php echo $region; ?></td>
                          <td class="py-4"><?php echo $case->post_status; ?>
                          <td class="py-4">
                            <a class="publish text-sm mx-2" href="#">PUBLISH</a>|<a class="text-sm mx-2" href="/case-reject?id=<?php echo $id; ?>">REJECT</a>
                            <div class="modal publish-modal message p-8">
                              <div class="flex flex-col justify-center text-center">
                                <p class="text-xl">Are you sure you want to publish the following submission?</p>
                                <h1 class="text-pink my-12"><?php echo $case->ID; ?></h1>
                                <a class="button py-2 w-full max-w-md mx-auto mb-2" href="/case-published?id=<?php echo $id; ?>">Publish</a>
                                <a class="button py-2 w-full max-w-md mx-auto invert" href="#">Cancel</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="users">
                <div class="table-wrap">
                  <table class="datatable w-full">
                    <thead>
                      <tr>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Email</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Created</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Role</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $users = get_users(); ?>
                      <?php foreach ($users as $user) : ?>
                        <?php $id = $user->ID; ?>
                        <tr class="border-b border-border-grey">
                          <td class="py-4"><?php echo $user->user_email; ?></td>
                          <td class="py-4"><?php echo wp_date('m/d/Y', get_post_timestamp()); ?></td>
                          <?php $user_role = $user->roles[0]; ?>
                          <?php
                          $roles = [
                            'author' => 'contributor',
                            'contributor' => 'restaurant',
                            'administrator' => 'Admin'
                          ];
                          ?>
                          <td class="py-4"><select name="user_role" class="role-select" data-user="<?php echo $user->ID; ?>" data-role="<?php echo $user_role; ?>">>
                          <?php foreach($roles as $slug => $role): ?>
                          <?php echo $slug; ?>
                          <?php echo $user_role; ?>
                              <option <?php if ($slug == $user_role) echo 'selected'; ?> value="<?php echo $slug ?>"><?php echo ucwords($role); ?></option>
                              <?php endforeach; ?>
                            </select></td>
                          <td class="py-4">
                            <a class="publish text-sm mx-2" href="#">DELETE</a>
                            <div class="modal publish-modal message p-8">
                              <div class="flex flex-col justify-center text-center">
                                <p class="text-xl">Are you sure you want to delete the following user?</p>
                                <h1 class="text-pink my-12"><?php echo $user->ID; ?></h1>
                                <a class="button py-2 w-full max-w-md mx-auto mb-2" href="/user-deleted?id=<?php echo $id; ?>">DELETE USER</a>
                                <a class="button py-2 w-full max-w-md mx-auto invert" href="#">Cancel</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="assignments">
                <div class="table-wrap">
                  <table class="datatable w-full">
                    <thead>
                      <tr>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Submission ID</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Date Submitted</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">restaurant</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">User #</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">contributor ID</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Region</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</th>
                        <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($cases as $case) : ?>
                        <?php $id = $case->ID; ?>
                        <?php $contributor = wp_get_object_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
                        <tr class="border-b border-border-grey">
                          <td class="py-4"><?php echo $id; ?></td>
                          <td class="py-4"><?php echo wp_date('m/d/Y', get_post_timestamp()); ?></td>
                          <td class="py-4"><?php echo get_field('restaurant', $id)->post_title; ?></td>
                          <td class="py-4"><?php echo $current_user->ID; ?></td>
                          <td class="py-4"><?php echo get_field('contributor_case_number', $case->ID) ?></td>
                          <?php $region = wp_get_object_terms($case->ID, 'region')[0]->name; ?>
                          <td class="py-4"><?php echo $region; ?></td>
                          <td class="py-4"><?php echo $case->post_status; ?>
                          <td class="py-4">
                            <a class="publish text-sm mx-2" href="#">PUBLISH</a>|<a class="text-sm mx-2" href="/case-reject?id=<?php echo $id; ?>">REJECT</a>
                            <div class="modal publish-modal message p-8">
                              <div class="flex flex-col justify-center text-center">
                                <p class="text-xl">Are you sure you want to publish the following submission?</p>
                                <h1 class="text-pink my-12"><?php echo $case->ID; ?></h1>
                                <a class="button py-2 w-full max-w-md mx-auto mb-2" href="/case-published?id=<?php echo $id; ?>">Publish</a>
                                <a class="button py-2 w-full max-w-md mx-auto invert" href="#">Cancel</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

      <?php else : ?>

        <!-- article -->

        <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>

    </article>
    <!-- /article -->

  <?php endif; ?>

  </section>
  <!-- /section -->
</main>
<?php get_footer(); ?>