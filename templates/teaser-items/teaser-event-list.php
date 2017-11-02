<div <?php post_class( "teaser" ); ?>>
  <?php 
    // Date formats
    $datebox_format = 'M \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
    $atc_format = 'Y-m-d H:i:s';
    $loc_id = !empty( $meta['_location_id'] ) ? $meta['_location_id'][0] : false;
    if( $loc_id ) {
      global $EM_Location;
      $location_obj;
      if( is_object($EM_Location) && $EM_Location->location_id == $loc_id ){
        $location_obj = $EM_Location;
      }else{
        $location_obj = apply_filters('em_event_get_location', em_get_location( $loc_id ) );
      }

      $location = !is_object( $location_obj ) ? false : $location_obj->location_address . ', ' .
        $location_obj->location_town . ', ' .
        $location_obj->location_state . ' ' .
        $location_obj->location_postcode;
    }

    $start = !empty( $meta['_start_ts'] ) ? $meta['_start_ts'][0] : 0;
    $end = !empty( $meta['_end_ts'] ) ? $meta['_end_ts'][0] : 0;
    // d($meta);
    $time = __("All day", 'proud-core');
    if($start && !empty( $meta['_event_start_time'] ) && $meta['_event_start_time'][0] != "00:00:00" ) {
      $time = date_i18n( 'g:ia', $meta['_start_ts'][0] );
    }
    if($end && $start !== $end && !empty( $meta['_event_end_time'] ) && $meta['_event_end_time'][0] != "00:00:00" ) {
      $time .= ' - ' . date_i18n( 'g:ia', $meta['_end_ts'][0] );
    }
  ?>
  <div class="row">
    <div class="col-xs-3 col-md-2">
      <div class="date-box"><?php echo date_i18n($datebox_format, $start) ?></div>
    </div>
    <div class="col-xs-9 col-md-10">
      <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
        <h5 class="margin-top-none"><span class="start-time"><?php echo $time ?></span>
        <?php if( !empty( $location_obj->location_name ) ) :?>
          <i class="fa fa-caret-right icon-even-width text-center"></i> <span class="location"><?php echo $location_obj->location_name ?></span>
        <?php endif; ?></h5>
      </ul>
      <ul class="list-inline">
        <li>
          <span class="addtocalendar" data-title="<?php print $post->post_title ?>" data-slug="<?php print get_post_field('post_name') ?>">
            <a class="atcb-link btn btn-xs btn-default"><i class="fa fa-calendar "></i> Add to calendar</a>
            <var class="atc_event">
              <var class="atc_date_start"><?php echo date_i18n($atc_format, $start) ?></var>
              <var class="atc_date_end"><?php echo date_i18n($atc_format, $end) ?></var>
              <var class="atc_timezone"><?php echo date_i18n('e', $start) ?></var>
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
      <?php do_action( 'teaser_search_matching', $post ); ?>
      <p class="margin-bottom-none"><?php echo \Proud\Core\wp_trim_excerpt(); ?></p>
    </div>
  </div>
</div>