<?php

/**
 * UniqueID is passed through a bunch of files so that accordions can have a unique
 * parent id and then target the expected parent.
 *
 * Find the original definition of uniqueID in teaser-list-widget.class.php
 */
?>
<div class="panel panel-default accordion"><!-- template-file: teaser-question-accordian.php -->
  <div class="panel-heading">
    <h3 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion<?php echo esc_attr($uniqueID); ?>" href="#collapse<?php echo the_id(); ?>">
        <?php echo the_title(); ?>
      </a>
    </h3>
  </div>
  <div id="collapse<?php echo the_id(); ?>" class="panel-collapse collapse">
    <div class="panel-body">
      <?php echo the_content(); ?>
    </div>
  </div>
</div>
