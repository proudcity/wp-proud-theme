<div class="table-responsive"><table class="table table-striped"><!-- template-file: teaser-agency-table-header.php -->
  <?php
  echo sprintf( '<thead><tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr></thead>',
    _x( 'Agency', 'post type singular name', 'wp-agency' ),
    empty($this->hide['person']) ? __( 'Person', 'proud-agency' ) : '',
    empty($this->hide['phone']) ? __( 'Phone', 'proud-teaser' ) : '',
    empty($this->hide['email']) ? __( 'Contact', 'proud-teaser' ) : '',
    empty($this->hide['social']) ? __( 'Social', 'proud-teaser' ) : ''
  );
  ?>
  <tbody>
