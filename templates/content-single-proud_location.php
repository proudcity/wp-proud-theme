<?php use Proud\Theme\Titles; ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php if( !Titles\titleHidden() ) : ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
      <p class="text-muted"><?php echo __('Posted on ', 'wp-proud') . get_the_date(); ?></p>
      <hr />
    </header>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-<?php echo is_active_sidebar('sidebar-news') ? '8' : '12' ?> entry-content">
        <?php if( has_post_thumbnail() && !get_post_meta( get_the_ID(), 'hide_featured_image', true ) && !Titles\titleHidden() ): ?>
          <div class="media text-center">
            <?php the_post_thumbnail(); ?>
            <?php $media = get_post(get_post_thumbnail_id()); ?>
            <?php if( $media && !empty($media->post_excerpt) ): ?><div class="media-byline"><span><?php echo $media->post_excerpt ?></span></div><?php endif; ?>
          </div>
        <?php endif; ?>
        <?php the_content(); ?>
      </div>
      <?php if (is_active_sidebar('sidebar-news')): ?>
        <div class="text-left col-md-4 right-sidebar">
            <?php dynamic_sidebar('sidebar-location'); ?>
        </div>
      <?php endif; ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'proud'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
