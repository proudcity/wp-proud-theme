<?php
$terms = wp_get_post_terms( get_the_ID(), 'faq-topic');
$term_slug = !empty($terms) ?  $terms[0]->slug . '/' : '';
$js_path = '/' . $term_slug . $post->post_name;
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
  (function($, Proud) {
    $(document).ready(function() {
      Proud.proudNav.triggerOverlay('answers', '<?php echo $js_path ?>');
    });
  })(jQuery, Proud);
</script>