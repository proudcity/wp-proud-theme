<?php
use Proud\Document;

$icon = Document\get_document_icon();
$filetype = Document\get_document_type();
?>
<tr><!-- template-file: teaser-document-table.php -->
  <td><?php the_title(sprintf('<a href="%s" rel="bookmark" id="%s">', esc_url(get_permalink()), get_the_ID()), '</a>'); ?></td>
  <td>
    <?php if(empty($hide['category'])): ?>
      <?php foreach ($terms as $term): ?>
        <a href="?filter_categories[]=<?php echo absint($term->term_id); ?>"><?php echo esc_attr($term->name); ?></a>
      <?php endforeach; ?>
    <?php endif; ?>
  </td>
  <td><?php if(empty($hide['date'])): ?><?php echo get_the_date(); ?><?php endif; ?></td>
  <td>
    <?php if(empty($hide['download']) && !empty($src)): ?><a href="<?php echo esc_url(get_permalink()) ?>" aria-labelledby="<?php the_ID(); ?>">
      <i aria-hidden="true" class="fa fa-fw text-muted filetype-icon <?php echo sanitize_html_class($icon); ?>"></i> <?php echo strtoupper($filetype); ?> (<?php echo esc_attr($meta->size); ?>)
    </a><?php endif; ?>
  </td>
</tr>

