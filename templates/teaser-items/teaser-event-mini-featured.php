<li <?php post_class( "featured teaser-mini" ); ?>><!-- template-file: teaser-event-mini-featured.php -->
  <?php if( has_post_thumbnail() ): ?>
  <div class="image image-aspect ratio-2-1">
    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('featured-teaser'); ?></a>
  </div>
  <?php endif; ?>
  <?php the_title( sprintf( '<h3 class="h4 entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
  <p class="text-muted margin-bottom-none"><?php echo get_the_date(); ?></p>
  <p class="featured-caption"><?php echo \Proud\Core\wp_trim_excerpt( '', true, false, 15 ); ?></p>
</li>
