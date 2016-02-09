<?php
$js_path = esc_url('/payments') . '#/city/payments/' . $post->post_name;
?>

<article <?php post_class(); ?>>
  <header>
    <h1 class="entry-title"><?php the_title(); ?></h1>
  </header>
  <div class="entry-content" id="entry-content">
    <?php the_content(); ?>
  </div>
</article>
<script type="text/javascript">
  jQuery('#entry-content').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-4x"></i></div>');
  window.location = '<?php print $js_path ?>';
</script>