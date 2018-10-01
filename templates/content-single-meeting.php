<?php
use Proud\Theme\Wrapper,
  Proud\Document;

// Date formats from teaser-event-list.php
$datebox_format = 'M \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
$time_format = 'g:i a';
$atc_format = 'Y-m-d H:i:s';

$id = get_the_ID();

$datetime = new DateTime(get_post_meta($id, 'datetime', true));
$is_upcoming = $datetime > new DateTime();
$location_id = get_post_meta($id, 'location', true);
if (!empty($location_id)) {
  $obj_location = get_post($location_id);
  $location_meta = get_post_meta($location_id);
  $location = @$location_meta['address'][0] . ', ' . @$location_meta['city'][0] . ' ' . @$location_meta['zip'][0];
}

$agency_id = get_post_meta($id, 'agency', true);
if (!empty($agency_id)) {
  $agency = get_post($agency_id);
  $agency_meta = [];
  foreach (get_post_meta($agency_id) as $key => $item) {
    $agency_meta[$key] = @$item[0];
  }
}

$agenda = get_post_meta($id, 'agenda', true);

$attachments = [];
foreach(['agenda', 'minutes'] as $field) {
  $item = [
    'id' => get_post_meta($id, $field . '_attachment', true),
    'show_preview' => false,
  ];
  if (!empty($item['id'])) {
    $item['url'] = wp_get_attachment_url($item['id']);
    $attachment_meta = get_post_meta($item['id'], 'sm_cloud', true);
    $item['filesize'] = @round($attachment_meta['object']['size'] / 1024 / 1024, 1);
    $item['filetype'] = pathinfo($item['url'], PATHINFO_EXTENSION);

    if (in_array($item['filetype'], array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx') ) && (
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

$video = get_post_meta($id, 'video', true);
$youtube_bookmarks = json_decode(get_post_meta( $id, 'youtube_bookmarks', true), true);


/**
 * Prints a document, including metadata and preview.
 *
 * @param $params
 */
function printDocument($params) {
    extract($params);
    $src = $url;
?>
    <div class="row">
        <div class="col-md-3">
            <p>
          <?php if(get_option('proud_document_show_date', '1') !== '0'): ?><div><?php the_date('F j, Y'); ?></div><?php endif; ?>
            <ul class="list-inline list-inline-middot icon-list">
                <li><?php echo strtoupper($filetype); ?></li>
              <?php if ($filesize): ?><li><?php echo $filesize; ?>MB</li><?php endif; ?>
            </ul>
            </p>
          <?php if (!empty($src)): ?>
              <p>
                <?php if ($src): ?>
                    <a href="<?php echo $src; ?>" class="btn btn-primary btn-sm" download="<?php echo $filename; ?>"><i class="fa fa-download"></i> Download</a>
                <?php endif; ?>
              </p>
          <?php endif; ?>
        </div>
        <div class="col-md-9">
          <?php echo the_content() ?>
          <?php if ($show_preview === 'office'): ?>
              <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $src; ?>" style="width:100%; height:900px;<?php if($show_preview === 2): ?>display:none<?php endif; ?>;" frameborder="0"></iframe>
          <?php elseif ($show_preview): ?>
              <iframe src="//docs.google.com/gview?url=<?php echo $src; ?>&embedded=true" id="doc-preview" style="width:100%; height:900px;<?php if($show_preview === 2): ?>display:none<?php endif; ?>;" frameborder="0" ></iframe>
          <?php endif; ?>
        </div>
    </div>
<?php
}
// -------








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
              <i class="fa fa-caret-right icon-even-width text-center"></i> <span class="location"><?php echo $obj_location->post_title ?></span>
          <?php endif; ?>
        </h3>
        <?php if( !empty( $location ) ) :?><h6 class="margin-top-smaller"><?php echo $location ?></h6><?php endif;?>
        <ul class="list-inline">
          <li>
            <section class="widget widget-proud-share-links clearfix">
                <!--<div class="dropdown share">-->
                <a class="btn btn-sm btn-default" href="#" id="share-meeting" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="true"><i aria-hidden="true" class="fa fa-fw fa-share-alt"></i>Share</a>
                <ul class="dropdown-menu" aria-labelledby="share-arbitrary-instance-events-share">
                    <li><a title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php"
                           target="_blank"><i aria-hidden="true" class="fa fa-facebook-square fa-fw"></i>
                            Facebook</a></li>
                    <li><a title="Share on Twitter"
                           href="https://twitter.com/share?url=http%3A%2F%2Fwordpress.dd%3A8083%2Fevent%2Fnational-coffee-with-a-cop-day-october-3rd%3Fevent%3Dnational-coffee-with-a-cop-day-october-3rd%26post_type%3Devent%26name%3Dnational-coffee-with-a-cop-day-october-3rd"><i
                                aria-hidden="true" class="fa fa-twitter-square fa-fw"></i> Twitter</a></li>
                    <li><a title="Share by Email"
                           href="mailto:?subject=National+Coffee+with+a+Cop+Day+%26%238211%3B+October+3rd+from+San+Rafael&amp;body=Read more: http%3A%2F%2Fwordpress.dd%3A8083%2Fevent%2Fnational-coffee-with-a-cop-day-october-3rd%3Fevent%3Dnational-coffee-with-a-cop-day-october-3rd%26post_type%3Devent%26name%3Dnational-coffee-with-a-cop-day-october-3rd"><i
                                aria-hidden="true" class="fa fa-envelope fa-fw"></i> Email</a>
                    </li>
                </ul>
                <!--</div>-->
            </section>
          </li>
          <?php if ($is_upcoming): ?>
            <li>
              <span class="addtocalendar" data-title="<?php print $post->post_title ?>" data-slug="<?php print get_post_field('post_name') ?>">
                <a class="atcb-link btn btn-sm btn-default"><i class="fa fa-calendar "></i> Add to calendar</a>
                <var class="atc_event">
                  <var class="atc_date_start"><?php echo date_format($datetime, $atc_format); ?></var>
                  <var class="atc_date_end"><?php echo date_format($datetime, $atc_format); ?></var>
                  <var class="atc_timezone"><?php echo $datetime->getTimezone()->getName(); ?></var>
                  <var class="atc_title"><?php echo $post->post_title ?></var>
                  <var class="atc_description"><?php //echo $post->post_content ?></var>
                  <var class="atc_location"><?php echo $location ? $location : '' ?></var>
                </var>
              </span>
            </li>
            <?php if ( !empty($location) ): ?>
              <li><a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-sm btn-default  btn-block"><i class="fa fa-map-marker"></i> Directions</a></li>
            <?php endif; ?>
          <?php endif;?>
        </ul>

    </div>
</div>


<ul class="nav nav-tabs" style="margin-top:10px;">
  <?php if (!empty($video)): ?><li class="active"><a data-toggle="tab" href="#tab-video">Video</a></li><?php endif; ?>
  <?php if (!$is_upcoming && (!empty($minutes) || !empty($attachments['minutes']))): ?><li <?php if (empty($video)): ?>class="active"<?php endif; ?>><a data-toggle="tab" href="#tab-minutes">Minutes</a></li><?php endif; ?>
  <li <?php if ($is_upcoming && empty($video)): ?>class="active"<?php endif; ?>><a data-toggle="tab" href="#tab-agenda">Agenda</a></li>
  <?php if (!empty($agency)): ?><li><a data-toggle="tab" href="#tab-contact">Contact Information</a></li><?php endif; ?>
</ul>

<div class="tab-content">
  <?php if (!empty($video)): ?>
    <div id="tab-video" class="tab-pane fade in active">
        <div class="row">
            <div class="youtube-player-wrapper <?php if(!empty($youtube_bookmarks)):?>col-md-9 pull-right<?php else: ?>col-md-12<?php endif; ?>">
              <iframe id="player" frameborder="0" allowfullscreen="1" allow="autoplay; encrypted-media" title="YouTube video player" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video ?>?autoplay=0&amp;controls=1&amp;enablejsapi=1&amp;widgetid=1"></iframe>
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

  <?php if (!$is_upcoming && (!empty($minutes) || !empty($attachments['minutes']))): ?>
      <div id="tab-minutes" class="tab-pane fade <?php if (empty($video)): ?>in active<?php endif; ?>">
        <?php if (!empty($minutes)): ?>
          <?php echo $minutes ?>
        <?php endif; ?>
        <?php if (!empty($attachments['minutes'])) { printDocument($attachments['minutes']); } ?>
      </div>
  <?php endif; ?>

  <div id="tab-agenda" class="tab-pane fade <?php if ($is_upcoming && empty($video)): ?>in active<?php endif; ?>">
      <?php if (!empty($agenda)): ?>
        <?php echo $agenda ?>
      <?php endif; ?>
      <?php if (!empty($attachments['agenda'])) { printDocument($attachments['agenda']); } ?>
  </div>

  <?php if (!empty($agency)): ?>
    <div id="tab-contact" class="tab-pane fade">
        <div class="row">
            <div class="col-sm-12">
                <h3><a href="<?php echo $agency->guid; ?>"><?php echo $agency->post_title; ?></a></h3>
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



</div>

<script type="text/javascript" src="//www.youtube.com/iframe_api"></script>

<script type="text/javascript">
  // Set up interaction with the YouTube video
  (function($, Proud) {
    Proud.behaviors.proud_meeting_youtube_bookmarks = {
      attach: function (context, settings) {
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
      }
    }
  })(jQuery, Proud);
</script>



<!-- addtocalendar code @todo: better embed -->
<link href="//addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css">

<!-- 2. Include script -->
<script type="text/javascript">(function () {
    if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
    if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
      var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
      s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
      s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
      var h = d[g]('body')[0];h.appendChild(s); }})();
</script>


