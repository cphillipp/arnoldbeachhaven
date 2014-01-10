<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Background Option with Pattern
 *
 * @since Lambda 1.1
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function option_tree_footer_background_pattern( $value, $settings, $int ) { ?>
  <div class="option option-background-upload" id="<?php echo $value->item_id; ?>_div">
    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
		<?php echo htmlspecialchars_decode( $value->item_title ); ?>
		<span class="infoButton right">
			<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" width="40px" height="20px" alt="Info" style="left: 0px;">
		</span>  
        </div>
    </div>   
    <div class="section">
      <div class="element">
        
        <fieldset id="choosepattern">
		<?php
		//First we need the absolute path to our theme directory to make readdir work
		$absolute_path = __FILE__;
		$path_to_file = explode( 'lambda', $absolute_path );
		$absolute_path_to_theme = $path_to_file[0];
		
		//lets search for pattern!
		if ($handle = opendir($absolute_path_to_theme.'/images/footer/pattern/')) {
			
			$count = 0;
			while (false !== ($file = readdir($handle))) {
				if($file != '..' && $file != '.') {
					$checked = '';
					if ( isset($settings[$value->item_id]['background-image']) && $settings[$value->item_id]['background-image'] == trim( $file ) ) 
					{ 
						$checked = ' checked="checked"'; 
					}				
					echo '<div class="single_pattern">
							<input class="check-with-label" name="'.$value->item_id.'[background-image]" id="'.$value->item_id.'_'.$count.'" type="radio" value="'.trim( $file ).'"'.$checked.' />
							<label class="label-for-check" for="'.$value->item_id.'_'.$count.'"><div class="pattern" style="background: url('.THEME_WEB_ROOT.'/images/footer/pattern/'.$file.');"></div></label></div>';
					$count++;
				}
			}
			
			//and we also do not forget to close ;)			
			closedir($handle);
		}	
		?>
		</fieldset>
		
      	</div> <?php if($value->item_desc) { ?>
        <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
	    <div class="clear"></div>
      <?php } ?>
    </div>
  </div>
<?php
}