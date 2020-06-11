
<div class="entry-content row">
<div class="col-md-4 padding-md-left pull-md-right">
    <p><?php the_post_thumbnail( array( 300, 300 ) ); ?></p>
    <p>
        <strong>Phone</strong><br/>
        <?php echo $meta['_staff_member_phone'][0]; ?>
    </p>
    <p>
        <strong>Email</strong><br/>
        <a href="mailto:<?php echo $meta['_staff_member_email'][0]; ?>"><?php echo $meta['_staff_member_email'][0]; ?> </a>
    </p>
</div>
    <div class="col-md-8">
        <?php the_title( sprintf( '<h3 class="h4 entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

        <?php echo $meta['_staff_member_bio'][0]; ?> 
    </div>
</div>
