<head><!-- template-file: templates/head.php -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="initial-scale=1.0, width=device-width"/>
  <?php

  wp_head();
//
//  function print_filters_for( $hook = '' ) {
//	  global $wp_filter;
//	  if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
//		  return;
//
//	  print '<pre>';
//	  print_r( $wp_filter[$hook] );
//	  print '</pre>';
//  }
//
//
//
?>

  <?php
  if ( ! has_post_thumbnail() ){ ?>
     <meta properyt="og:image" content="<?php echo esc_url( get_option( 'proud_default_social_image' ) ); ?>" />
  <?php } // has_post_thumnail ?>

</head>
