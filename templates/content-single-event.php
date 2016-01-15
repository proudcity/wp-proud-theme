<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <?php the_content(); ?>
  </article>
<?php endwhile; ?>
