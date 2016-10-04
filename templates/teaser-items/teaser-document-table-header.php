<div class="table-responsive"><table class="table table-striped">
  <?php
  echo sprintf( '<thead><tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr></thead>',
    __( 'Name', 'proud-teaser' ),
    empty($this->hide['category']) ? __( 'Category', 'proud-teaser' ) : '',
    empty($this->hide['date']) ? __( 'Date', 'proud-teaser' ) : '',
    empty($this->hide['download']) ? __( 'Download', 'proud-teaser' ) : ''
  );
  ?>
  <tbody>
