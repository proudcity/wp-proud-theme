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

        'Lato' => "'Lato', sans-serif",
//        'Open Sans' => "'Open Sans', sans-serif",
        'Montserrat' => "'Montserrat', sans-serif",
//        'Lora' => "'Lora', serif",
        'Merriweather' => "'Merriweather', serif",
        'Public Sans' => "'Public Sans webfont', sans-serif",
        'Roboto' => "'Roboto', sans-serif",
        'Source Sans Pro' => "'Source Sans Pro', sans-serif",
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
 * Builds font URIs for default and headings
 *
 * @param callable $callback
 * @return string
 */
function customize_font_uris( $callback ) {
    $font_default = get_theme_mod( 'proud_fonts_default', 'Lato' );
    $font_headings = get_theme_mod( 'proud_fonts_headings', 'Lato' );

    // Handle public sans

    if ( $font_default === 'Public Sans' || $font_headings === 'Public Sans' ) {
        $callback( Assets\asset_path( 'fonts/public-sans/public-sans.css' ), 'public-sans-font' );

        if ( $font_default === $font_headings ) {
            // Both are public sans
            return;
        }
    }

    // Google fonts

    $fonts = [];//

    if ($font_default !== 'Public Sans') {
      $fonts[] = customize_font_slug( $font_default );
    }

    if ( $font_headings !== 'Public Sans' && $font_default !== $font_headings ) {
        $fonts[] = customize_font_slug( $font_headings );
    }


    $callback( '//fonts.googleapis.com/css?family=' . implode( '|', $fonts ), 'external-fonts' );
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
            <?php if ( $font_default === 'Public Sans'): ?>
            text-rendering: optimizeLegibility;
            font-variant-ligatures: common-ligatures;
            -webkit-font-variant-ligatures: common-ligatures;
            -webkit-font-feature-settings: "kern";
            font-feature-settings: "kern";
            font-kerning: normal;
            <?php endif; ?>
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
        <?php if ( $font_headings === 'Public Sans'): ?>
        text-rendering: optimizeLegibility;
        font-variant-ligatures: common-ligatures;
        -webkit-font-variant-ligatures: common-ligatures;
        -webkit-font-feature-settings: "kern";
        font-feature-settings: "kern";
        font-kerning: normal;
        <?php endif; ?>
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