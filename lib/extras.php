<?php

namespace Proud\Theme\Extras;

use Proud\Theme\Setup;

/**
 * Add <body> classes
 */
function body_class( $classes ) {
    // Add page slug if it doesn't exist
    if ( is_single() || is_page() && ! is_front_page() ) {
        if ( ! in_array( basename( get_permalink() ), $classes ) ) {
            $classes[] = basename( get_permalink() );
        }
    }

    global $proudcore;
    // Add class if sidebar is active
    if ( $proudcore::$layout->page_parent_info() ) {
        $classes[] = 'sidebar-primary';
    }

    // Process colors for lightness

    $topnav_light               = is_light_color( get_theme_mod( 'color_topnav', '#000000' ) );
    $topnav_light_extra         = is_extra_light_color( get_theme_mod( 'color_topnav', '#000000' ) );
    $topbar_light               = is_light_color( get_theme_mod( 'color_nav_topbar', get_theme_mod( 'color_topnav', '#000000' ) ) );
    $topbar_light_extra         = is_extra_light_color( get_theme_mod( 'color_nav_topbar', get_theme_mod( 'color_topnav', '#000000' ) ) );
    $highlight_light            = is_light_color( get_theme_mod( 'color_highlight', '#333333' ) );
    $highlight_light_extra      = is_extra_light_color( get_theme_mod( 'color_highlight', '#333333' ) );
    $secondary_light            = is_light_color( get_theme_mod( 'color_secondary', get_theme_mod( 'color_topnav', '#000000' ) ) );
    $secondary_light_extra      = is_extra_light_color( get_theme_mod( 'color_secondary', get_theme_mod( 'color_topnav', '#000000' ) ) );
    $footer_light               = is_light_color( get_theme_mod( 'color_footer', '#333333' ) );
    $footer_light_extra         = is_extra_light_color( get_theme_mod( 'color_footer', '#333333' ) );
    $footer_actions_light       = is_light_color( get_theme_mod( 'color_footer_actions', '#FFFFFF' ) );
    $footer_actions_light_extra = is_extra_light_color( get_theme_mod( 'color_footer_actions', '#FFFFFF' ) );

    if ( $topnav_light ) {
        $classes[] = 'light-background-topnav';

        if ( $topnav_light_extra ) {
            $classes[] = 'extra-light-background-topnav';
        }
    }

    if ( $topbar_light ) {
        $classes[] = 'light-background-topnav-topbar';

        if ( $topbar_light_extra ) {
            $classes[] = 'extra-light-background-topnav-topbar';
        }
    }

    if ( $highlight_light ) {
        $classes[] = 'light-background-highlight';

        if ( $highlight_light_extra ) {
            $classes[] = 'extra-light-background-highlight';
        }
    }

    if ( $secondary_light  ) {
        $classes[] = 'light-background-secondary';

        if ( $secondary_light_extra ) {
            $classes[] = 'extra-light-background-secondary';
        }
    }

    if ( $footer_light ) {
        $classes[] = 'light-background-footer';

        if ( $footer_light_extra ) {
            $classes[] = 'extra-light-background-footer';
        }
    }

    if ( $footer_actions_light ) {
        $classes[] = 'light-background-footer-actions';

        if ( $footer_actions_light_extra ) {
            $classes[] = 'extra-light-background-footer-actions';
        }
    }

    if ( get_theme_mod( 'background_image', '' ) || get_color_if_not_white('color_background') ) {
        $classes[] = 'background-color-active';
    }

    return apply_filters( 'proud_body_class', $classes );
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Convert current-menu-item to active
 */
function convert_nav_class( $classes, $item ) {
    if ( in_array( 'current-menu-item', $classes ) ) {
        $classes[] = 'active ';
    }

    return $classes;
}

add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\\convert_nav_class', 10, 2 );


/**
 * Edit events em-wrapper class
 */
function convert_events_class( $content ) {
    return str_replace( 'em-wrapper', 'em-wrapper row', $content );
}

add_filter( 'em_content', __NAMESPACE__ . '\\convert_events_class', 10, 2 );

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
    return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'proud' ) . '</a>';
}

add_filter( 'excerpt_more', __NAMESPACE__ . '\\excerpt_more' );
