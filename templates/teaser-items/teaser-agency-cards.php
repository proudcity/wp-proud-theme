<?php use Proud\Agency; ?>
<div <?php post_class( "card-wrap" ); ?>><!-- template-file: teaser-agency-cards.php -->
  <div class="card">
    <?php if( has_post_thumbnail() ): ?>
    <div class="card-img-top text-center">
      <a href="<?php echo esc_url( Agency\get_agency_permalink() ) ?>"><?php the_post_thumbnail('card-thumb'); ?></a>
    </div>
    <?php endif; ?>
    <div class="card-block">
      <?php the_title( sprintf( '<h3 class="entry-title margin-top-none"><a href="%s" rel="bookmark">', esc_url( Agency\get_agency_permalink() ) ), '</a></h3>' ); ?>
    </div>
  </div>
</div>
