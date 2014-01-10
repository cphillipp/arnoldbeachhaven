<?php
#-----------------------------------------------------------------
# validator
#-----------------------------------------------------------------
if ( !function_exists( 'callValidator' ) ) {
	function callValidator() {
		
		global $lambda_meta_data;
		
		$rules = 'rules: { ';
		$messages = 'messages: { ';
		
		$contactelements = $lambda_meta_data->the_meta();
		
		if(isset($contactelements[UT_THEME_INITIAL.'contact_form_fields']) && is_array($contactelements[UT_THEME_INITIAL.'contact_form_fields'])) {
			foreach ($contactelements[UT_THEME_INITIAL.'contact_form_fields'] as $field)	{
				
				$special_form_types = array('checkbox', 'radio', 'select', 'email');
				
				#-----------------------------------------------------------------
				# create form rules
				#-----------------------------------------------------------------
				
				//check if field type is special form type
				if(in_array($field['field_type'],$special_form_types) && isset($field['is_required'])) {
					//check if field type is email
					if($field['field_type'] != 'email') {
						$rules.= remove_trash($field['field_name']).': "required",'; 
					} else {
						$field['min_length'] = !empty( $field['min_length'] ) ? $field['min_length'] : 1; 
						$rules.=  remove_trash($field['field_name']).': {
							required: true,
							email: true,
							minlength: '.$field['min_length'].'
						},';
					}				
				}			
				//now check standard field types
				if(!in_array($field['field_type'],$special_form_types) && isset($field['is_required']) && !isset($field['min_length'])) {
					$rules.= remove_trash($field['field_name']).': "required",'; 
				} elseif(!in_array($field['field_type'],$special_form_types) && isset($field['is_required']) && isset($field['min_length'])) {
					$field['min_length'] = !empty( $field['min_length'] ) ? $field['min_length'] : 1;
					$rules.= remove_trash($field['field_name']).': {
							required: true,
							minlength: '.$field['min_length'].'
					},';
				}
				
				#-----------------------------------------------------------------
				# create error messages
				#-----------------------------------------------------------------
				if(in_array($field['field_type'],$special_form_types) && isset($field['error_message']) && isset($field['is_required'])) {
					$messages.=  remove_trash($field['field_name']).':"'.$field['error_message'].'",'; 
				} elseif(!in_array($field['field_type'],$special_form_types) && isset($field['error_message']) && isset($field['is_required']) && isset($field['min_length'])) {
					$field['min_length'] = !empty( $field['min_length'] ) ? $field['min_length'] : 1;
					$messages.=  remove_trash($field['field_name']).': {
						required: "'.$field['error_message'].'",
						minlength: "'.__( 'Your input must consist of at least ', 'claymore' ).$field['min_length'].__( ' characters', 'claymore' ).'"
					},';
				
				}
	
			}
		}
		$rules = substr($rules,0,-1);
		$rules .= '}';
		
		$messages = substr($messages,0,-1);
		$messages .= '}';
		
		echo "<script type=\"text/javascript\">
			jQuery(function($) {	
					$('#contactForm').validate({
						errorElement: \"span\",
						".$rules.",
						".$messages."
					});
			});
		</script>";
	}
}
#-----------------------------------------------------------------
# create simple input field
#-----------------------------------------------------------------
if ( !function_exists( 'render_input_field' ) ) {
	function render_input_field($atts, $value = '') {
				
				$input_value = ($value) ? 'value="'.$value.'"' : '';
								
				$render_field = '<p>
				<label for="'.remove_trash($atts['field_name']).'">'.lambda_translate_meta($atts['field_name']).':</label>
				<input type="text" '.$input_value.' name="'.remove_trash($atts['field_name']).'" id="'.remove_trash($atts['field_name']).'" class="reginput input_full"></p>';
				
				echo $render_field;
	}
}
#-----------------------------------------------------------------
# create email field
#-----------------------------------------------------------------
if ( !function_exists( 'render_email_field' ) ) {
	function render_email_field($atts, $value = '') {
				
				$input_value = ($value) ? 'value="'.$value.'"' : '';
	
				$render_field = '<p>
				<label for="'.remove_trash($atts['field_name']).'">'.lambda_translate_meta($atts['field_name']).':</label>
				<input type="text" '.$input_value.' name="'.remove_trash($atts['field_name']).'" id="'.remove_trash($atts['field_name']).'" class="reginput input_full"></p>';
							
				echo $render_field;
	}
}
#-----------------------------------------------------------------
# create textarea
#-----------------------------------------------------------------
if ( !function_exists( 'render_textarea' ) ) {
	function render_textarea($atts, $value = '') {
				
				$input_value = ($value) ? 'value="'.$value.'"' : '';
				
				$error_atts = (isset($atts['is_required'])) ? 'data-rule="maxlen:'.$atts['min_length'].'" data-msg="'.$atts['error_message'].'"' : '';			
				
				$render_field = '
				<label for="'.$atts['field_name'].'">'.lambda_translate_meta($atts['field_name']).':</label>
				<p><textarea class="input_full" name="'.$atts['field_name'].'" id="'.$atts['field_name'].'" '.$error_atts.'>'.$input_value.'</textarea><div class="valmsg"></div></p>';
				
				echo $render_field;
	}
}
#-----------------------------------------------------------------
# create radio buttons
#-----------------------------------------------------------------
if ( !function_exists( 'render_radio' ) ) {
	function render_radio($atts, $formdata = '') {
				$values = explode(";", $atts['values']);
				$render_field .= '<fieldset class="row"><legend style="display:block;">'.lambda_translate_meta($atts['field_name']).'</legend>';
				if(is_array($values)) {
					
					foreach($values as $singe_value) {
						
						//reset select value
						$checked = '';
						
						if($formdata == $singe_value) {
							$checked = 'checked="checked"';
						}
						
						$render_field .= '<input name="'.remove_trash($atts['field_name']).'" type="radio" '.$checked.' value="'.remove_trash($singe_value).'" id="'.remove_trash($singe_value).'" /><span class="answer">'.$singe_value.'</span>';
					
					}
				}
				$render_field .= '</fieldset>';
				echo $render_field;
	}
}
#-----------------------------------------------------------------
# create select field
#-----------------------------------------------------------------
if ( !function_exists( 'render_select' ) ) {
	function render_select($atts, $formdata = '') {
				$values = explode(";", $atts['values']);
				if(is_array($values)) {
					$render_field = '<div class="row"><label for="'.remove_trash($atts['field_name']).'">'.lambda_translate_meta($atts['field_name']).':</label><select name="'.remove_trash($atts['field_name']).'" id="'.remove_trash($atts['field_name']).'">';
					
					foreach($values as $singe_value) {
						
						//reset select value
						$selected = '';
						
						if($formdata == $singe_value) {
							$selected = 'selected="selected"'; 
						}
						
						$render_field .= '<option '.$selected.'  value="'.$singe_value.'">'.$singe_value.'</option>';
						
					}
					
					$render_field .= '</select></div>';
				}
				echo $render_field;
	}
}
#-----------------------------------------------------------------
# create checkbox
#-----------------------------------------------------------------
if ( !function_exists( 'render_checkbox' ) ) {
	function render_checkbox($atts, $formdata = '') {
				
				$values = explode(";", $atts['values']);
				$render_field = '<fieldset class="row"><legend style="display:block;">'.lambda_translate_meta($atts['field_name']).'</legend>';
				
				if(is_array($values)) {
					foreach($values as $singe_value) {
						//reset checked
						$checked = '';
						
						//check if value has been fullfilled before!
						if(is_array($formdata) && in_array(remove_trash($singe_value), $formdata)) {
							$checked = 'checked="checked"';
						} 
						
						$render_field .= '<input name="'.remove_trash($atts['field_name']).'[]" type="checkbox" '.$checked.' id="'.remove_trash($singe_value).'" value="'.remove_trash($singe_value).'" /><span class="answer">'.$singe_value.'</span>';
					}
				}
				
				$render_field .= '</fieldset>';
				echo $render_field;
	
	}
}
#-----------------------------------------------------------------
# this function is elementary important to keep the form JavaScript running
#-----------------------------------------------------------------
if ( !function_exists( 'remove_trash' ) ) {
	function remove_trash($cleanmeup){
		$newValue = preg_replace('@[\.,\+\\\\/*-;:<>\?!\[\] ()&%$]@', '', $cleanmeup);
		return $newValue;
	}
}
#-----------------------------------------------------------------
# create QuickContactForm with PHP Validation
#-----------------------------------------------------------------
if ( !function_exists( 'quickcontact' ) ) {
	function quickcontact() {
		
		global $hasError, $nameError, $emailError, $commentError; ?>
		 
		 <form action="<?php the_permalink(); ?>" id="quickcontact" method="post">
			<p>
				<label for="contactName"><small>Name:</small></label>
				<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>"  />
				<?php if($nameError != '') { ?>
					<br /><span class="error"><?php echo $nameError; ?></span>
				<?php } ?>
			</p>
			<p>
				<label for="contactemail"><small>Email</small></label>
				<input type="text" name="contactemail" id="contactemail" value="<?php if(isset($_POST['contactemail']))  echo $_POST['contactemail'];?>" />
				<?php if($emailError != '') { ?>
					<br /><span class="error"><?php echo $emailError; ?></span>
				<?php } ?>
			</p>
			<p>
				<label for="commentsText"><small>Message:</small></label>
				<textarea name="comments" id="commentsText"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
				<?php if($commentError != '') { ?>
					<br /><span class="error"><?php echo $commentError; ?></span>
				<?php } ?>
			</p>
			<p>
				<input type="hidden" name="submitted_top" id="submitted_top" value="true" />
				<input type="submit" value="<?php _e('Send email', 'claymore'); ?>">
			</p>
		</form>
	
	<?php } 
}
?>