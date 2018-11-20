<?php

$url = esc_url( get_permalink() );
$content = '';
if (!empty($meta['agenda'][0]) || !empty($meta['agenda_attachment'][0])) {
    if (!empty($meta['agenda_attachment'][0])) {
      $item = "<i class='fa fa-fw fa-file-pdf-o'></i>Agenda";
    }
    else {
      $item = "<i class='fa fa-fw fa-file-text'></i>Agenda";
    }
    $content .= "<a class='label label-primary' href='$url#tab-agenda'>$item</a>";
}
//print_r($meta);
if (!empty($meta['minutes'][0]) || !empty($meta['minutes_attachment'][0])) {
  if (!empty($meta['minutes_attachment'])) {
    $item = "<i class='fa fa-fw fa-file-pdf-o'></i>Minutes";
  }
  else {
    $item = "<i class='fa fa-fw fa-file-text'></i>Minutes";
  }
  $content .= "<a class='label label-primary' href='$url#tab-minutes'>$item</a>";
}

if (!empty($meta['audio'][0])) {
  $item = "<i class='fa fa-fw fa-soundcloud'></i> Audio";
  $content .= "<a class='label label-primary' href='$url#tab-audio'>$item</a>";
}

if (!empty($meta['video'][0])) {
  $item = "<i class='fa fa-fw fa-youtube'></i> Video";
  $content .= "<a class='label label-primary' href='$url#tab-video'>$item</a>";
}

$date_format = 'M j, Y';
$time_format = 'g:i a';

?>
<tr>
    <td><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></td>
    <td>
      <?php if( empty($hide['date']) ): ?><div style="min-width:7em;"><?php echo date_format($datetime, $date_format) ?></div><?php endif; ?>
      <?php if( empty($hide['time']) ): ?><div><?php echo date_format($datetime, $time_format) ?></div><?php endif; ?>
    </td>
    <td><?php if( empty($hide['content_available']) ): ?><?php echo $content ?><?php endif; ?></td>
</tr>
