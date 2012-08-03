$(document).ready(function() {

	// iphone full screen
	window.scrollTo(0,0);
	
	// hide children in menu
	//$("li:not(.menu-level-1)").hide();
	
	$("#mobile-menu ul li").click(function() {
		console.log(this);
		
		
		// show children
		$("ul li" , $(this)).show(300);
		
		
		
		// load content
		var anchors = $("a", this);
		var first_anchor = anchors[0];
		var link_target = ['/templatizer/', 
			$(first_anchor).attr('href')].join('');
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
		$('#mobile-switch-bar').css('left', 0);
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