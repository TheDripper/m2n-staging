<?php get_header(); ?>
<?php $display_name = $_POST['first_name'] . $_POST['last_name']; ?>
<?php $args = array(
  'user_login'=>$_POST['email'],
  'user_email'=>$_POST['email'],
  'user_pass'=>$_POST['password'],
  // 'user_number'=>$_POST['user-number'],
  'first_name'=>$_POST['first_name'],
  'last_name'=>$_POST['last_name'],
  'role'=>'contributor',
  'display_name'=>$display_name
); ?>
<?php 
  $new_doc = wp_insert_user($args);
  $args = array (
    'post_type'=>'restaurant',
    'post_author'=>$new_doc,
    'post_title'=>$display_name
  );
?>
<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>
  </section>
</main>
<?php get_footer(); ?>