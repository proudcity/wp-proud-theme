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
  $wp_customize->add_setting( 'color_topnav' , array(
    'default'     => '#000000',
    'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'color_link' , array(
    'default'     => '#0071bc',
    'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'color_highlight' , array(
    'default'     => '#000000',
    'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'color_footer' , array(
    'default'     => '#333333',
    'transport'   => 'refresh',
  ) );

  // Controls
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_topnav', array(
    'label'        => __( 'Top bar color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_topnav',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_link', array(
    'label'        => __( 'Link color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_link',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_highlight', array(
    'label'        => __( 'Highlight color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_highlight',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_footer', array(
    'label'        => __( 'Footer color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_footer',
  ) ) );

  // Logo
  $wp_customize->add_setting( 'proud_logo' );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'proud_logo', array(
    'label'    => __( 'Logo', 'proud' ),
    'section'  => 'title_tagline',
    'settings' => 'proud_logo',
    'description' => __( 'The logo appears in the header and footer and should have a transparent back', 'proud' ),
  ) ) );
}
add_action( 'customize_register', 'proud_customize_register' );

// Strip menus of all their css classes and change the active class to `active`
function wp_nav_menu_attributes_filter($classes) {
  $classes = is_array($classes) ? array_intersect($classes, array('current-menu-item')) : '';
  return count($classes) ? array('active') : array();
}
add_filter('nav_menu_css_class', 'wp_nav_menu_attributes_filter', 100, 1);


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
function submenu_limit( $items, $args ) {
    if ( empty($args->submenu) )
        return $items;
    $parent_id = is_numeric($args->submenu) ? $args->submenu : array_pop( wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' ) );
    $children  = submenu_get_children_ids( $parent_id, $items );
    foreach ( $items as $key => $item ) {

        if ( ! in_array( $item->ID, $children ) )
            unset($items[$key]);
    }
    return $items;
}
function submenu_get_children_ids( $id, $items ) {
    $ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );

    foreach ( $ids as $id ) {

        $ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
    }
    return $ids;
}
add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

function hex_to_rgb( $hex ) {
  preg_match('/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i', $hex, $result);
  return $result ? [
      'r' => intval($result[1], 16),
      'g' => intval($result[2], 16),
      'b' => intval($result[3], 16)
  ] : null;
}

function is_light_color( $hex, $rgb = [] ) { 
  
  if( !$rgb ) {
    $rgb = hex_to_rgb( $hex );
  }
  $o = round( ( ( intval($rgb['r'] ) * 299 ) + ( intval( $rgb['g'] ) * 587 ) + ( intval( $rgb['b'] ) * 114 ) ) / 1000 );
  return ( $o > 135 ) ? true : false;
}

function proud_customize_css()
{
  // See below, @TODO test for darkness
  $header_rgb = hex_to_rgb( get_theme_mod( 'color_topnav', '#000000' ) );

    ?>
        <!-- proud custom theme settings -->
        <style type="text/css">
            .navbar-default,
            .menu-box,
            .nav-contain .nav-pills li a,
            .agency-icon {
              background-color: <?php echo get_theme_mod('color_topnav', '#000000'); ?> !important;
            }

            .navbar.navbar-default {
              border-color: <?php echo get_theme_mod('color_topnav', '#000000'); ?> !important;
            }

            .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
              background-color: rgba(0,0,0,0.4);
            }

            .jumbotron:not(.jumbotron-image),
            .nav-contain .nav-pills li.active a,
            .btn-primary {
              background-color: <?php echo get_theme_mod('color_highlight', '#000000'); ?> !important;
              border-color: <?php echo get_theme_mod('color_highlight', '#000000'); ?> !important;
            }

            a.card-btn {
              color: <?php echo get_theme_mod('color_highlight', '#000000'); ?>;
            }

            .widget-proud-social-app .nav-pills>li>a {
              color: <?php echo get_theme_mod('color_topnav', '#000000'); ?>;
            }
            
            .card .social-card-header, .card .social-card-header .post-link a { 
              background-color: rgba(<?php echo $header_rgb['r'] . ',' . $header_rgb['g'] . ','. $header_rgb['b'] ?>, 1);
            }
            
            a{
              color: <?php echo get_theme_mod('color_link', '#0071bc'); ?>;
            }
            
            .page-footer {
              background-color: <?php echo get_theme_mod('color_footer', '#333333'); ?>;
            }
         </style>
    <?php
}
add_action( 'wp_head', 'proud_customize_css');

