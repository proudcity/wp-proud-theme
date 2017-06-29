<?php 
use Proud\Document;
$icon = Document\get_document_icon();
$title = ($icon == 'fa-globe') ? 'title="Complete this form online"' : 'title="View/download form"';
?>

<div <?php post_class( "teaser" ); ?>>
  <div class="row">
    
    <div class="col-xs-2 col-md-1">
      <a href="<?php echo esc_url( get_permalink() ) ?>" <?php echo $title ?>>
        <i class="fa fa-3x text-muted filetype-icon <?php echo $icon ?>"></i>
      </a>
    </div>
    <div class="col-md-7">
      <h4 class="entry-title" style="margin-top:0;">
        <?php the_title( sprintf( '<a href="%s" rel="bookmark" %s>', esc_url( get_permalink() ), $title ), '</a>' ); ?>
        <?php foreach ($terms as $term): ?><a class="label label-default" href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a> <?php endforeach; ?>
      </h4>
      <div class="text-muted text-small">Posted on <?php echo get_the_date(); ?></div>
    </div>
    <div class="col-md-3 text-md-right">
      <?php if (!empty($src)): ?>
        <a href="<?php echo $src; ?>" class="btn btn-primary btn-sm" download="<?php echo $filename; ?>"><i class="fa fa-download"></i> Download</a>
      <?php endif; ?>
    </div>
  </div>
  <?php do_action( 'teaser_search_matching', $post ); ?>
</div>
