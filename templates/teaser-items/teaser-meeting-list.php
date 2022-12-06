<div <?php post_class( "teaser" ); ?>><!-- template-file: teaser-meeting-list.php -->
  <?php
    // Date formats (same as Events)
    $datebox_format = 'M \<\s\p\a\n \c\l\a\s\s=\"\d\a\t\e\-\b\i\g\"\>j\<\/\s\p\a\n\> Y';
    $atc_format = 'Y-m-d H:i:s';
    $time_format = 'g:i a';

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
          <?php
            // builds out or HTML, JSON and such for the add to calendar button
            Proud\Theme\Extras\get_atcb_button( $post, $location, $datetime );
          ?>
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
