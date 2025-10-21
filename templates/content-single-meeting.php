<?php
use Proud\Theme\Wrapper,
  Proud\Document;

// Date formats from teaser-event-list.php
$datebox_format = 'M \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
$time_format = 'g:i a';
$atc_format = 'Y-m-d H:i:s';
$timezone = get_option('timezone_string');

$id = get_the_ID();
$datetime = new DateTime(get_post_meta($id, 'datetime', true));
$is_upcoming = $datetime > new DateTime();
$location_id = get_post_meta(absint($id), 'location', true);
if (!empty($location_id)) {
  $obj_location = get_post( absint( $location_id ));
  $location_meta = get_post_meta( absint( $location_id ) );
  $streetAddress = empty($location_meta['address2'][0]) ?
    @$location_meta['address'][0] :
    @$location_meta['address'][0] . ', ' . $location_meta['address2'][0];
  $location = $streetAddress . ', ' . @$location_meta['city'][0] . ' ' . @$location_meta['zip'][0];
} else {
  $location = null;
}

$agency_id = get_post_meta( absint( $id ), 'agency', true);
if (!empty($agency_id)) {
  $agency = get_post($agency_id);
  $agency_meta = [];
  foreach (get_post_meta($agency_id) as $key => $item) {
    $agency_meta[$key] = @$item[0];
  }
}

$agenda = wpautop(get_post_meta( absint( $id ), 'agenda', true));
$agenda_packet = wpautop(get_post_meta( absint( $id ), 'agenda_packet', true));
$minutes = wpautop(get_post_meta( absint( $id ), 'minutes', true));

// Generate a list of attachments similar to what we're using in content-single-document.php
$attachments = [];
foreach(['agenda', 'agenda_packet', 'minutes'] as $field) {
  $item = [
    'id' => get_post_meta( absint( $id ), $field . '_attachment', true),
    'show_preview' => false,
  ];
  if (!empty($item['id'])) {
    $item['url'] = wp_get_attachment_url($item['id']);
    $attachment_meta = get_post_meta($item['id'], 'sm_cloud', true);

    if ( ! empty( $attachment_meta ) ){
      $item['filesize'] = round( $attachment_meta['filesize'] / 1024 / 1024, 1 );
    } else {
      $item['filesize'] = 'null';
    }

    $item['filetype'] = pathinfo($item['url'], PATHINFO_EXTENSION);
    $item['filename'] = pathinfo($item['url'], PATHINFO_FILENAME);
    $item['show_preview'] = get_post_meta($id, $field . '_attachment_preview', true);
    $show_preview =  ($item['show_preview'] === '0') ? false : true;

    if (
        $show_preview == '1' &&
        in_array($item['filetype'], array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx') )
      && (
        empty($item['filesize'])
        || ( $item['filesize'] <= 20 )
      )) {
      if (in_array($item['filetype'], array('doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx') )) {
        $item['show_preview'] = 'office';
      }
      else {
        $item['show_preview'] = 'google';
      }
    };
    $attachments[$field] = $item;
  }

}

$videoStyle = get_post_meta( absint( $id ), 'video_style', true);
$video = get_post_meta( absint( $id ), 'video', true);
$externalVideo = get_post_meta( absint( $id ), 'external_video', true);
$audio = get_post_meta( absint( $id ), 'audio', true);
$youtube_bookmarks = json_decode(get_post_meta( absint( $id ), 'youtube_bookmarks', true), true);

$hasActive = false;

// Get URL
global $wp;
$page_url = home_url( $wp->request );


/**
 * Prints a document, including metadata and preview.
 *
 * @param $params
 */
function printDocument($params) {

  extract($params);
    $src = $url;
    if (empty($src)) {
        return;
    }
?>
    <div class="row"><!-- template-file: templates/content-single-meeting.php -->
        <div class="col-md-3">
            <?php echo printDocumentInfo($params); ?>
        </div>
        <div class="col-md-9">
          <?php //echo the_content() ?>
          <?php if ($show_preview === 'office'): ?>
              <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $src; ?>" style="width:100%; height:900px;<?php if($show_preview === 2): ?>display:none<?php endif; ?>;" frameborder="0"></iframe>
          <?php elseif ($show_preview): ?>
              <iframe src="//docs.google.com/gview?url=<?php echo $src; ?>&embedded=true" id="doc-preview" style="width:100%; height:900px;<?php if($show_preview === 2): ?>display:none<?php endif; ?>;" frameborder="0" ></iframe>
          <?php endif; ?>
        </div>
    </div>
<?php
}


function printDocumentInfo($params){
  extract($params);
  $src = $url;
  if (empty($src)) {
    return;
  }
?>
  <div title="<?php echo esc_attr( $filename ); ?>"><?php echo esc_attr( $filename ); ?>.<?php echo esc_attr( $filetype ); ?></div>
  <?php if(get_option('proud_document_show_date', '1') !== '0'): ?><div><?php the_date('F j, Y'); ?></div><?php endif; ?>
    <ul class="list-inline list-inline-middot icon-list">
        <li><?php echo strtoupper($filetype); ?></li>
      <?php if ($filesize): ?><li><?php echo $filesize; ?>MB</li><?php endif; ?>
    </ul>
  <?php if (!empty($src)): ?>
        <p>
          <?php if ($src): ?>
            <a href="<?php echo $src; ?>" class="btn btn-primary btn-sm" download="<?php echo $filename; ?>"><i aria-hidden="true" class="fa fa-download fa-fw"></i>Download</a>
            <?php if (!$show_preview): ?>
                <a href="<?php echo $src; ?>" class="btn btn-default btn-sm" target="_blank"><i aria-hidden="true" class="fa fa-external-link fa-fw"></i>Popout</a>
            <?php endif; ?>
          <?php endif; ?>
        </p>
  <?php endif; ?>
<?php
}


?>
<header>
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
</header>
<div class="row">
    <div class="col-xs-3 col-md-2">
        <div class="date-box"><?php echo date_format($datetime, $datebox_format); ?></div>
    </div>
    <div class="col-xs-9 col-md-10">
        <h3 class="margin-top-none"><span class="start-time"><?php echo date_format($datetime, $time_format); ?></span>
          <?php if( !empty( $obj_location ) ) :?>
              <i aria-hidden="true" class="fa fa-caret-right icon-even-width text-center"></i><span class="location"><?php echo get_the_title( absint( $obj_location->ID ) );; ?></span>
          <?php endif; ?>
        </h3>
        <?php if( null !== $location && !empty( $location ) ) :?><h6 class="margin-top-smaller"><?php echo $location ?></h6><?php endif;?>
        <ul class="list-inline">
          <li>
            <section class="widget widget-proud-share-links clearfix">
                <!--<div class="dropdown share">-->
                <a class="btn btn-sm btn-default" href="#" id="share-meeting" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="true"><i aria-hidden="true" class="fa fa-fw fa-share-alt"></i>Share</a>
                <ul class="dropdown-menu" aria-labelledby="share-arbitrary-instance-events-share">
                  <li><a title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php print urlencode($page_url); ?>" target="_blank"><i aria-hidden="true" class="fa fa-facebook-square fa-fw"></i> Facebook</a></li>
                  <li><a title="Share on Twitter" href="https://twitter.com/share?url=<?php print urlencode($page_url); ?>"><i aria-hidden="true" class="fa fa-twitter-square fa-fw"></i> Twitter</a></li>
                  <li><a  title="Share by Email" href="mailto:?subject=<?php print urlencode($title); ?>&body=Read more: <?php print urlencode($page_url); ?>"><i aria-hidden="true" class="fa fa-envelope fa-fw"></i> Email</a>
                </ul>
                <!--</div>-->
            </section>
          </li>
          <?php if ($is_upcoming): ?>
            <li>
              <?php
                // builds out or HTML, JSON and such for the add to calendar button
                Proud\Theme\Extras\get_atcb_button( $post, $location, $datetime );
              ?>
            </li>
            <?php if ( !empty($location) ): ?>
              <li><a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-sm btn-default  btn-block"><i aria-hidden="true" class="fa fa-map-marker"></i> Directions</a></li>
            <?php endif; ?>
          <?php endif;?>
        </ul>

    </div>
  </div>
  <?php
    if (isset(get_option('meetings_time_display')) && 'on' === get_option('meetings_settings_group')){
      echo 'time display';
    }
  ?>
<?php $hasActive = false; ?>
<ul class="nav nav-tabs" style="margin-top:10px;">
    <?php if (!empty($agenda) || !empty($attachments['agenda'])): ?><li <?php if(!$hasActive) { echo 'class="active"'; $hasActive = true; } ?>><a data-toggle="tab" href="#tab-agenda">Agenda</a></li><?php endif; ?>
    <?php if (!empty($agenda_packet) || !empty($attachments['agenda_packet'])): ?><li <?php if(!$hasActive) { echo 'class="active"'; $hasActive = true; } ?>><a data-toggle="tab" href="#tab-agenda-packet">Agenda Packet</a></li><?php endif; ?>
    <?php if (!$is_upcoming && (!empty($minutes) || !empty($attachments['minutes']))): ?><li <?php if(!$hasActive) { echo 'class="active"'; $hasActive = true; } ?>><a data-toggle="tab" href="#tab-minutes">Minutes</a></li><?php endif; ?>
    <?php if (empty($videoStyle) && !empty($video)): ?><li <?php if(!$hasActive) { echo 'class="active"'; $hasActive = true; } ?>><a data-toggle="tab" href="#tab-video">Video</a></li><?php endif; ?>
    <?php if ($videoStyle === 'external' && !empty($externalVideo)): ?><li><a href="<?php echo $externalVideo ?>" target="_blank" title="View video on external website">Video <i aria-hidden="true" class="fa fa-external-link"></i></a></li><?php endif; ?>
    <?php if (!empty($audio)): ?><li <?php if(!$hasActive) { echo 'class="active"'; $hasActive = true; } ?>><a data-toggle="tab" href="#tab-audio">Audio</a></li><?php endif; ?>
    <?php if (!empty($agency)): ?><li <?php if(!$hasActive) { echo 'class="active"'; $hasActive = true; } ?>><a data-toggle="tab" href="#tab-contact">Contact Information</a></li><?php endif; ?>
</ul>

<?php $hasActive = false; ?>
<div class="tab-content">

  <?php if (!empty($agenda) || !empty($attachments['agenda'])): ?>
      <div id="tab-agenda" class="tab-pane fade <?php if(!$hasActive) { echo 'in active'; $hasActive = true; } ?>">

        <div class="row">
            <div class="col-md-9" style="padding-top:10px;"><?php echo apply_filters( 'the_content', $agenda ); ?></div>
            <?php if ( isset( $attachments['agenda'] ) && ! empty( $attachments['agenda'] ) ){ ?>
              <div class="col-md-3 col-sm-hidden" style="padding-top:10px;"><?php if(strlen($agenda > 1000)): ?><?php echo printDocumentInfo($attachments['agenda']); ?><?php endif; ?></div>
            <?php } // isset $attachments['agenda'] ?>
        </div>

        <?php if (!empty($attachments['agenda'])) {
          if(!empty($agenda)) {
            echo '<hr/>';
          }
          printDocument($attachments['agenda']);
        } ?>
      </div>
  <?php endif; ?>

  <?php if (!empty($agenda_packet) || !empty($attachments['agenda_packet'])): ?>
      <div id="tab-agenda-packet" class="tab-pane fade <?php if(!$hasActive) { echo 'in active'; $hasActive = true; } ?>">

        <div class="row">
          <div class="col-md-9" style="padding-top:10px;"><?php echo apply_filters( 'the_content', $agenda_packet ); ?></div>

          <?php if ( isset( $attachments['agenda_packet'] ) && ! empty( $attachments['agenda_packet'] ) ){ ?>
              <div class="col-md-3 col-sm-hidden" style="padding-top:10px;"><?php if(strlen($agenda_packet > 1000)): ?><?php echo printDocumentInfo($attachments['agenda_packet']); ?><?php endif; ?></div>
          <?php } // isset $attachments['agenda_packet'] ?>
        </div>

        <?php if (!empty($attachments['agenda_packet'])) {
        if(!empty($agenda_packet)) {
        echo '<hr/>';
        }
        printDocument($attachments['agenda_packet']);
        } ?>
      </div></!-- /#tab-agenda-packet -->

  <?php endif; ?>

  <?php if (!$is_upcoming && (!empty($minutes) || !empty($attachments['minutes']))): ?>
      <div id="tab-minutes" class="tab-pane fade <?php if(!$hasActive) { echo 'in active'; $hasActive = true; } ?>">
        <?php if (!empty($minutes)): ?>
            <div class="row">
                <div class="col-md-9" style="padding-top:10px;"><?php echo apply_filters( 'the_content', $minutes ); ?></div>
                <?php if ( isset( $attachments['minutes'] ) && ! empty( $attachments['minutes'] ) ){ ?>
                  <div class="col-md-3 col-sm-hidden" style="padding-top:10px;"><?php echo printDocumentInfo($attachments['minutes']); ?></div>
                <?php } ?>
            </div>
            <hr/>
        <?php endif; ?>
        <?php if (!empty($attachments['minutes'])) {
          // if(!empty($minutes)) {
          //   echo '<hr/>';
          // }
          printDocument($attachments['minutes']);
        } ?>
      </div>
  <?php endif; ?>

  <?php if (!empty($video)): ?>
    <div id="tab-video" class="tab-pane fade <?php if(!$hasActive) { echo 'in active'; $hasActive = true; } ?>">
        <div class="row">
            <div class="youtube-player-wrapper <?php if(!empty($youtube_bookmarks)):?>col-md-9 pull-right<?php else: ?>col-md-12 col-lg-10<?php endif; ?>">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe id="player" frameborder="0" allowfullscreen="1" allow="autoplay; encrypted-media" title="YouTube video player" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video ?>?autoplay=0&amp;controls=1&amp;enablejsapi=1&amp;widgetid=1"></iframe>
              </div>
            </div>
            <?php if(!empty($youtube_bookmarks)):?>
              <div class="col-md-3">
                <h4>Select a bookmark:</h4>
                <div id="youtube-list"><ul class="list-group">
                  <?php foreach($youtube_bookmarks as $item): ?>
                    <a class="list-group-item" href="#" data-youtube-seek="<?php echo $item['seconds'] ?>">
                      <?php echo $item['label'] ?>
                      <span class="badge badge-default pull-right"><?php echo $item['time'] ?></span>
                    </a>
                  <?php endforeach; ?>
                </ul></div>
              </div>
            <?php endif; ?>
        </div>
    </div>
  <?php endif; ?>

  <?php if (!empty($audio)): ?>
      <div id="tab-audio" class="tab-pane fade <?php if(!$hasActive) { echo 'in active'; $hasActive = true; } ?>">
          <div class="row">
              <div class="col-md-8">
                <?php echo $audio; ?>
              </div>
          </div>
      </div>
  <?php endif; ?>

  <?php if (!empty($agency)): ?>
    <div id="tab-contact" class="tab-pane fade <?php if(!$hasActive) { echo 'in active'; $hasActive = true; } ?>">
        <div class="row">
            <div class="col-sm-12">
                <h3><a href="<?php echo get_permalink($agency) ?>"><?php echo get_the_title( $agency ); ?></a></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
            <?php
            $agencyContact = new AgencyContact();
            $agencyContact->printWidget([], $agency_meta);
            ?>
            </div>
        </div>
    </div>
  <?php endif; ?>
</div>


<script type="text/javascript" src="//www.youtube.com/iframe_api"></script>

<script type="text/javascript">
  // Set up interaction with the YouTube video
  (function($, Proud) {
    Proud.behaviors.proud_meeting_youtube_bookmarks = {
      attach: function (context, settings) {

        // Video
        var player;
        window.onYouTubeIframeAPIReady = function () {
          player = new YT.Player('player', {
            height: '315',
            width: '560',
            videoId: '<?php echo $video ?>',
            playerVars: { 'autoplay': 0, 'controls': 1 },
          });
        }
        $('#tab-video').find('a[data-youtube-seek]').bind('click', function(e) {
          e.preventDefault();
          player.seekTo($(this).data('youtube-seek'));
        });

        // Set active tab
        if (location.hash !== ''){
          $('a[href="' + location.hash.replace('/', '') + '"]').tab('show');
        }

      }
    }
  })(jQuery, Proud);

</script>
