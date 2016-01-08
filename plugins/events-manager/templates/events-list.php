<?php
/*
 * Default Events List Template
 * This page displays a list of events, called during the em_content() if this is an events list page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 * 
 * $args - the args passed onto EM_Events::output()
 * 
 */
$args = apply_filters('em_content_events_args', $args);

$events = EM_Events::get($args);
//d($events);
//echo EM_Events::output( $args );
?>
<div class="col-md-9"><div class="teaser-list">
<?php
foreach ($events as $EM_Event){

  $datebox_format = 'F \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
  $atc_format = 'Y-m-d H:i:s';

  $location = empty($EM_Event->location) ? false : $EM_Event->location->location_address . ', ' .
    $EM_Event->location->location_town . ', ' .
    $EM_Event->location->location_state . ' ' .
    $EM_Event->location->postcode;
  ?>
  <div class="row">
    <div class="col-xs-3 col-sm-2">
      <div class="date-box"><?php echo date_i18n($datebox_format, $EM_Event->start) ?></div>
    </div>
    <div class="col-sm-10 col-xs-9">
      <h4><a href="<?php echo get_permalink($EM_Event->post_id) ?>">June 9 City Council Meeting</a></h4>
      <p></p>
      <?php if ($EM_Event->bookings) { ?>
        <a href="#register" class="btn btn-xs btn-default"><i class="fa fa-calendar-check-o"></i> Register</a>
      <?php } //endif ?>
      <span class="addtocalendar">
        <a class="atcb-link btn btn-xs btn-default"><i class="fa fa-calendar"></i> Add to calendar</a>
        <var class="atc_event">
          <var class="atc_date_start"><?php echo date_i18n($atc_format, $EM_Event->start) ?></var>
          <var class="atc_date_end"><?php echo date_i18n($atc_format, $EM_Event->end) ?></var>
          <var class="atc_timezone"><?php echo date_i18n('e', $EM_Event->start) ?></var>
          <var class="atc_title"><?php echo $EM_Event->post_title ?></var>
          <var class="atc_description"><?php //echo $EM_Event->post_content ?></var>
          <var class="atc_location"><?php echo $location ? $location : '' ?></var>
        </var>
      </span>
      <?php if ($location) { ?>
        <a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-map-marker"></i> Directions</a>
      <?php } //endif ?>
      </p>
    </div>
  </div>
<?php } //foreach ?>
</div></div>

<!-- addtocalendar code @todo: better embed -->
<link href="//addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css">
<script type="text/javascript">(function () {
  if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
  if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
      var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
      s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
      s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
      var h = d[g]('body')[0];h.appendChild(s); }})();
</script>
