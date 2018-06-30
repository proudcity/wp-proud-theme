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
  $location = get_post($location_id);
}
$agency_id = get_post_meta($id, 'agency', true);
if (!empty($agency_id)) {
  $agency = get_post($agency_id);
}

$agenda = get_post_meta($id, 'agenda', true);
$agenda_attachment_id = get_post_meta($id, 'agenda_attachment', true);
if (!empty($agenda_attachment_id)) {
  $agenda_attachment = get_post($agenda_attachment_id);
}

$minutes = get_post_meta($id, 'minutes', true);
$minutes_attachment_id = get_post_meta($id, 'minutes_attachment', true);

$video = get_post_meta($id, 'video', true);
$youtube_bookmarks = json_decode(get_post_meta( $id, 'youtube_bookmarks', true));

print_r($datetime);
print_R(' '.$location_id);
print_R(' '.$agency_id);
print_R(' agenda attachment: '.$agenda_attachment_id);
print_r($location);

print_R(' minutes attachment: '.$minutes_attachment_id);
print_r($minutes_attachment);

print_r($youtube);
print_R($youtube_bookmarks);

//exit;
//
//$src = get_post_meta( $id, 'document', true );
//$filename = get_post_meta( $id, 'document_filename', true );
//$meta = json_decode(get_post_meta( $id, 'document_meta', true ));
//$terms = wp_get_post_terms( $id, 'document_taxonomy', array("fields" => "all"));
//$filetype = Document\get_document_type();
//
//if (in_array($filetype, array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx') ) && (
//    empty($meta->size)
//    || ( strpos(strtoupper($meta->size), 'KB') !== FALSE || ( strpos($meta->size, 'MB') !== FALSE && (int)str_replace(' MB', '', $meta->size) <= 25 ) )
//  )) {
//  if (in_array($filetype, array('doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx') )) {
//    $show_preview = 'office';
//  }
//  else {
//    $show_preview = true;
//  }
//};
?>
<div class="row">
    <div class="col-xs-3 col-md-2">
        <div class="date-box"><?php echo date_format($datetime, $datebox_format); ?></div>
    </div>
    <div class="col-xs-9 col-md-10">
        <h1 class="entry-title">
          <?php the_title(); ?>
        </h1>
        <h5 class="margin-top-none"><span class="start-time"><?php echo date_format($datetime, $time_format); ?></span>
          <?php if( !empty( $location ) ) :?>
              <i class="fa fa-caret-right icon-even-width text-center"></i> <span class="location"><?php echo $location->post_title ?></span>
          <?php endif; ?>
        </h5>
        <?php if ($is_upcoming): ?>
            <ul class="list-inline">
                <li>
              <span class="addtocalendar" data-title="<?php print $post->post_title ?>" data-slug="<?php print get_post_field('post_name') ?>">
                <a class="atcb-link btn btn-xs btn-default"><i class="fa fa-calendar "></i> Add to calendar</a>
                <var class="atc_event">
                  <var class="atc_date_start"><?php echo date_format($datetime, $atc_format); ?></var>
                  <var class="atc_date_end"><?php echo date_format($datetime, $atc_format); ?></var>
                  <var class="atc_timezone"><?php echo $datetime->getTimezone(); ?></var>
                  <var class="atc_title"><?php echo $post->post_title ?></var>
                  <var class="atc_description"><?php //echo $post->post_content ?></var>
                  <var class="atc_location"><?php echo $location ? $location : '' ?></var>
                </var>
              </span>
                </li>
              <?php if ( !empty($location) ) { ?>
                  <li><a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-xs btn-default  btn-block"><i class="fa fa-map-marker"></i> Directions</a></li>
              <?php } //endif ?>
        </ul>
        <?php endif;?>

    </div>
</div>
</div>


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
