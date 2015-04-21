<?php
/*
Template Name: Query Test (No Sidebar)
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="row">
			
				    <div id="main" class="large-12 medium-12 columns" role="main">
					
					<?php

						//This creates list of session slugs that are not in the future (the "past years" set)
						$pastyear_slugs_a = array();
						$pastyear_terms_args = array(
							'orderby'=>'asc',
							'hide_empty'=>true,
							);
						$pastyears = get_terms('years', $pastyear_terms_args);
						foreach ($pastyears as $term ) {
							$pastyear_slugs_a[]=$term->slug;
						}

						// END

						// Creates a WP_Query set that only inlcludes posts that are in the "past years" set above

						$args_test = array(
							'post_type' => 'sessions',
							'post_status' => 'publish,future',
							'tax_query' => array(
								array(
									'taxonomy' => 'years',
									'field' => 'slug',
									'terms' => $pastyear_slugs_a
									),
								),
							); 
						$query_test = null;
			  			$query_test = new WP_Query($args_test);

			  			echo '<h1>Past Year</h1>';
			  			while ( $query_test -> have_posts() ) : $query_test->the_post(); ?>
			  			<a href="<?php the_permalink();?>"><p><?php the_title(); ?></p></a>
						
			  			<?php wp_reset_postdata();
			  			endwhile;

			  			//
						
						// Creates a WP_Query set that only inlcludes posts that are NOT in the "past years" set above

						$args_test = array(
							'post_type' => 'sessions',
							'post_status' => 'publish,future',
							'tax_query' => array(
								array(
									'taxonomy' => 'years',
									'field' => 'slug',
									'terms' => $pastyear_slugs_a,
									'operator' => 'NOT IN'
									),
								),
							); 
						$query_test = null;
			  			$query_test = new WP_Query($args_test);

			  			echo '<h1>Next Year</h1>';
			  			while ( $query_test -> have_posts() ) : $query_test->the_post(); ?>
			  			<a href="<?php the_permalink();?>"><p><?php the_title(); ?></p></a>
						
			  			<?php wp_reset_postdata();
			  			endwhile;

			  			//



					?>
						
				    <!-- Get list of terms within 'Years' custom taxonomy -->
						<?php
						echo '<h1>Years</h1>';
						$args = array(
							'orderby'=>'asc',
							'hide_empty'=>true,
							);
						
						$custom_terms = get_terms('years', $args);
						
						foreach($custom_terms as $term){
						    echo 'Term slug: ' . $term->slug . ' Term Name: ' . $term->name . '<br>';}
						?>


    				</div> <!-- end #main -->
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
