<?php
$id = get_the_ID();
$src = get_post_meta( $id, 'document', true );
$filename = get_post_meta( $id, 'document_filename', true );
$meta = json_decode(get_post_meta( $id, 'document_meta', true ));
$terms = wp_get_post_terms( $id, 'document_taxonomy', array("fields" => "all"));
?>
<a href="/documents" class="btn btn-default btn-sm pull-md-right header-margin"><i class="fa fa-arrow-left"></i> Back to documents</a>
<h1 class="entry-title">
  <?php the_title(); ?>
  <?php foreach ($terms as $term): ?><a class="label label-default" href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a><?php endforeach; ?>
</h1>
<div class="row">
  <div class="col-md-3">
    <!--<p><img src="<?php echo $meta->icon; ?>" /></p>-->
    <h5><?php the_date('M d Y'); ?></h5>
    <ul class="list-inline list-inline-middot icon-list">
      <li><?php echo strtoupper($meta->filetype); ?></li>
      <li><?php echo $meta->size; ?></li>
    </ul>
    <?php if (!empty($src)): ?>
      <div><a href="<?php echo $src; ?>" class="btn btn-primary btn-lg" download="<?php echo $filename; ?>"><i class="fa fa-download"></i> Download</a></div>
       <p class="text-small text-muted"><?php echo $filename; ?></p>
    <?php endif; ?>
  </div>
  <div class="col-md-9">
    <?php echo the_content() ?>
    <?php if ($meta->filetype == 'pdf'): ?>
      <iframe src="//docs.google.com/gview?url=<?php echo $src; ?>&embedded=true" style="width:100%; height:600px;" frameborder="0"></iframe>
    <?php endif; ?>
  </div>
</div>