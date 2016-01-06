<?php
/**
 * Template Name: Teasers Page
 */

use Proud\Theme\Teaser;

?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php 

            $meta = get_post_meta( get_the_ID() );
            // Call Teaser list
            $teaser_list = new Teaser\ContentTeaser( $meta[ 'proud_teaser_display' ], array(
              'post_type' => 'post',
              'posts_per_page' => 5,
              'update_post_term_cache' => false, // don't retrieve post terms
              'update_post_meta_cache' => false, // don't retrieve post meta
            ) );

            $teaser_list->print_teaser_list();
        ?>
    <?php endwhile; ?>

<?php endif; ?>

<?php
 
    
 
?>