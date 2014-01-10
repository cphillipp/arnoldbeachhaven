<?php

function lambda_regx_removal($buffer) { 
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}

#-----------------------------------------------------------------
# Custom CSS Stuff
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_custom_css' ) ) {

	function lambda_custom_css() {
		
		global $lambda_meta_data, $slider_meta_data;
		
		/*
		 * need variables and arrays
		 */
		 
		$theme_path = get_template_directory_uri();
		$theme_options = get_option('option_tree');
		$color_scheme = $theme_options['color_scheme'];
							
		$wocommerce = false;
		
		if( function_exists('is_shop') ) {
			$wocommerce = ( is_shop() ) ? true : false;
		}
		
				
		if( lambda_is_blog_related() ) {
				
			$homeid = get_option('page_for_posts');  
			$pagemetadata = get_post_meta($homeid, $lambda_meta_data->get_the_id(), TRUE);
			$slidermetadata = get_post_meta($homeid, $slider_meta_data->get_the_id(), TRUE);	
				
		} elseif( $wocommerce ) {
			
			$shopid = get_option('woocommerce_shop_page_id'); 
			$pagemetadata = get_post_meta($shopid, $lambda_meta_data->get_the_id(), TRUE);
			$slidermetadata = get_post_meta($shopid, $lambda_meta_data->get_the_id(), TRUE);
			
		
		} else {
			
			$pagemetadata =	$lambda_meta_data->the_meta();
			$slidermetadata = $slider_meta_data->the_meta();		
		}
		
		
		#-----------------------------------------------------------------
		# Color Helper Functions
		#-----------------------------------------------------------------
		function HexToRGB($hex) {
			
			$hex = preg_replace("/#/", "", $hex);
			$color = array();
		 
			if(strlen($hex) == 3) {
				$color['r'] = hexdec(substr($hex, 0, 1) . $r);
				$color['g'] = hexdec(substr($hex, 1, 1) . $g);
				$color['b'] = hexdec(substr($hex, 2, 1) . $b);
			}
			else if(strlen($hex) == 6) {
				$color['r'] = hexdec(substr($hex, 0, 2));
				$color['g'] = hexdec(substr($hex, 2, 2));
				$color['b'] = hexdec(substr($hex, 4, 2));
			}
			
			$color = implode(',', $color);
			
			return $color;
		}
		 
		function RGBToHex($r, $g, $b) {
			$hex = "#";
			$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
			$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
			$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
		 	
			return $hex;
		}
		
		
					
		/*
		 * generate CSS
		 */
		$finalcss = '<style type="text/css">';
				
		#-----------------------------------------------------------------
		# Custom CSS
		#----------------------------------------------------------------- 
		$themecolor = $theme_options['color_scheme'];
		$themecolor = preg_replace("/#/", "", $themecolor);
		$themefiles = recognized_color_themefiles();
				
		if( !isset($themefiles[$themecolor]) ) {
		
			
			$finalcss .= '
			#navigation ul li:hover a {
				color:'.$theme_options['navigation_hover'].';
			}
			#navigation ul li.active a {
				color:'.$theme_options['navigation_hover'].';
			}
			
			#navigation ul > li ul li ul li.active > a,
			#navigation ul > li ul li.active > a {
				background:#FFFFFF;
				color:'.$theme_options['navigation_hover'].';
			}			
			
			/* Submenu */
			#navigation ul.sub-menu {
				-webkit-box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.2);
				-moz-box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.2);
				-ms-box-shadow:0px 0px 2px rgba(0, 0, 0, 0.2);
				-o-box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.2);
				box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.2);
				background-color: rgb('.$theme_options['drop_down_background_color'].');
				background:rgba('.$theme_options['drop_down_background_color'].', 0.9);
				border-top:2px solid '.$color_scheme.';
			}
			
			#navigation ul li ul li.active a {
				color:'.$color_scheme.' !important;
				background-color:#FFFFFF;
			}
									
			#navigation ul li ul li:hover {
				background-color:'.$theme_options['drop_down_background_color_hover'].';
			}
			
			#navigation ul li ul li:hover a {
				color:'.$theme_options['drop_down_font_color_hover'].' !important;
			}			
			
			#navigation ul li ul li:hover ul li a {
				color: '.$theme_options['drop_down_font_color']['font-color'].' !important;
			}
			
			#navigation ul.sub-menu a:hover {
				color: '.$theme_options['drop_down_font_color_hover'].' !important;
			}		
			
			#navigation ul li ul li:hover a.sf-with-ul:after, .sub-menu .sf-with-ul:after { left: 100%; margin-left:-10px; border: solid transparent; content: " "; height: 0; width: 0; position: absolute; pointer-events: none; }
			#navigation ul li ul li:hover a.sf-with-ul:after, .sub-menu .sf-with-ul:after { border-left-color: '.$theme_options['drop_down_font_color']['font-color'].'; border-width: 4px; top: 50%; margin-top: -7px; }
						
			#navigation ul.sub-menu .current-menu-ancestor a {
				color: '.$theme_options['drop_down_font_color_hover'].' !important;
				background-color:'.$theme_options['drop_down_background_color_hover'].';
			}
						
			#navigation ul.sub-menu .current-menu-ancestor ul a {
				background-color: rgb('.$theme_options['drop_down_background_color'].');
				background:rgba('.$theme_options['drop_down_background_color'].', 0.9);
			}
						
			#navigation ul.sub-menu .current-menu-ancestor ul a:hover {
				color:'.$theme_options['drop_down_font_color_hover'].' !important;
				background-color:'.$theme_options['drop_down_background_color_hover'].';
			}
			
			#navigation ul.sub-menu .current-menu-ancestor ul li.active > a {
				color:'.$color_scheme.' !important;
				background-color:#FFFFFF;
			}	
			
			#navigation ul.sub-menu .current-menu-ancestor ul a {
				color: '.$theme_options['drop_down_font_color']['font-color'].' !important;
			}
		
		
		
		
			#sidebar a:hover,
			#sidebar_second a:hover {
				color:'.$color_scheme.' !important;
			}
			
			.home-title,
			.widget_rss a.rsswidget:hover {
				color: '.$color_scheme.';
			}
			
			.flex-control-nav li a:hover,
			.flex-control-nav li a.active,
			a.comment-reply-link:hover,
			.edit-link a:hover,
			.permalink-hover:hover,
			#slider-nav a#slider-next:hover,
			#slider-nav a#slider-prev:hover,
			.post-slider-nav a.slider-prev:hover,
			.post-slider-nav a.slider-next:hover,
			#slider-bullets a.activeSlide,
			#slider-bullets a:hover  {
				background-color:'.$color_scheme.';
			}
			
			.single-product-title:hover,
			ul.archive li a:hover,
			.author-link,
			p.search-title span, 
			p.tag-title span,
			.author-name a,
			ul.filter_portfolio a:hover,
			ul.filter_portfolio a.selected,
			#logo h1 a:hover,
			.entry-content a,
			.portfolio-info a,
			ul.archive,
			.entry-meta a:hover,
			.entry-meta-single-post a:hover,
			blockquote cite, 
			blockquote cite a, 
			blockquote cite a:visited, 
			blockquote cite a:visited,
			.quote cite,
			.entry-title a:hover,
			#teaser-content a,
			span.current,   
			.themecolor,
			a:hover,
			.tag-links a:hover,
			.h-link,
			.widget_recent_comments a{
				color:'.$color_scheme.';
			}
			
			::-moz-selection  {
				color: #FFFFFF !important;
				background:'.$color_scheme.';
			}
			::selection {
				color: #FFFFFF !important;
				background:'.$color_scheme.';
			}
			
			.entry-attachment .entry-caption,
			.gallery-caption,
			.lambda-pricingtable.featured .lambda-pricingtable-top,
			.testimonial-company {
				background:'.$color_scheme.';
			}
			
			.lambda-pricingtable.featured .lambda-pricingtable-top {
				border-top:1px solid '.$color_scheme.';
			}
			
			#vmenu li.selected:hover h3,
			#vmenu li.selected,
			.camera_wrap .camera_pag .camera_pag_ul li:hover > span,
			.camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span,
			.camera_bar_cont span,
			.link-post span,
			.lambda-dropcap2,
			.lambda-highlight1 {
				background-color:'.$color_scheme.';
			}
			
			.camera_commands,
			.camera_prev,
			.camera_next,
			.flex-direction-nav a,
			.lambda-featured-header-caption,
			.hover-overlay {
				background-color: rgb(26, 136 ,193);
				background-color:rgba(26, 136 ,193,0.8);
			}
			
			.lambda_widget_flickr .flickr_items img {
				background-color:'.$color_scheme.';
			}
			
			#footer .lambda_widget_flickr .flickr_items img {
				background-color:'.$color_scheme.';
			}
			
			#toTop {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/to-top.png");
			}
			.lambda-like {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/lambda-like.png");
			}
			ul.tabs li a.active {
				border-top:2px solid '.$color_scheme.';
			}
			
			.testimonial-entry {
				background-attachment: scroll;
				background-image: url("'.THEME_WEB_ROOT.'/images/default/blockquote.png");
				background-repeat: no-repeat;
				background-position: 44px 30px;
			}
			
			.testimonial-name span {
				color:'.$color_scheme.';
			}
			
			.more-link:hover,
			.excerpt:hover {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/excerpt-icon-hover.png");
			}
			#mobile-menu li a:hover,
			h3.trigger:hover a,
			p.trigger:hover a{
				color:'.$color_scheme.';
			}
			
			/* Up Toggle State */
			h3.trigger,
			p.trigger {
				border-bottom: 1px solid #D9D9D9;
				background-color: #FFFFFF;
				background-image: url("'.THEME_WEB_ROOT.'/images/default/toggle-open.png");
				background-repeat: no-repeat;
				background-position: left 3px;
			}
			p.trigger {
				background-position: left 1px;
			}
			
			h3.trigger.active a,
			p.trigger.active a {
				color:'.$color_scheme.';
			}
			
			
			#nav-portfolio .nav-next a:hover {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/excerpt-icon-hover.png");	
			}
			#nav-portfolio .nav-previous a:hover {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/excerpt-icon-back-hover.png");	
			}
			
			.tprev:hover{
				background-image: url("'.THEME_WEB_ROOT.'/images/default/excerpt-icon-back-hover.png");	
			}
			.tnext:hover {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/excerpt-icon-hover.png");
			}
			#mobile-menu li,
			ul.archive li,
			.widget_links li,
			.widget_nav_menu li,
			.widget_pages li,
			.widget_meta li,
			.widget_categories li,
			.widget_archive li,
			.widget_product_categories li,
			.widget_recent_entries li {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/arrow-right.gif");
				color:#333333;
			}
			.widget_recent_comments li {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/comment.png");
			}
			.widget_search #s {/* This keeps the search inputs in line */
				background-image: url("'.THEME_WEB_ROOT.'/images/default/zoom.png");
			}
			.tweet_list li {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/twitter-widget.png");
			}
			.pformat .post_format_image  {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-image.png");
			}
			.pformat .post_format_standard  {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-standard.png");
			}
			.pformat .post_format_audio {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-audio.png");
			}
			.pformat .post_format_gallery {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-gallery.png");
			}
			
			.pformat .post_format_video {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-video.png");
			}
			.pformat .post_format_link {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-link.png");
			}
			.pformat .post_format_quote {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-quote.png");
			}
			.pformat .post_format_aside {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/pformat-aside.png");
			}
			
			.lambda-address {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/contact-adress.png");
			}
			.lambda-phone {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/contact-phone.png");
			}
			.lambda-fax {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/contact-fax.png");
			}
			.lambda-email {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/contact-email.png");
			}
			.lambda-internet {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/contact-internet.png");
			}
			
			.lambda-most-liked-posts li {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/like.png");
			}
			.lambda_widget_mostlikesposts {
				color:'.$color_scheme.';
			}
			.response span{
				color:'.$color_scheme.';
			}
			.claymore-caption.dark .excerpt:hover,
			.claymore-caption.white .excerpt:hover,
			.tweet_text a,
			#sidebar .lambda_widget_recent_comments a,
			#sidebar_second .lambda_widget_recent_comments a,
			.tweet_time a:hover,
			.more-link:hover,
			.excerpt:hover {
				color:'.$color_scheme.' !important;
			}
			.portfolio-title span {
				color:#042c41;
			}
						
			.lambda-pricingtable.featured .lambda-table-button {
				-moz-box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].';
				-webkit-box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].';
				box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].';
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, '.$theme_options['tb_color_one'].'), color-stop(1, '.$theme_options['tb_color_two'].') );
				background:-moz-linear-gradient( center top, '.$theme_options['tb_color_one'].' 5%, '.$theme_options['tb_color_two'].' 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$theme_options['tb_color_one'].'\', endColorstr=\''.$theme_options['tb_color_two'].'\');
				background-color:'.$theme_options['tb_color_one'].';
				-moz-border-radius:6px;
				-webkit-border-radius:6px;
				border-radius:6px;
				border:1px solid '.$theme_options['tb_color_two'].';
				display:inline-block;
				color:'.$theme_options['tb_font_color'].' !important;
				font-family:arial;
				font-size:15px;
				font-weight:bold;
				padding:6px 24px;
				text-decoration:none;
				text-shadow:1px 1px 0px '.$theme_options['tb_color_two'].';
			}
			
			.cta-button:hover,
			.lambda-pricingtable.featured .lambda-table-button:hover {
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, '.$theme_options['tb_color_two'].'), color-stop(1, '.$theme_options['tb_color_one'].') );
				background:-moz-linear-gradient( center top, '.$theme_options['tb_color_two'].' 5%, '.$theme_options['tb_color_one'].' 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$theme_options['tb_color_two'].'\', endColorstr=\''.$theme_options['tb_color_one'].'\');
				background-color:'.$theme_options['tb_color_two'].';
			}
			
			.cta-button:active,
			.lambda-pricingtable.featured .lambda-table-button:active {
				position:relative;
				top:1px;
			}
			
			.lambda-pricingtable.featured .lambda-pricingtable-top h2 {
				text-shadow:1px 1px 0px '.$theme_options['tb_font_shadow'].';
			}
			.mm-button {
				background-image: url("'.THEME_WEB_ROOT.'/images/default/mobile-menu.png");
			}
			.cta-button {
				-moz-box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].';
				-webkit-box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].';
				box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].';
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, '.$theme_options['tb_color_one'].'), color-stop(1, '.$theme_options['tb_color_two'].') );
				background:-moz-linear-gradient( center top, '.$theme_options['tb_color_one'].' 5%, '.$theme_options['tb_color_two'].' 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$theme_options['tb_color_one'].'\', endColorstr=\''.$theme_options['tb_color_two'].'\');
				background-color:'.$theme_options['tb_color_one'].';
				-moz-border-radius:6px;
				-webkit-border-radius:6px;
				border-radius:6px;
				border:1px solid '.$theme_options['tb_color_two'].';
				display:inline-block;
				color:'.$theme_options['tb_font_color'].' !important;
				font-family:arial;
				font-size:16px;
				font-weight:normal;
				padding:10px 30px;
				text-decoration:none;
				text-shadow:1px 1px 0px '.$theme_options['tb_font_shadow'].';
				margin-left:20px;
				float:right;
				cursor:pointer;
			}
						
			.woo-button {
				-moz-box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].' !important;
				-webkit-box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].' !important;
				box-shadow:inset 0px 1px 0px 0px '.$theme_options['tb_shadow'].' !important;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, '.$theme_options['tb_color_one'].'), color-stop(1, '.$theme_options['tb_color_two'].') ) !important;
				background:-moz-linear-gradient( center top, '.$theme_options['tb_color_one'].' 5%, '.$theme_options['tb_color_two'].' 100% ) !important;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$theme_options['tb_color_one'].'\', endColorstr=\''.$theme_options['tb_color_two'].'\') !important;
				background-color:'.$theme_options['tb_color_one'].' !important;
				border:1px solid '.$theme_options['tb_color_two'].' !important;
				color:'.$theme_options['tb_font_color'].' !important;
				text-shadow:1px 1px 0px '.$theme_options['tb_color_two'].' !important;
			}
			.woo-button:hover {
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, '.$theme_options['tb_color_two'].'), color-stop(1, '.$theme_options['tb_color_one'].') ) !important;
				background:-moz-linear-gradient( center top, '.$theme_options['tb_color_two'].' 5%, '.$theme_options['tb_color_one'].' 100% ) !important;
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$theme_options['tb_color_two'].'\', endColorstr=\''.$theme_options['tb_color_one'].'\') !important;
				background-color:'.$theme_options['tb_color_two'].' !important;
			}
			a.woo-button {
				color:'.$theme_options['tb_font_color'].' !important;
			}
			
			/* Price Filter */
			.widget_price_filter .ui-slider .ui-slider-handle {
				border:1px solid '.$theme_options['tb_color_two'].';
				background: '.$theme_options['tb_color_two'].';
				background:-webkit-gradient(linear, left top, left bottom, from('.$theme_options['tb_color_two'].'), to('.$theme_options['tb_color_one'].'));
				background:-webkit-linear-gradient('.$theme_options['tb_color_two'].', '.$theme_options['tb_color_one'].');
				background:-moz-linear-gradient(center top, '.$theme_options['tb_color_two'].' 0, '.$theme_options['tb_color_one'].' 100%);
				background:-moz-gradient(center top, '.$theme_options['tb_color_two'].' 0, '.$theme_options['tb_color_one'].' 100%);	
			}
			
			.widget_price_filter .price_slider_wrapper .ui-widget-content {
				background: '.$theme_options['tb_color_two'].';
				background:-webkit-gradient(linear, left top, left bottom, from('.$theme_options['tb_color_two'].'), to('.$theme_options['tb_color_one'].'));
				background:-webkit-linear-gradient('.$theme_options['tb_color_two'].', '.$theme_options['tb_color_one'].');
				background:-moz-linear-gradient(center top, '.$theme_options['tb_color_two'].' 0, '.$theme_options['tb_color_one'].' 100%);
				background:-moz-gradient(center top, '.$theme_options['tb_color_two'].' 0, '.$theme_options['tb_color_one'].' 100%);	
			}
			
			.widget_price_filter .ui-slider .ui-slider-range {
				background:'.$theme_options['tb_color_two'].' url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAADCAYAAABS3WWCAAAAFUlEQVQIHWP4//9/PRMDA8NzEPEMADLLBU76a5idAAAAAElFTkSuQmCC) top repeat-x;
			}
			
			/* Mini Icons */
			a.button.added:before,
			button.button.added:before,
			input.button.added:before,
			#respond input#submit.added:before,
			#content input.button.added:before {
				background-color: '.$color_scheme.' !important;
			}
			
			/* Checkout */
			#payment div.payment_box {
				box-shadow:inset 0px 1px 0px 0px #ffffff;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6) );
				background:-moz-linear-gradient( center top, #ffffff 5%, #f6f6f6 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#ffffff\', endColorstr=\'#f6f6f6\');
				text-shadow:1px 1px 0px #ffffff;	
				color:#666666 !important;
			}
			
			ul.order_details {
				background-color: '.$color_scheme.';
			}
			
			ul.order_details li {
				color: #FFF;
			}
			
			mark {
				background-color: '.$color_scheme.';
				color: #FFF;
			}
			
			/* Elements */
			div.product span.price,
			span.price,
			#content div.product span.price,
			div.product p.price,
			#content div.product p.price {
				color: #FFFFFF;
				background-color: '.$color_scheme.';
			}
			
			div.product span.price del,
			#content div.product span.price del,
			div.product p.price del,
			#content div.product p.price del {
				color:rgba(255,255,255,0.5)
			}
			
			div.product span.price del,
			#content div.product span.price del,
			div.product p.price del,
			#content div.product p.price del {
				border-color: #FFF;
			}
			
			span.onsale {
				text-shadow:0 -1px 0 '.$color_scheme.';
				color:#fff;
				-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.3), inset 0 -1px 0 rgba(0,0,0,0.2), 0 1px 2px rgba(0,0,0,0.2);
				-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.3), inset 0 -1px 0 rgba(0,0,0,0.2), 0 1px 2px rgba(0,0,0,0.2);
				box-shadow:inset 0 1px 0 rgba(255,255,255,0.3), inset 0 -1px 0 rgba(0,0,0,0.2), 0 1px 2px rgba(0,0,0,0.2);	
				border:1px solid '.$theme_options['tb_color_two'].';
				background: '.$theme_options['tb_color_two'].';
				background:-webkit-gradient(linear, left top, left bottom, from('.$theme_options['tb_color_two'].'), to('.$theme_options['tb_color_one'].'));
				background:-webkit-linear-gradient('.$theme_options['tb_color_two'].', '.$theme_options['tb_color_one'].');
				background:-moz-linear-gradient(center top, '.$theme_options['tb_color_two'].' 0, '.$theme_options['tb_color_one'].' 100%);
				background:-moz-gradient(center top, '.$theme_options['tb_color_two'].' 0, '.$theme_options['tb_color_one'].' 100%);
			}
			
			.posted_in a {
				color: '.$color_scheme.';
			}
			
			.posted_in a:hover {
				color: #000 !important;
			}		
			
			.widget_layered_nav ul li.chosen a {
				background: #333 url('.THEME_WEB_ROOT.'/images/woocommerce/cross_white.png) no-repeat 6px center;
				box-shadow:inset 0 1px 1px rgba(255,255,255,0.5) #888;
				-webkit-box-shadow:inset 0 1px 1px rgba(255,255,255,0.5) #888;
				-moz-box-shadow:inset 0 1px 1px rgba(255,255,255,0.5) #888;
				color:#fff !important;
			}';
			
		
		} //end custom color css part	
					
		
		/*
		 * Sidebar Alignement
		 */
		$page_settings = (isset($pagemetadata['sidebar_align'])) ? $pagemetadata['sidebar_align'] : '';
		
		if ( function_exists( 'is_product_category' ) ) {
			
			if( is_product_category() ) {
				
				$page_settings = get_option_tree('woo_cat_sidebar_alignment');
		
			}
						
		}
		
		
		$sidebar_position = (!empty($page_settings)) ? $page_settings : $theme_options['sidebar_alignement'];
		$content_position = ($sidebar_position == "right" ? "left" : "right");
		$sidebar_margin = ($sidebar_position == "right" ? "left" : "right");
		$sidebar_second_margin = ($sidebar_position == "both" ? "left" : "right");
			
		$finalcss .= "
		#wrap #content {float: $content_position;}
		#wrap #sidebar {float: $sidebar_position;}
		#wrap #sidebar .widget-container {margin-$sidebar_margin: 20px;margin-$sidebar_position: 0px;}
		
		/* second sidebar enhancement */	
		#wrap #sidebar_second {float:$content_position;}
		#wrap #sidebar_second .widget-container {margin-$sidebar_second_margin: 20px;margin-$content_position: 0px;}";
		
		
		
		
		#-----------------------------------------------------------------
		# Declare CSS Font Stacks for reuse
		#-----------------------------------------------------------------
		$websafefonts = array(
			'arial'		 	=> 'Arial, Helvetica, sans-serif',
			'georgia'	 	=> 'Georgia, serif',
			'helvetica' 	=> '"HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif',
			'tahoma' 		=> 'Tahoma, Geneva, sans-serif',
			'times' 		=> '"Times New Roman", Times, serif',
			'trebuchet' 	=> '"Trebuchet MS", Helvetica, sans-serif',
			'verdana' 		=> 'Verdana, Geneva, sans-serif',
			'impact' 		=> 'Impact, Charcoal, sans-serif',
			'palatino'	 	=> '"Palatino Linotype", "Book Antiqua", Palatino, serif',
			'century' 		=> 'Century Gothic, sans-serif',
			'lucida'		=> '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
			'luciaconsole'	=> '"Lucida Console", Monaco, monospace',
			'arialblack'	=> '"Arial Black", Gadget, sans-serif',
			'arialnarrow' 	=> '"Arial Narrow", sans-serif',
			'copperplate'	=> 'Copperplate / Copperplate Gothic Light, sans-serif',
			'gillsans'		=> 'Gill Sans / Gill Sans MT, sans-serif',
			'courier'		=> '"Courier New", Courier, monospace'
		);
		
		
		#-----------------------------------------------------------------
		# Add Custom Font to font stack
		#-----------------------------------------------------------------
		if( isset($theme_options['custom_font']) && is_array($theme_options['custom_font']) ) {
			foreach ($theme_options['custom_font'] as $key => $value) {
				$websafefonts[strtolower($value['title'])] = '"'.$value['title'].'"';
			}
		}
		
		
		#-----------------------------------------------------------------
		# Load Cutom Font Face
		#-----------------------------------------------------------------
		if(isset($theme_options['custom_font']) && is_array($theme_options['custom_font'])) :
		
			foreach ($theme_options['custom_font'] as $key => $value) {
						
				$finalcss .= "@font-face {";
					
					if(isset($value['title']) && !empty($value['title']))
					$finalcss .= "\t\t" ."font-family: '".$value['title']."';";
					
					if(isset($value['embedded-opentype']) && !empty($value['embedded-opentype'])) {
						$finalcss .= "\t\t" ."src: url('".$value['embedded-opentype']."');";		
						$finalcss .= "\t\t" ."src: url('".$value['embedded-opentype']."?#iefix') format('embedded-opentype'),";
					}
					
					if(isset($value['woff']) && !empty($value['woff']))
					$finalcss .= "\t\t" . "url('".$value['woff']."') format('woff'),";
					
					if(isset($value['svg']) && !empty($value['svg']))
					$finalcss .= "\t\t" . "url('".$value['svg']."') format('svg');";
					
					if(isset($value['truetype']) && !empty($value['truetype']))
					$finalcss .= "\t\t" . "url('".$value['truetype']."') format('truetype'),";				
					
				$finalcss .= "}";
			
			}
		
		endif;
		
		
		#-----------------------------------------------------------------
		# Body Typography
		#-----------------------------------------------------------------
		if (isset($theme_options['bodyfont']) && !empty($theme_options['bodyfont'])) {
			
			$finalcss .= 'body {';
				
				$finalcss .= 'color:'.$theme_options['bodyfont']['font-color'].';';
				$finalcss .= 'font-size:'.$theme_options['bodyfont']['font-size'].';';
				$finalcss .= 'font-family:'.$websafefonts[$theme_options['bodyfont']['font-family']].';';
				$finalcss .= 'font-weight:'.$theme_options['bodyfont']['font-weight'].';';
				$finalcss .= 'font-style:'.$theme_options['bodyfont']['font-style'].';';
					
			$finalcss .= '}';
					
		} 
		
		
		#-----------------------------------------------------------------
		# Navigation Customisation
		#-----------------------------------------------------------------
		
		//Navigation Level 1
		if (!empty( $theme_options['navigation_font'] )) {
		
			$finalcss .= '#navigation ul li a {';		
					
					$finalcss .= 'color:'.$theme_options['navigation_font']['font-color'].';';
					$finalcss .= 'font-size:'.$theme_options['navigation_font']['font-size'].' !important;';
					$finalcss .= 'font-family:'.$websafefonts[$theme_options['navigation_font']['font-family']].' !important;';
					$finalcss .= 'font-weight:'.$theme_options['navigation_font']['font-weight'].' !important;';
					$finalcss .= 'font-style:'.$theme_options['navigation_font']['font-style'].' !important;';
					$finalcss .= 'text-transform:'.$theme_options['navigation_font']['font-transform'].' !important;';			
				
			$finalcss .= '}'; 
		
		}
		
		//Navigation Level 2 Link Style
		if ( !empty($theme_options['drop_down_font_color']) ) {
			
			$finalcss .= '#navigation ul.sub-menu li a {';
					
					$finalcss .= 'color:'.$theme_options['drop_down_font_color']['font-color'].';';
					$finalcss .= 'font-size:'.$theme_options['drop_down_font_color']['font-size'].' !important;';
					$finalcss .= 'font-family:'.$websafefonts[$theme_options['drop_down_font_color']['font-family']].' !important;';
					$finalcss .= 'font-weight:'.$theme_options['drop_down_font_color']['font-weight'].' !important;';
					$finalcss .= 'font-style:'.$theme_options['drop_down_font_color']['font-style'].' !important;';
					$finalcss .= 'text-transform:'.$theme_options['drop_down_font_color']['font-transform'].' !important;';				
					
			$finalcss .= '}';
			
		}
		
		
		#-----------------------------------------------------------------
		# Headlines
		#----------------------------------------------------------------- 
		$fontface = ($theme_options['headline_font_face_type'] == 'headline_font_face_google') ? polish_font_name($theme_options['headline_font_face_google']['font-family']) : $websafefonts[$theme_options['headline_font_face_websafe']['font-family']];
			
		$finalcss .= 'h1 { font-family: '.$fontface.';
			 font-size: '.$theme_options['h1_font_size']['0'].$theme_options['h1_font_size']['1'].';
		}';
			
		$finalcss .= 'h2 { font-family: '.$fontface.'; 
			 font-size: '.$theme_options['h2_font_size']['0'].$theme_options['h2_font_size']['1'].';
		}';
		
		$finalcss .= 'h3 { font-family: '.$fontface.'; 
			 font-size: '.$theme_options['h3_font_size']['0'].$theme_options['h3_font_size']['1'].';
		}';
		
		$finalcss .= 'h4 { font-family: '.$fontface.'; 
			 font-size: '.$theme_options['h4_font_size']['0'].$theme_options['h4_font_size']['1'].';
		}';
		
		$finalcss .= 'h5 { font-family: '.$fontface.'; 
			 font-size: '.$theme_options['h5_font_size']['0'].$theme_options['h5_font_size']['1'].';
		}';
		
		$finalcss .= 'h6 { font-family: '.$fontface.'; 
			 font-size: '.$theme_options['h6_font_size']['0'].$theme_options['h6_font_size']['1'].';
		}';
		
		$finalcss .= 'h1, h2, h3, h4, h5, h6 {
			color: '.$theme_options['headline_font_color'].';
		}';
		
		if($theme_options['headline_font_face_type'] == 'headline_font_face_websafe') {
			
			$finalcss .= ' h1, h2, h3, h4, h5, h6 {
				font-weight: '.$theme_options['headline_font_face_websafe']['font-weight'].';
				font-style: '.$theme_options['headline_font_face_websafe']['font-style'].'; 
			}';
			
		}		
		
		$finalcss .='
		.tp-caption.themecolor_background {
			background-color: '.$color_scheme.';
		}
		.tp-caption.themecolor_normal {
			color: '.$color_scheme.';
		}
		.tp-caption.themecolor_small {
			color: '.$color_scheme.';
		}'
		;
		
				
		#-----------------------------------------------------------------
		# Custom Footer
		#----------------------------------------------------------------- 
		$backgroundtype = $theme_options['footer_background_type'];
		$backgroundpattern = !empty($theme_options['footer_default_backgroundpattern']['background-image']) ? $theme_options['footer_default_backgroundpattern']['background-image'] : '';
		$backgroundtexture = !empty($theme_options['footer_default_backgroundtexture']['background-image']) ? $theme_options['footer_default_backgroundtexture']['background-image'] : '';

		if($backgroundtype == 'footer_default_backgroundpattern' && !empty($backgroundpattern)) {
			
			$finalcss .= '#footer-wrap, #footer .widget-title span { background: url('.THEME_WEB_ROOT.'/images/footer/pattern/'.$backgroundpattern.'); }';
			
		} elseif($backgroundtype == 'footer_default_backgroundtexture' && !empty($backgroundtexture)) {
			
			$finalcss .= '#footer-wrap, #footer .widget-title span { background: url('.THEME_WEB_ROOT.'/images/footer/bg-textured/'.$backgroundtexture.'); background-position: center top; }';
		
		}	
		
		$finalcss .= stripslashes($theme_options['custom_css']);
		$finalcss .= '</style>';
		
		#-----------------------------------------------------------------
		# Output minified CSS
		#-----------------------------------------------------------------
		echo lambda_regx_removal($finalcss);
		
	}
	
	add_action('wp_head', 'lambda_custom_css' );
	
}
?>