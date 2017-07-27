<?php

use Proud\Theme\Setup;
use Proud\Theme\Wrapper;
global $proudcore;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'proud'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php echo Wrapper\alert_bar(); ?>
    <div class="wrap <?php echo Wrapper\container_class(); ?>" role="document">
      
      <?php if ( $proudcore::$layout->page_parent_info( 'title' ) ) : ?>
        <div class="page-header">
          <a id="offcanvas-toggle" href="#" class="btn btn-primary visible-xs pull-right"><i class="fa fa-bars"></i></a>
          <h2><?php echo Wrapper\parent_title(); ?></h2>
        </div><!-- /.sidebar -->
        <?php \Proud\Core\ProudBreadcrumb::print_breadcrumb() ?>
      <?php endif; ?>

      <div id="content-main" class="content row">
        
        <?php if ( $proudcore::$layout->page_parent_info( 'noagency' ) ) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

        <?php if ( $proudcore::$layout->page_parent_info( 'agency') ) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_agency_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->

      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer-actions');
      get_template_part('templates/footer');
      do_action('proud_footer');
      do_action('proud_settings');
      wp_footer();
    ?>
  </body>
</html>
