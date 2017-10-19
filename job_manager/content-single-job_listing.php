<?php global $post; ?>
<div class="single_job_listing" itemscope itemtype="http://schema.org/JobPosting">
  <meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />

  <?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
    <div class="job-manager-info"><?php _e( 'This listing has expired.', 'wp-job-manager' ); ?></div>
  <?php else : ?>
    <?php
      /**
       * single_job_listing_start hook
       *
       * @hooked job_listing_meta_display - 20
       * @hooked job_listing_company_display - 30
       */
    ?>

    <?php if ( is_position_filled() ) : ?>
      <div class="alert alert-warning position-filled"><?php _e( 'This position has been filled', 'wp-job-manager' ); ?></div>
    <?php elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) : ?>
      <div class="alert alert-warning listing-expired"><?php _e( 'Applications have closed', 'wp-job-manager' ); ?></div>
    <?php endif; ?>

    <div class="job_description" itemprop="description">
      <?php echo apply_filters( 'the_job_description', get_the_content() ); ?>
    </div>

    <?php if ( false && candidates_can_apply() ) : ?>
      <?php get_job_manager_template( 'job-application.php' ); ?>
    <?php endif; ?>

    <?php
      /**
       * single_job_listing_end hook
       */
      do_action( 'single_job_listing_end' );
    ?>
  <?php endif; ?>
</div>
