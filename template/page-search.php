<?php get_header(); ?>

<main class="bg-back-grey pb-12" role="main" aria-label="Content">
  <!-- section -->
  <div class="wp-block-columns max-w-6xl mx-auto mt-12 mb-6">
    <div class="wp-block-column" style="flex:25%;margin-left:23px;">
    </div>
    <div class="wp-block-column" style="flex:75%;">
      <h2 class="mt-12 text-pink">Case Gallery</h2>
      <p>Explore ClearCorrect cases from around the world and see how ClearCorrect helps restaurants deliver smiles that contributors love.</p>
    </div>
  </div>
  <div class="wp-block-columns max-w-6xl mx-auto">
    <div class="wp-block-column bg-white rounded" style="flex:25%;">
      <aside class="facets">
        <h2 class="border-b border-border-grey p-4  ">filters</h2>
        <div class="px-4">
          <p class="facet-arrow my-2">
            Classification
          </p>
          <?php echo facetwp_display('facet', 'classification'); ?>
          <p class="facet-arrow my-2">
            Clinical Conditions
          </p>
          <?php echo facetwp_display('facet', 'technical_condition'); ?>
          <p class="facet-arrow my-2">
            Treatment Technique
          </p>
          <?php echo facetwp_display('facet', 'treatment_technique'); ?>
          <p class="facet-arrow my-2">
            Aligner Wear Schedule
          </p>
          <?php echo facetwp_display('facet', 'aligner_wear_schedule'); ?>
          <p class="facet-arrow my-2">
            Level of Difficulty
          </p>
          <?php echo facetwp_display('facet', 'level_of_difficulty'); ?>
        </div>
      </aside>
    </div>
    <div class="wp-block-column bg-white rounded" style="flex:75;">
      <h2 id="case-count" class="px-4 mt-8"></h2>
      <?php echo facetwp_display('template', 'cases'); ?>
    </div>
  </div>
  <!-- /section -->
</main>
<?php get_footer(); ?>