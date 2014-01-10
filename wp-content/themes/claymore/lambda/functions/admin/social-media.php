<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Image Social Option
 *
 */
function option_tree_social( $value, $settings, $int ) 
{ 
?>
  <div class="option option-option-tree-social">
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
        <?php $count = 0; ?>
        <ul class="ui-sortable option-tree-social-wrap" id="<?php echo $value->item_id; ?>_list">
        <?php
        if ( !empty( $settings[$value->item_id] ) ) {
          foreach( $settings[$value->item_id] as $image ) { ?>
            <li><?php option_tree_social_view( $value->item_id, $image, $int, $count ); ?></li><?php 
            $count++; 
          }
        } 
        ?>
        </ul>
        <a href="#" id="<?php echo $value->item_id; ?>" class="btn-mini btn-success add-social right">Add Social Media</a>
      	</div> <?php if($value->item_desc) { ?>
        <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
	    <div class="clear"></div>
      <?php } ?>
    </div>
  </div>
<?php
}

/**
 * Social HTML
 */
function option_tree_social_view( $id, $image, $int, $count ) {
  // required fileds
  $requred_fields = array(
    array(
      'name'  => 'order',
      'type'  => 'hidden',
      'label' => '',
      'class' => 'option-tree-social-order'
    ),
    array(
      'name'  => 'title',
      'type'  => 'text',
      'label' => 'Title',
      'class' => 'option-tree-social-title'
    )
  );
  
  // optional fields
  $image_social_fields = array(
    array(
      'name'  => 'image',
      'type'  => 'image',
      'label' => 'Image URL',
      'class' => ''
    ),
    array(
      'name'  => 'link',
      'type'  => 'text',
      'label' => 'Link URL',
      'class' => 'social_url'
    )
  );
  
  // filter the optional fields
  $image_social_fields = apply_filters( 'image_social_fields', $image_social_fields, $id );
  
  // merge required & optional arrays
  $image_social_fields = array_merge( $requred_fields, $image_social_fields );
  ?>
  <div id="option-tree-social-editor_<?php echo $count; ?>" class="option-tree-social">
    <div class="open simple_ui_box">
     
	 <span class="dynamictitle">
	 <?php echo empty( $image['title'] ) ? "Social Icon " . ($count + 1) : stripslashes($image['title']); ?>
     </span>
    
	
	<a href="#" class="edit btn-mini btn-success"><i class="icon-edit icon-white"></i></a>
    <a href="#" class="trash remove-social btn-mini btn-danger"><i class="icon-remove icon-white"></i></a>
    
	
	
	<div class="option-tree-social-body">
      <?php
      foreach( $image_social_fields as $field ) {
      
        if ( $field['type'] == 'image' || $field['name'] == 'image' ){ ?>
          <div>
            <label><?php echo $field['label']; ?></label><br />      		  
            <input type="text" name="<?php echo $id; ?>[<?php echo $count; ?>][<?php echo $field['name']; ?>]" id="<?php echo $id; ?>-<?php echo $count; ?>-<?php echo $field['name']; ?>" value="<?php echo ( isset( $image[$field['name']] ) ? stripslashes($image[$field['name']]) : '' ); ?>" class="upload<?php if ( isset( $image[$field['name']] ) ) { echo ' has-file'; } ?>"/>
            <input id="upload_<?php echo $id ?>-<?php echo $count ?>-<?php echo $field['name'] ?>" class="upload_button" type="button" value="Upload" rel="<?php echo $int; ?>" />
            <div class="screenshot" id="<?php echo $id ?>-<?php echo $count ?>-<?php echo $field['name'] ?>_image">
              <?php 
              if ( isset( $image[$field['name']] ) && $image[$field['name']] != '' ) 
              { 
                $remove = '<a href="javascript:(void);" class="remove">Remove</a>';
                $screenshot_image = $image[$field['name']];
                $new_image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image[$field['name']] );
                if ( $new_image ) 
                {
                  echo '<img src="'.$screenshot_image.'" alt="" />'.$remove.'';
                }
              }
              ?>
          </div><div class="clear"></div>
        <?php
        } else if ( $field['type'] == 'text' ) {
          echo '
          <p>
            <label>'.$field['label'].'</label><br /> 
            <input type="text" name="'.$id.'['.$count.']['.$field['name'].']" value="'.( isset( $image[$field['name']] ) ? stripslashes($image[$field['name']]) : '' ).'" class="'.$field['class'].'" />
          </p>';
        } else if ( $field['type'] == 'textarea' ) {
          echo '
          <p>
            <label>'.$field['label'].'</label><br /> 
            <textarea name="'.$id.'['.$count.']['.$field['name'].']" rows="6" class="'.$field['class'].'">'.( isset( $image[$field['name']] ) ? stripslashes($image[$field['name']]) : '' ).'</textarea>
          </p>';
        } else if ( $field['type'] == 'hidden' ) {
          echo '<input type="hidden" name="'.$id.'['.$count.']['.$field['name'].']" value="'.( isset( $image[$field['name']] ) ? stripslashes($image[$field['name']]) : '' ).'" class="'.$field['class'].'" />';
        }
      }
      ?>
	  </div>
    </div>
  </div>
  <?php
}