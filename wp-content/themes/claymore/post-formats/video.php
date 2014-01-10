 <?php	
#-----------------------------------------------------------------
# Video Output
#-----------------------------------------------------------------
global $lambda_meta_data, $columns;

$videometa = $lambda_meta_data->the_meta();

//Embedded Code will overwrite hosted videos!
if(isset($videometa['embedded_code']) || isset($videometa['portfolio_embedded_code']) || isset($videometa['single_embedded_code'])) { ?>
 	
	
     <div class="thumb">
	 	
		<div class="lambda-video">
        	
			<?php echo (isset($videometa['embedded_code'])) ? $videometa['embedded_code'] : ''; ?>
			<?php echo (isset($videometa['portfolio_embedded_code'])) ? $videometa['portfolio_embedded_code'] : ''; ?>
			<?php echo (isset($videometa['single_embedded_code'])) ? $videometa['single_embedded_code'] : ''; ?>

        </div>
       
     </div>
	
<?php }

if(!isset($videometa['embedded_code']) && !isset($videometa['portfolio_embedded_code']) && !isset($videometa['single_embedded_code']) && (isset($videometa['nonverbla_url']) || isset($videometa['nonverbla_hd_url']))) {
	//load Video Player
	echo '<div class="thumb">';
		nonverbla_video_player($videometa, get_the_ID(), $columns);
	echo '</div>';                  
}

?>