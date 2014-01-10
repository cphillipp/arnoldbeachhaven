<?php

/*
 * Social Icon Widget 
 * lambda framework v 1.0
 * by www.unitedthemes.com
 */


class WP_Widget_Social extends WP_Widget {
	
	protected $slug = 'lambda_social';
	
    function __construct() {
		$widget_ops = array('classname' => 'lambda_widget_social clearfix', 'description' => __( 'Displays Social Icons!', 'claymore') );
		parent::__construct('lw_social', __('Lambda - Social', 'claymore'), $widget_ops);
		$this->alt_option_name = 'lambda_widget_social';

	}

    function form($instance) {
	
		//Call Jquery 
		wp_enqueue_script('jquery');
		
		$title = esc_attr( $instance['title'] );
		$color = esc_attr( $instance['color'] );
		$items = json_decode($instance['socialmedia'], true);
	
		?>
		
		
		<?php
		#-----------------------------------------------------------------
		# Create list of Icons available
		#-----------------------------------------------------------------
		
		$social_icons = array();
		
		//First we need the absolute path to our theme directory to make readdir work
		$absolute_path = __FILE__;
		$path_to_file = explode( 'lambda', $absolute_path );
		$absolute_path_to_theme = $path_to_file[0];
			
		//lets search for icons!
		if ($handle = opendir($absolute_path_to_theme.'/images/icons/social/black/')) {
				
			while (false !== ($file = readdir($handle))) {
				if($file != '..' && $file != '.') {
					
					//Create Key Name
					$key = preg_replace('/.png/', '', $file);
					$key = preg_replace('/_alt/', '', $key);
					$key = ucfirst($key);					
					
					//Push to Array					
					$social_icons[$key] = $file;
		
				}
			}
			
			//and we also do not forget to close ;)			
			closedir($handle);
		}
		
		asort($social_icons);
		
		?>
		   
        
		<?php if($this->number != '__i__') { ?>
		
		<?php
		#-----------------------------------------------------------------
		# Additional CSS Styles
		#-----------------------------------------------------------------
		?>
	
		<style type="text/css">
		#widget-items-<?php echo $this->number; ?> .widget-item{
			margin: 0 0 10px 0;
		}
		#widget-items-<?php echo $this->number; ?> .widget-item label{
			display: block;
			margin: 0 0 10px 0;
		}
		#widget-items-<?php echo $this->number; ?> input{
			width:190px;
			float: right;
			margin: -3px 0 0 0;
		}
		#widget-items-<?php echo $this->number; ?> .clear{
			clear: both;
		}
		.lambda-widget-box {
			border: 1px solid #DFDFDF;
			background: #FFF;
			display: block;
			margin-bottom: 15px;
			padding:10px;
		}
		.lambda-widget-box input {
			float:none !important;		
		}
		
		.lambda-alert {
			padding: 8px 35px 8px 14px;
			margin-bottom: 0;
			color: #c09853;
			text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
			background-color: #fcf8e3;
			border: 1px solid #fbeed5;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
		}
		
		.lambda-success {
		  color: #468847;
		  background-color: #dff0d8;
		  border-color: #d6e9c6;
		  text-align:center;
		}
		
		
		</style>

		<?php
		#-----------------------------------------------------------------
		# JavaScript for adding unlimited Icons
		#-----------------------------------------------------------------
		?>


		<script type="text/javascript">
			jQuery(document).ready(function($){
			    		
				var item = '<div class="widget-item lambda-widget-box"><p><label><?php _e('Icon', 'claymore'); ?>:</label>';
				
				item += '<select class="icon">';
				<?php
					foreach($social_icons as $iconname => $image) {
						echo "item += '<option value=\"".$image."\">".$iconname."</option>';";
					}			
				?>
				item += '</select></p>';				
				
				item  += '<p><label><?php _e('Link', 'claymore'); ?>:</label><input type="text" class="widefat link" /></p>';
				item += '<a href="#" class="del-item button clear"><?php _e('remove', 'claymore'); ?></a></div>';
				
				//Delete Item
				$('.del-item').live('click', function(){
					$(this).parent().remove();
				});
				
				//Add Item
				$('#add-item-<?php echo $this->number; ?>').click(function(event){
					event.stopPropagation();
					$('#widget-items-<?php echo $this->number; ?>').append(item);
				});
				
				
				$('#widget-<?php echo $this->id; ?>-savewidget').click(function() {
					get_data_object_string();
				});
				
				$('#savewidget').click(function() {
					get_data_object_string();
				});
				
				function get_data_object_string(){
				var i=0, data={};
				$('#widget-items-<?php echo $this->number; ?> .widget-item').each(function(){
					if( $(this).find('.icon').val()!='' || $(this).find('.link').val()!='' ){
						i++;
						data[i]={};
						data[i]['icon'] = $(this).find('.icon').val();
						data[i]['link'] = $(this).find('.link').val();
					}
				});				
				
				$( '#<?php echo $this->get_field_id('socialmedia'); ?>' ).val( JSON.stringify( data ) );
				}
			});
		</script>
		
	
		<?php
		#-----------------------------------------------------------------
		# Widget Title
		#-----------------------------------------------------------------
		$checked_black = '';
		$checked_white = '';
		
		?>		
	
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'claymore'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color:', 'claymore'); ?></label>
		<select name="<?php echo $this->get_field_name('color'); ?>">
		
			<?php $checked_black = ($color == 'black') ? 'selected="selected"' : ''; ?>
			<?php $checked_white = ($color == 'white') ? 'selected="selected"' : ''; ?>
				
			<option value="black" <?php echo $checked_black; ?>><?php _e('Black Icons', 'claymore'); ?></option>	
			<option value="white" <?php echo $checked_white; ?>><?php _e('White Icons', 'claymore'); ?></option>
			
		</select></p>
								
		<div class="clear"></div>
		<div id="widget-items-<?php echo $this->number; ?>">
		
        
        <?php 
				
		if(is_array($items)) {
				
			foreach( $items as $num => $fields ): ?>
			<div class="widget-item lambda-widget-box">
							
				<p><label><?php _e('Icon', 'claymore'); ?>:</label>
				
				<select class="icon">
					<?php 
						foreach($social_icons as $socialname => $icon) {
							$checked = '';
							$checked = ($icon == $fields['icon']) ? ' selected="selected"' : '' ;
							echo '<option value="'.$icon.'"'.$checked.'>'.$socialname.'</option>';
						}					
					?>			
				</select></p>
			
				<p><label><?php _e('Link', 'claymore'); ?>:</label><input type="text" class="link" name="link" value="<?php echo esc_attr($fields['link']); ?>" /></p>
				<div class="clear"></div>
				<a href="#" class="del-item button"><?php _e('remove', 'claymore'); ?></a>
			</div>
			
			<?php 
			endforeach; 	
		} else {
		?>
		
		<div class="widget-item lambda-widget-box">
			
			<p><label><?php _e('Icon', 'claymore'); ?>:</label>
			<select class="icon">
				<?php 
					foreach($social_icons as $socialname => $icon) {
						$checked = '';
						$checked = ($icon == $fields['icon']) ? ' selected="selected"' : '' ;
						echo '<option value="'.$icon.'"'.$checked.'>'.$socialname.'</option>';
					}					
				?>			
			</select></p>
			
			<p><label><?php _e('Link', 'claymore'); ?>:</label><input type="text" class="link" /></p>
			
			<div class="clear"></div>
			<a href="#" class="del-item button"><?php _e('remove', 'claymore'); ?></a>
			
		</div>
					
		<?php } ?>	
			
		</div>
				
		<input type="button" id="add-item-<?php echo $this->number; ?>" class="button" value="Add Item" />
		<input type="hidden" id="<?php echo $this->get_field_id('socialmedia'); ?>" name="<?php echo $this->get_field_name('socialmedia'); ?>" value="" />
		
		<?php } else { ?>
		
		<div class="lambda-alert lambda-success">
			<?php _e('Please "save" first <br /> to activate the Widget!'); ?>
		</div>
		
		
		<?php } ?>
		
		
	
	<?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ){

	extract( $args );
	
	$items = json_decode($instance['socialmedia'], true);
	$title = $instance['title'];
	$color = $instance['color'];
	$title = apply_filters( $this->slug, $title );
	$themepath = get_template_directory_uri();
	
	if(is_array($items)) {
		$out = '<ul class="social-icons clearfix">';
		foreach( $items as $num => $fields ){
			
			//Create "Alt"
			$alt = preg_replace('/.png/', '', $fields['icon']);
			$alt = preg_replace('/_alt/', '', $alt);
			$alt = preg_replace('/_/', '', $alt);
			
			$alt = ucfirst($alt);		
					
			$out .= '
			<li>
				<a href="'.$fields['link'].'">
				<img src="'.$themepath.'/images/icons/social/'.$color.'/'.$fields['icon'].'" alt="'.$alt.'" title="'.$alt.'" />
				</a>
			</li>';
		}	
		$out .='</ul>';
	}

	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;
	    
	echo "
	$before_widget
	    $title
	    $out
	$after_widget
	";
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("WP_Widget_Social");' ) );
?>