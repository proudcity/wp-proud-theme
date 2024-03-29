<div class="table-responsive"><table class="table table-striped"><!-- template-file: teaser-staff-member-table-header.php -->
  <?php

  $position_label = get_option( 'staff_position_label', 'Position' );

  echo sprintf( '<thead><tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr></thead>',
    __( 'Name', 'proud-teaser' ),
    empty($this->hide['position']) ? __( $position_label, 'proud-teaser' ) : '',
    empty($this->hide['agency']) ? _x( 'Agency', 'post type singular name', 'wp-agency' ) : '',
    empty($this->hide['phone']) ? __( 'Phone', 'proud-teaser' ) : '',
    empty($this->hide['email']) ?__( 'Contact', 'proud-teaser' ) : '',
    empty($this->hide['social']) ? __( 'Social', 'proud-teaser' ) : ''
  );

  ?>
  <tbody>
