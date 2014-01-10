;(function ($) {	

	var LAMBDA_metabox = {
 
	/*-----------------------------------------------------------------------------------*/
	/* Launch tinyMCE, handle tinyMCE on repeating fields
	/*-----------------------------------------------------------------------------------*/

	tinyMCE: function() { 
		
		//run our tinyMCE script on textareas at load
		LAMBDA_metabox.runTinyMCE();
		
		//create a div to bind to
		if ( ! $.wpalchemy ) {
			$.wpalchemy = $('<div/>').attr('id','wpalchemy').appendTo('body');
		};
		
		//run our tinyMCE script on textareas when copy is made
		$(document.body).on('wpa_copy', $.wpalchemy, function() { 		
			LAMBDA_metabox.runTinyMCE();
		});
	},
	
	/*-----------------------------------------------------------------------------------*/
	/* Repeatable TinyMCE-enhanced textareas
	/*-----------------------------------------------------------------------------------*/

	runTinyMCE: function() {
				// some settings for a more minimal tinyMCE editor
				tinyMCEminConfig = {
				theme : "advanced",
				skin:"wp_theme",
				mode : "none",
				language : "en",
				theme_advanced_resizing:"1",
				width:"100%",
				height : "150",
				theme_advanced_layout_manager : "SimpleLayout",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_buttons1:"styleselect,formatselect,bold,italic,strikethrough,underline,|,link,unlink,|,forecolor,|undo,redo,|,code",
				theme_advanced_buttons2: "",
				theme_advanced_buttons3: "themecolor,scgenerator,lambda_buttons,lambda_tables,lambda_sliders, | ,lambda_vimeo, lambda_youtube",
				theme_advanced_statusbar_location:"",
				plugins:"safari,inlinepopups,spellchecker,paste,wordpress,tabfocus",
				width : "540"
				};
				
				//store the default settings
				try {
					tinyMCEdefaultConfig = $.extend(true, {}, tinyMCE.settings);
				
					//tweak the setting just a litte to set the height and to add an HTML code button (since toggling editors is crazy difficult)
					tinyMCEdefaultConfig.height = "150";
					tinyMCEdefaultConfig.wpautop = false;
					tinyMCEdefaultConfig.theme_advanced_buttons1 = tinyMCEdefaultConfig.theme_advanced_buttons1 + ',|,code';
					tinyMCEdefaultConfig.theme_advanced_buttons3 = tinyMCEminConfig.theme_advanced_buttons3;

				} catch(e) {
					
					tinyMCEdefaultConfig = tinyMCEminConfig;
					
				}
						
			//all custom text areas, except the one to copy
			textareas = $('div.wpa_group:not(.tocopy) .customEditor textarea'); 
			
			//count the number of textareas
			var count = textareas.length;
			
			//give each a unique ID so we can apply TinyMCE to each 
			textareas.each(function(i) {  
				var id = $(this).attr('id');
				if (!id) {
					id = 'customEditor-' + ( i + count ); //doesn't quite count in order, but does always get a unique id#
					$(this).attr('id', id);
				}  
											
				try { 

					//if the customEditor div has the minimal class, serve up the minimal tinyMCE configuration
					if($(this).parent().hasClass('minimal')){
						tinyMCE.settings = tinyMCEminConfig;	
					} else {
						tinyMCE.settings = tinyMCEdefaultConfig;
					}

					tinyMCE.execCommand('mceAddControl', false, id); 
				} catch(e){}
			
			});  //end each
		
		 
		
	} , //end runTinyMCE text areas 
	
/*-----------------------------------------------------------------------------------*/
/* Custom Media Upload Buttons for tinyMCE textareas
/*-----------------------------------------------------------------------------------*/

	mediaButtons: function() {
	
			$('body').on('click','.custom_upload_buttons a',function(){  
				textarea = $(this).closest('.customEditor').find('textarea');   
				mceID = textarea.attr('id');  
				kia_backup = window.send_to_editor; // backup the original 'send_to_editor' function
				window.send_to_editor = window.send_to_editor_clone;
			});
			
			//borrow the send to editor function
			window.send_to_editor_clone = function(html){

				try {
					tinyMCE.execInstanceCommand(mceID, 'mceInsertContent', false, html);
				} catch(e) {
						$(textarea).insertAtCaret(html); 
				}

				tb_remove();
							
				// restore the default behavior
				window.send_to_editor = kia_backup;
			}
			
	}, //end mediaButtons			

/*-----------------------------------------------------------------------------------*/
/* Meta Fields Sorting
/*-----------------------------------------------------------------------------------*/

	sortable: function(){

		var textareaID;
		$('#wpa_loop-lambda_page_item').sortable({
			//cancel: ':input,button,.customEditor', // exclude TinyMCE area from the sort handle
			handle: '.ui-widget-header',
			placeholder: "ui-state-highlight",
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
				
		$('#wpa_loop-claymore_verticaltabs').sortable({
			//cancel: ':input,button,.customEditor', // exclude TinyMCE area from the sort handle
			handle: '.testimonial_item_name',
			placeholder: "verticaltabs_highlight",
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_home_verticaltabs').sortable({
			//cancel: ':input,button,.customEditor', // exclude TinyMCE area from the sort handle
			handle: '.testimonial_item_name',
			placeholder: "verticaltabs_highlight",
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_home_items').sortable({
			placeholder: "home_item_order_placeholder",
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_home_testimonials').sortable({
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_testimonial_items').sortable({
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_team_member').sortable({
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_contact_form_fields').sortable({
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_faq_items').sortable({
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_project_atts').sortable({
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
		$('#wpa_loop-claymore_portfolio_images').sortable({
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                ui.placeholder.height(ui.item.height());
                ui.placeholder.width(ui.item.width());
				textareaID = $(ui.item).find('.customEditor textarea').attr('id');
				try { tinyMCE.execCommand('mceRemoveControl', false, textareaID); } catch(e){}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				try { tinyMCE.execCommand('mceAddControl', false, textareaID); } catch(e){}
				$(this).find('.update-warning').show();
			}
		});
		
	}, //end of sortable
	
	}; // End LAMBDA_metabox Object // Don't remove this, or the sky will fall on your head.

 /*-----------------------------------------------------------------------------------*/
/* Execute the above methods in the LAMBDA_metabox object.
/*-----------------------------------------------------------------------------------*/
  
	$(document).ready(function () {
		
		LAMBDA_metabox.tinyMCE();
		LAMBDA_metabox.mediaButtons();
		LAMBDA_metabox.sortable();
				
		var ctmce= $('#content-tmce');
		
		$("#save-post, #publish, #adminmenuwrap, #update").click(function() { 
			switchEditors.switchto(ctmce[0]);
			$("#wpa_loop-lambda_page_item").find('.tocopy').remove();			 
		});
			
	});
  
})(jQuery);



// jQuery insertAtCaret plugin
// http://stackoverflow.com/questions/946534/insert-text-into-textarea-with-jquery#answer-2819568
jQuery.fn.extend({
insertAtCaret: function(myValue){
  return this.each(function(i) {
    if (document.selection) {
      //For browsers like Internet Explorer
      this.focus();
      sel = document.selection.createRange();
      sel.text = myValue;
      this.focus();
    }
    else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = startPos + myValue.length;
      this.scrollTop = scrollTop;
    } else {
      this.value += myValue;
      this.focus();
    }
  })
}
});


jQuery(document).ready(function($){
  
  $(document).on("click", ".upload-button", function(event){	
      
    event.preventDefault();
    
     // If the media frame already exists, reopen it.
    if ( frame ) {
        frame.open();
        return;
    }
    
    var button = $(this);    
    var input = button.siblings('input:text').first();
    var frame = wp.media( {
        title       : button.data( 'uploader_title' ),
        multiple    : false,
        library     : { type : button.data( 'limit_type' )},
        button      : { text : button.data( 'uploader_button_text' ) }
    } );

    frame.on( 'select', function() {
        var attachment = frame.state().get( 'selection' ).first().toJSON();
        $(input).val(attachment.url);
    } );

    frame.open();
    return false;
    
  });
  
});