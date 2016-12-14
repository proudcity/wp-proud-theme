<?php
/* 
 * Remember that this file is only used if you have chosen to override event pages with formats in your event settings!
 * You can also override the single event page completely in any case (e.g. at a level where you can control sidebars etc.), as described here - http://codex.wordpress.org/Post_Types#Template_Files
 * Your file would be named single-event.php
 */
/*
 * This page displays a single event, called during the the_content filter if this is an event page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 * 
 * $args - the args passed onto EM_Events::output() 
 */
  global $EM_Event;

  $datebox_format = 'F \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
  $atc_format = 'Y-m-d H:i:s';

  $location = empty($EM_Event->location) ? false : $EM_Event->location->location_address . ', ' .
    $EM_Event->location->location_town . ', ' .
    $EM_Event->location->location_state .
    (isset($EM_Event->location->postcode) ?  ' ' . $EM_Event->location->postcode : '' );
    
  //
  /* @var $EM_Event EM_Event */
  //echo $EM_Event->output_single();
  $time = __("All day", 'proud-core');
  if(!empty($EM_Event->start) && !empty( $EM_Event->event_start_time ) && $EM_Event->event_start_time != "00:00:00" ) {
    $time = date_i18n( 'h:i a', $EM_Event->start );
  }

?>

<div class="row">
  <div class="col-xs-3 col-sm-2">
    <div class="date-box"><?php echo date_i18n($datebox_format, $EM_Event->start) ?></div>
  </div>
  <div class="col-sm-10 col-xs-9">
      <h3 class="margin-top-none margin-bottom-none"><span class="start-time"><?php echo $time ?></span>
        <?php if( !empty( $location ) ) :?>
          <i class="fa fa-caret-right icon-even-width text-center"></i> <span class="location"><?php echo $EM_Event->location->location_name  ?></span></h3>
          <h6 class="margin-top-smaller"><?php echo $location ?></h6>
      <?php endif; ?>
      <ul class="list-inline">
        <?php if ($EM_Event->bookings) { ?>
        <li><a href="#register" class="btn btn-sm btn-default"><i class="fa fa-calendar-check-o"></i> Register</a></li>
        <?php } //endif ?>
        <li><?php the_widget( 'ShareLinks', array( 'classes' => 'btn btn-sm btn-default'), array('widget_id'=>'arbitrary-instance-' . strtolower('events-share') ) ); ?></li>
        <li><span class="addtocalendar">
          <a class="atcb-link btn btn-sm btn-default"><i class="fa fa-calendar"></i> Add to calendar</a>
          <var class="atc_event">
            <var class="atc_date_start"><?php echo date_i18n($atc_format, $EM_Event->start) ?></var>
            <var class="atc_date_end"><?php echo date_i18n($atc_format, $EM_Event->end) ?></var>
            <var class="atc_timezone"><?php echo date_i18n( 'e', $EM_Event->start ) ?></var>
            <var class="atc_title"><?php echo $EM_Event->post_title ?></var>
            <var class="atc_description"><?php echo $EM_Event->post_content ?></var>
            <var class="atc_location"><?php echo $location ?></var>
          </var>
        </span></li>
        <li><a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-sm btn-default btn-block"><i class="fa fa-map-marker"></i> Directions</a></li>
      </p>
  </div>
</div>
<hr>
<?php if( get_post_thumbnail_id($EM_Event) ): ?>
  <div class="media text-center">
    <?php echo get_the_post_thumbnail($EM_Event); ?>
    <?php $media = get_post(get_post_thumbnail_id($EM_Event)); ?>
    <?php if( $media && !empty($media->post_excerpt) ): ?><div class="media-byline"><span><?php echo $media->post_excerpt ?></span></div><?php endif; ?>
  </div>
<?php endif; ?>
<?php echo apply_filters('dbem_notes', $EM_Event->post_content); ?>


<?php if ($EM_Event->bookings) { ?>
  <hr>
  <?php
  if( get_option('dbem_rsvp_enabled') ){
    if( !defined('EM_XSS_BOOKINGFORM_FILTER') && locate_template('plugins/events-manager/placeholders/bookingform.php') ){
      //xss fix for old overriden booking forms
      add_filter('em_booking_form_action_url','esc_url');
      define('EM_XSS_BOOKINGFORM_FILTER',true);
    }
    ob_start();
    $template = em_locate_template('placeholders/bookingform.php', true, array('EM_Event'=>$EM_Event));
    // d($template);
    EM_Bookings::enqueue_js();
    echo ob_get_clean();
  }
  ?>
  <hr>
<?php } //endif ?>

<!--
<span class="addtocalendar">
  <a class="atcb-link btn btn-sm btn-default"><i class="fa fa-calendar"></i> Add to calendar</a>
  <var class="atc_event">
    <var class="atc_date_start"><?php echo date_i18n($atc_format, $EM_Event->start) ?></var>
    <var class="atc_date_end"><?php echo date_i18n($atc_format, $EM_Event->end) ?></var>
    <var class="atc_timezone"><?php echo date_i18n('e', $EM_Event->start) ?></var>
    <var class="atc_title"><?php echo $EM_Event->post_title ?></var>
    <var class="atc_description"><?php echo $EM_Event->post_content ?></var>
    <var class="atc_location"><?php echo $location ?></var>
  </var>
</span>
<a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-map-marker"></i> Directions</a>
-->

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

    
