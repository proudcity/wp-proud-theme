<?php

use Proud\Theme\Customizer;

/**
 * Proud includes
 *
 * The $lib_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/lib/pull/1042
 */
$proud_includes = [
    'lib/assets.php',    // Scripts and stylesheets
    'lib/extras.php',    // Custom functions
    'lib/setup.php',     // Theme setup
    'lib/titles.php',    // Page titles
    'lib/wrapper.php',   // Theme wrapper class
    'lib/customizer.php' // Theme customizer
];

foreach ($proud_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'proud'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);

function proud_customize_register($wp_customize) {
    // Settings
    $wp_customize->add_setting('color_topnav', array(
        'default' => '#000000',
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('color_nav_topbar', array(
        'default' => get_theme_mod('color_topnav', '#000000'),
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('color_link', array(
        'default' => '#0071bc',
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('color_highlight', array(
        'default' => '#000000',
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('color_secondary', array(
        'default' => get_theme_mod('color_topnav', '#000000'),
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('color_footer', array(
        'default' => '#333333',
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting('color_footer_actions', array(
        'default' => '#FFFFFF',
        'transport' => 'refresh',
    ));

    // Controls
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_topnav', array(
        'label' => __('Main nav color', 'proud'),
        'section' => 'colors',
        'settings' => 'color_topnav',
    )));
    // Don't show topbar setting unless enabled
    if (get_theme_mod( 'proud_topbar_enable', false )) {
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_nav_topbar', array(
            'label'    => __( 'Topbar color', 'proud' ),
            'section'  => 'colors',
            'settings' => 'color_nav_topbar',
        ) ) );
    }
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_link', array(
        'label' => __('Link color', 'proud'),
        'section' => 'colors',
        'settings' => 'color_link',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_highlight', array(
        'label' => __('Primary color', 'proud'),
        'section' => 'colors',
        'settings' => 'color_highlight',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_secondary', array(
        'label' => __('Secondary color', 'proud'),
        'section' => 'colors',
        'settings' => 'color_secondary',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_footer_actions', array(
        'label' => __('Footer actions bar color', 'proud'),
        'section' => 'colors',
        'settings' => 'color_footer_actions',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_footer', array(
        'label' => __('Footer color', 'proud'),
        'section' => 'colors',
        'settings' => 'color_footer',
    )));

    // Background modifications
    $wp_customize->add_setting('color_background', array(
        'default' => '#FFFFFF',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_background', array(
        'label' => __('Background color', 'proud'),
        'section' => 'colors',
        'settings' => 'color_background',
    )));
    $wp_customize->add_setting('background_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'background_image', array(
        'label' => __('Background Image', 'proud'),
        'section' => 'colors',
        'settings' => 'background_image',
        'description' => __('Background image for the page.', 'proud'),
    )));

    // Logo
    $wp_customize->add_setting('proud_logo');
    $wp_customize->add_setting('proud_logo_id');
    $wp_customize->add_setting('proud_logo_includes_title');
    // Old URL based logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'proud_logo', array(
        'label' => __('Logo', 'proud'),
        'section' => 'title_tagline',
        'settings' => 'proud_logo',
        'description' => __('The logo appears in the header and footer and should have a transparent background. Check the box below if you would not like the site title to appear next to the logo.', 'proud'),
    )));
    // New MediaID-based logo
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'proud_logo_id', array(
        'label' => __('Logo', 'proud'),
        'section' => 'title_tagline',
        'settings' => 'proud_logo_id',
        'description' => __('The logo appears in the header and footer and should have a transparent background. Check the box below if you would not like the site title to appear next to the logo.', 'proud'),
    )));
    $wp_customize->add_control('proud_logo_includes_title', array(
        'label' => __('Logo includes site name', 'proud'),
        'section' => 'title_tagline',
        'settings' => 'proud_logo_includes_title',
        'type' => 'checkbox',
        'std' => '1'
    ));


    // Top bar
    $wp_customize->add_section(
        'proud_topbar',
        array(
          'title'       => __( 'Top bar', 'proud' ),
          //'description' => __( 'Enable the optional ProudCity Top Bar', 'proud' ),
          'priority'    => 20, //Determines what order this appears in
          'capability'  => 'edit_theme_options', //Capability needed to tweak
        )
    );

    // Fonts default lowercase for select keys
    $wp_customize->add_setting( 'proud_topbar_enable' , array(
        'default' => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting( 'proud_topbar_logo' , array());
    $wp_customize->add_setting( 'proud_topbar_title' , array(
        'default' => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting( 'proud_topbar_link' , array(
        'default' => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting( 'proud_topbar_title_attr' , array(
        'default' => 'Home',
        'transport' => 'refresh',
    ));
    $wp_customize->add_setting( 'proud_topbar_action_icons' , array(
        'default' => false,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('proud_topbar_enable', array(
        'label' => __('Show the Top Navigation Bar', 'proud'),
        'section' => 'proud_topbar',
        'settings' => 'proud_topbar_enable',
        'type' => 'checkbox',
        //'std' => '1'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'proud_topbar_logo', array(
        'label' => __('Top Bar Logo', 'proud'),
        'section' => 'proud_topbar',
        'settings' => 'proud_topbar_logo',
        'description' => __('This optional logo appears in the top-left corner of the top bar. It is typically the city seal.', 'proud'),
    )));
    $wp_customize->add_control('proud_topbar_title', array(
        'label' => __('Top Bar title', 'proud'),
        'description' => __('Appears next to the logo on the left. Leave blank to hide.', 'proud'),
        'section' => 'proud_topbar',
        'settings' => 'proud_topbar_title',
        'type' => 'textfield',
    ));
    $wp_customize->add_control('proud_topbar_link', array(
        'label' => __('Top Bar link url', 'proud'),
        'description' => __('The URL to use as the link for the Top Bar title, if it is visible. Defaults to this site\'s homepage', 'proud'),
        'section' => 'proud_topbar',
        'settings' => 'proud_topbar_link',
        'type' => 'textfield',
    ));
    $wp_customize->add_control('proud_topbar_title_attr', array(
        'label' => __('Top Bar accessibility title', 'proud'),
        'description' => __('Appears in a tooltip when hovering over the title.', 'proud'),
        'section' => 'proud_topbar',
        'settings' => 'proud_topbar_title_attr',
        'type' => 'textfield',
    ));
    $wp_customize->add_control('proud_topbar_action_icons', array(
        'label' => __('Action Icons in Top Bar', 'proud'),
        'description' => __('Move the Action Icons (Search, Answers, etc) from the Primary Navigation to the Top Navigation Bar', 'proud'),
        'section' => 'proud_topbar',
        'settings' => 'proud_topbar_action_icons',
        'type' => 'checkbox',
        //'std' => '1'
    ));

  // If we're customizing and in preview, alter some stuff
  if ( $wp_customize->is_preview() && ! is_admin() ) {
    add_action( 'wp_footer', 'proud_customize_preview', 21 );
  }





    // Fonts

    $wp_customize->add_section(
        'proud_fonts',
        array(
            'title'       => __( 'Fonts', 'proud' ),
            'description' => __( 'Controls fonts for the ProudCity themes.', 'proud' ),
            'priority'    => 20, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
        )
    );

    // Fonts default lowercase for select keys
    $wp_customize->add_setting( 'proud_fonts_default' , array(
        'default' => 'Lato',
        'sanitize_callback' => 'Proud\Theme\Customizer\customize_sanitize_select',
    ));
    $wp_customize->add_setting( 'proud_fonts_headings' , array(
        'default' => 'Lato',
        'sanitize_callback' => 'Proud\Theme\Customizer\customize_sanitize_select',
    ));

    // Default font
    $wp_customize->add_control('proud_fonts_default', array(
        'label' => __('Default font', 'proud'),
        'section' => 'proud_fonts',
        'settings' => 'proud_fonts_default',
        'type' => 'select',
        'choices' => Customizer\customize_font_select(),
        'description' => __('Controls default font sitewide.', 'proud'),
    ) );
    // Heading font
    $wp_customize->add_control('proud_fonts_headings', array(
        'label' => __('Headings font', 'proud'),
        'section' => 'proud_fonts',
        'settings' => 'proud_fonts_headings',
        'type' => 'select',
        'choices' => Customizer\customize_font_select(),
        'description' => __('Controls heading font (h1, h2, h3, h4, h5, h6) sitewide.', 'proud'),
    ) );

    // If we're customizing and in preview, alter some stuff
    if ( $wp_customize->is_preview() && ! is_admin() ) {
        add_action( 'wp_footer', 'proud_customize_preview', 21 );
    }

//    var_dump($wp_customize->get_section('proud_fonts'));

}

add_action('customize_register', 'proud_customize_register');

// Strip menus of all their css classes and change the active class to `active`
function wp_nav_menu_attributes_filter($classes) {
    $classes = is_array($classes) ? array_intersect($classes, array('current-menu-item')) : '';
    return count($classes) ? array('active') : array();
}

add_filter('nav_menu_css_class', 'wp_nav_menu_attributes_filter', 100, 1);

/**
 * Enqueue Goverment font styles
 */
function proud_theme_add_gov_icon_styles() {
    // Enqueue our css
    wp_register_style(
        'gov-icons/css',
        Proud\Theme\Assets\asset_path('fonts/govicons-master/css/govicons.min.css'),
        array()
    );
    wp_enqueue_style('gov-icons/css');
}

add_action('admin_enqueue_scripts', 'proud_theme_add_gov_icon_styles');

/**
 *  Adds additional goverment custom icons
 */
function proud_theme_icon_picker_options($options) {
    $options['icons'] = [
        'gi-barcode',
        'gi-ruler',
        'gi-construction',
        'gi-fingerprint',
        'gi-nuclear-plant',
        'gi-radioactive',
        'gi-biohazard',
        'gi-microscope',
        'gi-dna',
        'gi-road-sign',
        'gi-road',
        'gi-road-barricade',
        'gi-submarine',
        'gi-radar',
        'gi-reticle-dot',
        'gi-reticle-crosshair',
        'gi-dogtags',
        'gi-medal-circle',
        'gi-medal-star',
        'gi-18F-logo',
        'gi-statue-of-liberty',
        'gi-liberty-bell',
        'gi-users',
        'gi-user-politician',
        'gi-shield-o',
        'gi-shield',
        'gi-us-shield',
        'gi-missile',
        'gi-satellite',
        'gi-drone',
        'gi-security-camera',
        'gi-textile',
        'gi-leaf',
        'gi-recycle',
        'gi-comment',
        'gi-comments',
        'gi-lightbulb',
        'gi-search',
        'gi-tools',
        'gi-book',
        'gi-script',
        'gi-clock-o',
        'gi-code',
        'gi-cloud-o',
        'gi-cloud',
        'gi-database',
        'gi-pie-chart',
        'gi-bar-chart',
        'gi-line-chart',
        'gi-briefcase',
        'gi-medkit',
        'gi-stethoscope',
        'gi-heartbeat',
        'gi-ship-front',
        'gi-bus-front',
        'gi-truck-front',
        'gi-truck',
        'gi-tank',
        'gi-helicopter',
        'gi-airplane',
        'gi-jet',
        'gi-gun',
        'gi-ammo',
        'gi-desktop',
        'gi-mobile',
        'gi-tablet',
        'gi-times',
        'gi-check',
        'gi-check-square-o',
        'gi-warning',
        'gi-ribbon',
        'gi-key',
        'gi-folder',
        'gi-folder-misc',
        'gi-table',
        'gi-tables',
        'gi-unlock',
        'gi-lock',
        'gi-gear',
        'gi-gears',
        'gi-money',
        'gi-usd',
        'gi-vote',
        'gi-us-tophat',
        'gi-elephant',
        'gi-donkey',
        'gi-balance',
        'gi-gavel',
        'gi-handshake',
        'gi-user-military',
        'gi-user-suit',
        'gi-user-student',
        'gi-user',
        'gi-presenter',
        'gi-file-word-o',
        'gi-file-excel-o',
        'gi-file-contract-o',
        'gi-file-text-o',
        'gi-file-text',
        'gi-file-o',
        'gi-file',
        'gi-id-card-o',
        'gi-id-card',
        'gi-dc-flag',
        'gi-dc-map',
        'gi-us-flag-wavy',
        'gi-us-flag-straight',
        'gi-us-map',
        'gi-globe',
        'gi-washington-monument',
        'gi-capitol',
        'gi-pentagon',
        'gi-building',
        'gi-540-fedapi',
        'gi-540-logo',
    ];
    $options['icon-prefix'] = 'gi';
    return $options;
}

add_filter('proud_form_icon_picker_options', 'proud_theme_icon_picker_options', 10);

/**
 * Allow Submenus
 * From http://www.ordinarycoder.com/wordpress-wp_nav_menu-show-a-submenu-only/
 * Usage:
 * $args = array(
 *   'menu'    => 'Menu Name',
 *   'submenu' => 'About Us',  // Menu title
 *  );
 * @todo: should this be in proud_core?
 */
function submenu_limit($items, $args) {
    if (empty($args->submenu))
        return $items;
    $parent_id = is_numeric($args->submenu) ? $args->submenu : array_pop(wp_filter_object_list($items, array('title' => $args->submenu), 'and', 'ID'));
    $children = submenu_get_children_ids($parent_id, $items);
    foreach ($items as $key => $item) {

        if (!in_array($item->ID, $children))
            unset($items[$key]);
    }
    return $items;
}

function submenu_get_children_ids($id, $items) {
    $ids = wp_filter_object_list($items, array('menu_item_parent' => $id), 'and', 'ID');

    foreach ($ids as $id) {

        $ids = array_merge($ids, submenu_get_children_ids($id, $items));
    }
    return $ids;
}

add_filter('wp_nav_menu_objects', 'submenu_limit', 10, 2);

/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 *
 * @param string $hex Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param float $adjustPercent A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 */
function adjust_brightness($hex, $adjustPercent) {
    $hex = ltrim($hex, '#');

    if (strlen($hex) == 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }

    $hex = array_map('hexdec', str_split($hex, 2));

    foreach ($hex as & $color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hex);
}

/**
 * Gets RGB array from hex
 *
 * @param string $hex Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 *
 * @return array|null
 */
function hex_to_rgb($hex) {
    preg_match('/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i', $hex, $result);
    return $result ? [
        'r' => intval($result[1], 16),
        'g' => intval($result[2], 16),
        'b' => intval($result[3], 16)
    ] : null;
}

/**
 * Gets brightness value for color
 *
 * @param string $hex Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param array $rgb
 *
 * @return boolean
 */
function get_color_lightness($hex, $rgb = []) {

    if (!$rgb) {
        $rgb = hex_to_rgb($hex);
    }

    if ( empty( $rgb['r']) || empty( $rgb['g'] ) || empty( $rgb['b'] ) ){
        $lightness = true;
    } else{
        $lightness = round(((intval($rgb['r']) * 299) + (intval($rgb['g']) * 587) + (intval($rgb['b']) * 114)) / 1000);
    }

    return $lightness;
}

/**
 * Tests if color is light
 *
 * @param string $hex Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param array $rgb
 *
 * @return boolean
 */
function is_light_color($hex, $rgb = []) {
    $o = get_color_lightness($hex, $rgb);

    return ($o > 135) ? true : false;
}

/**
 * Tests if color is light
 *
 * @param string $hex Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param array $rgb
 *
 * @return boolean
 */
function is_extra_light_color($hex, $rgb = []) {
    $o = get_color_lightness($hex, $rgb);

    return ($o > 190) ? true : false;
}


/**
 * Helper function returns either a color or '' if the color is white
 * @param $theme_mod
 *
 * @return string
 */
function get_color_if_not_white($theme_mod) {
    // Get our background color.
    $color = get_theme_mod($theme_mod, '');
    if ($color) {
        $c_hex = hex_to_rgb($color);

        if ($c_hex && $c_hex['r'] === 255 && $c_hex['g'] === 255 && $c_hex['b'] === 255) {
            return '';
        }
    }
    return $color;
}

function proud_customize_css() {
    // Set up navbar background, allow transparent alter
    $navbar_background = get_theme_mod( 'color_topnav', '#000000' );

    // See below
    $header_rgb = hex_to_rgb( $navbar_background );
    if (proud_navbar_transparent()) {
        $navbar_background_rga = implode(',', $header_rgb);
    }

    // Set up navbar topbar
    $topbar_background = get_theme_mod( 'color_nav_topbar', get_theme_mod( 'color_topnav', '#000000' ) );

    $color_background = get_color_if_not_white( 'color_background' );
    $background_image = get_theme_mod( 'background_image', '' );

    // Deal with links
    $link_color = get_theme_mod( 'color_link', '#0071bc' );
    if ( is_light_color( $link_color ) ) {
        $link_color_hover = adjust_brightness( $link_color, -0.20 );
    } else {
        $link_color_hover = adjust_brightness( $link_color, 0.20 );
    }

    // Primary/highlight
    $color_primary = get_theme_mod( 'color_highlight', '#000000' );
    $is_primary_light = is_light_color( $color_primary );
    $is_primary_extra_light = is_extra_light_color( $color_primary );
    if ( $is_primary_light ) {
        $color_primary_hover = adjust_brightness(  $color_primary, -0.15 );
    } else {
        $color_primary_hover = adjust_brightness(  $color_primary, 0.15 );
    }
    $color_primary_rgb = hex_to_rgb(  $color_primary );

    // Secondary links
    $color_secondary = get_theme_mod('color_secondary', get_theme_mod( 'color_topnav', '#000000' ) );
    $is_secondary_light = is_light_color( $color_secondary );
    $is_secondary_extra_light = is_extra_light_color( $color_secondary );
    if ( is_light_color( $is_secondary_light ) ) {
        $color_secondary_hover = adjust_brightness( $color_secondary, -0.15 );
    } else {
        $color_secondary_hover = adjust_brightness( $color_secondary, 0.15 );
    }
    $color_secondary_rgb = hex_to_rgb( $color_secondary );

    // Get PROUD json scss variables

    $manifestFile = dirname( __FILE__ ) . '/assets/' . 'manifest.json';
    $subManifestFile = get_template_directory() . '/assets/' . 'manifest.json';

    $manifestHelper = new \Proud\Theme\Assets\JsonManifest( $manifestFile );

    $proudSCSS = $manifestHelper->get()['config']['proudSCSS'];

    // Have a child theme
    if ( $manifestFile !== $subManifestFile ) {
        $subManifestHelper = new \Proud\Theme\Assets\JsonManifest( $subManifestFile );
        $subManifest = $subManifestHelper->get();

        // Have child css settings, so add them
        if ( !empty( $subManifest['config']['proudSCSS']['nav-fixed-top-min'] ) ) {
            $proudSCSS = $subManifest['config']['proudSCSS'];
        }
    }

    // Deal with menu active state
    $color_navbar_active = $color_secondary;
    $color_navbar_active_hover = $color_secondary_hover;
    $is_navbar_active_light = $is_secondary_light;
    $is_navbar_active_extra_light = $is_secondary_extra_light;
    if ($color_navbar_active == $navbar_background) {
        // If secondary is same color as bar...
        $color_navbar_active = $color_primary;
        $color_navbar_active_hover = $color_primary_hover;
        $is_navbar_active_light = $is_primary_light;
        $is_navbar_active_extra_light = false;
    }

    ?>
    <!-- proud custom theme settings -->
    <style type="text/css">

        <?php if ($color_background): ?>
        body {
            background-color: <?php echo $color_background ?>;
        }

        <?php endif; ?>
        <?php if ($background_image): ?>
        body {
            background-image: url("<?php echo $background_image ?>");
            background-repeat: repeat;
        }

        <?php endif; ?>

        .menu-box, .navbar-default {
          background-color: <?php echo $navbar_background ?> !important;
        }

        .navbar.navbar-default {
          border-color: <?php echo $navbar_background ?> !important;
        }

        .navbar-topbar .menu-box, .navbar-topbar.navbar-default {
            background-color: <?php echo $topbar_background ?> !important;
        }

        .navbar-topbar.navbar.navbar-default {
            border-color: <?php echo $topbar_background ?> !important;
        }

        <?php if( proud_navbar_transparent() ): ?>
        .jumbotron-inverse .jumbotron-bg {
            background-color: rgba(<?php echo $navbar_background_rga ?>, 0.8) !important;
            border-color: rgba(<?php echo $navbar_background_rga ?>, 0.8) !important;
        }

        @media screen and (min-width: <?php echo $proudSCSS['nav-fixed-top-min'] ?>) {
            .proud-navbar-transparent .navbar-external {
                background-color: rgba(<?php echo $navbar_background_rga ?>, 0.8) !important;
                border-color: rgba(<?php echo $navbar_background_rga ?>, 0.8) !important;
            }

            .scrolled.proud-navbar-transparent .navbar-external, .search-active.proud-navbar-transparent .navbar-external, .active-311.proud-navbar-transparent .navbar-external {
                background-color: rgba(<?php echo $navbar_background_rga ?>, 1) !important
            }

            .scrolled .navbar.navbar-external {
                border-color: rgba(<?php echo $navbar_background_rga ?>, 1) !important
            }
        }

        <?php elseif ( $navbar_background == '#FFFFFF' || $navbar_background == '#ffffff' ): ?>
        .navbar.navbar-external {
            border-bottom: 1px solid #eeeeee !important;
        }
        <?php endif; ?>

        /** Active navbar items **/
        <?php // @TODO switch to scss? ?>
        @media screen and (min-width: <?php echo $proudSCSS['nav-fixed-bottom-min'] ?>) {
          .navbar-external .below .navbar-nav > .active > a,
          .navbar-external .below .navbar-nav > .active > a:hover,
          .navbar-external .below .navbar-nav > .active > a:focus,
          .navbar-external .below .navbar-nav > :not(.active) > a:hover,
          .navbar-external .below .navbar-nav > :not(.active) > a:focus {
            <?php if ($is_navbar_active_light): ?>
              <?php if ($is_navbar_active_extra_light): ?>
                color: #434343!important;
              <?php else: ?>
                color: #101010!important;
              <?php endif; ?>
            <?php else: ?>
              color: #fff!important;
            <?php endif; ?>
          }

          .navbar-external .below .navbar-nav > .active > a,
          .navbar-external .below .navbar-nav > .active > a:hover,
          .navbar-external .below .navbar-nav > .active > a:focus {
            background: <?php echo $color_navbar_active; ?>;
          }

          .navbar-external .below .navbar-nav > :not(.active) > a:hover,
          .navbar-external .below .navbar-nav > :not(.active) > a:focus {
            background: <?php echo $color_navbar_active_hover; ?>;
          }
        }

        .nav-contain .nav-pills li a,
        .agency-icon {
            background-color: <?php echo $color_secondary ?> !important;
        }
        .nav-contain .nav-pills li a:hover,
        .agency-icon :hover {
            background-color: <?php echo $color_secondary_hover ?> !important;
        }
        .card-btn.card-inverse {
            box-shadow: none !important;
        }
        .card-btn.card-inverse,
        .card-btn.card-inverse a,
        .card-btn.card-inverse .h4 {
            color: #fff !important;
        }

        .jumbo-header > .jumbotron:not(.jumbotron-image),
        .jumbotron-inverse:not(.jumbotron-image),
        .nav-contain .nav-pills li.active a,
        .btn-primary,
        .card-inverse,
        .label-primary {
            background-color: <?php echo  $color_primary ?> !important;
            border-color: <?php echo  $color_primary ?> !important;
        }

        .gform_wrapper .button, .gform_button,
        .gform_wrapper .button:hover, .gform_button:hover {
            <?php if ($is_primary_light): ?>
              <?php if ($is_primary_extra_light): ?>
                color: #434343;
              <?php else: ?>
                color: #101010;
              <?php endif; ?>
            <?php else: ?>
              color: #fff;
            <?php endif; ?>
        }

        .gform_wrapper .button, .gform_button {
            background-color: <?php echo  $color_primary ?>;
            border-color: <?php echo  $color_primary ?>;
        }

        .gform_wrapper .button:hover, .gform_button:hover {
            background-color: <?php echo  $color_primary_hover ?>;
            border-color: <?php echo  $color_primary_hover ?>;
        }

        a.card-btn,
        .widget-proud-social-app .nav-pills > li > a,
        /* Service center icons */
        .action-box dl .h4 .fa,
        .action-box dl .h4 .fa:hover {
            color: <?php echo  $color_primary ?>;
        }

        a.card-btn:hover,
        .widget-proud-social-app .nav-pills > li > a:hover {
            color: <?php echo  $color_primary_hover ?>;
        }

        a.card-btn.card-inverse:focus,
        a.card-btn.card-inverse:hover{
            box-shadow: 0 0 8px 4px #fff inset !important;
            border:1px solid #FFF;
        }

        .card .social-card-header, .card .social-card-header .post-link a {
            background-color: rgba( <?php echo $color_primary_rgb['r'] . ',' . $color_primary_rgb['g'] . ','. $color_primary_rgb['b'] ?>, 1 );
        }

        a {
            color: <?php echo $link_color ?>;
        }

        a:focus,
        a:hover {
          color: <?php echo $link_color_hover ?>;
        }

        .footer-actions {
            background-color: <?php echo get_theme_mod( 'color_footer_actions', '#FFFFFF' ); ?>;
        }

        .page-footer, .powered-by-footer {
            background-color: <?php echo get_theme_mod( 'color_footer', '#333333' ); ?>;
        }

        <?php Customizer\customize_font_default_css(); ?>

        <?php Customizer\customize_font_headings_css(); ?>
    </style>
    <meta name="theme-color" content="<?php echo $navbar_background; ?>"/>
    <?php
}

add_action('wp_head', 'proud_customize_css');

/**
 * Called by preview
 */
function proud_customize_preview() {
  ?>
  <script>
    jQuery("#external-fonts-css, #public-sans-font-css").remove();
    <?php Customizer\customize_font_uris( function ( $uri, $handle ) {
      echo "jQuery('head').append(";
      echo "  \"<link id='$handle-css' href='$uri' rel='stylesheet' type='text/css' media='all' />\"";
      echo ");";
    } ); ?>
  </script>
  <?php
}
