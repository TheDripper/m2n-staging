<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-user=<?php echo get_current_user_id(); ?>>
  <header>
    <div class="bg-grey logo-cont m-0 w-full relative z-10 w-full">
      <div class="max-w-6xl w-full mx-auto flex justify-end items-end">
        <a href="/"><img class="logo mt-6 mb-4" src="<?php echo get_template_directory_uri() . '/build/images/logo.png'; ?>" /></a>
      </div>
    </div>
    <nav class="flex justify-between items-center py-2 m-0 w-full max-w-6xl relative z-10 w-full max-w-6xl mx-auto">
      <a href="/cases">Case Gallery</a>
      <div class="flex justify-between items-start">
        <div class="search-wrap relative mr-24">
          <?php if (is_page('search')) : ?>
            <?php echo facetwp_display('facet', 'search_bar'); ?>
          <?php else : ?>
            <input id="search" placeholder="Search" type="text" />
            <img src="/wp-content/themes/template/build/images/Search.svg" />
          <?php endif; ?>
        </div>
        <?php if (current_user_can('author')) : ?>
          <ul class="logged-in-dropdown">
            <li><a href="/update-profile"><?php echo wp_get_current_user()->user_login; ?></a></li>
            <li><a href="/restaurant-dashboard">Dashboard</a></li>
            <li><a href="/restaurant-messages">Messages</a></li>
            <?php $logout = get_site_url(); ?>
            <li><a href="<?php echo wp_logout_url($logout); ?>">Log out</a></li>

          </ul>
        <?php elseif (current_user_can('contributor')) : ?>
          <ul class="logged-in-dropdown">
            <li><a href="/contributor-dashboard"><?php echo wp_get_current_user()->user_login; ?></a></li>
            <li><a href="/contributor-dashboard">Dashboard</a></li>
            <li><a href="/contributor-messages">Messages</a></li>
            <?php $logout = get_site_url(); ?>
            <li><a href="<?php echo wp_logout_url($logout); ?>">Log out</a></li>
          </ul>
        <?php elseif (current_user_can('administrator')) : ?>
          <ul class="logged-in-dropdown">
            <li><a href="/admin-dashboard"><?php echo wp_get_current_user()->user_login; ?></a></li>
            <li><a href="/admin-dashboard">Dashboard</a></li>
            <li><a href="/admin-messages">Messages</a></li>
            <?php $logout = get_site_url(); ?>
            <li><a href="<?php echo wp_logout_url($logout); ?>">Log out</a></li>
          </ul> 
        <?php else : ?>
          <ul class="flex">
            <li class="mr-2 border-r pr-2"><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
          </ul>
        <?php endif; ?>
      </div>
    </nav>
  </header>