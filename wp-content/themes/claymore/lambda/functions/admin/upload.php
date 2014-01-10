<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Upload Option
 *
 * @access public
 * @since 1.0.0
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function option_tree_upload( $value, $settings, $int ) { ?>
  <div class="option option-upload" id="<?php echo $value->item_id; ?>_div">
    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
			<?php echo htmlspecialchars_decode( $value->item_title ); ?>
			<span class="infoButton right">
				<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" width="40px" height="20px" alt="Info" style="left: 0px;">
			</span>  
        </div>
    </div>   <div class="section">
      <div class="element">
        <input type="text" name="<?php echo $value->item_id; ?>" id="<?php echo $value->item_id; ?>" value="<?php if ( isset( $settings[$value->item_id] ) ) { echo $settings[$value->item_id]; } ?>" class="upload<?php if ( isset( $settings[$value->item_id] ) ) { echo ' has-file'; } ?>" />
        <button style="margin-left:0px; margin-top:10px;" id="upload_<?php echo $value->item_id; ?>" class="upload_button btn btn-success" rel="<?php echo $int; ?>" /><i class="icon-picture icon-white"></i> <?php _e('Upload', 'claymore'); ?></button>
        
		<hr />
		
		<?php if ( is_array( @getimagesize( $settings[$value->item_id] ) ) ) { ?>
        <div class="screenshot" id="<?php echo $value->item_id; ?>_image">
          <?php 
          if ( isset( $settings[$value->item_id] ) && $settings[$value->item_id] != '' ) {
            $remove = '<a class="btn btn-mini btn-danger right remove" href="javascript:(void);" class="remove" title="Remove"><i class="icon-remove icon-white"></i></a>';
            $image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $settings[$value->item_id] );
            if ( $image ) {
              echo '<img src="'.$settings[$value->item_id].'" alt="" />'.$remove.'';
            } else {
              $parts = explode( "/", $settings[$value->item_id] );
              for( $i = 0; $i < sizeof($parts); ++$i ) {
                $title = $parts[$i];
              }
              echo '<div class="no_image"><a href="'.$settings[$value->item_id].'">'.$title.'</a>'.$remove.'</div>';
            }
          }
          ?>
        </div>
        <?php } ?>
      </div> <?php if($value->item_desc) { ?>
       <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
	 <div class="clear"></div>
      <?php } ?>
    </div>
  </div>
<?php
}