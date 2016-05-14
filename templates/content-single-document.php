<?php
use Proud\Theme\Wrapper,
  Proud\Document;

$id = get_the_ID();
$src = get_post_meta( $id, 'document', true );
$filename = get_post_meta( $id, 'document_filename', true );
$meta = json_decode(get_post_meta( $id, 'document_meta', true ));
$terms = wp_get_post_terms( $id, 'document_taxonomy', array("fields" => "all"));
$show_preview = $meta->filetype == 'pdf' && ( strpos(strtoupper($meta->size), 'KB') !== FALSE || ( strpos($meta->size, 'MB') !== FALSE && (int)str_replace(' MB', '', $meta->size) < 10 ) );

$form_id = get_post_meta( $id, 'form', true );
if ( !empty($form_id) ) {

  // Docs: https://www.gravityhelp.com/documentation/article/embedding-a-form/#usage-examples
  // gravity_form( $id_or_title, $display_title = true, $display_description = true, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true );
  $form = gravity_form( $form_id, false, true, false, null, false, 0, false );
  $show_preview = 2;
}

?>
<div class="page-header">
  <h2><a href="/documents" onclick="history.go(-1);return false;">Documents</a></h2>
</div>

<h1 class="entry-title">
  <i class="fa fa-fw <?php echo Document\get_document_icon() ?>"></i>
  <?php the_title(); ?>
</h1>

<div class="row">
  <div class="col-md-3">
    <!--<p><img src="<?php echo $meta->icon; ?>" /></p>-->
    <p>
      <?php foreach ($terms as $term): ?>
        <a class="label label-default" href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a>
      <?php endforeach; ?>
    </p>
    <p>
      <div><?php the_date('F j Y'); ?></div>
      <ul class="list-inline list-inline-middot icon-list">
        <li><?php echo strtoupper($meta->filetype); ?></li>
        <li><?php echo $meta->size; ?></li>
      </ul>
    </p>
    <?php if (!empty($src)): ?>
      <p>
        <a href="<?php echo $src; ?>" class="btn btn-primary" download="<?php echo $filename; ?>"><i class="fa fa-download"></i> Download</a>
        <?php if ($show_preview === 2): ?>
          <a href="#" onclick="jQuery('#doc-preview').slideToggle();jQuery(this).toggleClass('active');" class="btn btn-default"><i class="fa fa-eye"></i> Preview</a>
        <?php endif; ?>
      </p>

    <?php endif; ?>
  </div>
  <div class="col-md-9">
    <?php echo the_content() ?>
    <?php if ($show_preview): ?>
      <iframe src="//docs.google.com/gview?url=<?php echo $src; ?>&embedded=true" id="doc-preview" style="width:100%; height:600px;<?php if($show_preview === 2): ?>display:none<?php endif; ?>;" frameborder="0" ></iframe>
    <?php endif; ?>
    <?php if( !empty($form_id) ): ?>
      <?php print $form; ?>
    <?php endif; ?>
  </div>
</div>
