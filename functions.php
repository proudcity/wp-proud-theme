<?php
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




function proud_customize_register( $wp_customize ) {
  // Settings
  $wp_customize->add_setting( 'color_main' , array(
    'default'     => '#000000',
    'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'color_secondary' , array(
    'default'     => '#000000',
    'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'color_highlight' , array(
    'default'     => '#000000',
    'transport'   => 'refresh',
  ) );

  // Controls
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_main', array(
    'label'        => __( 'Main color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_main',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_secondary', array(
    'label'        => __( 'Secondary color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_secondary',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_highlight', array(
    'label'        => __( 'Highlight color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_highlight',
  ) ) );
}
add_action( 'customize_register', 'proud_customize_register' );




function proud_customize_css()
{
    ?>
        <!-- proud custom theme settings -->
        <style type="text/css">
            .navbar-default,
            .nav-contain .nav-pills li a,
            .agency-icon {
              background-color: <?php echo get_theme_mod('color_main', '#000000'); ?> !important;
            }

            .navbar.navbar-default {
              border-color: <?php echo get_theme_mod('color_main', '#000000'); ?> !important;
            }

            .banner-wrap.blue-back:before,
            .section-city .customize {
              background-color: <?php echo get_theme_mod('color_secondary', '#000000'); ?> !important;
            }

            .nav-contain .nav-pills li.active a,
            #banner .get-started .btn,
            #map-wrapper .menu-ui a.active,
            .agency-icon:hover {
              background-color: <?php echo get_theme_mod('color_highlight', '#000000'); ?> !important;
            }

            #banner .get-started .btn {
              border-color: <?php echo get_theme_mod('color_highlight', '#000000'); ?> !important;
            }

            a{
              color: <?php echo get_theme_mod('color_highlight', '#000000'); ?>;
            }

            #banner.city-banner h3,
            #banner.city-banner h1,
            .section-city .customize {
              color: {{settings.header.searchColor}} !important;
            }
         </style>
    <?php
}
add_action( 'wp_head', 'proud_customize_css');