<li id="sched_main" class="accordion-navigation">
	<a href="#<?php echo $post->post_name; ?>">
		<?php the_title(); ?>
	</a>
	
	<div id="<?php echo $post->post_name; ?>" class="content" >

		<div class="row">
			
			<?php
				if (get_field('session_sponsors')) { ?>
					<div class="medium-8 large-8 columns">
						<?php the_content(); ?>
					</div>
					<div class="medium-4 large-4 columns">
						Sponsored By:
					</div>
				<?php } else { ?>
					<div class="medium-12 columns">
						<?php the_content(); ?>
					</div>
				<?php }
			?>

		</div>

		<?php
			if (get_field('session_childs')) { ?>
				
				<div id="sched_sub" class="row">
					<div class="medium-12 large-12 columns child-sched">
						<div class="small-12 text-center">Included in this session:</div>
						<ul class="tabs vertical" data-tab>
							<?php 
							$active_counter_1 = 0;
							foreach (get_field('session_childs') as $child): 
								$active_counter_1++;
								?>
								<li class="tab-title<?php if($active_counter_1 == 1){echo ' active';} ?>"><a href="#<?php echo get_post($child)->post_name; ?>"><?php echo get_post($child)->post_title; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<div class="tabs-content child-sched-content">
							<?php 
							$active_counter_2 = 0;
							foreach (get_field('session_childs') as $child): 
							$active_counter_2++;
							?>
								<div class="content<?php if($active_counter_2 == 1){echo ' active';} ?>" id="<?php echo get_post($child)->post_name; ?>">
									<div class="medium-9 columns">
										<?php echo get_post($child)->post_content; ?>
									</div>
								</div>
							<?php endforeach; ?>

						</div> <!-- child-sched-content -->
					</div> <!-- child-sched -->
				</div> <!-- row -->
			<?php }  //end of: if (get_field('session_childs'))
		?>
	</div>
</li>