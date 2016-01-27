<?php
$id = get_the_ID();
$src = get_post_meta( $id, 'document', true );
$meta = json_decode(get_post_meta( $id, 'document_meta', true ));
$terms = wp_get_post_terms( $id, 'document_taxonomy', array("fields" => "all"));
?>
<div <?php post_class( "teaser" ); ?>>
  <div class="row">
    
    <div class="col-xs-2 col-md-1">
      <img src="<?php echo $meta->icon; ?>" />
    </div>
    <div class="col-md-4">
      <h4 class="entry-title" style="margin-top:0;">
        <?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
        <small><?php foreach ($terms as $term): ?><a class="label label-default" href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a><?php endforeach; ?></small>
      </h4>
      <div class="muted"><?php echo get_the_date(); ?></div>
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-3">
      <a href="<?php echo $src; ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
    </div>

  </div>
</div>
