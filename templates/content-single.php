<?php use Proud\Theme\Titles; ?>

<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php if( !Titles\titleHidden() ) : ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
      <p class="text-muted"><?php echo get_the_date(); ?></p>
      <hr />
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
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'proud'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
