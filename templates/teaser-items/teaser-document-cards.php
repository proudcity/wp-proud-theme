<?php 
use Proud\Document;
$icon = Document\get_document_icon();
$title = ($icon == 'fa-globe') ? 'title="Complete this form online"' : 'title="View/download form"';
?>
<div <?php post_class( "card-wrap" ); ?>>
  <a href="<?php echo esc_url( get_permalink() ) ?>" <?php echo $title ?> class="card text-center card-btn card-block">
    <i class="fa fa-3x text-muted filetype-icon <?php echo $icon ?>"></i>
    <h4 class="entry-title">
      <?php the_title( ); ?>
    </h4>
  </a>
</div>