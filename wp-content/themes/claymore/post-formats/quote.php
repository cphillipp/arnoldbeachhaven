<?php
#-----------------------------------------------------------------
# Quote
#-----------------------------------------------------------------
global $lambda_meta_data;
?>

	<div class="quote">
		<div class="quote-border">
		<h2 class="entry-title">
			<?php $linkmeta = $lambda_meta_data->the_meta();
			echo (isset($linkmeta['post_format_quote'])) ? $linkmeta['post_format_quote'] : ''; ?>
		</h2>
		
		<cite>&#8722; <?php the_title(); ?></cite>
        </div> 
	</div>


