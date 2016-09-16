<tr>
  
  <td><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></td>
  
  <td>
    <?php echo !empty( $meta['_staff_member_title'][0] ) ? $meta['_staff_member_title'][0] : '' ?>
  </td>

  <td>
    <?php if( empty($hide['agency']) ): ?>
      <?php foreach ($terms as $term): ?>
        <a class="label label-default" href="?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a>
      <?php endforeach; ?>
    <?php endif; ?>
  </td>

  <td><?php if( !empty( $meta['_staff_member_phone'][0] ) ): ?>
    <?php echo sprintf( '<a href="%s"><i class="fa fa-fw fa-phone"></i>%s</a>', esc_url( 'tel:' . $meta['_staff_member_phone'][0] ) , $meta['_staff_member_phone'][0] ); ?>
  <?php endif; ?></td>

  <td><?php if( !empty( $meta['_staff_member_email'][0] ) ): ?>
    <?php if(filter_var( $meta['_staff_member_email'][0], FILTER_VALIDATE_EMAIL ) ): ?>
      <?php echo sprintf( '<a href="%s"><i class="fa fa-fw fa-envelope-o"></i>%s</a>', esc_url( 'mailto:' . $meta['_staff_member_email'][0] ) , __('Email', 'proud-agency') ); ?>
    <?php else: ?>
      <?php echo sprintf( '<a href="%s"><i class="fa fa-fw fa-external-link"></i>%s</a>', esc_url( $meta['_staff_member_email'][0] ) , __('Contact', 'proud-agency') ); ?>
    <?php endif; ?> 
  <?php endif; ?></td>

  <td>
    <?php if( empty($hide['social']) && !empty( $meta['_staff_member_fb'][0] ) ): ?><a href="<?php echo esc_url( $meta['_staff_member_fb'][0] ) ?>"><i class="fa fa-fw fa-facebook-square"></i></a><?php endif; ?>
    <?php if( empty($hide['social']) && !empty( $meta['_staff_member_tw'][0] ) ): ?><a href="<?php echo esc_url( $meta['_staff_member_tw'][0] ) ?>"><i class="fa fa-fw fa-twitter-square"></i></a><?php endif; ?>
  </td>

</tr>