<?php
// Theme override of Events Manager 7.4.5 templates/formats/single_location_format.php.
// Removed the #_LOCATIONIMAGE{medium} block and the {no_loc_image}/{/no_loc_image}
// wrappers because templates/content-single-location.php already prints the
// featured image. Re-sync this file against the upstream copy on EM updates.
// https://github.com/proudcity/wp-proudcity/issues/2963
?>
<section class="em-item-header">
	<div class="em-item-meta">
		<section class="em-item-meta-column">
			<section class="em-location-where">
				<h3><?php esc_html_e('Location', 'events-manager'); ?></h3>
				<div class="em-item-meta-line em-location-address">
					<span class="em-icon-location em-icon"></span>
					#_LOCATIONFULLBR
				</div>
			</section>
		</section>
		<section class="em-item-meta-column">
			<section class="em-location-next-event">
				<h3><?php esc_html_e('Next Event', 'events-manager'); ?></h3>
				{has_events}
				<div class="em-item-meta-line em-location-events">
					<span class="em-icon-calendar em-icon"></span>
					<div>#_LOCATIONNEXTEVENT</div>
				</div>
				{/has_events}
				{no_events}
				<div class="em-item-meta-line em-location-no-events">
					<span class="em-icon-calendar em-icon"></span>
					<div><?php esc_html_e('No upcoming events', 'events-manager'); ?></div>
				</div>
				{/no_events}
			</section>
		</section>
	</div>
</section>
<section class="em-location-section-map">
	#_LOCATIONMAP{100%,0}
</section>
<section class="em-location-content">
	#_LOCATIONNOTES
</section>
<section class="em-location-events">
	<a name="upcoming-events"></a>
	<h3><?php esc_html_e('Upcoming Events', 'events-manager'); ?></h3>
	#_LOCATIONNEXTEVENTS
</section>