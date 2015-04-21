<?php
/***************************
Child Post ID's
***************************/
//Sets up list of child post ID's
//This can be used to prevent children sessions from showign on the main schedule
$child_ids = array();
while ($schedule_test -> have_posts() ) : $schedule_test->the_post(); 
{
	if (get_field('session_childs')) {
		foreach (get_field('session_childs') as $child) {
			$child_ids[] = $child;
		}
	}
}
endwhile;


/***************************
Conference Schedule Dates
***************************/
//Creates a list of dates that the schedule must include
//Driven off the conference page in the WP-UI (example: DRIVE/2015)
$dates = array();
while( have_rows('con_dates-highs_r') ): the_row();
$dates_raw = get_sub_field('con_dates');
$dates[] = $dates_raw;
endwhile;


/***************************
Schedule Query
***************************/
//Creates a new main query that limits the returned posts & custom posts to those that match the page slug
//For this to work, the page slug must correspond with the associated custom taxonomy value 
//Example: DRIVE/2015 page slug must be drive2015, which is the slug for the 'Years' taxonomy for DRIVE/2015

$page_slug = get_post( $post_id )->post_name; // Defines page slug as variable

$schedule_args = array(
	'post_type' => 'sessions',
	'post_status' => 'publish,future',
	'order' => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'years',
			'field' => 'slug',
			'terms' => $page_slug
			),
		),
	); 
$schedule_q = null;
$schedule_q = new WP_Query($schedule_args);