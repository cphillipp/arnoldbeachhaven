<?php
#-----------------------------------------------------------------
# override default filter for 'textarea' sanitization.
#----------------------------------------------------------------- 
if(!function_exists('optionscheck_change_santiziation')) { 
    
    add_action('admin_init','optionscheck_change_santiziation', 100);
    
    function optionscheck_change_santiziation() {
        
        remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
        add_filter( 'of_sanitize_textarea', 'lambda_custom_sanitize_textarea' );
        
    }
    
}

if(!function_exists('lambda_custom_sanitize_textarea')) {
    
    function lambda_custom_sanitize_textarea($input) {
        
        global $allowedposttags;
        
        $custom_allowedtags["embed"] = array(
            "src"               => array(),
            "type"              => array(),
            "allowfullscreen"   => array(),
            "allowscriptaccess" => array(),
            "height"            => array(),
            "width"             => array()
        );
        
        $custom_allowedtags["script"] = array();
        $custom_allowedtags["a"] = array('href' => array(),'title' => array());
        $custom_allowedtags["img"] = array('src' => array(),'title' => array(),'alt' => array());
        $custom_allowedtags["br"] = array();
        $custom_allowedtags["em"] = array();
        $custom_allowedtags["strong"] = array();
        $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
        $output = wp_kses( $input, $custom_allowedtags);
        return $output;
    }
    
}

#-----------------------------------------------------------------
# Sanitize Data for Tablemaner / Slidermanager
#-----------------------------------------------------------------
if(!function_exists('lambda_prepare_input')) {

    function lambda_prepare_input( $input ) {
        
        return htmlspecialchars($input);
    
    }
    
}

if(!function_exists('lambda_prepare_out')) {
    
    function lambda_prepare_out( $input ) {
        
        $input = htmlspecialchars_decode( $input );        
        return stripslashes( $input );
    
    }
    
}

if(!function_exists('lambda_loop_multi_array')) {

    function lambda_loop_multi_array( $func , $arr ) {
        
        $newArr = array();
        
        if ( !empty($arr) ) {
            foreach($arr AS $key => $value) {
                $newArr[$key] = ( is_array( $value ) ? lambda_loop_multi_array( $func , $value ) : $func( $value ));
            }
        }
        
        return $newArr;
        
    } 
    
}
	
if(!function_exists('lambda_prepare_save')) {
	
	function lambda_prepare_save( $content ) {		
        
        $content = lambda_loop_multi_array('lambda_prepare_input' , $content);
        $content = serialize(  $content );
		
        return $content;
				
	}
	
}

if(!function_exists('lambda_prepare_load')) {
	
	function lambda_prepare_load( $content ) {		
        
        $content = maybe_unserialize( $content );                
        $content = lambda_loop_multi_array('lambda_prepare_out' , $content);        
		        
        return $content;
				
	}
	
}
?>