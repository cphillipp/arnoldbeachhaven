<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

function option_tree_fontmanager( $value, $settings, $int ) 
{ 
?>
  <div class="option option-option-tree-fontmanager">
    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
		<?php echo htmlspecialchars_decode( $value->item_title ); ?> 
		<span class="infoButton right">
				<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" width="40px" height="20px" alt="Info" style="left: 0px;">
		</span> 
        </div>
    </div>   <div class="section">
      <div class="element">
        <?php $count = 0; ?>
        <ul class="ui-sortable option-tree-fontmanager-wrap" id="<?php echo $value->item_id; ?>_list">
        <?php
        if ( !empty( $settings[$value->item_id] ) ) {
          foreach( $settings[$value->item_id] as $font ) { ?>
            <li><?php option_tree_fontmanager_view( $value->item_id, $font, $int, $count ); ?></li><?php 
            $count++; 
          }
        } 
        ?>
        </ul>
        <a href="#" id="<?php echo $value->item_id; ?>" class="btn btn-success light add-font right">Add Font</a>
      </div> <?php if($value->item_desc) { ?>
        <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
		<div class="clear"></div>
      <?php } ?>
    </div>
  </div>
<?php
}

/**
 * Fontmanager
 */
 
function option_tree_fontmanager_view( $id, $font, $int, $count ) {
  // required fileds
  $required_fields = array(
    array(
      'name'  => 'order',
      'type'  => 'hidden',
      'label' => '',
      'class' => 'option-tree-fontmanager-order'
    ),
    array(
      'name'  => 'title',
      'type'  => 'text',
      'label' => 'Fontname',
      'class' => 'option-tree-fontmanager-title'
    )
  );
  
  // optional fields
  $fontmanager_fields = array(
	array(
      'name'  => 'embedded-opentype',
      'type'  => 'font',
      'label' => 'Font URL ( embedded-opentype - eot )',
      'class' => ''
    ),
	array(
      'name'  => 'woff',
      'type'  => 'font',
      'label' => 'Font URL ( woff )',
      'class' => ''
    ),
	array(
      'name'  => 'truetype',
      'type'  => 'font',
      'label' => 'Font URL ( truetype - ttf )',
      'class' => ''
    ),
	array(
      'name'  => 'svg',
      'type'  => 'font',
      'label' => 'Font URL ( svg )',
      'class' => ''
    )
  );
  
  // filter the optional fields
  $fontmanager_fields = apply_filters( 'fontmanager_fields', $fontmanager_fields, $id );
  
  // merge required & optional arrays
  $fontmanager_fields = array_merge( $required_fields, $fontmanager_fields ); ?>
  <div id="option-tree-fontmanager-editor_<?php echo $count; ?>" class="option-tree-fontmanager">
   
   <style type="text/css">
    
		<?php 
		
		$fontface = "@font-face {";
		$fontface .= "font-family: '".$font['title']."';". "\n";

		foreach ($fontmanager_fields as $field) {
			if ( $field['type'] == 'font' || $field['name'] == 'font' ){	
												
					if($field['name'] == 'embedded-opentype') {
						$fontface .= "src: url('".$font[$field['name']]."');". "\n";
						$fontface .= "src: url('".$font[$field['name']]."?#iefix') format('embedded-opentype'),". "\n";
					}
					
					if($field['name'] == 'woff')
					$fontface .= "	   url('".$font[$field['name']]."') format('woff'),". "\n";
					
					if($field['name'] == 'truetype')
					$fontface .= "	   url('".$font[$field['name']]."') format('truetype'),". "\n";
					
					if($field['name'] == 'svg')
					$fontface .= "	   url('".$font[$field['name']]."') format('svg');". "\n";
			}			
		} 	

		$fontface .=	"font-weight: normal;". "\n";
		$fontface .=	"font-style: normal;". "\n";	
		$fontface .= "}";
		
		echo $fontface;
		?>
	    
    </style>
    
    <div class="simple_ui_box">
        <div class="open" style="font-family: '<?php echo $font['title']; ?>'">
          <?php echo empty( $font['title'] ) ? "Font " . ($count + 1) : stripslashes($font['title']); ?>
        </div>
        <a href="#" class="edit btn btn-mini btn-primary">Edit</a>
        <a href="#" class="trash remove-font btn btn-mini btn-danger">Delete</a>
    </div>
    
    <div class="option-tree-fontmanager-body fontmanager">
      <?php
      foreach( $fontmanager_fields as $field ) {
      
        if ( $field['type'] == 'font' || $field['name'] == 'font' ){ ?>
          <div class="singlefont">
            <label><?php echo $field['label']; ?></label>      		  
            <input type="text" name="<?php echo $id; ?>[<?php echo $count; ?>][<?php echo $field['name']; ?>]" id="<?php echo $id; ?>-<?php echo $count; ?>-<?php echo $field['name']; ?>" value="<?php echo ( isset( $font[$field['name']] ) ? stripslashes($font[$field['name']]) : '' ); ?>" class="upload<?php if ( isset( $font[$field['name']] ) ) { echo ' has-file'; } ?>"/>
            <input id="upload_<?php echo $id ?>-<?php echo $count ?>-<?php echo $field['name'] ?>" class="upload_button btn btn-mini btn-success" type="button" value="Upload" rel="<?php echo $int; ?>" />
          </div>
        <?php
        } else if ( $field['type'] == 'text' ) {
          echo '
          <p>
            <label>'.$field['label'].'</label>
            <input type="text" name="'.$id.'['.$count.']['.$field['name'].']" value="'.( isset( $font[$field['name']] ) ? stripslashes($font[$field['name']]) : '' ).'" class="'.$field['class'].'" />
          </p>';
        } else if ( $field['type'] == 'textarea' ) {
          echo '
          <p>
            <label>'.$field['label'].'</label>
            <textarea name="'.$id.'['.$count.']['.$field['name'].']" rows="6" class="'.$field['class'].'">'.( isset( $font[$field['name']] ) ? stripslashes($font[$field['name']]) : '' ).'</textarea>
          </p>';
        } else if ( $field['type'] == 'hidden' ) {
          echo '<input type="hidden" name="'.$id.'['.$count.']['.$field['name'].']" value="'.( isset( $font[$field['name']] ) ? stripslashes($font[$field['name']]) : '' ).'" class="'.$field['class'].'" />';
        }
      }
      ?>
      
      <label><?php _e('Example Shortcode', UT_THEME_INITIAL); ?></label>
      <div class="fontshortcode">
      [font face="<?php echo $font['title']; ?>" size="24" weight="normal" color="#006699" style="italic"] <?php echo $font['title']; ?> [/font]
      </div>
      
    </div>
  </div>
  <?php
}