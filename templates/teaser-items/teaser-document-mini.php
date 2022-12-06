<?php
use Proud\Document;
$icon = Document\get_document_icon();
$title = ($icon == 'fa-globe') ? 'title="Complete this form online"' : 'title="View/download form"';
?>

<div <?php post_class( "teaser" ); ?>><!-- template-file: teaser-document-mini.php -->
  <div class="row">

    <div class="col-md-9">
      <h3 class="h4 entry-title" style="margin-top:0;">
        <i aria-hidden="true" class="fa fa-fw text-muted filetype-icon <?php echo sanitize_html_class( $icon ); ?>"></i>
        <?php the_title( sprintf( '<a href="%s" rel="bookmark" %s>', esc_url( get_permalink() ), $title ), '</a>' ); ?>
      </h3>
    </div>
    <div class="col-md-3 text-md-right">
      <?php if (!empty($src)): ?>
        <a href="<?php echo esc_url( $src ); ?>" class="btn btn-primary btn-sm" download="<?php echo $filename; ?>"><i aria-hidden="true" class="fa fa-fw fa-download"></i>Download</a>
      <?php endif; ?>
    </div>
  </div>
</div>
