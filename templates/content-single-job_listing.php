<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php job_listing_meta_display() ?>
      <hr />
    </header>
    <div class="row">
      <div class="col-md-8">
        <?php the_content(); ?>
        <?php if ( candidates_can_apply() ) : ?>
            <?php
              $apply = get_the_job_application_method();
              if ( !empty( $apply->type) &&  ( $apply->type === 'url' ||  $apply->type === 'email' ) ) :
                /**
                 * job_manager_application_details_email or job_manager_application_details_url hook
                 */
                do_action( 'job_manager_application_details_' . $apply->type, $apply );
			        ?>
            <?php endif;//get_job_manager_template( 'job-application.php' ); ?>
        <?php endif; ?>
      </div>
      <div class="col-md-4 right-sidebar">
        <?php dynamic_sidebar('sidebar-job'); ?>
      </div>
  </article>
<?php endwhile; ?>
