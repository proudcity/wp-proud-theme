<?php

namespace Proud\Theme\Extras;

use Proud\Theme\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }
  
  // @TODO make into module
  $classes[] = 'proud-navbar-active';

  // Add class if sidebar is active
  if (Setup\page_agency_info(-1)) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'proud') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');
