function BuildWall(){
	var $container = $('#tmpltzr #main .view .view-content');
	$container.imagesLoaded( function(){
		$container.masonry({
			itemSelector: '.views-row',
			columnWidth: 240,
			isAnimated: false,
			gutterWidth: 20,
			isFitWidth: true,
		});
	});
}

$(document).ready(function () {
	gsappFetcher.start();

	/*************************** UTILITIES ***************************/
	jQuery.fn.exists = function(){return this.length>0;}
	
	if($('.tmpltzr-photoset').exists()){
		$('.tmpltzr-photoset').each(function(){
			var id = $(this).attr('id');
			id = '#' + id;
			console.log('$(id): ' + $(id));
			$(id).jcarousel({
    			scroll: 1,
    			visible: 1,
    			start: 1,
    			width: 500,
    			buttonPrevHTML: '<div></div>',
    			buttonNextHTML: '<div></div>'
    		});
		});
    }
    
    
    var setMasonryBrickWidths = function(){	
		$('#tmpltzr #main .view .view-content .views-row').each(function(){
			if($(this).children('.node').hasClass('tmpltzr-module-500')){
				$(this).css('width', '500px');
			}else{
				$(this).css('width', '240px');
			}
		});
	 }  
	
	setMasonryBrickWidths();
    
    /*************************** NON-MOBILE FRIENDLY EMBEDDED CONTENT ***************************/
	var convertFlashEmbedsToLinks = function(){
		if($('.tmpltzr-primaryvideo object').length > 0){
			$('.tmpltzr-primaryvideo object').each(function(){
				if($(this).attr('type') == "application/x-shockwave-flash"){
					$(this).parents('.views-row').remove();
				}
			});	
		}
	}	
	
	/* if viewing the stock site on a mobile device, like an iPad or other tablet,
	   this function will remove any non-mobile friendly embeds, like the flickr
	   image set flash-based <object>
	*/
	if($('body').hasClass('mobile')){
		convertFlashEmbedsToLinks();
	}
	
	  
    /*************************** MENU ***************************/
	var scrollMenu = function(){
		var target = $('#menu ul li.active-trail');
		
		if($('#menu ul li.active-trail').exists()){
			if($('#menu ul li.active-trail li.active-trail').exists()){
				$('#menu').scrollTo( target, 0 );
			}else{
				$('#menu').scrollTo( target, 800, {easing:'linear'} );
			}
		}
	}
	
	//scrollMenu(); //scrolls highest level of .active-trail to the top of the menu
	
	/* 
		Adds a dot to all menu items that link to pages off the site
	*/		
	var addDotToMenu = function(m){
		$('li',m).each(function(){
			var anchor = $('a', this);
			var href = anchor.attr('href');
			href = href.substring(0,4);
			if(href == 'http'){
				offsite = '<img class="hover-only" src="/templatizer/sites/all/themes/tmpltzr/assets/offsite.png" />';
				anchor.append(offsite);
				anchor.attr("target", "_blank"); //make sure it opens in a new tab/window
			}
		});
	}
	
	var menu = $("#menu ul.menu");
	addDotToMenu(menu);

	/*
		Resizes the height of the menu based on the actual page size
	*/

	var resizeMenu = function(){
		var wh = window.innerHeight;
		var hh = $("#header").height();
		$("#menu").css('height', wh-hh);
	}
	
	/*
		Colors the active section of the menu in Columbia Blue
	*/
	var menuActiveTrailColor = function(){
		$("#menu .active-trail").each(function(){
			$('a:eq(0)', this).css('color', '#00D6FF');
		});
	}
	
	menuActiveTrailColor();
	
	/*************************** COURSE BLOGS INDEX ***************************/
	/*
		Evenly arranges columns of links to course blogs based on screen width
	*/
	var evenColumnsCourseBlogsIndex = function(wrapped){
		$('.view-courseblogs').each( function(i){ 
			if(wrapped){ console.log('wrapped'); $('.view-content .views-row', this).unwrap(); }
			var count = $('.view-content .views-row', this).length;
			switch($('.wrapper #content').css('width')){
				case "520px":
					$("#fixed-header").css('width', '500px');
					var colCount = Math.max(1,Math.floor(count/2));
					$('.view-content .views-row', this).slice(0, colCount).wrapAll('<div class="col" />');
					$('.view-content .views-row', this).slice(colCount, count).wrapAll('<div class="col" />');
					break;
				case "800px":
					$("#fixed-header").css('width', '750px');
					var colCount = Math.max(1,Math.floor(count/3));
					$('.view-content .views-row', this).slice(0, colCount).wrapAll('<div class="col" />');
					$('.view-content .views-row', this).slice(colCount, (2*colCount)).wrapAll('<div class="col" />');
					$('.view-content .views-row', this).slice((2*colCount), count).wrapAll('<div class="col" />');
					break;
				default:
					break;
			}
		});
	}
	
	
		$('#semester-list .term-list a.term-index-term').each(function(){
			$(this).bind('click',function(){
				var href1 = $(this).attr('href');
				href1 = "#" + href1;
				$(window).scrollTo( href1, 200 );
				return false;
			});
		});
	
	
	var unbindRegionCourseBlogIndexFilter = function(){
		
		link = $(this);
		link.removeClass('selected');
		var region = link.attr('id');
		region = '.'+region;
		$(region).addClass('unselected');
		link.unbind('click').bind('click', bindRegionCourseBlogIndexFilter($(this)) );
		return false;
	};
	
	var bindRegionCourseBlogIndexFilter = function(){
		$('.term-list a.term-index-term').removeClass('selected');	
		$('.view-courseblogs a.term-index-term').addClass('unselected').removeClass("program");
		var region = $(this).attr('id');
		region = '.'+region;
		$(region).removeClass('unselected');
		$(this).addClass('selected');
		$(this).unbind('click').bind('click', unbindRegionCourseBlogIndexFilter);
		console.log('unbound');
		return false;
	};
	
	var unbindProgramCourseBlogIndexFilter = function(){
		link = $(this);
		link.removeClass('selected');
		var program = link.attr('id');
		program = '.'+program;
		$(program).removeClass('program');
		link.unbind('click').bind('click', bindProgramCourseBlogIndexFilter );
		console.log('good');
		return false;
	}
	
	var bindProgramCourseBlogIndexFilter = function(){
		$('.term-list a.term-index-term').removeClass('selected');
		$('.view-courseblogs a.term-index-term').addClass('unselected').removeClass("program");
		
		var program = $(this).attr('id');
		program = '.'+program;
		$(program).addClass('program');
		$(this).addClass('selected');
		$(this).unbind('click').bind('click', unbindProgramCourseBlogIndexFilter);
		return false;
	}
	
	$('#region-list .term-list a.term-index-term').each(function(){
		$(this).bind('click', bindRegionCourseBlogIndexFilter);
	});
	
	$('#program-list .term-list a.term-index-term').each(function(){
		$(this).bind('click', bindProgramCourseBlogIndexFilter);
	});

	//scrollCourseBlogsIndex();
	
	$(document).scroll(function() {
		if($(document).scrollTop() >= 270){
			$("#fixed-header").addClass('fix-header');
			$("#course-blogs-index-listing").css('margin-top','395px');
		}else{
			$("#fixed-header").removeClass('fix-header');
			$("#course-blogs-index-listing").css('margin-top','0');
		}
	});
	
	/*************************** RESIZE ***************************/
	var resized = false; 
	var resizeFunc = function(post){
	
		resizeMenu(); //resize the height of the menu
		//$('#tmpltzr .tmpltzr-primaryquarter').parent('.views-row').wrapAll('<div class="tmpltzr-primaryquarter-container" />');
		
		var ww = window.innerWidth;
		if(ww >= 1270){
			$('.wrapper #content').css('width', '800px');
			
			var id ='';
			$('#tmpltzr #main .view .views-row').each(function(i){
				if($('.tmpltzr-secondary-float', this).length != 0){
					id = $('.tmpltzr-secondary-float', this).attr('id');
					console.log('id: ' + id);
					$(this).addClass(id).addClass('empty');
					$('#tmpltzr #right-sidebar').append($('.tmpltzr-secondary-float', this));
					
				}
			});					
		}else{
			$('.wrapper #content').css('width', '520px');
			
			var insertClass = '';
			$('#tmpltzr #right-sidebar .tmpltzr-secondary-float').each(function(){
				insertClass = '#tmpltzr #main .view .views-row.' + $(this).attr('id');
				
				$(insertClass).append($(this)).removeClass('empty');
			});			
		}
		if(resized){ BuildWall(); }
		evenColumnsCourseBlogsIndex(resized); //even out columns in course blog index
		resized = true; //set to true after the resize function has run once
	}
	
	
	/*************************** STARTUP FUNCTIONS ***************************/
	
	
	resizeFunc(); //run the resize function on page load
	$(window).resize(resizeFunc); //bind the resize function to the page
	
	//setTimeout(BuildWall,5000);
	

	
});


$(window).load(function(){
	setTimeout(BuildWall,100);
	setTimeout(BuildWall,500);
});