<?php
/**
 * Single view Job meta box
 *
 * Hooked into single_job_listing_start priority 20
 *
 * @since  1.14.0
 */
global $post;

do_action( 'single_job_listing_meta_before' ); ?>

<ul class="job-listing-meta meta list-inline">
  <?php do_action( 'single_job_listing_meta_start' ); ?>

  <li class="job" itemprop="employmentType">
    <?php Proud\WP_Job_Manager\proud_wp_job_manager_print_types($post); ?>
  </li>

  <li class="location" itemprop="jobLocation"><i class="fa fa-map-marker"></i> <?php the_job_location(); ?></li>

  <li class="date-posted" itemprop="datePosted"><i class="fa fa-calendar"></i> <date><?php printf( __( 'Posted %s ago', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>

  <?php do_action( 'single_job_listing_meta_end' ); ?>
</ul>

<?php do_action( 'single_job_listing_meta_after' ); ?>
