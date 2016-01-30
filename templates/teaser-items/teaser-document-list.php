<div <?php post_class( "teaser" ); ?>>
  <div class="row">
    
    <div class="col-xs-2 col-md-1">
      <img src="<?php echo $meta->icon; ?>" />
    </div>
    <div class="col-md-7">
      <h4 class="entry-title" style="margin-top:0;">
        <?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
        <?php foreach ($terms as $term): ?><a class="label label-default" href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a><?php endforeach; ?>
      </h4>
      <div class="text-muted text-small"><?php echo get_the_date(); ?></div>
    </div>
    <div class="col-md-3 text-md-right">
      <a href="<?php echo $src; ?>" class="btn btn-primary" download="<?php echo $filename; ?>"><i class="fa fa-download"></i> Download</a>
    </div>

  </div>
</div>
