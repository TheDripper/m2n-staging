<?php


// Clean up wordpres <head>
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  $manifest = json_decode(file_get_contents('build/assets.json', true));
  $main = $manifest->main;
  wp_enqueue_style('fonts', get_template_directory_uri() . "/build/fonts.css",  false, null);
  wp_enqueue_style('theme-css', get_template_directory_uri() . "/build/" . $main->css,  ['fonts'], null);
  wp_enqueue_script('wp-util');
  wp_enqueue_script('slick', "http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js", ['jquery'], null, true);
  wp_enqueue_script('facet-loader', get_template_directory_uri() . "/build/facet-load.js", ['jquery'], null, true);
  wp_enqueue_script('theme-js', get_template_directory_uri() . "/build/" . $main->js, ['jquery', 'wp-util'], null, true);
}, 100);

// add_action('admin_enqueue_scripts', function () {
//     $manifest = json_decode(file_get_contents('build/assets.json', true));
//     $main = $manifest->main;
//     wp_enqueue_style('fonts', get_template_directory_uri() . "/build/fonts.css",  false, null);
//     wp_enqueue_style('theme-css', get_template_directory_uri() . "/build/" . $main->css,  ['fonts'], null);
// });
/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
  /**
   * Enable features from Soil when plugin is activated
   * @link https://roots.io/plugins/soil/
   */
  add_theme_support('soil-clean-up');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-relative-urls');
  /**
   * Enable plugins to manage the document title
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
   */
  add_theme_support('title-tag');
  /**
   * Register navigation menus
   * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
   */
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'mini')
  ]);
  /**
   * Enable post thumbnails
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support('post-thumbnails');
  /**
   * Enable HTML5 markup support
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
   */
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
  /**
   * Enable selective refresh for widgets in customizer
   * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
   */
  // add_theme_support('customize-selective-refresh-widgets');


}, 20);


add_action('rest_api_init', function () {
  $namespace = 'presspack/v1';
  register_rest_route($namespace, '/path/(?P<url>.*?)', array(
    'methods'  => 'GET',
    'callback' => 'get_post_for_url',
  ));
});

/**
 * This fixes the wordpress rest-api so we can just lookup pages by their full
 * path (not just their name). This allows us to use React Router.
 *
 * @return WP_Error|WP_REST_Response
 */
function get_post_for_url($data)
{
  $postId    = url_to_postid($data['url']);
  $postType  = get_post_type($postId);
  $controller = new WP_REST_Posts_Controller($postType);
  $request    = new WP_REST_Request('GET', "/wp/v2/{$postType}s/{$postId}");
  $request->set_url_params(array('id' => $postId));
  return $controller->get_item($request);
}

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }
  return $classes;
}
function wporg_custom_post_type()
{
  register_post_type(
    'case',
    array(
      'labels'      => array(
        'name'          => __('cases', 'textdomain'),
        'singular_name' => __('case', 'textdomain'),
      ),
      'public'      => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'cases'),
      'exclude_from_search' => FALSE,
      'supports' => array('thumbnail', 'title', 'editor', 'author')
    )
  );
  register_post_type(
    'restaurant',
    array(
      'labels'      => array(
        'name'          => __('restaurants', 'textdomain'),
        'singular_name' => __('restaurant', 'textdomain'),
      ),
      'public'      => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'restaurants'),
      'exclude_from_search' => FALSE,
      'supports' => array('thumbnail', 'title', 'editor', 'author')
    )
  );
  register_post_type(
    'banner-ad',
    array(
      'labels'      => array(
        'name'          => __('banner-ads', 'textdomain'),
        'singular_name' => __('banner-ad', 'textdomain'),
      ),
      'public'      => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'banner-ads'),
      'exclude_from_search' => FALSE,
      'supports' => array('thumbnail', 'title', 'editor', 'author')
    )
  );
}
add_action('init', 'wporg_custom_post_type');

function register_taxonomies()
{
  $labels = array(
    'name'                       => 'region',
    'singular_name'              => 'region',
    'menu_name'                  => 'region',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'regions')
  );
  register_taxonomy('region', array('case'), $args);


  $labels = array(
    'name'                       => 'classification',
    'singular_name'              => 'classification',
    'menu_name'                  => 'classification',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'classifications')
  );
  register_taxonomy('classification', array('case'), $args);
  $labels = array(
    'name'                       => 'technical_condition',
    'singular_name'              => 'technical_condition',
    'menu_name'                  => 'technical_condition',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'technical_conditions')
  );
  register_taxonomy('technical_condition', array('case'), $args);
  $labels = array(
    'name'                       => 'treatment_technique',
    'singular_name'              => 'treatment_technique',
    'menu_name'                  => 'treatment_technique',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'treatment_techniques')
  );
  register_taxonomy('treatment_technique', array('case'), $args);
  $labels = array(
    'name'                       => 'aligner_wear_schedule',
    'singular_name'              => 'aligner_wear_schedule',
    'menu_name'                  => 'aligner_wear_schedule',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'aligner_wear_schedules')
  );
  register_taxonomy('aligner_wear_schedule', array('case'), $args);
  $labels = array(
    'name'                       => 'level_of_difficulty',
    'singular_name'              => 'level_of_difficulty',
    'menu_name'                  => 'level_of_difficulty',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'level_of_difficultys')
  );
  register_taxonomy('level_of_difficulty', array('case'), $args);
  $labels = array(
    'name'                       => 'gender',
    'singular_name'              => 'gender',
    'menu_name'                  => 'gender',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'genders')
  );
  register_taxonomy('gender', array('case'), $args);
  $labels = array(
    'name'                       => 'country',
    'singular_name'              => 'country',
    'menu_name'                  => 'country',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'countrys')
  );
  register_taxonomy('country', array('case'), $args);
  $labels = array(
    'name'                       => 'number_of_aligner_sets',
    'singular_name'              => 'number_of_aligner_sets',
    'menu_name'                  => 'number_of_aligner_sets',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'number_of_aligner_setss')
  );
  register_taxonomy('number_of_aligner_sets', array('case'), $args);
  $labels = array(
    'name'                       => 'submission_materials',
    'singular_name'              => 'submission_materials',
    'menu_name'                  => 'submission_materials',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'submission_materialss')
  );
  register_taxonomy('submission_materials', array('case'), $args);
  $labels = array(
    'name'                       => 'aligner_material',
    'singular_name'              => 'aligner_material',
    'menu_name'                  => 'aligner_material',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'aligner_materials')
  );
  register_taxonomy('aligner_material', array('case'), $args);
  $labels = array(
    'name'                       => 'type_of_retention',
    'singular_name'              => 'type_of_retention',
    'menu_name'                  => 'type_of_retention',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'type_of_retentions')
  );
  register_taxonomy('type_of_retention', array('case'), $args);
  $labels = array(
    'name'                       => 'other_products_used',
    'singular_name'              => 'other_products_used',
    'menu_name'                  => 'other_products_used',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'other_products_used')
  );
  register_taxonomy('other_products_used', array('case'), $args);
  $labels = array(
    'name'                       => 'number_of_revisions',
    'singular_name'              => 'number_of_revisions',
    'menu_name'                  => 'number_of_revisions',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'number_of_revisionss')
  );
  register_taxonomy('number_of_revisions', array('case'), $args);
  $labels = array(
    'name'                       => 'total_treatment_time',
    'singular_name'              => 'total_treatment_time',
    'menu_name'                  => 'total_treatment_time',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'total_treatment_times')
  );
  register_taxonomy('total_treatment_time', array('case'), $args);
  $labels = array(
    'name'                       => 'country',
    'singular_name'              => 'country',
    'menu_name'                  => 'country',
    'all_items'                  => 'All Items',
    'parent_item'                => 'Parent Item',
    'parent_item_colon'          => 'Parent Item:',
    'new_item_name'              => 'New Item Name',
    'add_new_item'               => 'Add New Item',
    'edit_item'                  => 'Edit Item',
    'update_item'                => 'Update Item',
    'view_item'                  => 'View Item',
    'separate_items_with_commas' => 'Separate items with commas',
    'add_or_remove_items'        => 'Add or remove items',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search Items',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'has_archive'                => true,
    'rewrite'                    => array('slug' => 'countries')
  );
  register_taxonomy('country', array('restaurant'), $args);
}
add_action('init', 'register_taxonomies', 0);

function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
// function my_acf_init() {

// 	acf_update_setting('google_api_key', 'AIzaSyCttO3DiKRKOeTdh0MNVbFjC2xs46ECs_8');
// }


// add_action('acf/init', 'my_acf_init');
function my_acf_google_map_api($api)
{

  $api['key'] = 'AIzaSyCttO3DiKRKOeTdh0MNVbFjC2xs46ECs_8';

  return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

add_action('wp_ajax_nopriv_get_data', 'my_ajax_handler');
add_action('wp_ajax_get_data', 'my_ajax_handler');

function my_ajax_handler()
{
  $new_posts = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'post_status' => 'any',
    'offset' => $_POST['offset']
  ));
  foreach ($new_posts as $new_post) : ?>
    <?php
    global $post;
    $post = $new_post;
    setup_postdata($post);
    ?>
    <div class="card new-feather w-1/4 px-8 mb-6">
      <div class="no-modal">
        <img src="<?php the_post_thumbnail_url(); ?>" />
      </div>
      <div class="modal">
        <img src="<?php the_post_thumbnail_url(); ?>" />
        <div class="flex flex-col items-start p-12">
          <h1 class="my-6"><?php the_title(); ?></h1>
          <?php the_content(); ?>
          <a class="wp-block-button__link mt-6">FIND A PROVIDER</a>
        </div>
      </div>
    </div>
    <?php wp_reset_postdata(); ?>
  <?php endforeach;
  wp_die();
}

add_action('wp_ajax_nopriv_add_save', 'add_save');
add_action('wp_ajax_add_save', 'add_save');

function add_save()
{
  $user = get_current_user_ID();
  $save_id = (int) $_POST["id"];
  $saves = intval(get_field('saves', $save_id));
  $saved = json_decode(get_field('saved', 'user_' . $user));
  $saved = json_decode(json_encode($saved), true);
  if (empty($saved)) {
    $saved = [];
  }
  if (!in_array($save_id, $saved)) {
    $saves++;
    update_field('saves', $saves, $save_id);
    the_field('saves', $save_id);
    $saved[] = $save_id;
    update_field('saved', json_encode($saved), 'user_' . $user);
  } else {
    the_field('saves', $save_id);
  }
  wp_die();
}

add_action('wp_ajax_nopriv_drop_save', 'drop_save');
add_action('wp_ajax_drop_save', 'drop_save');
function drop_save()
{
  $user = get_current_user_ID();
  $save_id = (int) $_POST["id"];
  $saves = intval(get_field('saves', $save_id));
  $saved = json_decode(get_field('saved', 'user_' . $user));
  $saved = json_decode(json_encode($saved), true);
  if (in_array($save_id, $saved)) {
    $saves--;
    update_field('saves', $saves, $save_id);
    the_field('saves', $save_id);
    $is_saved = array_search($save_id, $saved);
    unset($saved[$is_saved]);
    update_field('saved', json_encode($saved), 'user_' . $user);
  } else {
    the_field('saves', $save_id);
  }
  wp_die();
}
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}


function filter_cases()
{
  $current_user = wp_get_current_user();
  $gender = (array) get_terms('gender', array('hide_empty' => false))[0];
  $classification = (array) get_terms('classification', array('hide_empty' => false))[0];
  $tax = $_POST['tax'];
  $args = array(
    'author'        =>  $current_user->ID,
    'orderby' => 'post_date',
    'order'         =>  'ASC',
    'posts_per_page' => -1,
    'post_type' => 'case',
    'post_status' => 'any',
    'tax_query' => array(
      array(
        'taxonomy' => $tax,
        'field'    => 'slug',
        'terms'    => $_POST['slug']
      ),
    ),
  );
  $cases = get_posts($args); ?>
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
  <?php
  wp_die();
}
add_action('wp_ajax_nopriv_filter_cases', 'filter_cases');
add_action('wp_ajax_filter_cases', 'filter_cases');



add_action('wp_login_failed', 'my_front_end_login_fail');  // hook failed login

function my_front_end_login_fail($username)
{
  $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
  // if there's a valid referrer, and it's not the default log-in screen
  if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
    $redirect = '';
    if (strpos($referrer, 'contributor') !== false) {
      $redirect = '/contributor-login?failed=true';
    }
    if (strpos($referrer, 'restaurant') !== false) {
      $redirect = '/restaurant-login?failed=true';
    }
    wp_redirect($referrer . $redirect);  // let's append some information (login=failed) to the URL for the theme to use
    exit;
  }
}
function cards_filter_cases()
{
  // $restaurant = $_POST['restaurant'];
  $current_user = wp_get_current_user();
  $gender = (array) get_terms('gender', array('hide_empty' => false));
  $gender = json_decode(json_encode($gender), true);
  $classification = (array) get_terms('classification', array('hide_empty' => false));
  $classification = json_decode(json_encode($classification), true);
  $tax = '';
  // var_dump($_POST['slug']);
  foreach ($gender as $term) {
    if (in_array($_POST["slug"], $term, true)) $tax = 'gender';
  }
  foreach ($classification as $term) {
    if (in_array($_POST["slug"], $term, true)) $tax = 'classification';
  }
  if (in_array($_POST["slug"], $classification, true)) $tax = 'classification';

  $args = array(
    'post_type' => 'case',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => array(
      array(
        'taxonomy' => $tax,
        'field'    => 'slug',
        'terms'    => $_POST['slug']
      )
    )
  );
  if ($_POST['restaurant']) {
    $args['meta_key'] = 'restaurant';
    $args['meta_value'] = $_POST['restaurant'];
  }
  global $post;
  $q = new WP_Query($args);
  while ($q->have_posts()) : $q->the_post() ?>
    <?php get_template_part('content', 'case'); ?>
  <?php
  endwhile;
  wp_reset_postdata();
  wp_die();
}
add_action('wp_ajax_nopriv_cards_filter_cases', 'cards_filter_cases');
add_action('wp_ajax_cards_filter_cases', 'cards_filter_cases');

add_action('wp_ajax_nopriv_set_first_login', 'set_first_login');
add_action('wp_ajax_set_first_login', 'set_first_login');

function set_first_login()
{
  echo update_field('first_login', false, 'user_' . $_POST['user']);
  wp_die();
}
add_action('wp_ajax_nopriv_load_more_cases', 'load_more_cases');
add_action('wp_ajax_load_more_cases', 'load_more_cases');

function load_more_cases()
{
  $offset = $_POST['offset'];
  $args = array(
    'post_type' => 'case',
    'posts_per_page' => 10,
    'post_status' => 'publish',
    'offset' => $offset
  );
  global $post;
  $q = new WP_Query($args);
  while ($q->have_posts()) : $q->the_post() ?>
    <?php get_template_part('content', 'case'); ?>
  <?php
  endwhile;
  wp_reset_postdata();
  wp_die();
}

function admin_filter_cases()
{
  $current_user = wp_get_current_user();
  $gender = (array) get_terms('gender', array('hide_empty' => false))[0];
  $classification = (array) get_terms('classification', array('hide_empty' => false))[0];
  $tax = $_POST['tax'];
  $args = array(
    'orderby' => 'post_date',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'post_type' => 'case',
    'post_status' => 'any',
    'tax_query' => array(
      array(
        'taxonomy' => $tax,
        'field'    => 'slug',
        'terms'    => $_POST['slug']
      ),
    ),
  );
  $cases = get_posts($args); ?>
  <?php if ($_POST['tab_slug'] == 'contributor-posts') : ?>
    <div class="table-wrap">
      <table class="datatable w-full contributor-posts">
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
          <?php foreach ($cases as $case) : ?>
            <?php $id = $case->ID; ?>
            <?php $contributor = wp_get_post_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
            <tr class="border-b border-border-grey">
              <td class="py-4"><?php echo $id; ?></td>
              <td class="py-4"><?php echo wp_date('m/d/Y', get_post_timestamp($id)); ?></td>
              <td class="py-4"><?php echo $current_user->user_email; ?></td>
              <td class="py-4"><?php echo $case->post_title; ?></td>
              <td class="py-4"><?php echo wp_get_post_terms($id, 'region')[0]->name; ?></td>
              <td class="py-4"><?php echo $case->post_status; ?></td>
              <td class="py-4"><a class="text-sm mx-2" href="/submission-edit?id=<?php echo $id; ?>">EDIT</a>|<a class="text-sm mx-2 delete" href="/submission-delete?id=<?php echo $id; ?>">DELETE</a>
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
  <?php else : ?>
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
            <?php $restaurant_email = get_user_by('id', get_post($id)->post_author)->user_email; ?>
            <td class="py-4"><?php echo $restaurant_email; ?></td>
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
  <?php endif; ?>

<?php
  wp_die();
}
add_action('wp_ajax_nopriv_admin_filter_cases', 'admin_filter_cases');
add_action('wp_ajax_admin_filter_cases', 'admin_filter_cases');

add_action('wp_ajax_nopriv_restaurant_contributor_admin', 'restaurant_contributor_admin');
add_action('wp_ajax_restaurant_contributor_admin', 'restaurant_contributor_admin');

function restaurant_contributor_admin()
{
  $user = $_POST['user'];
  $role = $_POST['role'];
  $old_role = $_POST['old_role'];
  $u = get_user_by('id', $user);
  echo $role;
  wp_update_user(array(
    'ID' => $user,
    'role' => $role
  ));
  wp_die();
}
add_action('rest_api_init', function () {
  $namespace = 'presspack/v1';
  register_rest_route($namespace, '/restaurant-register', array(
    'methods' => 'POST',
    'callback' => 'register_rest',
  ));
});

function register_rest()
{
  $display_name = $_POST['first_name'] . $_POST['last_name'];
  $args = array(
    'user_login' => $_POST['email'],
    'user_email' => $_POST['email'],
    'user_pass' => $_POST['password'],
    // 'user_number'=>$_POST['user-number'],
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'role' => 'author',
    'display_name' => $display_name
  );
  $new_doc = wp_insert_user($args);
  $args = array(
    'post_type' => 'restaurant',
    'post_author' => $new_doc,
    'post_title' => $display_name
  );
  $restaurant = wp_insert_post($args);
  unset($_POST['first_name']);
  unset($_POST['last_name']);
  unset($_POST['email']);
  unset($_POST['user_number']);
  unset($_POST['user_email']);
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'term_') === 0) {
      wp_set_object_terms($restaurant, $value, substr($key, 5));
    } else {
      update_field($key, $value, $restaurant);
    }
  }
}
