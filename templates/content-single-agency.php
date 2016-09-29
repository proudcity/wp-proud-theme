<?php use Proud\Theme\Titles; ?>

<?php if (get_post_meta( get_the_id(), 'agency_type', true ) == 'external' && $url = get_post_meta( get_the_id(), 'url', true )): ?>
  <script type="text/javascript">
    jQuery('#entry-content').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-4x"></i></div>');
    window.location = '<?php print $url ?>';
  </script>
<?php endif; ?>

<article <?php post_class(); ?>>
  <?php if( !Titles\titleHidden() ) : ?>
  <header>
    <h1 class="entry-title"><?php the_title(); ?></h1>
  </header>
  <?php endif; ?>
  <div class="entry-content">
      <?php if( has_post_thumbnail() && !Titles\titleHidden() ): ?>
      <p>
          <?php the_post_thumbnail(); ?>
      </p>
      <?php endif; ?>
    <?php the_content(); ?>
  </div>
</article>