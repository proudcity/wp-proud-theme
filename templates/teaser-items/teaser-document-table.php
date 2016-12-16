<?php 
use Proud\Document;
$icon = Document\get_document_icon();
$filetype = Document\get_document_type();
?>
<tr>
  <td><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></td>
  <td><?php if( empty($hide['category']) ): ?><?php foreach ($terms as $term): ?><a href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a><?php endforeach; ?><?php endif; ?></td>
  <td><?php if( empty($hide['date']) ): ?><?php echo get_the_date(); ?><?php endif; ?></td>
  <td>
    <?php if( empty($hide['download']) && !empty($src) ): ?><a href="<?php echo esc_url( get_permalink() ) ?>" <?php echo $title ?>>
      <i class="fa fa-fw text-muted filetype-icon <?php echo $icon ?>"></i> <?php echo strtoupper($filetype); ?> (<?php echo $meta->size; ?>)
    </a><?php endif; ?>
  </td>
</tr>

