<div <?php post_class( "teaser" ); ?>>
  <?php
    // Date formats (same as Events)
    $datebox_format = 'M \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
    $atc_format = 'Y-m-d H:i:s';
    $time_format = 'g:i a';
    $timezone = get_option('timezone_string');

  //$datetime = new DateTime(get_post_meta($id, 'datetime', true));
    $is_upcoming = $datetime > new DateTime();
  ?>
  <div class="row">
    <div class="col-xs-3 col-md-2">
      <div class="date-box"><?php echo date_format($datetime, $datebox_format) ?></div>
    </div>
    <div class="col-xs-9 col-md-10">
      <?php the_title( sprintf( '<h3 class="h4 entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
        <h5 class="margin-top-none"><span class="start-time"><?php echo date_format($datetime, $time_format) ?></span>
        <?php if( !empty( $location_name ) ) :?>
          <i aria-hidden="true" class="fa fa-caret-right icon-even-width text-center"></i> <span class="location"><?php echo $location_name ?></span>
        <?php endif; ?></h5>
      </ul>
      <?php if($is_upcoming): ?>

        <ul class="list-inline">
        <li>
          <span class="addtocalendar" data-title="<?php print $post->post_title ?>" data-slug="<?php print get_post_field('post_name') ?>">
            <div class="atcb">
              <?php
                $event = array(
                  "event" => array(
                      "@context" => "https://schema.org",
                      "@type" => "Event",
                      "name" => esc_attr( $post->post_title ),
                      "startDate" => date_format( $datetime, "Y-m-d" ),
                      "endDate" => date_format( $datetime, "Y-m-d" ),
                      "location" => $location,
                  ),
                  "label" => "Add to Calendar",
                  "options" => array( "Apple", "Google", "iCal", "Microsoft365", "Outlook.com", "MicrosoftTeams", "Yahoo" ),
                  "timezone" => $timezone,
                  "trigger" => "click",
                  "iCalFilename" => sanitize_title( $post->post_title ),
                  "background" => false,
                );
              ?>
              <script type="application/json">
                <?php echo json_encode( $event, JSON_PRETTY_PRINT ); ?>
              </script>
            </div><!-- /.atcb -->

            <!--
            <a class="atcb-link btn btn-xs btn-default"><i aria-hidden="true" class="fa fa-calendar "></i> Add to calendar</a>
            <var class="atc_event">
              <var class="atc_date_start"><?php echo date_format($datetime, $atc_format); ?></var>
              <var class="atc_date_end"><?php echo date_format($datetime, $atc_format); ?></var>
              <var class="atc_timezone"><?php echo $timezone ?></var>
              <var class="atc_title"><?php echo $post->post_title ?></var>
              <var class="atc_description"><?php //echo $post->post_content ?></var>
              <var class="atc_location"><?php echo $location ? $location : '' ?></var>
            </var>
              -->
          </span>
        </li>
        <?php if ( !empty($location) ) { ?>
          <li><a href="https://maps.google.com?daddr=<?php echo urlencode($location) ?>" target="_blank" class="btn btn-xs btn-default  btn-block"><i aria-hidden="true" class="fa fa-map-marker"></i> Directions</a></li>
        <?php } //endif ?>
        </ul>
      <?php endif; ?>
      <?php //do_action( 'teaser_search_matching', $post ); ?>
    </div>
  </div>
</div>

<!-- https://github.com/add2cal/add-to-calendar-button -->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/add-to-calendar-button@1/assets/css/atcb.min.css">-->
<!--<script src="https://cdn.jsdelivr.net/npm/add-to-calendar-button@1" async defer></script>-->
<!-- script is registered in setup.php -->
<?php wp_enqueue_script( 'atcb' ); ?>