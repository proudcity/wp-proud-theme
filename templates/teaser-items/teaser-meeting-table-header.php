<div class="table-responsive"><table class="table table-striped">
  <?php
  if (empty($this->hide['date'])) {
    $dateLabel =  __( 'Date', 'proud-teaser' );
  }
  elseif (empty($this->hide['time'])) {
    $dateLabel =  __( 'Time', 'proud-teaser' );
  }
  else {
    $dateLabel = '';
  }

  echo sprintf( '<thead><tr><th width="80%%">%s</th><th width="20%%">%s</th><th colspan="4" width="0">%s</th></tr></thead>',
    __( 'Name', 'proud-teaser' ),
    $dateLabel,
    empty($this->hide['content_available']) ? __( 'Content', 'proud-teaser' ) : ''
  );
  ?>
  <tbody>
