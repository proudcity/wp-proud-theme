<?php use Proud\Agency; ?>
<div <?php post_class( "card-wrap" ); ?>>
  <a href="<?php echo esc_url( Agency\get_agency_permalink() ) ?>" class="card text-center card-btn card-block">
    <i class="fa <?php echo $meta['agency_icon'][0]; ?> fa-3x"></i>
      <?php the_title( sprintf( '<h3 class="entry-title">' ), '</h3>' ); ?>
  </a>
</div>