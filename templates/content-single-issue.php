<?php
$post_id = get_the_ID();
$type = get_post_meta( $post_id, 'issue_category_type', true );
?>

<article <?php post_class(); ?>>
  <header>
    <h1 class="entry-title"><?php the_title( sprintf( 'Report Issue: ') ); ?></h1>
  </header>
  <div class="entry-content row" id="entry-content">
    <div class="col-md-9">
      <?php the_content(); ?>
      <?php if ($type == 'iframe'): ?>
        <iframe src="<?php echo get_post_meta( $post_id, 'iframe', true ); ?>" style="border:none;height:1500px;width:100%"></iframe>
      <?php elseif($type == 'form'): ?>
        <?php gravity_form( get_post_meta( $post_id, 'form', true ), false, false ); ?>
      <?php else: ?>
        <script type="text/javascript">
          jQuery('#entry-content').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-4x"></i></div>');
          window.location = '<?php echo get_post_meta( $post_id, 'url', true ) ?>';
        </script>
      <?php endif ?>
    </div>
  </div>
</article>