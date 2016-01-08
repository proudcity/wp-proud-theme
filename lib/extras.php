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
 * Convert current-menu-item to active
 */
function convert_nav_class( $classes, $item ){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}
add_filter('nav_menu_css_class' , __NAMESPACE__ . '\\convert_nav_class' , 10 , 2);


/**
 * Edit events em-wrapper class
 */
function convert_events_class( $content ){
    return str_replace( 'em-wrapper', 'em-wrapper row', $content );
}
add_filter('em_content' , __NAMESPACE__ . '\\convert_events_class' , 10 , 2);

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'proud') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');
