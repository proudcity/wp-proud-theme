<?php

use Proud\Theme\Setup;
use Proud\Theme\Wrapper;

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
    <div class="wrap <?php echo Wrapper\container_class(); ?>" role="document">
      
      <?php if (Setup\page_agency_info(true)) : ?>
        <div class="page-header">
          <h2><?php echo Wrapper\agency_title(); ?></h2>
        </div><!-- /.sidebar -->
      <?php endif; ?>

      <div class="content row">
        
        <?php if (Setup\page_agency_info()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

        <?php if (Setup\page_agency_info(true)) : ?>
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
