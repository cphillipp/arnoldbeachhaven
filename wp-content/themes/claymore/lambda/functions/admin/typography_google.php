<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Typography Google Option
 *
 * @access public
 * @since lambda 1.0
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function option_tree_typography_google( $value, $settings, $int ) { ?>
  <?php
  
  global $webfonts;
  
  $googlefonts = recognized_google_fonts();
  
  //echo "<pre>";
  //print_r($googlefonts);
  //echo "</pre>"; 
    
  ?>
  
  <div class="option option-font" id="<?php echo $value->item_id; ?>_div">
    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
		<?php echo htmlspecialchars_decode( $value->item_title ); ?>
		<span class="infoButton right">
				<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" width="40px" height="20px" alt="Info" style="left: 0px;">
		</span>  
        </div>
    </div>   <div class="section">
      <div class="element">
      
        <div class="select_googlefont">
        <script>
			jQuery(document).ready(function($) {			
				
				(function($){

				  $.fn.fontselect = function(options) {  
				
					 options = $.extend({
							style: 'font-select',
							placeholder: 'Select a font',
							lookahead: 2,
							api: 'http://fonts.googleapis.com/css?family='
					}, options);
				 
					 var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };
				
					 var fonts = [
					 
					 <?php 
					 
					 $totalfonts = count($googlefonts->items);
					 
					 $fontcount = 1;
					 foreach($googlefonts->items as $font) {
  						
						$comma = ($fontcount != $totalfonts) ? ',' : '';
						
						echo '"'.$font->family.'"'.$comma;
					  	
					 $fontcount++; 
					 
					 }
					 
					 ?>
					 
					 ];
				
				  var Fontselect = (function(){
					
					  function Fontselect(original, o){
						this.$original = $(original);
						this.options = o;
						this.active = false;
						this.setupHtml();
						this.getVisibleFonts();
						this.bindEvents();
					  }
					  
					  Fontselect.prototype.bindEvents = function(){
					  
						$('li', this.$results)
						.click(__bind(this.selectFont, this))
						.mouseenter(__bind(this.activateFont, this))
						.mouseleave(__bind(this.deactivateFont, this));
						
						$('span', this.$select).click(__bind(this.toggleDrop, this));
						this.$arrow.click(__bind(this.toggleDrop, this));
					  }
					  
					  Fontselect.prototype.toggleDrop = function(ev){
						
						if(this.active){
						  this.$element.removeClass('font-select-active');
						  this.$drop.hide();
						  clearInterval(this.visibleInterval);
						  
						} else {
						  this.$element.addClass('font-select-active');
						  this.$drop.show();
						  this.moveToSelected();
						  this.visibleInterval = setInterval(__bind(this.getVisibleFonts, this), 500);
						}
						
						this.active = !this.active;
					  }
					  
					  Fontselect.prototype.selectFont = function(){
						
						var font = $('li.active', this.$results).data('value');
						this.$original.val(font).change();
						this.updateSelected();
						this.toggleDrop();
					  }
					  
					  Fontselect.prototype.moveToSelected = function(){
						
						var $li, font = this.$original.val();
						
						if (font){
						  $li = $("li[data-value='"+ font +"']", this.$results);
						} else {
						  $li = $("li", this.$results).first();
						}
				
						this.$results.scrollTop($li.addClass('active').position().top);
					  }
					  
					  Fontselect.prototype.activateFont = function(ev){
						$('li.active', this.$results).removeClass('active');
						$(ev.currentTarget).addClass('active');
					  }
					  
					  Fontselect.prototype.deactivateFont = function(ev){
						
						$(ev.currentTarget).removeClass('active');
					  }
					  
					  Fontselect.prototype.updateSelected = function(){
						
						var font = this.$original.val();
						$('span', this.$element).text(this.toReadable(font)).css(this.toStyle(font));
					  }
					  
					  Fontselect.prototype.setupHtml = function(){
					  
						this.$original.empty().hide();
						this.$element = $('<div>', {'class': this.options.style})
						this.$arrow = $('<div><b></b></div>');
						this.$select = $('<a><span>'+ this.options.placeholder +'</span></a>');
						this.$drop = $('<div>', {'class': 'fs-drop'});
						this.$results = $('<ul>', {'class': 'fs-results'});
						this.$original.after(this.$element.append(this.$select.append(this.$arrow)).append(this.$drop));
						this.$drop.append(this.$results.append(this.fontsAsHtml())).hide();
					  };
					  
					  Fontselect.prototype.fontsAsHtml = function(){
						
						var l = fonts.length;
						var r, s, h = '';
						
						for(var i=0; i<l; i++){
						  r = this.toReadable(fonts[i]);
						  s = this.toStyle(fonts[i]);
						  h += '<li data-value="'+ fonts[i] +'" style="font-family: '+s['font-family'] +'; font-weight: '+s['font-weight'] +'">'+ r +'</li>';
						}
						
						return h;
					  };
					  
					  Fontselect.prototype.toReadable = function(font){
						return font.replace(/[\+|:]/g, ' ');
					  };
					  
					  Fontselect.prototype.toStyle = function(font){
						var t = font.split(':');
						return {'font-family': this.toReadable(t[0]), 'font-weight': (t[1] || 400)};
					  };
					  
					  Fontselect.prototype.getVisibleFonts = function(){
					  
						if(this.$results.is(':hidden')) return;
						
						var fs = this;
						var top = this.$results.scrollTop();
						var bottom = top + this.$results.height();
						
						if(this.options.lookahead){
						  var li = $('li', this.$results).first().height();
						  bottom += li*this.options.lookahead;
						}
					   
						$('li', this.$results).each(function(){
				
						  var ft = $(this).position().top+top;
						  var fb = ft + $(this).height();
				
						  if ((fb >= top) && (ft <= bottom)){
							var font = $(this).data('value');
							fs.addFontLink(font);
						  }
						  
						});
					  };
					  
					  Fontselect.prototype.addFontLink = function(font){
					  
						var link = this.options.api + font;
					  
						if($("link[href*='" + font + "']").length === 0){
							  $('link:last').after('<link href="' + link + '" rel="stylesheet" type="text/css">');
						  }
					  };
					
					  return Fontselect;
					})();
					
				  return new Fontselect(this, options);
				
				  };
				})(jQuery);
				
				
				$('#<?php echo $value->item_id; ?>').fontselect({
					  placeholder: '<?php echo ( isset( $settings[$value->item_id]['font-family'] ) ) ? stripslashes( $settings[$value->item_id]['font-family'] ) : ''; ?>'
				});
		  	});
		</script>
          
        <input type="text" name="<?php echo $value->item_id; ?>[font-family]" id="<?php echo $value->item_id; ?>" value="<?php echo ( isset( $settings[$value->item_id]['font-family'] ) ) ? stripslashes( $settings[$value->item_id]['font-family'] ) : ''; ?>" class="cp_input" />        
        </div>
        
      </div>
      <?php if($value->item_desc) { ?> <?php if($value->item_desc) { ?>
         <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
		 <div class="clear"></div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
<?php
}