$(document).ready(function() {

	// iphone full screen
	window.scrollTo(0,0);
	
	// hide children in menu
	//$("li:not(.menu-level-1)").hide();
	
	var MAX_MENU_LEVELS = 6;
	
	var collapseMenu = function(level){
		var selector = '';
		for(i = level; i <= MAX_MENU_LEVELS; i++){
			selector = '#mobile-menu ul li.menu-level-'+i;
			$(selector).removeClass('expanded').addClass('collapsed');
		}
	};
	
	$("#mobile-menu ul li a").click(function() {
		//console.log(this);
		
		var classes = $(this).parent('li').attr('class');
		
		var levelIdx = classes.indexOf('menu-level-') + 11;
		var level = classes.substring(levelIdx, levelIdx+1);
		collapseMenu(level);
		
		$('a.active').removeClass('active');
		$(this).addClass('active');
		
		$(this).parent('li').addClass("expanded").removeClass("collapsed").addClass("active-trail");//.children("ul").show(300);
		
		
		$("#mobile-menu .active-trail").each(function(){
			$('a:eq(0)', this).css('color', '#00D6FF');
		});
	
		
		
		
		// load content
		var link_target = ['/templatizer/', 
			$(this).attr('href')].join('');
		load_content(link_target);
		
		
		return false;
	});
	
	
	
	$('#mobile-switch-bar').css('left', '570px');

	$('#mobile-switch-bar').toggle(function() {
		// move menu offscreen and show content
		var offscreen = {
			'position': 'absolute',
			'left': '-2000px',
		};
		$('#mobile-menu').css(offscreen);
		$('#mobile-switch-bar').css('left', '0');
		$('#mobile-switch-bar div').css('left', '26px').css('right', '');
		$('#mobile-switch-bar div div').addClass('page');
		$('#mobile-content').css('left', '100px');
	},
	function() {
		// move content offscreen and show menu
		var offscreen = {
			'position': 'absolute',
			'left': '-2000px',
		};
		$('#mobile-menu').css('left', 0);
		$('#mobile-switch-bar').css('left', '570px');
		$('#mobile-switch-bar div').css('right', '26px').css('left', '');
		$('#mobile-switch-bar div div').removeClass('page');
		$('#mobile-content').css(offscreen);
	});
	
	
	
	
	// load content inline via ajax	
	$('#programs-page').click(function() {
			$('#mobile-content').load("/templatizer/programs?mobile=false #tmpltzr", function(data) {
				$(data); var contents = $('#tmpltzr', data).html();
				$('#mobile-content').html(contents);
			});
	});
	
	$('#about-deans').click(function() {
		load_content("/templatizer/about/deans-statement");
	});
	
	
});

function load_content(url) {
	var url = [url, '?mobile=false #tmpltzr'].join('');
	$('#mobile-content').load(url, function(data) {
		$(data); var contents = $('#tmpltzr', data).html();
		$('#mobile-content').html(contents);
	});
}