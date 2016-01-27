<a href="/documents" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back to documents</a>
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="row">
  <div class="col-md-3">
    <!--<p><img src="<?php echo $meta->icon; ?>" /></p>-->
    <h5><?php the_date('M d Y'); ?></h5>
    <p>
      <?php echo strtoupper($meta->filetype); ?><br/>
      <?php echo $meta->size; ?><br/>
    </p>
    <p><a href="<?php echo $src; ?>" class="btn btn-primary btn-lg"><i class="fa fa-download"></i> Download</a></p>
  </div>
  <div class="col-md-9">
    <iframe src="http://docs.google.com/gview?url=<?php echo urlencode($src); ?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
  </div>
</div>


