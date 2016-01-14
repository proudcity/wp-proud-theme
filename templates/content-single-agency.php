<?php use Proud\Theme\Titles; ?>

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