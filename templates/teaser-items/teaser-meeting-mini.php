<?php
// Date formats (same as Events)
$date_format = 'F d, Y';
?>
<li <?php post_class( "teaser-mini" ); ?>>
    <<?php echo $header_tag; ?> class="<?php echo $header_class; ?> entry-title"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></<?php echo $header_tag; ?>>
    <p class="text-muted"><?php echo date_format($datetime, $date_format) ?></p>
</li>