<?php if ( $apply = get_the_job_application_method() ) :
  wp_enqueue_script( 'wp-job-manager-job-application' );
  ?>
  <div class="job_application">
    <?php do_action( 'job_application_start', $apply ); ?>
    
    <p><input type="button" class="application_button button btn btn-primary btn-lrg" value="<?php _e( 'Apply for job', 'wp-job-manager' ); ?>" /></p>
    
    <div class="application_details collapse"><div class="well">
      <?php
        /**
         * job_manager_application_details_email or job_manager_application_details_url hook
         */
        do_action( 'job_manager_application_details_' . $apply->type, $apply );
      ?>
    </div></div>
    <?php do_action( 'job_application_end', $apply ); ?>
  </div>
<?php endif; ?>