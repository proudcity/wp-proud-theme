<?php
use Proud\Document;

$icon = Document\get_document_icon();
$title = ($icon == 'fa-globe') ? 'title="Complete this form online"' : 'title="View/download form"';
?>

<div <?php post_class("teaser"); ?>><!-- template-file: teaser-document-list.php -->
  <div class="row">

    <div class="col-md-8">
      <h3 class="h4 entry-title" style="margin-top:0;">
        <i aria-hidden="true" class="fa fa-fw text-muted filetype-icon <?php echo sanitize_html_class($icon);?>"></i>
        <?php the_title(sprintf('<a href="%s" rel="bookmark" %s id="%s">', esc_url(get_permalink()), $title, get_the_ID()), '</a>'); ?>

        <?php foreach ($terms as $term): ?>
          <a class="label label-default" href="?filter_categories[]=<?php echo absint($term->term_id);?>"><?php echo esc_attr($term->name); ?></a>
        <?php endforeach; ?>

      </h3>
      <div class="text-muted text-small">Posted on <?php echo get_the_date(); ?></div>
    </div>
    <div class="col-md-3 text-md-right">
      <?php if (!empty($src)): ?>
        <a href="<?php echo $src; ?>" class="btn btn-primary btn-sm" download="<?php echo $filename; ?>" aria-labelledby="<?php the_ID(); ?>"><i aria-hidden="true" class="fa fa-fw fa-download"></i>Download</a>
      <?php endif; ?>
    </div>
  </div>
  <?php do_action('teaser_search_matching', $post); ?>
</div>
