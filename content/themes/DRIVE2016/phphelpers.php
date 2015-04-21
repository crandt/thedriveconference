<?php

// Take "any" date/time string and convert it to another value/format.  Used to interpret dates to more usable formats.
// Taken from http://stackoverflow.com/questions/2754765/how-to-reformat-date-in-php
$date_output_from_wp = '2009-08-12'
$date = DateTime::createFromFormat('Y-m-d', $date_output_from_wp)->format('F j, Y');



$date = DateTime::createFromFormat('Y-m-d', $post->post_date)->format('m/d/Y');


<pre><?php var_dump($post); ?></pre>



?>


			<script type="text/javascript">
			$('#sched_main').foundation({accordion: {multi_expand: false}});
			</script>