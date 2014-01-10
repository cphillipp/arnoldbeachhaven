<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Category Option
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
function option_tree_category( $value, $settings, $int ) 
{ 
?>
  <div class="option option-select">
     
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
        <div class="select_wrapper">
          <select name="<?php echo $value->item_id; ?>" id="<?php echo $value->item_id; ?>" class="select">
          <?php
       		$categories = &get_categories( array( 'hide_empty' => false ) );
       		if ( $categories )
       		{
       	    echo '<option value="">-- Choose One --</option>';
            foreach ($categories as $category) 
            {
              $selected = '';
    	        if ( isset( $settings[$value->item_id] ) && $settings[$value->item_id] == $category->term_id ) 
    	        { 
                $selected = ' selected="selected"'; 
              }
            	echo '<option value="'.$category->term_id.'"'.$selected.'>'.$category->name.'</option>';
            }
          }
          else
          {
            echo '<option value="0">No Categories Available</option>';
          }
          ?>
          </select>
        </div>
      </div> <?php if($value->item_desc) { ?>
        <div class="desc alert alert-neutral">            <?php echo htmlspecialchars_decode( $value->item_desc ); ?>
        </div>
      <?php } ?>
    </div>
  </div>
<?php
}

/**
 * Categories Option
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
function option_tree_categories( $value, $settings, $int ) 
{ 
?>
  <div class="option option-checbox">
    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
		<?php echo htmlspecialchars_decode( $value->item_title ); ?> 
        </div>
    </div>   
    <div class="section">
      <div class="element">
        <?php
        // check for settings item value 
	      if ( isset( $settings[$value->item_id] ) ) {
          $ch_values = (array) $settings[$value->item_id];
        } else {
          $ch_values = array();
        }
        // loop through tags
	      $categories = &get_categories( array( 'hide_empty' => false ) );
       	if ( $categories )
       	{
       	  $count = 0;
  	      foreach ( $categories as $category ) 
  	      {
            $checked = '';
  	        if ( in_array( $category->term_id, $ch_values ) ) 
  	        { 
              $checked = ' checked="checked"'; 
            }
  	        echo '<div class="input_wrap"><input name="'.$value->item_id.'['.$count.']" id="'.$value->item_id.'_'.$count.'" type="checkbox" value="'.$category->term_id.'"'.$checked.' /><label for="'.$value->item_id.'_'.$count.'">'.$category->name.'</label></div>';
  	        $count++;
       		}
       	}
       	else
       	{
       	  echo '<p>No Tags Available</p>';
       	}
        ?>
      </div> <?php if($value->item_desc) { ?>
      <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
	  <div class="clear"></div>
      <?php } ?>
    </div>
  </div>
<?php
}