<?php

#-----------------------------------------------------------------
# Lambda Shortcode Generator
#-----------------------------------------------------------------

//Split path to locate wordpress root!
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

// Access to WordPress
require_once( $path_to_wp . '/wp-load.php' );
$themepath = get_template_directory_uri();

//Get the Shortcodes Definitions!
require_once( 'lambda.sc.definitions.php' );

function lambda_get_option_element( $name, $attr_opt, $type, $code ){

	switch( $attr_opt['type'] ){
	case 'radio':
	    
		$return .= '<p><strong>'.$attr_opt['title'].': </strong></p>';
	    foreach( $attr_opt['opt'] as $val => $title ){
		 $return .= '
		    <input style="float:left; margin-right:5px;" class="attr" type="radio" data-attrname="'.$name.'" name="'.$code.'-'.$name.'" value="'.$val.'" id="sc-opt-'.$code.'-'.$name.'-'.$val.'"'.($val==$attr_opt['def']?' checked="checked"':'').'>
			<label style="float:left;" for="sc-opt-'.$code.'-'.$name.'-'.$val.'">'.$title.'</label>			
			<div class="clear"></div>';
	    }
		
	    break;
	
	case 'select':
		
		$return .= '<label for="'.$name.'"><strong>'.$attr_opt['title'].': </strong></label><br /><select id="'.$name.'">';
			$values = $attr_opt['values'];
			foreach( $values as $value ){
		    	$return .= '<option value="'.$value.'">'.$value.'</option>';
			}
		$return .= '</select>';
		
		break;
		
	case 'custom':
 
		if( $name == 'item' ){
			$return .= '
			<label><strong>'.__('Manage Items', 'claymore' ).'</strong></label><br />
			<div class="sc-list-items" id="options-item" data-name="item" data-type="s">
				<div class="sc-lister"><p><input class="sc-list-item" type="text" name="" value="Title" /><textarea class="sc-list-text" type="text" name="" /></textarea><a href="#" class="button remove-list-item">-</a></p></div>
			</div>
			<a href="#" class="btn btn-success add-list-item">'.__('Add Item', 'claymore' ).'</a><div class="clear"></div>';
			
		} elseif( $type == 'c' ){
		
			$return .= '<label for="'.$code.'-lastcolumn"><strong>Last column</strong></label><input type="checkbox" class="lastcolumn" id="'.$code.'-lastcolumn" />';
	    
		} elseif( $name == 'customname' ){
		
			$return .= '<input type="text" id="custom-box-name">';
			
	    }
		break;
		
	CASE 'text':
	DEFAULT:
	    $return .= '
		<label for="sc-opt-'.$name.'"><strong>'.$attr_opt['title'].': </strong></label><br />
		<input class="attr" type="text" data-attrname="'.$name.'" value="'.$attr_opt['def'].'" />';
	    break;
    }
	
    if( isset($attr_opt['desc']) && !empty($attr_opt['desc']) )
	$return .= '<p class="description">'.$attr_opt['desc'].'</p>';
    else
	$return .= '<br />';
    
    return $return;
}
#-----------------------------------------------------------------
# Create Shortcode Select Field
#-----------------------------------------------------------------
$shortcodes = $lambda_shortcodes;

//internal counter for headlines
$counter = 1;

//start select output
$htmlselect = '<div id="shortcode-generator">
    					
						<div class="lambda-opttitle">
							<div class="lambda-opttitle-pad">'.__('Lambda Shortcode Generator', 'claymore' ).'</div>
						</div>
						
						<div class="shortcode-content lambda-settings-pad">						
	   					<select id="lambda-shortcodes">
							<option value="">'.__('Choose a Shortcode', 'claymore' ).'</option>';
							
							//Loop through Shortcode definitions
							foreach( $shortcodes as $code => $options ){
								
								if($code == 'headline_'.$counter) {
									//Select Headlines
									$htmlselect .= '<option class="disabled" value="'.$options['title'].'" disabled="disabled">'.$options['title'].'</option>';
									$counter++;
								} else {
								
								$htmlselect .= '<option value="'.$code.'" data-clabel="'.$options['clabel'].'">'.$options['title'].'</option>';
								$htmloptions .= '<div class="sc-options" id="options-'.$code.'" style="display:none;" data-name="'.$code.'" data-type="'.$options['type'].'">';
								
								if( isset($options['attr']) ){
									 foreach( $options['attr'] as $name => $attr_opt ){
										$htmloptions .= '<br />'.lambda_get_option_element( $name, $attr_opt, $options['type'], $code );
									 }
								}
								$htmloptions .= '</div>'; }//endif
							} //endforeach

$htmlselect .= '</select></div>'; //end select output ?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _e('Shortcode Generator', 'claymore' ); ?></title>
	<link rel="stylesheet" href="<?php echo $themepath; ?>/lambda/assets/css/lambda.ui.css" />
	<script type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/jquery/jquery-migrate.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>

<style>
.remove-list-item {
    bottom: -8px;
    display: inline-block;
    height: 16px;
    position: absolute;
    right: -8px;
    text-indent: -999px;
    width: 16px;
	background: url(<?php echo $themepath; ?>/lambda/tinymce/icons/delete.png) no-repeat;
}
</style>

<script type="text/javascript">

jQuery(document).ready(function($){

    var editor = tinyMCE.activeEditor;
    var content = editor.selection.getContent();
		
    $('#sc-content textarea').val( content );
    
   	preview_shortcode();

    $('#insert-shortcode').click(function(){
		tinyMCEPopup.execCommand('mceReplaceContent', false, $('#shortcode-preview-o').text() + $('#shortcode-preview-m').text() + $('#shortcode-preview-c').text());
		// Return
		tinyMCEPopup.close();
		return false;
		
    });

    $( '#lambda-shortcodes' ).change(function(){
		$( '.sc-options' ).hide();
		$( '#options-'+$(this).val() ).show();

		var datatype = $('#options-'+$(this).val()).attr('data-type');
			if( datatype == 'e' || datatype == 'c' ){
	    		$('#sc-content').show().find('textarea').val( content );
	    	if($(this).children('option:selected').attr('data-clabel')!='' )
				$('#clabel').html( $(this).children('option:selected').attr('data-clabel')+':' );
	    	else
				$('#clabel').html( 'Content:' );
			} else {
	    	$('#sc-content textarea').val('').parent().hide();
		}
		preview_shortcode();
    });

    $('#sc-content textarea').keyup(function(){
		preview_shortcode();
    });
	
	$('#sc-content textarea').bind('input propertychange', function(){ 
		preview_shortcode();
	})

    $('.sc-options input.attr').live('keyup click', function(){
		preview_shortcode();
    });
	

    $('#options-box input[type="radio"]').click(function(){
	$this=$(this);
	if( $this.val()=='custom' ){
	    $('#custom-box-name').attr('data-attrname','style').addClass('attr');
	    $('#options-box input[type="radio"]').attr('data-attrname','temp').removeClass('attr');
	}else{
	    $('#options-box input[type="radio"]').attr('data-attrname','style').addClass('attr');
	    $('#custom-box-name').attr('data-attrname','temp').removeClass('attr');
	}
		preview_shortcode();
    });
 
    $('.add-list-item').click(function(){
		$(this).prevAll('div').append( '<div class="sc-lister"><input class="sc-list-item" type="text" name="" /><textarea class="sc-list-text" type="text" name="" /></textarea><a href="#" class="button remove-list-item">-</a></div>' );
		return false;
    });
	
    $('.remove-list-item').live('click', function(){
	
	$(this).parent().remove();
		list_items_code();
		return false;
    });
	
    $('.sc-list-item').live('keyup', function(){
		list_items_code();
    });
	
	$('.sc-list-text').live('keyup', function(){
		list_items_code();
    });
	
	$(".sc-lister textarea").live("input propertychange", function(){ 
		list_items_code();
	});
   
    $('.video-id').keyup(function(){
		$('#shortcode-preview-m').html( $(this).val() );
    });
	
    $('.icon-number').change(function(){
		preview_shortcode( $(this).val() );
    });
	
    $('.head-number').change(function(){
		preview_shortcode( $(this).val() );
    });
	
    $('.lastcolumn').click(function(){
	if( $(this).attr('checked')=='checked' )
	    preview_shortcode( '_last' );
	else
	    preview_shortcode();
    });

    $('.cp, .color').live('click',function(){
	$this=$(this);
	$this.ColorPicker({
	    color: '#FF0000',
	    onBeforeShow: function(){ elID = this; },
	    onShow: function (colpkr) { $(colpkr).show().css( 'z-index', $('#TB_window').css('z-index')+1 ); return false; },
	    onHide: function (colpkr) { $(colpkr).hide(); },
	    onChange: function (hsb, hex, rgb) {
		$(elID).parents('.option').find('.cp').css('backgroundColor', '#'+hex);
		$(elID).parents('.option').find('input').val('#'+hex.toUpperCase());
		preview_shortcode();
	    }
	}).live('keyup',function(){
	    $this = $(this);
	    if( $this.hasClass('color') )
		$this.ColorPickerSetColor( $this.val().replace('#','') ).parents('.option').find('.cp').css( 'background-color', $this.val() );
	}).css('z-index','999999').click();
   });

   
   
   function list_items_code(){
	   
	   	var code = '';
	   	var tabid = '1';
	
		$('.sc-list-item').each(function(){
	   	if( $(this).val() != '' ) {
				var tabcontent = $(this).next('.sc-list-text').val();
				code += ' [tab title="'+$(this).val()+'" id="t'+tabid+'"] '+tabcontent+' [/tab] '; 
				tabid++;
			}
		});
		$('#shortcode-preview-m').html( code );
	}
	
	
	
	
	
    function preview_shortcode( add ){
	
	name = $('#lambda-shortcodes').val();
	add=add||'';
	if((name=='num'||name=='h') && add=='') add='1';

	var code = ' ['+name;
	if( $('#options-'+name).attr('data-type')=='c' ){
	    if( $('#options-'+name+' input.lastcolumn').attr('checked') == 'checked' )
		add = '_last';
	}
	code += add;
	$('#options-'+name+' input.attr').each(function(){
	    $this = $(this);
	    switch( $this.attr('type') ){
		case 'text':
		    code += ' '+$this.attr('data-attrname')+'="'+$this.val()+'"';
		    break;
		case 'radio':
		case 'checkbox':
		    if( $this.attr('checked')=='checked' )
			code += ' '+$this.attr('data-attrname')+'="'+$this.val()+'"';
		    break;
	    }
	});
	code += '] ';

	datatype=$('#options-'+name).attr('data-type');
	if( datatype=='s' ){
	    $('#shortcode-preview-m').html( '' );
	}else{
	    if( datatype!='m' )
		$('#shortcode-preview-m').text(  $('#sc-content textarea').val() );
	}
	$('#shortcode-preview-o').html( code );
	if( $('#options-'+name).attr('data-type') != 's' )
	    $('#shortcode-preview-c').html( ' [/'+name+add+'] ' );
	else
	    $('#shortcode-preview-c').html( '' );

	if(name=='button')
	    $('#sg-result').show().html('<style type="text/css">#previewbutton { color: '+$('#colorpicker-text').val()+' !important; background-color: '+$('#colorpicker-background').val()+' !important; border:0; border-right:2px solid '+$('#colorpicker-border').val()+' !important; }#previewbutton:hover { color: '+$('#colorpicker-text_h').val()+' !important; background-color: '+$('#colorpicker-background_h').val()+' !important; border-color: '+$('#colorpicker-border_h').val()+' !important; }</style><input id="previewbutton" type="button" value="'+$('#sc-content textarea').val()+'" style="'+$('input[data-attrname="css"]').val()+'" /><br />');
	else
	    $('#sg-result').hide();

    }
});
</script>

</head>
<body>
<div class="bootstrap-wpadmin">

<?php echo $htmlselect; ?>

<div class="lambda-opttitle">
	<div class="lambda-opttitle-pad"><?php _e('Shortcode', 'claymore' ); ?></div>
</div>
						
<div class="lambda-settings-pad">

	<?php echo $htmloptions; ?>

		<div id="sc-content" style="display:none;"><br />
			<label id="clabel" for="sc-content"></label><br />
			<textarea id="" style="width:250px; height:100px;"></textarea>
		
			<div class="hr"></div>
		</div>
	
		<span id="sg-result"></span>
		<code class="shortcode_prev"><span id="shortcode-preview-o" style=""></span><span id="shortcode-preview-m"></span><span id="shortcode-preview-c" style=""></span></code>
    
</div>

<input class="btn btn-success" id="insert-shortcode" value="<?php _e( 'Insert Shortcode', 'claymore' ); ?>" type="button">
<div class="clear"></div>

</div><!-- /#shortcode-content -->
</div>
</body>
</html>