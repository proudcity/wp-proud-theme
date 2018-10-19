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
    $content .= "<a class='label label-default' href='$url#tab-agenda'>$item</a>";
}
//print_r($meta);
if (!empty($meta['minutes'][0]) || !empty($meta['minutes_attachment'][0])) {
  if (!empty($meta['minutes_attachment'])) {
    $item = "<i class='fa fa-fw fa-file-pdf-o'></i>Minutes";
  }
  else {
    $item = "<i class='fa fa-fw fa-file-text'></i>Minutes";
  }
  $content .= "<a class='label label-default' href='$url#tab-minutes'>$item</a>";
}

if (!empty($meta['audio'][0])) {
  $item = "<i class='fa fa-fw fa-soundcloud'></i> Media";
  $content .= "<a class='label label-default' href='$url#tab-audio'>$item</a>";
}

if (!empty($meta['video'][0])) {
  $item = "<i class='fa fa-fw fa-youtube'></i> Media";
  $content .= "<a class='label label-default' href='$url#tab-video'>$item</a>";
}


?>
<tr>
    <td><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></td>
    <td><?php if( empty($hide['date']) ): ?><?php echo get_the_date(); ?><?php endif; ?></td>
    <td><?php if( empty($hide['content_available']) ): ?><?php echo $content ?><?php endif; ?></td>
</tr>
