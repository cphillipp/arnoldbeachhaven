<?php

global $lambda_content_column, $theme_options;

#-----------------------------------------------------------------
# Define Image Width
#-----------------------------------------------------------------
if($lambda_content_column == 'sixteen') {
	
	$lambda_image_width = '940';
	
} elseif($lambda_content_column == 'eleven') {
	
	$lambda_image_width = '640';
	
} elseif($lambda_content_column == 'eight') {
	
	$lambda_image_width = '460';
	
}else {
	
	$lambda_image_width = '460';
}


#-----------------------------------------------------------------
# Image Output
#-----------------------------------------------------------------

global $columns;

if(has_post_thumbnail(get_the_ID())) : ?>

<div class="thumb">
	<div class="post-image">	
		
		<div class="overflow-hidden imagepost">
		
		<?php 
			
			//get featured image
			$imgID = get_post_thumbnail_id($post->ID);		
			$popup = $url = wp_get_attachment_url( $imgID ); 
			
			//cropping if customer has backend option to yes
			if(isset($theme_options['activate_image_cropping']) && $theme_options['activate_image_cropping'] == 'yes') {
				$url = aq_resize( $url, $lambda_image_width , get_option_tree('blog_single_height'), true );
			}
			
			//get image meta for SEO
			$alt = get_post_meta($imgID , '_wp_attachment_image_alt', true);			

		?>
				
		<a title="<?php echo get_the_title(); ?>" data-rel="prettyPhoto" href="<?php echo $popup; ?>"><img src="<?php echo $url; ?>" alt="<?php echo trim( strip_tags($alt) ); ?>" /></a>
		
		
		</div>
	</div>
</div>

<?php endif; ?>