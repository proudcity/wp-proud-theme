<div class="table-responsive"><table class="table table-striped">
  <?php

  $position_label = get_option( 'staff_position_label', 'Position' );

  echo sprintf( '<thead><tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr></thead>',
    __( 'Name', 'proud-teaser' ),
    __( $position_label, 'proud-teaser' ),
    empty($this->hide['agency']) ? _x( 'Agency', 'post type singular name', 'wp-agency' ): '',     
    __( 'Phone', 'proud-teaser' ),    
    __( 'Contact', 'proud-teaser' ),    
    empty($this->hide['social']) ? __( 'Social', 'proud-teaser' ) : ''
  );

  ?>
  <tbody>
