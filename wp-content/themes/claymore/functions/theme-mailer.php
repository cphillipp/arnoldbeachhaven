<?php
global $lambda_meta_data, $emailSent, $captcha_error;
$contactelements = $lambda_meta_data->the_meta();

#-----------------------------------------------------------------
# Main Contact Form
#-----------------------------------------------------------------
if(isset($_POST['submitted'])) {

  if(get_option_tree('google_recaptcha')) {
  
  require_once('recaptchalib.php');
  $privatekey = get_option_tree('private_key');
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
  }
  
  if (!$resp->is_valid && get_option_tree('google_recaptcha')) {
    // What happens when the CAPTCHA was entered incorrectly
	$captcha_error = $resp->error;
  
  
  #-----------------------------------------------------------------
  # Everything has been fullfilled - Give it a go!
  #-----------------------------------------------------------------
  } else {
	
	//request email recipient
	$emailTo = $contactelements['email_to'];
	if (!isset($emailTo) || ($emailTo == '') ){
		$emailTo = get_option('admin_email');
	}
				
	//create message body
	$body = '';
	if(is_array($_POST)) {
		foreach($_POST as $celement => $value) {
		
			if(!is_array($value)) {
				
				$value = clearPostData($value);	
				if($celement != 'recaptcha_challenge_field' && $celement != 'recaptcha_response_field' && $celement != 'submitted') {		
					$body.= $celement." : ".$value."\n\n";
				}
				
			} else {
				
				foreach($value as $singevalue) {
					
					$singevalue = clearPostData($singevalue);			

					if($celement != 'recaptcha_challenge_field' && $celement != 'recaptcha_response_field' && $celement != 'submitted') {		
						$body.= $celement." : ".$singevalue."\n\n";	
					}
					
				} //endforeach
				
			} //endif		
		
		} //endforeach
				
	} //endif		
					
	// Build Message
	$subject = $contactelements['email_subject'].__(' From ', 'claymore').get_bloginfo( 'name' );
	$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
	
	wp_mail($emailTo, $subject, $body, $headers);
	$emailSent = true;
	}
}

//check post data and clear it up!
function clearPostData($postdata) {
	$postdata = stripslashes($postdata);
	$postdata = strip_tags($postdata);
	$postdata = trim($postdata);
	return $postdata;
}
?>