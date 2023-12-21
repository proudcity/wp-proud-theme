<?php use Proud\Theme\Titles; ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>><!-- template-file: templates/content-single-proud_location.php -->
    <?php if( !Titles\titleHidden() ) : ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
      <p class="text-muted"><?php echo __('Posted on ', 'wp-proud') . get_the_date(); ?></p>
      <hr />
    </header>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-<?php echo is_active_sidebar('sidebar-news') ? '8' : '12' ?> entry-content">
        <?php if( has_post_thumbnail() && !get_post_meta( get_the_ID(), 'hide_featured_image', true ) && !Titles\titleHidden() ): ?>
          <div class="media text-center">
            <?php the_post_thumbnail(); ?>
            <?php $media = get_post(get_post_thumbnail_id()); ?>
            <?php if( $media && !empty($media->post_excerpt) ): ?><div class="media-byline"><span><?php echo $media->post_excerpt ?></span></div><?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="proud-location-information row">

          <div itemscope itemtype="https://schema.org/Person">

            <div class="col-sm-6 proud-location-address"><!-- this should be a left column-->
              <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                <span itemprop="streetAddresss">
                    <p><strong>Address:</strong></p>
                    <p><?php echo esc_attr( get_post_meta( get_the_ID(), 'address', true ) ); ?></p>
                    <p><?php echo esc_attr( get_post_meta( get_the_ID(), 'address2', true ) ); ?></p>
                </span><!-- /streetAddress -->

                <p itemprop="addressLocality">
                    <?php echo esc_attr( get_post_meta( get_the_ID(), 'city', true ) ); ?>
                </p><!-- addressLocality -->

                <p itemprop="addressRegion">
                    <?php echo esc_attr( get_post_meta( get_the_ID(), 'state', true ) ); ?>
                </p><!-- addressRegion -->

                <span itemprop="postalCode">
                    <?php echo esc_attr( get_post_meta( get_the_ID(), 'zip', true ) ); ?>
                </span><!-- postalCode -->

            </div><!-- / PostalAddress -->
          </div><!-- / left column -->

          <div class="col-sm-6"><!-- this should be a right column -->

            <?php $email = get_post_meta( get_the_ID(), 'email', true );
              if ( isset( $email ) && ! empty( $email ) ){ ?>
              <p class="proud-location-email"><strong>Email:</strong> <a href="<?php echo sanitize_email( $email ); ?>" itemprop="email"><?php echo sanitize_email( $email ); ?></a></p>
            <?php } ?>

            <?php $phone = get_post_meta( get_the_ID(), 'phone', true );
              if ( isset( $phone ) && ! empty( $phone ) ){ ?>
            <p class="proud-location-phone" itemprop="telephone"><strong>Phone:</strong> <?php echo esc_attr( $phone ); ?></p>
            <?php } ?>

            <?php $website = get_post_meta( get_the_ID(), 'website', true );
              if ( isset( $website ) && ! empty( $website ) ){ ?>
            <p class="proud-location-website"><strong>Website:</strong> <a href="<?php esc_url( $website ); ?>" itemprop="url"><?php echo esc_url( $website ); ?></a></p>
            <?php } ?>

            <?php $hours = get_post_meta( get_the_ID(), 'hours', true );
              if ( isset( $hours ) && ! empty( $hours ) ){ ?>
            <p class="proud-location-hours" itemprop="openingHours" content="<?php echo esc_attr( $hours ); ?>"><strong>Hours:</strong> <?php echo esc_attr( $hours ); ?></p>
            <?php } ?>

          </div><!-- / right column -->

          </div><!-- /itemscope Person -->

        </div><!-- /.proud-location-information -->

        <?php the_content(); ?>

        <div class="proud-location-map">
          map goes here
        </div><!-- /.proud-location-map -->

      </div>
      <?php if (is_active_sidebar('sidebar-news')): ?>
        <div class="text-left col-md-4 right-sidebar">
            <?php dynamic_sidebar('sidebar-location'); ?>
        </div>
      <?php endif; ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'proud'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
