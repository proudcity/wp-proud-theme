<?php

namespace Proud\Theme\Setup;

use Proud\Theme\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/proud-translations
  load_theme_textdomain('proud', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'proud')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Make visual default.
  add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style( '//fonts.googleapis.com/css?family=Lato:400,900,700,300' );
  add_editor_style( Assets\asset_path( 'styles/proud-vendor.css' ) );
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {

  register_sidebar([
    'name'          => __('Footer actions', 'proud'),
    'id'            => 'footer-actions',
    'before_widget' => '<li class="dropdown %1$s %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
    'description'   => __('Widgets placed in this are displayed in a nav bar', 'proud')
  ]);

  register_sidebar([
    'name'          => __('Footer', 'proud'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<div class="col-xs-12 col-sm-4 col-md-3 col-md-offset-both-half %1$s %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="pane-tile">',
    'after_title'   => '</h4>'
  ]);

  register_sidebar([
    'name'          => __('Standard sidebar', 'proud'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('News sidebar', 'proud'),
    'id'            => 'sidebar-news',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  //@todo: if (is_plugin_active( 'wp-agency' )) {die();
    register_sidebar([
      'name'          => __('Agency sidebar', 'proud'),
      'id'            => 'sidebar-agency',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
    ]);
  //}

  //@todo: if (post_type_exists( 'event' )) {
    register_sidebar([
      'name'          => __('Event sidebar', 'proud'),
      'id'            => 'sidebar-event',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
    ]);
  //}

  //@todo: if (post_type_exists( 'job_listing' )) {
    register_sidebar([
      'name'          => __('Job sidebar', 'proud'),
      'id'            => 'sidebar-job',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
    ]);
  //}
  
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Theme assets
 */
function assets() {
  global $wp_styles;
  wp_enqueue_style( 'proud-vendor/css', Assets\asset_path( 'styles/proud-vendor.css' ), false, null);
  wp_enqueue_style( 'proud/css', Assets\asset_path( 'styles/proud.css' ), false, null);
  //IE9
  wp_enqueue_style( 'proud/ie9-and-below', Assets\asset_path( 'styles/ie9-and-below.css' ), ['proud/css'] );
  $wp_styles->add_data( 'proud/ie9-and-below', 'conditional', 'lte IE 9' );
  if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
  // Icons
  proud_theme_add_gov_icon_styles();
  // Add moderizer support
  wp_enqueue_script( 'proud/js/modernizr', 
    Assets\asset_path( 'scripts/modernizr.js' ),
    array()
  );

  wp_enqueue_script( 'proud/js', Assets\asset_path( 'scripts/main.js' ), ['jquery'], null, true );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );

// /**
//  * Theme menu
//  */
// function print_menu() {
//   if(has_nav_menu('primary_navigation')) {
//     wp_nav_menu( [ 
//       'theme_location'    => 'primary_navigation',
//       'container'         => 'div',
//       'container_class'   => 'below',
//       'container_id'      => '',
//       'menu_class'        => 'nav navbar-nav',
//       'menu_id'           => 'main-menu',
//       'echo'              => true,
//       'fallback_cb'       => 'wp_page_menu',
//       'before'            => '',
//       'after'             => '',
//       'link_before'       => '',
//       'link_after'        => '',
//       'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
//       'depth'             => 1,
//       'walker'            => ''
//     ] );
//   }
// }
// add_action( 'get_theme_menu', __NAMESPACE__ . '\\print_menu' );

