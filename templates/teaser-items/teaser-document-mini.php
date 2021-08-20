<?php 
use Proud\Document;
$icon = Document\get_document_icon();
$title = ($icon == 'fa-globe') ? 'title="Complete this form online"' : 'title="View/download form"';
?>

<div <?php post_class( "teaser" ); ?>>
  <div class="row">
    
    <div class="col-xs-1 col-md-1">
      <a href="<?php echo esc_url( get_permalink() ) ?>" <?php echo $title ?>>
        <i class="fa fa-2x text-muted filetype-icon <?php echo $icon ?>"></i>
      </a>
    </div>
    <div class="col-md-8">
      <h3 class="h4 entry-title" style="margin-top:0;">
        <?php the_title( sprintf( '<a href="%s" rel="bookmark" %s>', esc_url( get_permalink() ), $title ), '</a>' ); ?>
      </h3>
    </div>
    <div class="col-md-3 text-md-right">
      <?php if (!empty($src)): ?>
        <a href="<?php echo $src; ?>" class="btn btn-primary btn-sm" download="<?php echo $filename; ?>"><i class="fa fa-fw fa-download"></i>Download</a>
      <?php endif; ?>
    </div>
  </div>
</div>
