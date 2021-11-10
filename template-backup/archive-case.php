<?php get_header(); ?>

<main class="bg-back-grey pb-12" role="main" aria-label="Content" data-banner-ad="<?php echo '881';  ?>" data-page-content="906">
  <!-- section -->
  <div class="wp-block-columns max-w-6xl mx-auto mb-6">
    <div class="wp-block-column" style="flex:25%;margin-left:23px;">
    </div>
    <div class="wp-block-column content" style="flex:75%;">
      <?php the_content();  ?>
    </div>
  </div>
  <div class="wp-block-columns max-w-6xl mx-auto">
    <div class="wp-block-column bg-white rounded" style="flex:25%;">
      <aside class="facets">
        <h2 class="p-4 font-body-bold text-2xl">Filters</h2>
        <p class="facet-arrow py-2 border-t border-border-grey">
          Classification
        </p>
        <?php echo facetwp_display('facet', 'classification'); ?>
        <p class="facet-arrow py-2 border-t border-border-grey">
          Clinical Conditions
        </p>
        <?php echo facetwp_display('facet', 'technical_condition'); ?>
        <p class="facet-arrow py-2 border-t border-border-grey">
          Treatment Technique
        </p>
        <?php echo facetwp_display('facet', 'treatment_technique'); ?>
        <p class="facet-arrow py-2 border-t border-border-grey">
          Aligner Wear Schedule
        </p>
        <?php echo facetwp_display('facet', 'aligner_wear_schedule'); ?>
        <p class="facet-arrow py-2 border-t border-border-grey">
          Level of Difficulty
        </p>
        <?php echo facetwp_display('facet', 'level_of_difficulty'); ?>
      </aside>
    </div>
    <div class="wp-block-column bg-white rounded" style="flex:75%;">
      <div class="flex justify-between">
        <h2 id="case-count" class="px-4 mt-8 text-2xl"><?php echo wp_count_posts('case')->publish; ?> cases</h2>
        <div class="select relative">
          <select id="cards-filter-cases" class="px-4 mt-8 mr-4 border border-border-grey rounded px-2 z-10" data-restaurant=<?php echo $restaurant; ?>>
            <?php foreach (get_terms('gender', array('hide_empty' => false)) as $term) : ?>
              <option value="<?php echo $term->slug; ?>" data-tax="<?php echo 'gender'; ?>"><?php echo $term->name; ?></option>
            <?php endforeach; ?>
            <?php foreach (get_terms('classification', array('hide_empty' => false)) as $term) : ?>
              <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <?php echo facetwp_display('template', 'cases'); ?>
      <div class="wp-block-buttons aligncenter mt-6 mb-12 hollow font-avenir-demi">
        <div class="wp-block-button"><a class="wp-block-button__link">Load More</a></div>
      </div>
    </div>
  </div>
  <!-- /section -->
</main>
<?php get_footer(); ?>