<div class="table-responsive"><table class="table table-striped">
  <?php
  echo sprintf( '<thead><tr><th width="80%%">%s</th><th width="20%%">%s</th><th colspan="3" width="0">%s</th></tr></thead>',
    __( 'Name', 'proud-teaser' ),
    empty($this->hide['date']) ? __( 'Date', 'proud-teaser' ) : '',
    empty($this->hide['content_available']) ? __( 'Content', 'proud-teaser' ) : ''
  );
  ?>
  <tbody>
