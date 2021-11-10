<?php $restaurant = get_field('restaurant'); ?>
<?php
global $post;
// var_dump($restaurant);
$post = $restaurant;
?>
<div class="flex p-6 relative">
  <a class="absolute w-full h-full t-0 l-0" href="<?php the_permalink(); ?>"></a>
  <div class="restaurant-photo flex flex-col justify-start items-center">
    <?php the_post_thumbnail(); ?>
  </div>
  <div class="restaurant-contact ml-6 w-full">
    <h3 class="text-green text-md font-head">Dr. Jim Smith</h3>
    <div class="wp-block-columns">
      <div class="wp-block-column" style="flex:50%;">
        <label class="text-h5-grey uppercase text-xs font-bold">Location</label>
          <?php the_field('location'); ?>
      </div>
      <div class="wp-block-column" style="flex:50%;">
        <label class="text-h5-grey uppercase text-xs font-bold">Contact</label>
        <?php the_field('contact'); ?>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); ?>