<div <?php post_class( "card-wrap" ); ?>><!-- template-file: teaser-proud-topic-icons.php -->
  <a href="<?php echo esc_url( get_permalink() ) ?>" class="card text-center card-btn card-block">
    <i class="fa <?php echo esc_attr( $meta['topic_icon'][0] ?? '' ); ?> fa-3x"></i>
      <?php the_title( sprintf( '<h3 class="h4 entry-title">' ), '</h3>' ); ?>
  </a>
</div>
