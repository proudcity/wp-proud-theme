<?php
$type = get_post_meta( absint( get_the_ID() ), 'issue_category_type', true );
?>

<article <?php post_class(); ?>><!-- template-file: templates/content-single-issue.php -->
  <header>
    <h1 class="entry-title"><?php the_title( sprintf( _x( 'Report Issue: ', 'post prefix', 'wp-issue' )) ); ?></h1>
  </header>
  <div class="entry-content row" id="entry-content">
    <div class="col-md-9">
      <?php the_content(); ?>
      <?php if ( esc_attr( $type ) === 'iframe'): ?>
        <iframe src="<?php echo esc_url( get_post_meta( absint( get_the_ID() ), 'iframe', true ) ); ?>" style="border:none;height:1500px;width:100%"></iframe>
      <?php elseif( esc_attr( $type ) === 'form'): ?>
        <?php gravity_form( get_post_meta( absint( get_the_ID() ), 'form', true ), false, false ); ?>
      <?php elseif( esc_attr( $type ) === 'link' ): ?>
        <script type="text/javascript">
          jQuery('#entry-content').html('<div class="text-center"><i aria-hidden="true" class="fa fa-spinner fa-pulse fa-4x"></i></div>');
          window.location = '<?php echo esc_url( get_post_meta( absint( get_the_ID() ), 'url', true ) ); ?>';
        </script>
      <?php endif ?>
    </div>
  </div>
</article>
