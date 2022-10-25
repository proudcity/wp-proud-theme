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

$datetime = new DateTime();
$events = EM_Events::get($args);
//d($events);
//echo EM_Events::output( $args );
?>
<div class="col-md-9"><div class="teaser-list">
<?php
$events = apply_filters( 'proud_events_duplicator', $events );
foreach ($events as $EM_Event){

  $datebox_format = '\<\s\p\a\n \c\l\a\s\s=\"\m\o\n\t\h\-\s\m\l\"\>M\<\/\s\p\a\n\>\<\s\p\a\n \c\l\a\s\s=\"\m\o\n\t\h\-\b\i\g\"\>F\<\/\s\p\a\n\> \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
  $atc_format = 'Y-m-d H:i:s';

  $location = empty($EM_Event->location) ? false : $EM_Event->location->location_address . ', ' .
    $EM_Event->location->location_town . ', ' .
    $EM_Event->location->location_state . ' ' .
    $EM_Event->location->postcode;
  ?>
  <div class="row">
    <div class="col-xs-3 col-sm-2">
      <div class="date-box"><?php echo date_i18n($datebox_format, strtotime( $EM_Event->start_date ) ) ?></div>
    </div>
    <div class="col-sm-10 col-xs-9">
      <h3 class="h4"><a href="<?php echo get_permalink($EM_Event->post_id) ?>"><?php echo $EM_Event->post_title ?></a></h3>
      <p></p>
      <?php if ($EM_Event->bookings) { ?>
        <a href="#register" class="btn btn-xs btn-default"><i aria-hidden="true" class="fa fa-calendar-check-o"></i> Register</a>
      <?php } //endif ?>
      <span class="addtocalendar">
          <?php Proud\Theme\Extras\get_atcb_button( $EM_Event, $location, $datetime ); ?>
      </span>
      <?php if ($location) { ?>
        <a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-xs btn-default"><i aria-hidden="true" class="fa fa-map-marker"></i> Directions</a>
      <?php } //endif ?>
      </p>
    </div>
  </div>
<?php } //foreach ?>
</div></div>
