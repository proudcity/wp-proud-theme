<tr>
  <td><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></td>
  <td>
    <?php echo !empty( $meta['_staff_member_title'][0] ) ? $meta['_staff_member_title'][0] : '' ?>
  </td>
  <td>
    <?php foreach ($terms as $term): ?><a class="label label-default" href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a><?php endforeach; ?>
  </td>
  <td><?php if( !empty( $meta['_staff_member_phone'][0] ) ): ?>
    <?php echo sprintf( '<a href="%s"><i class="fa fa-fw fa-phone"></i>%s</a>', esc_url( 'tel:' . $meta['_staff_member_phone'][0] ) , $meta['_staff_member_phone'][0] ); ?>
  <?php endif; ?></td>
  <td><?php if( !empty( $meta['_staff_member_email'][0] ) ): ?>
    <a href="<?php echo esc_url( 'mailto:' . $meta['_staff_member_email'][0] ) ?>"><i class="fa fa-fw fa-envelope-o"></i>Email</a>
  <?php endif; ?></td>
</tr>