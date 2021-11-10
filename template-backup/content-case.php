<div class="case border border-border-grey m-4 p-4 rounded mb-6 relative">
  <div class="wp-block-columns">
    <div class="wp-block-column case-photos" style="flex:33%;">
      <div class="slider new">
        <?php
        $case_photos = [
          'before_occluded_buccal_view_of_anterior',
          'before_occluded_buccal_view_of_right_lateral',
          'before_occluded_buccal_view_of_left_lateral',
          'before_occlusal_view_of_upper',
          'before_occlusal_view_of_lower'
        ];
        foreach ($case_photos as $photo) :
        ?>
          <div class="case-photo">
            <img src="<?php echo get_field($photo); ?>" />
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="wp-block-column" style="flex:66%;">
      <div class="flex justify-between my-2 pb-2 border-b border-border-grey">
        <?php $id = get_the_ID(); ?>
        <label class="text-tiny">SUB ID: <?php echo $id; ?></label>
        <div class="saves flex relative" data-id="<?php echo $id; ?>">
          <p class="flex items-center text-tiny text-body-grey">SAVES: <?php echo get_field('saves'); ?></p>
          <?php $user = get_current_user_id(); ?>
          <?php $saved = json_decode(get_field('saved', 'user_' . $user)); ?>
          <?php $saved = json_decode(json_encode($saved), true); ?>
          <?php if ($saved && in_array($id, $saved)) : ?>
            <img class="drop-save ml-2" src="<?php echo get_template_directory_uri() . '/build/images/HeartActive.svg '; ?>" />
            <img class="absolute ml-2 save" style="opacity:0;pointer-events:none;" src="<?php echo get_template_directory_uri() . '/build/images/Heart.svg '; ?>" />
          <?php else : ?>
            <img class="drop-save ml-2" style="opacity:0;pointer-events:none;" src="<?php echo get_template_directory_uri() . '/build/images/HeartActive.svg '; ?>" />
            <img class="absolute ml-2 save" src="<?php echo get_template_directory_uri() . '/build/images/Heart.svg '; ?>" />
          <?php endif; ?>
        </div>
      </div>
      <div class="wp-block-columns">
        <div class="wp-block-column">
          <label class="text-h5-grey uppercase text-xs font-bold">Classification</label>
          <h5 class="text-sm text-white bg-pink uppercase font-bold text-center py-1 rounded w-1/2 mb-4"><?php echo wp_get_post_terms($id, 'classification')[0]->name; ?></h5>
          <label class="text-h5-grey uppercase text-xs font-bold">Conditions</label>
          <ul class="list">
            <?php foreach (wp_get_post_terms($id, 'technical_condition') as $condition) : ?>
              <li><?php echo $condition->name; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="wp-block-column">
          <label class="text-h5-grey uppercase text-xs font-bold">contributor</label>
          <?php $gender = wp_get_post_terms($id, 'gender')[0]->name; ?>
          <?php $age = get_field('age',$id);  ?>
          <p class="mb-4"><?php echo $gender; ?>, <?php echo $age; ?></p>
          <label class="text-h5-grey uppercase text-xs font-bold">Level of Difficulty</label>
          <p><?php echo wp_get_post_terms($id, 'level_of_difficulty')[0]->name; ?></p>
          <label class="text-h5-grey uppercase text-xs font-bold">restaurant</label>
          <?php  ?>
          <p class="font-bold"><a href="<?php the_permalink(); ?>">Dr. <?php echo get_field('restaurant',$id)->post_title; ?></a></p>
        </div>
      </div>
    </div>
  </div>
</div>