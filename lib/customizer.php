<?php

namespace Proud\Theme\Customizer;

use Proud\Theme\Assets;

/**
 * Add postMesproud support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMesproud';
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('proud/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');

/**
 * Available google fonts
 *
 * @TODO figure out commented out fonts that don't have enough weights
 * @return array
 */
function customize_font_families() {
	return [
        'Source Sans Pro' => "'Source Sans Pro', sans-serif",
        'Lato' => "'Lato', sans-serif",
//        'Open Sans' => "'Open Sans', sans-serif",
        'Roboto' => "'Roboto', sans-serif",
        'Montserrat' => "'Montserrat', sans-serif",
//        'Lora' => "'Lora', serif",
        'Merriweather' => "'Merriweather', serif",
//        'Noto Serif' => "'Noto Serif', serif",
//        'Roboto Slab' => "'Roboto Slab', serif",
//        'Source Serif Pro' => "'Source Serif Pro', serif",
    ];
}

/**
 * Returns array for select options
 *
 * @return array
 */
function customize_font_select() {
    $fonts = customize_font_families();

    array_walk( $fonts, function ( &$value, &$key ) {
        $value = $key;
    } );

    return $fonts;
}

/**
 * Builds google font + weight slug for a font
 *
 * @param string $font
 * @return string
 */
function customize_font_slug( $font ) {
    return preg_replace( '/ /', '+', $font ) . ':400,900,700,300';
}

/**
 * Builds google font URI for default and headings
 *
 * @return string
 */
function customize_font_uri() {
    $font_default = get_theme_mod( 'proud_fonts_default', 'Lato' );
    $font_headings = get_theme_mod( 'proud_fonts_headings', 'Lato' );

    $fonts = [customize_font_slug($font_default)];

    if ( $font_default !== $font_headings ) {
        $fonts[] = customize_font_slug($font_headings);
    }

    return '//fonts.googleapis.com/css?family=' . implode( '|', $fonts );
}

/**
 * Echos out css for default css
 */
function customize_font_default_css() {
    $fonts = customize_font_families();
    $font_default = get_theme_mod( 'proud_fonts_default', 'Lato' );

    $selectors = [
        'body',
        '.tooltip',
        '.popover',
        '.nav-contain .nav-pills li a', // this is slightly overpowered due to media query
        'section.widget-fullcalendar .ui-selectmenu-menu',
        'section.widget-fullcalendar .wpfc-calendar-wrapper *',
    ];

    // Print out css
    ?>
        <?php echo implode( ', ', $selectors ); ?> {
            font-family: <?php echo $fonts[$font_default]; ?>;
        }
    <?php
}

/**
 * Echos out css for headings css
 */
function customize_font_headings_css() {
    $fonts = customize_font_families();
    $font_headings = get_theme_mod( 'proud_fonts_headings', 'Lato' );

    $selectors = [
        '.h1', '.h2', '.h3', '.h4', '.h5', '.h6', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
    ];

    // Print out css
    ?>
    <?php echo implode( ', ', $selectors ); ?> {
        font-family: <?php echo $fonts[$font_headings]; ?>;
    }
    <?php
}

/**
 * Sanitizes a wp_customizer select input
 *
 * @param string $input
 * @param object $setting
 * @return string
 */
function customize_sanitize_select( $input, $setting ) {
    $input = sanitize_text_field( $input );

    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;

    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}