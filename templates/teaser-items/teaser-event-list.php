<div <?php post_class("teaser"); ?>><!-- template-file: teaser-event-list.php -->
  <?php
    global $EM_Event;
// Date formats
$datebox_format = 'M \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
$atc_format = 'Y-m-d H:i:s';
$loc_id = !empty($meta['_location_id']) ? $meta['_location_id'][0] : false;
$location = '';
if($loc_id) {
    global $EM_Location;
    $location_obj;
    if(is_object($EM_Location) && $EM_Location->location_id == $loc_id) {
        $location_obj = $EM_Location;
    } else {
        $location_obj = apply_filters('em_event_get_location', em_get_location($loc_id));
    }

    $location = !is_object($location_obj) ? false : $location_obj->location_address . ', ' .
      $location_obj->location_town . ', ' .
      $location_obj->location_state . ' ' .
      $location_obj->location_postcode;
}

// Get our start and end
$start = !empty($meta['_event_start_local']) ? $meta['_event_start_local'][0] : 0;
$end = !empty($meta['_event_end_local']) ? $meta['_event_end_local'][0] : 0;
// Get EM object
$EM_start = new \EM_DateTime($start);
$EM_end = new \EM_DateTime($end);
$datetime = new DateTime();

$time = __("All day", 'proud-core');
if($start && !empty($meta['_event_start_time']) && $meta['_event_start_time'][0] != "00:00:00") {
    $time = $EM_start->i18n('g:ia');
}
if($end && $start !== $end && !empty($meta['_event_end_time']) && $meta['_event_end_time'][0] != "00:00:00") {
    $time .= ' - ' . $EM_end->i18n('g:ia');
}
?>
  <div class="row">
    <?php the_title(sprintf('<h3 class="h4 entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
    <div class="col-xs-3 col-md-2">
      <div class="date-box"><?php echo $EM_start->i18n($datebox_format) ?></div>
    </div>
    <div class="col-xs-9 col-md-10">
        <p class="margin-top-none"><time class="start-time"><?php echo $time ?></time>
        <?php if(!empty($location_obj->location_name)) :?>
        <i aria-hidden="true" class="fa fa-caret-right icon-even-width text-center"></i> <span class="location"><?php echo esc_attr($location_obj->location_name); ?></span>
        <?php endif; ?></p>
      <ul class="list-inline">
        <?php if (!empty($location)) { ?>
          <li><a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-xs btn-default btn-block btn-directions"><i aria-hidden="true" class="fa fa-map-pin"></i> Directions</a></li>
        <?php } //endif?>
      </ul>
      <?php do_action('teaser_search_matching', $post); ?>
      <p class="margin-bottom-none"><?php echo \Proud\Core\wp_trim_excerpt(); ?></p>
    </div>
  </div>
</div>
