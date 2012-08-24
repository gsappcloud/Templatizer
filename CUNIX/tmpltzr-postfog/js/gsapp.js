var LOG = true;
var TMPLTZR = true;
var safelog = function(msg){
	if(LOG === true && msg != undefined){
		console.log(msg);
	}
}

var HOME_URL = 'http://www.postfog.org/templatizer';

var CURRENT_LEVEL = 0;
var CURRENT_STATE_INDEX = 0;
var CURRENT_STATES = Array();
CURRENT_STATES[0] = 'home';
CURRENT_STATES[1] = 'menu';
CURRENT_STATES[3] = 'redirected';

var CURRENT_STATE = CURRENT_STATES[CURRENT_STATE_INDEX];


var initCurrentState = function(state_index){
	if(state_index != undefined){
		CURRENT_STATE = CURRENT_STATES[state_index];
	}else{
		CURRENT_STATE = CURRENT_STATES[CURRENT_STATE_INDEX];
	}
}

var setCurrentState = function(state_index){
	try{
		CURRENT_STATE = CURRENT_STATES[state_index];
	}catch(e){
		safelog('error: ' + e.message);
	}
}

var getCurrentState = function(){
	return CURRENT_STATE;
}

var getCurrentStateIndex = function(){
	return CURRENT_STATE_INDEX;
}

var initCurrentLevel = function(){
	CURRENT_LEVEL = 0;
}

var setCurrentLevel = function(newLevel){
	CURRENT_LEVEL = newLevel;
}

var getCurrentLevel = function(){
	return CURRENT_LEVEL;
}

var getElementLevel = function($element){
	var classes = $element.attr('class');
	if( classes.indexOf('level-').length > 0 ){
		var levelIdx = classes.indexOf('level-') + 6;
		var level = classes.substring(levelIdx, levelIdx+1);
		return level;
	}else{
		return -1;
	}
}

initCurrentLevel();

var getOffset = function( el ) {
    var _x = 0;
    var _y = 0;
    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
        _x += el.offsetLeft - el.scrollLeft;
        _y += el.offsetTop - el.scrollTop;
        el = el.parentNode;
    }
    return { top: _y, left: _x };
}

var BuildWall = function(){
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


function externalLinkAppendImg(m){
	$('li',m).each(function(){
		var anchor = $('a', this);
		var href = anchor.attr('href');
		href = href.substring(0,4);
		if(href == 'http'){
			offsite = '<img class="hover-only" src="http://www.columbia.edu/cu/arch/tmpltzr-postfog/assets/offsite.png" />';
			anchor.append(offsite);
			anchor.attr("target", "_blank"); //make sure it opens in a new tab/window
		}
	});
}


/*************************** RESIZE ***************************/
/*
	Resizes the height of the menu based on the actual page size
*/
var resizeMenu = function(){
	var wh = window.innerHeight;
	var hh = $("#header").height();
	$("#menu").css('height', wh-hh);
}

var resizeFunc = function(){
	resizeMenu(); //resize the height of the menu
	
	var ww = window.innerWidth;
	if(ww >= 1270){
		$('#content').css('width', '800px');
		
		var id ='';
		$('#tmpltzr #main .view .views-row').each(function(i){
			if($('.tmpltzr-secondary-float', this).length != 0){
				id = $('.tmpltzr-secondary-float', this).attr('id');
				$(this).addClass(id).addClass('empty');
				$('#tmpltzr #right-sidebar').append($('.tmpltzr-secondary-float', this));
				
			}
		});					
	}else{
		$('#content').css('width', '520px');
		
		var insertClass = '';
		$('#tmpltzr #right-sidebar .tmpltzr-secondary-float').each(function(){
			insertClass = '#tmpltzr #main .view .views-row.' + $(this).attr('id');
			
			$(insertClass).append($(this)).removeClass('empty');
		});			
	}
	BuildWall();
	//evenColumnsCourseBlogsIndex(resized); //even out columns in course blog index TODO tct2003 reinstate this
	//resized = true; //set to true after the resize function has run once
}

var force_expanded = Array();
force_expanded.push('/studio-x-global/locations');
force_expanded.push('/studio-x-global/locations/studio-x-beijing');

var adjustPrimaryLinksMenu = function(path){
	$('#navigation .menu li').addClass('collapsed menu-item').removeClass('expanded');
	var selector = '',
		$selected;
	for(i in force_expanded){
		selector = '#navigation a:[href="' + force_expanded[i] + '"]';		
		$(selector).parent('li').removeClass('collapsed').addClass('force-expanded');
	} 
	
	/* if not the homepage, where path = '/' */
	safelog('not the homepage: ' + path.substring(13));
	if( (path.length > 13) && (path.substring(13,19) != 'search') ){
		selector = '#navigation a:[href="' + path + '"]';
		
		
		var selLen = $(selector).length;
		if( selLen < 0 ){//the page doesn't exist on the site
			window.location.href = HOME_URL;//redirect to homepage
		}else{//page exists
			if( selLen == 1 ){
				safelog('single selector');
				$selected = $(selector);
				setCurrentState(1);
			}else if(selLen > 1){//redirect, internal or not
				
				if( $('#navigation a:[href="' + path + '"]:eq(0)').parent('li').children('.menu').find('li a:[href="' + path + '"]:eq(0)').length > 0 ){//redirect
					$selected = $('#navigation a:[href="' + path + '"]:eq(0)').parent('li').children('.menu').find('li a:[href="' + path + '"]:eq(0)');
					$('#navigation a:[href="' + path + '"]:eq(0)').parent('li').addClass('redirect-active');
					$('#navigation a:[href="' + path + '"]:eq(0)').removeClass('active');
					
					safelog('redirected at birth');
					setCurrentState(3);
				}else{//internal redirect
					$(selector).each(function(){
						var stub = $(this).closest('.menu').parent('li').children('a:eq(0)').attr('href');
						if(TMPLTZR == true){
							stub = stub.substring(13, 18);// change 13 to 1 for non-templatizer
							if( stub == path.substring(13, 18) ){
								$selected = $(this);
							}else{
								$(this).removeClass('active');
							}
						}else{
							stub = stub.substring(1, 6);
							safelog('stub: ' + stub);
							safelog('path stub: ' + path.substring(1, 6));
							if( stub == path.substring(1, 6) ){
								$selected = $(this);
							}else{
								$(this).removeClass('active');
							}
						}
					});	
					setCurrentState(1);
				}
			}
			$selected.parents('li.collapsed').removeClass('collapsed').addClass('expanded active-trail');
			$('.active-trail').each(function(){
				$('a:eq(0)', this).css('color', 'white');
			});
			$selected.addClass('active').css('color', 'white');
			$selected.parents('.menu').show();
			$selected.parent('li').children('.menu').show();
			
		}
	}
}



/*
	Adds a span to be filled with triangles for hover and menu expand effects.
*/
var MAX_MENU_LEVELS = 6;
function menuAddTriangles(){
	var liW = 360;
	var aW = liW - 25;
	var liWStr = liW + 'px';
	var aWStr = aW + 'px';
	var selector = '#navigation > .menu > li';
	
	$('#navigation > .menu').addClass('level-0');
	$(selector).css('width', liWStr).prepend('<span class="menu-arrow-large"></span>');
	$(selector).each(function(){
		$(this).children('a').css('width',aWStr);
	});
	
	
	for(var i = 1; i < MAX_MENU_LEVELS; i++){
		selector += ' > ul.menu';
		$(selector).addClass('level-'+i);
		selector += ' > li';
		liW = aW;
		liWStr = liW + 'px';
		aW = liW - 19;
		aWStr = aW + 'px';
		$(selector).css('width', liWStr).prepend('<span class="menu-arrow-small"></span>');
		
		$(selector).each(function(){
			$(this).children('a').css('width',aWStr);
		});
		
	}
	
}



$(document).ready(function () {
	gsappFetcher.start();
	
	adjustPrimaryLinksMenu( window.location.pathname );
	menuAddTriangles();

	/*************************** UTILITIES ***************************/
	jQuery.fn.exists = function(){return this.length>0;}
	
	if($('.tmpltzr-photoset').exists()){
		$('.tmpltzr-photoset').each(function(){
			var id = $(this).attr('id');
			id = '#' + id;
			
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
	/* 
		Adds a dot to all menu items that link to pages off the site
	*/		
	
	
	var menu = $("#menu ul.menu");
	externalLinkAppendImg(menu);
	
	/*
		Hover effect for menu - shows offsite.png if offsite link on hover
	*/
	var menuHoverOn = function(){
		$(".hover-only", this).toggle(); //hover effect for offsite.png to appear on external links
		$(this).parent('li.collapsed').children(".menu-arrow-large").css('backgroundPosition', '-15px 0');
		$(this).parent('li.collapsed:not(.active-trail.leaf)').children(".menu-arrow-small").css('backgroundPosition', '-9px 0');
	}
	
	var menuHoverOff = function(){
		$(".hover-only", this).toggle(); //hover effect for offsite.png to appear on external links
		$(this).parent('li.collapsed').find(".menu-arrow-large").css('background-position', '');
		$(this).parent('li.collapsed').find(".menu-arrow-small").css('background-position', '');
	}
	
	
	
	$(".menu a").bind('mouseenter', menuHoverOn).bind('mouseleave', menuHoverOff);

	
	/*************************** COURSE BLOGS INDEX ***************************/
	/*
		Evenly arranges columns of links to course blogs based on screen width
	*/
	var evenColumnsCourseBlogsIndex = function(wrapped){
		$('.view-courseblogs').each( function(i){ 
			if(wrapped){ $('.view-content .views-row', this).unwrap(); }
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
		return false;
	};
	
	var unbindProgramCourseBlogIndexFilter = function(){
		link = $(this);
		link.removeClass('selected');
		var program = link.attr('id');
		program = '.'+program;
		$(program).removeClass('program');
		link.unbind('click').bind('click', bindProgramCourseBlogIndexFilter );
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
	
	
	
	
	/*************************** STARTUP FUNCTIONS ***************************/
	
	resizeFunc(); //run the resize function on page load
	$(window).resize(resizeFunc); //bind the resize function to the page
	
	//setTimeout(BuildWall,5000);
	

	
});


$(window).load(function(){
	setTimeout(BuildWall,100);
	setTimeout(BuildWall,500);
});