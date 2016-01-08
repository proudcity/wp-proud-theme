<?php use Proud\Theme\Titles; ?>

<?php if(!Titles\titleHidden()) : ?>
  <div><!-- class="page-header"-->
    <h1><?= Titles\title(); ?></h1>
  </div>
<?php endif; ?>