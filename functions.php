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
  $wp_customize->add_setting( 'color_footer_actions' , array(
    'default'     => '#FFFFFF',
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
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_footer_actions', array(
    'label'        => __( 'Footer actions bar color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_footer_actions',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_footer', array(
    'label'        => __( 'Footer color', 'proud' ),
    'section'    => 'colors',
    'settings'   => 'color_footer',
  ) ) );

  // Logo
  $wp_customize->add_setting( 'proud_logo' );
  $wp_customize->add_setting( 'proud_logo_includes_title' );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'proud_logo', array(
    'label'    => __( 'Logo', 'proud' ),
    'section'  => 'title_tagline',
    'settings' => 'proud_logo',
    'description' => __( 'The logo appears in the header and footer and should have a transparent background. Check the box below if you would not like the site title to appear next to the logo.', 'proud' ),
  ) ) );
  $wp_customize->add_control( 'proud_logo_includes_title', array(
    'label'      => __( 'Logo includes site name', 'proud' ),
    'section'    => 'title_tagline',
    'settings'   => 'proud_logo_includes_title',
    'type'       => 'checkbox',
    'std'        => '1'
  ) );

}
add_action( 'customize_register', 'proud_customize_register' );

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
    Proud\Theme\Assets\asset_path( 'fonts/govicons-master/css/govicons.min.css' ), 
    array()
  );
  wp_enqueue_style( 'gov-icons/css' );
}
add_action( 'admin_enqueue_scripts', 'proud_theme_add_gov_icon_styles' );

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
add_filter( 'proud_form_icon_picker_options', 'proud_theme_icon_picker_options', 10 );

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
  // Set up navbar background, allow transparent alter
  $navbar_background = get_theme_mod( 'color_topnav', '#000000' );
  if( proud_navbar_transparent() ) {
    $navbar_background_opaque = 'rgba(' . implode( ',', $header_rgb ) . ',1)';
  }

    ?>
        <!-- proud custom theme settings -->
        <style type="text/css">
            .menu-box, .navbar-default {
              background-color: <?php echo $navbar_background ?> !important;
            }
            .navbar.navbar-default {
              border-color: <?php echo $navbar_background ?> !important;
            }
            <?php if( proud_navbar_transparent() ): ?>
            #navbar-transparent-mask, .scrolled.proud-navbar-transparent .navbar-default, .search-active.proud-navbar-transparent .navbar-default, .active-311.proud-navbar-transparent .navbar-default,  .jumbotron-inverse .jumbotron-bg-mask  {
              background-color: <?php echo $navbar_background_opaque ?> !important;
            }
            .scrolled .navbar.navbar-default {
              border-color: <?php echo $navbar_background_opaque ?> !important;
            }
            <?php elseif($navbar_background == '#FFFFFF' || $navbar_background == '#ffffff'): ?> 
            .navbar.navbar-external {
              border-bottom: 1px solid #eeeeee !important;
            }
            <?php endif; ?>

            .nav-contain .nav-pills li a,
            .agency-icon {
              background-color: <?php echo get_theme_mod('color_topnav', '#000000'); ?> !important;
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
            
            .footer-actions {
              background-color: <?php echo get_theme_mod('color_footer_actions', '#FFFFFF'); ?>;
            }

            .page-footer {
              background-color: <?php echo get_theme_mod('color_footer', '#333333'); ?>;
            }
         </style>
    <?php
}
add_action( 'wp_head', 'proud_customize_css');

