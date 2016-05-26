<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="row">
      <div class="col-md-8">
        <?php the_content(); ?>
      </div>
      <div class="col-md-4 right-sidebar">
        <?php dynamic_sidebar('sidebar-event'); ?>
      </div>
  </article>
<?php endwhile; ?>
