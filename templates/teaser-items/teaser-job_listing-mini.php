<li <?php post_class( "teaser-mini" ); ?>>
  <<?php echo $header_tag; ?> class="entry-title"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></<?php echo $header_tag; ?>>
  <ul class="list-inline">
    <?php do_action( 'job_listing_meta_start' ); ?>
    <li class="job">
      <?php Proud\WP_Job_Manager\proud_wp_job_manager_print_types($post); ?>
    </li>
    <li class="date-posted" itemprop="datePosted"><i class="fa fa-calendar"></i> <date><?php printf( __( '%s ago', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>
    <?php do_action( 'job_listing_meta_end' ); ?>
  </ul>
</li>