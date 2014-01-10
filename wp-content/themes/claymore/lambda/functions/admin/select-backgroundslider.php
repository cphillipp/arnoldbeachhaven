<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/*
 * select backgroundsliders 
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since Passion 1.0
 */
 
function option_tree_select_backgroundslider( $value, $settings, $int ) 
{ global $wpdb;
?>
  <div class="option option-select" id="<?php echo $value->item_id; ?>_div">
    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
		<?php echo htmlspecialchars_decode( $value->item_title ); ?>
		<span class="infoButton right">
				<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" width="40px" height="20px" alt="Info" style="left: 0px;">
		</span>  
        </div>
    </div>   <div class="section">
      <div class="element">
        
		  <div class="select_wrapper">
          <select name="<?php echo $value->item_id; ?>" id="<?php echo $value->item_id; ?>" class="select">
          <?php
		  	if (isset($settings[$value->item_id]) ) { 
				$chosenslider = htmlspecialchars( stripslashes( $settings[$value->item_id] ), ENT_QUOTES); }	  	
							
			echo '<option value="">-- Choose One --</option>';
       		
			$table_name = $wpdb->base_prefix . "lambda_sliders";
			$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
			
			if(is_array($slidedata)) {				
				foreach ($slidedata as $singledata) { 
				   				   
				   if($singledata->slidertype == 'supersized') {
				   		if($chosenslider == 'lambda_'.$singledata->id) {
				   			echo "<option value='lambda_".$singledata->id."' name='".$singledata->option_name."' selected=\"selected\">".$singledata->option_name."</option>";
						} else {
				   			echo "<option value='lambda_".$singledata->id."' name='".$singledata->option_name."'>".$singledata->option_name."</option>";						
						}
				   }
				}
			}
			
			 
          ?>
          </select>
        </div>
      </div> <?php if($value->item_desc) { ?>
       <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
	<div class="clear"></div>
      <?php } ?>
    </div>
  </div>
<?php
}