<li <?php post_class( "teaser-mini" ); ?>>
  <?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
  <ul class="list-inline">
    <?php do_action( 'job_listing_meta_start' ); ?>
    <li class="job"><span class="label job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></span></li>
    <li class="date-posted" itemprop="datePosted"><i class="fa fa-calendar"></i> <date><?php printf( __( '%s ago', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>
    <?php do_action( 'job_listing_meta_end' ); ?>
  </ul>
</li>