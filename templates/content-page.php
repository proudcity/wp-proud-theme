<?php use Proud\Theme\Titles; ?>

<?php if( has_post_thumbnail() && !get_post_meta( get_the_ID(), 'hide_featured_image', true ) && !Titles\titleHidden() ): ?>
  <div class="media text-center">
    <?php the_post_thumbnail(); ?>
    <?php $media = get_post(get_post_thumbnail_id()); ?>
    <?php if( $media && !empty($media->post_excerpt) ): ?><div class="media-byline"><span><?php echo $media->post_excerpt ?></span></div><?php endif; ?>
  </div>
<?php endif; ?>
<?php the_content(); ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'proud'), 'after' => '</p></nav>']); ?>
