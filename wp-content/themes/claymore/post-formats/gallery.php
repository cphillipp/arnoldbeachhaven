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
# Gallery Output
#-----------------------------------------------------------------
?>

<?php if ( post_password_required() ) : ?>

<?php the_content(); ?>

<?php else : ?>
<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery("#post-slider-<?php the_ID(); ?>").flexslider({
							animation: "fade", 
							slideshow: true,
							slideshowSpeed: 2500
							
						});
					});
				</script>
<?php  ?>
                                                        
                                                        
 <?php
		
	//extract wordpress gallery shortcode to retrieve image ID's	
	$content = get_the_content();
	$pattern = '\[(\[?)(gallery)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
	
    preg_match( "/$pattern/s", $content, $match );
	
    if( isset( $match[2] ) && ( "gallery" == $match[2] ) ) {
        
		$atts = $match[3];		
		$atts = shortcode_parse_atts( $match[3] );
			
      	if( isset($atts['ids']) ) {

			//new wordpress gallery shortcode
			$images = array();
			$imageIDs = explode( ',', $atts['ids'] );
			
			$count = 1;		
			foreach($imageIDs as $singleID) {
				
				$images[$count] = new stdClass;
				$image_attributes = wp_get_attachment_image_src( $singleID, 'large' );
				$images[$count]->guid = $image_attributes['0'];
				$count++;
								
			}
						
				
		} else {
			//old gallery handling
			$images = get_children( array( 	'post_parent' => $post->ID, 
                                            'post_type' => 'attachment', 
                                            'post_mime_type' => 'image', 
                                            'orderby' => 'menu_order', 
                                            'order' => 'ASC', 
                                            'numberposts' => 999 ) );
								
			}
		
		
    } 
		
?>                                                        

                                                        

<?php if(is_array($images) && !empty($images)) : ?>

<div class="thumb"> 
	<div id="post-slider-<?php the_ID(); ?>" class="flexslider post-slider">
	
	  <ul class="slides">
		
		<?php 
							
			foreach($images as $singleimage) {
				   
				   $prettyphoto = ( is_single() ) ? 'data-rel="prettyPhoto[postgallery]"' : '';
				   $link = ( is_single() ) ? $singleimage->guid : get_permalink();
				   
				   $url = $singleimage->guid;
				   
				   //cropping if customer has backend option to yes
					if(isset($theme_options['activate_image_cropping']) && $theme_options['activate_image_cropping'] == 'yes') {

						$height = (is_single()) ?  get_option_tree('blog_single_gallery_height') :  get_option_tree('blog_preview_gallery_height');				   
						$url = aq_resize( $url, $lambda_image_width , $height, true );
						
					}
				   
				   				   	   
				   echo '<li><a href="'.$link.'" '.$prettyphoto.'><img src="'.$url.'" alt="'.$url.'" /></a></li>';
				   
			}
			 
		?>
	  </ul>
	  
	</div>
</div>

<?php endif; ?>

<?php endif; ?>