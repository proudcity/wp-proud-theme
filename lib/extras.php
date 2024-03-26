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

/**
 * Formats our data for the Add to Calendar button properly
 *
 * @since 2022-10-11
 * @author Curtis
 * @link: https://github.com/add2cal/add-to-calendar-button
 *
 * @uses    object          $event              required                        The event post_object
 * @uses    string          $location           required                        Location string
 * @uses    object          $datetime           required                        DateTime object
 * @uses    string          $timezone           optional                        Set if you want a different timezone than the site default
 */
function build_atcb_json( $event, $location, $datetime, $timezone = null  ){

    if ( null == $timezone ){
        $timezone = get_option( 'timezone_string' );
    }

    if ( 'event' === get_post_type( absint( $event->ID ) ) ){
        $start_date = get_post_meta( absint( $event->ID ), '_event_start_date', true );
        $end_date = get_post_meta( absint( $event->ID ), '_event_end_date', true );
        $start_time = get_post_meta( absint( $event->ID ), '_event_start_time', true );
        $end_time = get_post_meta( absint( $event->ID ), '_event_end_time', true );

        $description = get_permalink( absint( $event->ID ) );
    } else {
        // meetings
        $start_date = date( 'Y-m-d', strtotime( get_post_meta( absint( $event->ID ), 'datetime', true ) ) );
        $end_date = date( 'Y-m-d', strtotime( get_post_meta( absint( $event->ID ), 'datetime', true ) ) );
        $start_time = date( 'H:i', strtotime( get_post_meta( absint( $event->ID ), 'datetime', true ) ) );
        $end_time = date('H:i', strtotime( get_post_meta( absint( $event->ID ), 'datetime', true ) . '+1 hour' ) );

        $description = get_permalink( absint( $event->ID ) );

        $location = proud_get_meeting_location( get_post_meta( absint( $event->ID ), 'location', true ) );
    }
?>
    <add-to-calendar-button
      id="pc-atcb-button"
      name="<?php echo esc_attr( $event->post_title ); ?>"
      description="<?php echo esc_url( $description ); ?>"
      startDate="<?php echo sanitize_text_field( $start_date ); ?>"
      startTime="<?php echo sanitize_text_field( $start_time ); ?>"
      endTime="<?php echo sanitize_text_field( $end_time ); ?>"
      timeZone="<?php echo sanitize_text_field( $timezone ); ?>"
      location="<?php echo sanitize_text_field( $location ); ?>"
      iCalFileName="<?php echo sanitize_title( $event->post_title ); ?>"
      options="'Apple','Google','iCal','Outlook.com','Yahoo'"
      styleLight="
        --btn-background:#fff;
        --font: Roboto, sans-serif;
        --btn-hover-background:#e6e6e6;
        --btn-padding-x:1px; --btn-padding-y:5px;
        --btn-border-radius:2px; --list-border-radius:2px;
        --btn-border:#ccc;
        --btn-font-weight:400;
        --base-font-size:.8em; --base-font-size-l:.8em; --base-font-size-m:12px; --base-font-size-s: 12px;
        --btn-shadow:0 none transparent; --btn-hover-shadow:0 none transparent; --btn-active-shadow:0 none transparent;
      "
    ></add-to-calendar-button>
<?php

} // build_atcb_json

/**
 * Builds out the HTML for the Add to Calendar button and includes the scripts
 *
 * @since 2022-10-11
 * @author Curtis
 *
 * @uses    object          $event              required                        The event post_object
 * @uses    string          $location           required                        Location string
 * @uses    object          $datetime           required                        DateTime object
 * @uses    string          $timezone           optional                        Set if you want a different timezone than the site default
 */
function get_atcb_button( $event, $location, $datetime, $timezone = null ){ ?>
          <span class="addtocalendar" data-title="<?php print sanitize_title( $event->post_title ); ?>" data-slug="<?php print esc_attr( get_post_field('post_name') ); ?>">
                <?php echo build_atcb_json( $event, $location, $datetime ); ?>
          </span>
<?php

//https://github.com/add2cal/add-to-calendar-button
// script is registered in setup.php
wp_enqueue_script( 'atcb' );
}

/**
 * Returns a formatted address for meeting locations
 *
 * @todo move this into the Proud Meeting plugin?
 *
 * @since 2022.10.26
 * @author Curtis
 *
 * @param   int             $location_id            required            ID of the meeting location which is the location CPT
 * @uses    get_the_title()                                             Returns the title given the post_id
 * @uses    get_post_meta()                                             returns post meta given post_id and key
 * @return  string                                                      Built location information
 */
function proud_get_meeting_location( $location_id ){

    $title = get_the_title( absint( $location_id ) );
    $address = get_post_meta( absint( $location_id ), 'address', true );
    $city = get_post_meta( absint( $location_id ), 'city', true );

    return $title . ' ' . $address . ' ' . $city;
}
