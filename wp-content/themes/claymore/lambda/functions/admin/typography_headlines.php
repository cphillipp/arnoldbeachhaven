<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Typography Option
 *
 * @access public
 * @since 1.1.8
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function option_tree_typography_headlines( $value, $settings, $int ) { ?>
  <div class="option option-font" id="<?php echo $value->item_id; ?>_div">
    
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

		<div class="select_wrapper typography-family">
          <p>
		  <label><?php _e('Font Family' , 'claymore') ?></label>
		  <select name="<?php echo $value->item_id; ?>[font-family]" class="select">
            <?php
            echo '<option value="">font-family</option>';
            foreach ( recognized_font_families() as $key => $family ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $settings[$value->item_id]['font-family'], $key, false ) . '>' . esc_html( $family ) . '</option>';
            } 
            ?>
          </select>
		  </p>
        </div>
        
		<div class="select_wrapper typography-style" style="width:165px;">
          <p>
          <label><?php _e('Font Style' , 'claymore') ?></label>
		  <select name="<?php echo $value->item_id; ?>[font-style]" class="select">
            <?php
            echo '<option value="">font-style</option>';
            foreach ( recognized_font_styles() as $key => $style ) {
              echo '<option value="' . esc_attr( $key ) . '" ' . selected( $settings[$value->item_id]['font-style'], $key, false ) . '>' . esc_html( $style ) . '</option>';
            } 
            ?>
          </select>
		  </p>
        </div>
                
		<div class="select_wrapper typography-weight" style="width:165px;">
  		  <p>
		  <label><?php _e('Font Weight' , 'claymore') ?></label>
		  <select name="<?php echo $value->item_id; ?>[font-weight]" class="select">
            <?php
            echo '<option value="">font-weight</option>';
            foreach ( recognized_font_weights() as $key => $weight ) {
            	echo '<option value="' . esc_attr( $key ) . '" ' . selected( $settings[$value->item_id]['font-weight'], $key, false ) . '>' . esc_html( $weight ) . '</option>';
            } 
            ?>
          </select>
		  </p>
        </div>
        
      </div>
      <?php if($value->item_desc) { ?>
        <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
	<div class="clear"></div>
      <?php } ?>
    </div>
  </div>
<?php
}