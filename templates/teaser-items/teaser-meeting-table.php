<?php

$url = esc_url( get_permalink() );
$content = '<!-- template-file: teaser-meeting-table.php -->';
if (!empty($meta['agenda'][0]) || !empty($meta['agenda_attachment'][0])) {
    if (!empty($meta['agenda_attachment'][0])) {
      $item = "<i aria-hidden='true' class='fa fa-fw fa-file-pdf-o'></i>Agenda";
    }
    else {
      $item = "<i aria-hidden='true' class='fa fa-fw fa-file-text'></i>Agenda";
    }
    $content .= "<td><a class='label label-primary' href='$url#tab-agenda'>$item</a></td>";
}
else {
  $content .= '<td></td>';
}

if (!empty($meta['agenda_packet'][0]) || !empty($meta['agenda_packet_attachment'][0])) {
    if (!empty($meta['agenda_packet_attachment'][0])) {
      $item = "<i aria-hidden='true' class='fa fa-fw fa-file-pdf-o'></i>Packet";
    }
    else {
      $item = "<i aria-hidden='true' class='fa fa-fw fa-file-text'></i>Packet";
    }
    $content .= "<td><a class='label label-primary' href='$url#tab-agenda-packet'>$item</a></td>";
}
else {
  $content .= '<td></td>';
}


if (!empty($meta['minutes'][0]) || !empty($meta['minutes_attachment'][0])) {
  if (!empty($meta['minutes_attachment'])) {
    $item = "<i aria-hidden='true' class='fa fa-fw fa-file-pdf-o'></i>Minutes";
  }
  else {
    $item = "<i aria-hidden='true' class='fa fa-fw fa-file-text'></i>Minutes";
  }
  $content .= "<td><a class='label label-primary' href='$url#tab-minutes'>$item</a></td>";
}
else {
  $content .= '<td></td>';
}


if (!empty($meta['audio'][0])) {
  $item = "<i aria-hidden='true' class='fa fa-fw fa-soundcloud'></i> Audio";
  $content .= "<td><a class='label label-primary' href='$url#tab-audio'>$item</a></td>";
}
else {
  $content .= '<td></td>';
}

if (empty($meta['video_style'][0]) && !empty($meta['video'][0])) {
  $item = "<i aria-hidden='true' class='fa fa-fw fa-youtube'></i> Video";
  $content .= "<td><a class='label label-primary' href='$url#tab-video'>$item</a></td>";
}
elseif ($meta['video_style'][0] === 'external' && !empty($meta['external_video'][0])) {
    $item = "Video <i aria-hidden='true' class='fa fa-fw fa-external-link'></i>";
    $videoUrl = $meta['external_video'][0];
    $content .= "<td><a class='label label-primary' href='$videoUrl' target='_blank' title='Open video on external website'>$item</a></td>";
  }
else {
  $content .= '<td></td>';
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
    <?php if( empty($hide['content_available']) ): ?><?php echo $content ?><?php else: ?><td></td><?php endif; ?>
</tr>
