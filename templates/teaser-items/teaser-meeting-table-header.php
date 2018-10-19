<div class="table-responsive"><table class="table table-striped">
  <?php
  echo sprintf( '<thead><tr><th>%s</th><th>%s</th><th>%s</th></tr></thead>',
    __( 'Name', 'proud-teaser' ),
    empty($this->hide['date']) ? __( 'Date', 'proud-teaser' ) : '',
    empty($this->hide['content_available']) ? __( 'Content Available', 'proud-teaser' ) : ''
  );
  ?>
  <tbody>
