(function($){	
	
	$(document).ready(function(){
		
	/* Superfish
	================================================== */
	$(function(){ // run after page loads
		$('#navigation ul.menu')
		.find('li.current_page_item,li.current_page_parent,li.current_page_ancestor,li.current-cat,li.current-cat-parent,li.current-menu-item')
			.addClass('active')
			.end()
			.superfish({autoArrows	: true});
	});
	
	
	/* FitVid
	================================================== */
	$(".lambda-video").fitVids();
	
	
	/* Last Child
	================================================== */	
	$('ul.archive li:last-child').addClass('last');
	$('.widget-container ul li:last-child').addClass('last');
	$('.widget-container p:last-child').addClass('last');
	$('.faq .list:last-child').addClass('last');
	$('#footer li:last-child').addClass('last');

	
	/* top-header-social
	================================================== */
	$('.social-icons a, .author-links a, .member-contact a, .comments_avatar a, .size-medium, .size-large, .size-thumbnail, .size-full, .post-image img, .gallery-item img').each(function() {
		
		$(this).hover(
			function() {
				$(this).stop().animate({ opacity: 0.5 }, 400);
			},
			function() {
				$(this).stop().animate({ opacity: 1 }, 600);
		})
		
    });
	
	
	$('.lambda_widget_flickr a').live({
        mouseenter:
           function() {
			$(this).stop().animate({ opacity: 0.5 }, 400);
           },
        mouseleave:
           function() {
			$(this).stop().animate({ opacity: 1 }, 600);
           }
       }
    );

	
	/* image hover
	================================================== */
	$(".imagepost").stop().hover(function(){						
														
		$(this).find('.hover-overlay').stop().fadeIn(250);
								  
	}, function () {
							
		$(this).find('.hover-overlay').stop().fadeOut(250);						
								
	});	
	
	
	// Style Tags
	$(function(){ // run after page loads
		$('p.tags a')
		.wrap('<span class="st_tag" />');
	});
	
	
	//Youtube WMode
	$('iframe').each(function() {
		var url = $(this).attr("src");
		
		if (url!=undefined) {
		var youtube = url.search("youtube");
		
		splitable = url.split("?");
				
			if(youtube > 0 && splitable[1]) {
				$(this).attr("src",url+"&wmode=transparent")
			}
			
			if(youtube > 0 && !splitable[1]) {
				$(this).attr("src",url+"?wmode=transparent")
			}
		
		}
		
	});
	
	
	// Mobile Menu
	$(function(){ // run after page loads
		//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
		$(".mm-trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle(500);
			return false; //Prevent the browser jump to the link anchor
		});
	});
	
	$(window).smartresize(function(){
		
		if (($(window).width() > 959)) {
			$("#mobile-menu").hide(); 
		};
	
	});
	
	
	// Toggle Slides
	$(function(){ // run after page loads
		$(".toggle_container").hide(); 
		//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
		$("p.trigger, h3.trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle(500);
			return false; //Prevent the browser jump to the link anchor
		});
	});
	
	
	// valid XHTML method of target_blank
	$(function(){ // run after page loads
		$('a[rel*=external]').click( function() {
			window.open(this.href);
			return false;
		});
	});


	/* Tabs Activiation
	================================================== */
	var tabs = $('ul.tabs');
	tabs.each(function(i) {
		
		//Get all tabs
		var tab = $(this).find('> li > a');
		$(this).find("li:first").addClass("active").fadeIn('fast'); 
		$(this).find("li:first a").addClass("active").fadeIn('fast'); 
		$(this).next("ul.tabs-content").find("li:first").addClass("active").fadeIn('fast');
		
			
		var contentLocation = window.location.href.slice(window.location.href.indexOf('?') + 1).split('#');
		var contentLocator = "#" + contentLocation[1] + "Tab"
		
		if(contentLocation[1]) {
			tab.each(function(i) {		
				
				$("ul.tabs li").removeClass('active');
																							
				if($(this).attr('href') + "Tab" == contentLocator)
				$(this).parent().addClass('active');				
						
				//Show Tab Content & add active class
				$(contentLocator).show().addClass('active').siblings().hide().removeClass('active');
											
			});
		}
		
		tab.click(function(e) {
			
			//Get Location of tab's content
			var contentLocation = $(this).attr('href') + "Tab";
			
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				tab.removeClass('active');
				$(this).addClass('active');
				
				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
				
			} 
		});
	}); 
	
	/* scroll to top
	================================================== */	
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();	
		} else {
			$('#toTop').fadeOut();
		}
	});
	 
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},1000);
	});	
	
	/* IE Fallback
	================================================== */
	$('#clients li:last-child').css('margin-right', '0px');
	

});

})(jQuery);