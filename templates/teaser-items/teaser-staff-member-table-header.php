<div class="table-responsive"><table class="table table-striped">
  <?php
  echo sprintf( '<thead><tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr></thead>',
    __( 'Name', 'proud-teaser' ),
    __( 'Position', 'proud-teaser' ),
    empty($this->hide['agency']) ? _x( 'Agency', 'post type singular name', 'wp-agency' ): '',     
    __( 'Phone', 'proud-teaser' ),    
    __( 'Email', 'proud-teaser' ),    
    empty($this->hide['social']) ? __( 'Social', 'proud-teaser' ) : ''
  );
  ?>
  <tbody>
