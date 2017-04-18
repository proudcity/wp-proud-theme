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
    <div class="col-md-10">
      <h4 class="entry-title" style="margin-top:0;">
        <?php the_title( sprintf( '<a href="%s" rel="bookmark" %s>', esc_url( get_permalink() ), $title ), '</a>' ); ?>
      </h4>
      <div class="text-muted text-small">Posted on <?php echo get_the_date(); ?></div>
    </div>

  </div>
</div>
