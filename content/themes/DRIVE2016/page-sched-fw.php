<?php
/*
Template Name: Schedule (No Sidebar)
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="row">
			
				    <div id="main" class="large-12 medium-12 columns" role="main">
					
				    	<?php

						// Defines page slug as variable
				    	$page_slug = get_post( $post_id )->post_name;

				    	/***************************
				    	Conference Schedule Dates
				    	***************************/
				    	//Creates a list of dates that the schedule must include
				    	//Driven off the conference page in the WP-UI (example: DRIVE/2015)
				    	$dates = array();
				    	while( have_rows('con_dates-highs_r') ): the_row();
				    	$dates[] = get_sub_field('con_dates');
				    	endwhile;
				    	/***************************/


				    	/***************************
				    	Schedule Query
				    	***************************/
				    	//Creates a new main query that limits the returned posts & custom posts to those that match the page slug
				    	//For this to work, the page slug must correspond with the associated custom taxonomy value 
				    	//Example: DRIVE/2015 page slug must be drive2015, which is the slug for the 'Years' taxonomy for DRIVE/2015
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
				    	/***************************/
				    	
				    	/***************************
				    	Child Post ID's
				    	***************************/
				    	//Sets up list of child post ID's
				    	//This can be used to prevent children sessions from showign on the main schedule
				    	$child_ids = array();
				    	while ($schedule_q -> have_posts() ) : $schedule_q->the_post(); 
				    	if (get_field('session_childs')) {
				    		foreach (get_field('session_childs') as $child) {
				    			$child_ids[] = $child;
				    		}
				    	}
				    	endwhile;
				    	/***************************/

				    	/***************************
				    	List of Post Times
				    	***************************/
				    	//Sets up list of child post Times
				    	//
				    	$post_dates = array();
				    	while ($schedule_q -> have_posts() ) : $schedule_q->the_post(); 
				    	$post_dates[] = get_the_date();
				    	endwhile;

				    	echo '<pre>'.var_dump($post_dates).'</pre>';

				    	/***************************/

				    	foreach ($dates as $date ) {
				    		
				    		echo '<h1>' . DateTime::createFromFormat('m/d/Y', ($date))->format('l, F d') . '</h1>';

				    		echo '<ul class="accordion" data-accordion>';
				    		while ( $schedule_q -> have_posts() ) : $schedule_q->the_post(); 

				    		if ( 
					    			$date == DateTime::createFromFormat('Y-m-d H:i:s', ($post->post_date))->format('m/d/Y') //Checks if Date is equal to session date listed in page config (WP-UI)
					    			and
					    			!in_array($post->ID, $child_ids) //Compares Post ID to list of known child post id's 
					    			) 
				    		{
				    			get_template_part( 'partials/loop', 'schedule2' ); 
				    			wp_reset_postdata();
				    			}

				    			endwhile;
				    			echo '</ul>';
				    		}

			  			//

				    		?>

    				</div> <!-- end #main -->
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
