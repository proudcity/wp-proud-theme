<div <?php post_class( "teaser" ); ?> itemscope itemtype="http://schema.org/JobPosting">
  <meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />
  <div class="row">
    <div class="col-sm-2 pull-right">
      <a href="<?php the_job_permalink(); ?>"><?php the_company_logo(); ?></a>
    </div>
    <div class="col-sm-10 pull-left">
      <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
      <ul class="list-inline">
        <?php do_action( 'job_listing_meta_start' ); ?>
        <li class="job"><span class="label job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></span></li>
        <li class="company"><strong><?php the_company_name( ); ?></strong></li>
        <li class="date-posted" itemprop="datePosted"><i class="fa fa-calendar"></i> <date><?php printf( __( '%s ago', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>
        <?php do_action( 'job_listing_meta_end' ); ?>
      </ul>
      <p class="margin-bottom-none"><?php echo \Proud\Core\wp_trim_excerpt(); ?></p>
    </div>
  </div>
</div>