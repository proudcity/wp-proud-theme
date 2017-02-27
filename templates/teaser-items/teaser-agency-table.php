<tr>
  
  <td><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></td>
  
  <td><?php echo empty($this->hide['person']) && !empty( $meta['name'][0] ) ? $meta['name'][0] : '' ?></td>
  
  <td><?php if( !empty( $meta['phone'][0] ) ): ?>
    <?php echo sprintf( '<a href="%s"><i class="fa fa-fw fa-phone"></i>%s</a>', esc_url( 'tel:' . $meta['phone'][0] ) , $meta['phone'][0] ); ?>
  <?php endif; ?></td>

  <td><?php if( !empty( $meta['email'][0] ) ): ?>
    <?php if(filter_var( $meta['email'][0], FILTER_VALIDATE_EMAIL ) ): ?>
      <?php echo sprintf( '<a href="%s"><i class="fa fa-fw fa-envelope-o"></i>%s</a>', esc_url( 'mailto:' . $meta['email'][0] ) , __('Email', 'proud-agency') ); ?>
    <?php else: ?>
      <?php echo sprintf( '<a href="%s"><i class="fa fa-fw fa-external-link"></i>%s</a>', esc_url( $meta['email'][0] ) , __('Contact', 'proud-agency') ); ?>
    <?php endif; ?> 
  <?php endif; ?></td>

  <td>
    <?php if ( empty($this->hide['social']) ): ?>
      <?php if( !empty( $meta['social_facebook'][0] ) ): ?><a href="<?php echo esc_url( $meta['social_facebook'][0] ) ?>"><i class="fa fa-fw fa-facebook-square"></i></a><?php endif; ?>
      <?php if( !empty( $meta['social_twitter'][0] ) ): ?><a href="<?php echo esc_url( $meta['social_twitter'][0] ) ?>"><i class="fa fa-fw fa-twitter-square"></i></a><?php endif; ?>
    <?php endif; ?>
  </td>

</tr>