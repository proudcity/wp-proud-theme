<?php

namespace Proud\Theme\Setup;

use Proud\Theme\Assets;
use Proud\Theme\Customizer;

/**
 * Theme setup
 *
 * @return null
 */
function setup()
{
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
    register_nav_menus(
        [
        'primary_navigation' => __('Primary Navigation', 'proud'),
        'topbar_menu'        => __('Topbar Menu', 'proud'),
        ]
    );

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
    //add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
    // Use main stylesheet for visual editor
    // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    Customizer\customize_font_uris(
        function ($uri) {
            add_editor_style($uri);
        }
    );

    add_editor_style(Assets\asset_path('styles/proud-vendor.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
* Register sidebars
*/
function widgets_init()
{

    register_sidebar(
        [
            'name'          => __('Footer actions', 'proud'),
            'id'            => 'footer-actions',
            'before_widget' => '<li class="dropdown %1$s %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="h4">',
            'after_title'   => '</h2>',
            'description'   => __('Widgets placed in this are displayed in a nav bar', 'proud')
        ]
    );

    register_sidebar(
        [
          'name'          => __('Footer', 'proud'),
          'id'            => 'sidebar-footer',
          'before_widget' => '<div class="col-xs-12 col-sm-4 col-md-3 col-md-offset-both-half %1$s %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h2 class="h4 pane-tile">',
          'after_title'   => '</h2>'
        ]
    );

    register_sidebar(
        [
          'name'          => __('Standard sidebar', 'proud'),
          'id'            => 'sidebar-primary',
          'before_widget' => '<section class="widget %1$s %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="h3">',
          'after_title'   => '</h2>'
        ]
    );

    register_sidebar(
        [
          'name'          => __('News sidebar', 'proud'),
          'id'            => 'sidebar-news',
          'before_widget' => '<section class="widget %1$s %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="h3">',
          'after_title'   => '</h2>'
        ]
    );

    register_sidebar(
        [
          'name'          => __('Location sidebar', 'proud'),
          'id'            => 'sidebar-location',
          'before_widget' => '<section class="widget %1$s %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="h3">',
          'after_title'   => '</h2>'
        ]
    );

    register_sidebar(
        [
          'name'          => __('Agency sidebar', 'proud'),
          'id'            => 'sidebar-agency',
          'before_widget' => '<section class="widget %1$s %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="h3">',
          'after_title'   => '</h2>'
        ]
    );

    register_sidebar(
        [
          'name'          => __('Event sidebar', 'proud'),
          'id'            => 'sidebar-event',
          'before_widget' => '<section class="widget %1$s %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="h3">',
          'after_title'   => '</h2>'
        ]
    );

    register_sidebar(
        [
          'name'          => __('Job sidebar', 'proud'),
          'id'            => 'sidebar-job',
          'before_widget' => '<section class="widget %1$s %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="h3">',
          'after_title'   => '</h2>'
        ]
    );

}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Theme assets
 *
 * @return null
 */
function assets()
{
    global $wp_styles;

    $version = wp_get_theme('wp-proud-theme')->get('Version');

    // load regular scripts and styles if local or debug is on
    if (wp_get_environment_type() == 'local' || (defined(WP_DEBUG) && WP_DEBUG === true)) {
        $version = time();

        // enqueue for all env_types
        wp_enqueue_style('proud-vendor/css', Assets\asset_path('styles/proud-vendor.css'), false, esc_attr($version));
        wp_enqueue_style('proud/css', Assets\asset_path('styles/proud.css'), false, esc_attr($version));

        //IE9
        wp_enqueue_style('proud/ie9-and-below', Assets\asset_path('styles/ie9-and-below.css'), ['proud/css'], esc_attr($version));
        $wp_styles->add_data('proud/ie9-and-below', 'conditional', 'lte IE 9');
        if (is_single() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        // Icons
        proud_theme_add_gov_icon_styles();

        // Add moderizer support
        wp_enqueue_script(
            'proud/js/modernizr',
            Assets\asset_path('scripts/modernizr.js'),
            array(),
            esc_attr($version)
        );

        wp_enqueue_script('proud/js', Assets\asset_path('scripts/main.js'), ['jquery'], esc_attr($version), true);
        wp_enqueue_script('bootstrap', Assets\asset_path('scripts/bootstrap.js'), ['jquery'], esc_attr($version), true);

        // add to calendar, we use wp_enqueue_script on the widgets that need the scriptw
        //wp_register_script( 'atcb', Assets\asset_path( 'scripts/atcb/atcb-init.js'), '', '2.6.8', true );
        wp_register_script('atcb',  'https://cdn.jsdelivr.net/npm/add-to-calendar-button@2', '', '', true);

    } else {

        // enqueue for all env_types
        wp_enqueue_style('proud-vendor/css', Assets\asset_path('styles/proud-vendor.css'), false, esc_attr($version));
        wp_enqueue_style('proud/css', Assets\asset_path('styles/proud.css'), false, esc_attr($version));

        //IE9
        wp_enqueue_style('proud/ie9-and-below', Assets\asset_path('styles/ie9-and-below.css'), ['proud/css'], esc_attr($version));
        $wp_styles->add_data('proud/ie9-and-below', 'conditional', 'lte IE 9');
        if (is_single() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        // Icons
        proud_theme_add_gov_icon_styles();

        // Add moderizer support
        wp_enqueue_script(
            'proud/js/modernizr',
            Assets\asset_path('scripts/modernizr.min.js'),
            array(),
            esc_attr($version)
        );

        wp_enqueue_script('proud/js', Assets\asset_path('scripts/main.min.js'), ['jquery'], esc_attr($version), true);
        wp_enqueue_script('bootstrap', Assets\asset_path('scripts/bootstrap.min.js'), ['jquery'], esc_attr($version), true);

        // add to calendar, we use wp_enqueue_script on the widgets that need the scriptw
        //wp_register_script( 'atcb', Assets\asset_path( 'scripts/atcb/atcb-init.js'), '', '2.6.8', true );
        wp_register_script('atcb',  'https://cdn.jsdelivr.net/npm/add-to-calendar-button@2', '', '', true);

    } // if env local

}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
