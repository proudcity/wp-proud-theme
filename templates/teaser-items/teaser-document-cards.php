<?php
use Proud\Document;
$icon = Document\get_document_icon();
$title = ($icon == 'fa-globe') ? 'title="Complete this form online"' : 'title="View/download form"';
?>
<div <?php post_class( "card-wrap" ); ?>>
  <a href="<?php echo esc_url( get_permalink() ) ?>" title="<?php echo esc_attr( $title ); ?>" class="card text-center card-btn card-block">
    <i aria-hidden="true" class="fa fa-3x text-muted filetype-icon <?php echo sanitize_html_class( $icon ) ?>"></i>
    <h3 class="h4 entry-title">
      <?php the_title( ); ?>
    </h3>
  </a>
</div>