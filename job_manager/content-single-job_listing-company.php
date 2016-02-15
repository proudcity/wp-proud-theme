<?php
/**
 * Single view Company information box
 *
 * Hooked into single_job_listing_start priority 30
 *
 * @since  1.14.0
 */

if ( TRUE || ! get_the_company_name() ) {
  return;
}
?>
<div class="company panel panel-default" itemscope itemtype="http://data-vocabulary.org/Organization"><div class="panel-body">
  <div class="row">
    <div class="col-sm-3 col-md-2">
      <?php the_company_logo(); ?>
    </div>
    <div class="col-sm-9 col-md-10">
      <h5 class="name">
        <?php the_company_twitter(); ?>
        <?php the_company_name( '<strong itemprop="name">', '</strong>' ); ?>
      </h5>
      <?php if ( $website = get_the_company_website() ) : ?>
        <p><a class="website" href="<?php echo esc_url( $website ); ?>" itemprop="url" target="_blank" rel="nofollow"><?php _e( 'Website', 'wp-job-manager' ); ?></a></p>
      <?php endif; ?>
      <?php the_company_tagline( '<p class="tagline">', '</p>' ); ?>
      <?php the_company_video(); ?>
    </div>
  </div>
</div></div>