<?php
/**
 * Template Name: Teasers Page
 */

use Proud\Core;

?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php 

            // Header
            get_template_part('templates/page', 'header');

            $meta = get_post_meta( get_the_ID() );
            // Call Teaser list
            $teaser_list = new Core\TeaserList( 
                $meta[ 'proud_teaser_content' ][0], 
                $meta[ 'proud_teaser_display' ][0], 
                array(
                    'posts_per_page' => -1,
                    'update_post_term_cache' => false, // don't retrieve post terms
                    'update_post_meta_cache' => false, // don't retrieve post meta
                ),
                true
            );
        ?>
        <div class="row">
            <div class="col-md-3 padding-md-right">
                <div class="views-exposed-form">
                    <?php $teaser_list->print_filters(); ?>
                </div>
            </div>
            <div class="col-md-9">
                <?php $teaser_list->print_list(); ?>
            </div>
        </div>
        
    <?php endwhile; ?>

<?php endif; ?>

<?php
 
    
 
?>