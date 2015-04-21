<?php
/*
Template Name: Page Slug (No Sidebar)
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="row">
			
				    <div id="main" class="large-12 medium-12 columns" role="main">
					
				    	<?php

						// Creates a WP_Query set that only inlcludes posts where the Year custom taxonomy matches the page slug 



				    	$page_slug = get_post( $post_id )->post_name;

				    	$dates = array();
				    	while( have_rows('con_dates-highs_r') ): the_row();
				    	$dates_raw = get_sub_field('con_dates');
				    	$dates[] = $dates_raw;
				    	endwhile;

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
				    	$schedule_test = null;
				    	$schedule_test = new WP_Query($schedule_args);

				    	foreach ($dates as $date ) {

				    		echo '<h1>' . DateTime::createFromFormat('m/d/Y', ($date))->format('l, F d') . '</h1>';
				    		while ( $schedule_test -> have_posts() ) : $schedule_test->the_post(); 

				    		if ( $date == DateTime::createFromFormat('Y-m-d H:i:s', ($post->post_date))->format('m/d/Y')) 
				    		{
				    			?>

				    			<a href="<?php the_permalink();?>"><p><?php the_title(); ?></a></p> 
				    			
				    			<?php wp_reset_postdata();
				    		}

				    		endwhile;

				    	}
			  			//



				    	?>

    				</div> <!-- end #main -->
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
