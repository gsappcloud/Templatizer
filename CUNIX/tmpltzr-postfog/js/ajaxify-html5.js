// https://gist.github.com/854622
(function(window,undefined){
	// Prepare our Variables
	var
		History = window.History,
		$ = window.jQuery,
		document = window.document;

	// Check to see if History.js is enabled for our Browser
	if ( !History.enabled ) {
		return false;
	}

	// Wait for Document
	$(function(){
		// Prepare Variables
		var
			/* Application Specific Variables */
			contentSelector = '#content',
			$content = $(contentSelector),
			contentNode = $content.get(0),
			$menu = $('#navigation'),
			activeClass = 'active',
			activeSelector = '.active-trail .active',
			menuChildrenSelector = '> li,> ul > li',
			/* Application Generic Variables */
			$body = $(document.body),
			rootUrl = History.getRootUrl(),
			scrollOptions = {
				duration: 0
			};
		
		
		// test for templatizer tmpltzr
		var base_path = '';
		if ( rootUrl.indexOf("postfog") != -1 ) {
			base_path = '/templatizer/';
		}
		
		// Ensure Content
		if ( $content.length === 0 ) {
			$content = $body;
		}
		
		// Internal Helper
		$.expr[':'].internal = function(obj, index, meta, stack){
			// Prepare
			var
				$this = $(obj),
				url = $this.attr('href')||'',
				isInternalLink;
			
			// Check link
			isInternalLink = url.substring(0,rootUrl.length) === rootUrl || url.indexOf(':') === -1;
			
			// Ignore or Keep
			return isInternalLink;
		};
		
		
		// HTML Helper
		var documentHtml = function(html){
			// Prepare
			var result = String(html)
				.replace(/<\!DOCTYPE[^>]*>/i, '')
				.replace(/<(html|head|body|title|meta|script)([\s\>])/gi,'<div class="document-$1"$2')
				.replace(/<\/(html|head|body|title|meta|script)\>/gi,'</div>')
			;
			
			// Return
			return result;
		};
		
		
		// Menu Helper
		
		var MAX_MENU_LEVELS = 5;
	
		var collapseMenu = function($this, trunk){
			var selector = '';
			var classes = $this.parent('li').attr('class');
			var levelIdx = classes.indexOf('menu-level-') + 11;
			var level = classes.substring(levelIdx, levelIdx+1);
			
			if( ( $this.parent('li.force-expanded').length > 0 || level <= getCurrentLevel() ) && $('.active-trail').length > 0 ){//will require closing a top level menu
				
				if( $this.parent('li.force-expanded').length > 0 ) { console.log('forced works!'); }
				
				if(level == 0){
					var target;
					if($this.parent('li').prev().prev().length > 0){
						target = $this.parent('li').prev().prev().children('a:eq(0)');
					}else if($this.parent('li').prev().length > 0){
						target = $this.parent('li').prev().children('a:eq(0)');
					}else{
						target = $this;
					}
					console.log(target);
					$('#menu').scrollTo( target, 500 );			
				}
				
				//slideToggle OFF all menus above the previous active
				//would be better as a do-while with selector = "#navigation .menu .active-trail.menu-level-"+i
				$('li.active-trail').each(function(){
					var liClasses = $(this).attr('class');
					var liLevelIdx = liClasses.indexOf('menu-level-') + 11;
					var liLevel = liClasses.substring(liLevelIdx, liLevelIdx+1);
					if(liLevel >= level){
						//only collapse menu if not in the active-trail
						if(!(liLevel == level && trunk == true)){
							if( $(this).hasClass('expanded') ){
								$('.menu:eq(0)', this).slideToggle(500);
								$(this).removeClass('expanded').addClass('collapsed');
							}
							$(this).removeClass('active-trail');
							$('a:eq(0)', this).css('color','');
							//$('.menu-arrow-large, .menu-arrow-small', this).css('backgroundPosition', '');
						}
					}
				});
				
			}
			$('a.active').removeClass('active');
			return level;
		};
	
		var MAX_TOP = 170; // could also use #header.height
	
		var menuParser = function($this, trunk){	
			var redirect = false;
			var level = collapseMenu($this, trunk);
			//add active class to clicked item, or
			//in case of redirect to a lower item, like About > Dean's Statement
			if($this.parent('li').children('.menu').length > 0){
				var path = $this.attr('href');
				var redirect = 'a:[href="' + path + '"]';
				$redirectAnchor = $this.parent('li').children('.menu').find(redirect);
				if($redirectAnchor.length > 0){
					$redirectAnchor.addClass('active');
					var cl = $redirectAnchor.parent('li').attr('class');	
					var index = cl.indexOf('menu-level-') + 11;
					level = cl.substring(index, index+1);					
					redirect = true;
					$this.addClass('redirect-active');
					
				}else{
					$this.addClass('active');
				}
			}else{
				$this.addClass('active');
			}
			
			//assign classes to menu items clicked and higher in the tree
			$('a.active').parents('li').removeClass("collapsed").addClass("active-trail expanded");
			
			//open parent menu (and child menu) if a redirect
			if(redirect == true){
				$('a.active').parents('li').children('.menu').each(function(){
					if( !( $(this).is(":visible") ) ){
						$(this).slideToggle(500);
					}
				});
			} 
			
			if(trunk == false){//open the submenu if applicable and not a redirect
				if($this.parent('li').children('.menu').length > 0){
					$('a.active').parent('li').children('.menu').slideToggle(500);
				}
			}
			
			//make each .active-trail element white
			$('a.active').parents('li').each(function(){
				$(this).children('a:eq(0)').css('color','white');
			});
			
			setCurrentLevel(level);
		}
		
		
		// Ajaxify Helper - binds function to menu clicks that are internal links
		$.fn.ajaxify = function(){
			// Prepare
			var $this = $(this);
						
			// Ajaxify
			$this.find('a:internal:not(#gsapplogo)').click(function(event){ //exempt GSAPP Logo so it reloads everything
				console.log('***********CLICK');
				// Prepare
				var
					$this = $(this),
					url = $this.attr('href'),
					title = $this.attr('title')||null;
				
				// Continue as normal for cmd clicks etc
				if ( event.which == 2 || event.metaKey ) { return true; }
				$this.parent('li').children('span').css('backgroundPosition', '');

				if( $this.hasClass('active') ){
					if( $this.parent('li').hasClass('expanded') ){
						$this.parent('li').removeClass("expanded").addClass("collapsed").children('.menu').slideToggle(500);
					}else{
						$this.parent('li').addClass("expanded").removeClass("collapsed").children('.menu').slideToggle(500);
					}
				}else if( $this.hasClass('redirect-active') ){
					if( $this.parent('li').hasClass('expanded') ){
						$this.parent('li').removeClass("expanded").addClass("collapsed").children('.menu').slideToggle(500);
						//$('active').removeClass('active');
						//$this.removeClass('redirect-active').addClass('active');
					}else{
						$this.parent('li').addClass("expanded").removeClass("collapsed").children('.menu').slideToggle(500);
					}
				}else{	
					var trunk = false;
					if($this.parent('li').hasClass('active-trail')){
						trunk = true;
					}
					
					var $sib = $this.parent('li').siblings('li.active-trail');
					
					
					if( !( $sib.children('a:eq(0)').hasClass('active') ) ){
						$('.redirect-active').removeClass('redirect-active');//remove only if not in same branch and same level
					}
					menuParser($this, trunk);
					// Ajaxify this link
					History.pushState(null,title,url);
					event.preventDefault();
				}
							
				
				return false;
			});
			
			// Chain
			return $this;
		};
		
		// Ajaxify our Internal Links
		$body.ajaxify();
		
		
		
		
		// Hook into State Changes
		$(window).bind('statechange',function(){	
			// Prepare Variables
			var
				State = History.getState(),
				url = State.url,
				relativeUrl = url.replace(rootUrl,'');

			// Set Loading
			$body.addClass('loading');

			// Start Fade Out
			// Animating to opacity to 0 still keeps the element's height intact
			// Which prevents that annoying pop bang issue when loading in new content
			$content.animate({opacity:0},100);
			
			// Ajax Request the Traditional Page
			$.ajax({
				url: url,
				success: function(data, textStatus, jqXHR){				
					// Prepare
					var
						$data = $(documentHtml(data)),
						$dataBody = $data.find('.document-body:first'),
						$dataContent = $dataBody.find(contentSelector).filter(':first'),
						$menuChildren, contentHtml, $scripts;
					
					// Fetch the scripts
					$scripts = $dataContent.find('.document-script');
					if ( $scripts.length ) {
						$scripts.detach();
					}

					// Fetch the content
					contentHtml = $dataContent.html()||$data.html();
					if ( !contentHtml ) {
						document.location.href = url;
						return false;
					}
					
					
					// Update the content
					$content.stop(true,true);
					$content.html(contentHtml).ajaxify().css('opacity',100).show(); // you could fade in here if you'd like 
					
					//resize the page to check if room for sidebar
					resizeFunc();

					// Update the title
					document.title = $data.find('.document-title:first').text();
					try {
						document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<','&lt;').replace('>','&gt;').replace(' & ',' &amp; ');
					}
					catch ( Exception ) { }
					
					// Add the scripts
					$scripts.each(function(){
						var $script = $(this), scriptText = $script.text(), scriptNode = document.createElement('script');
						scriptNode.appendChild(document.createTextNode(scriptText));
						contentNode.appendChild(scriptNode);
					});

					// Complete the change
					if ( $body.ScrollTo||false ) { $body.ScrollTo(scrollOptions); } // http://balupton.com/projects/jquery-scrollto 
					$body.removeClass('loading');
	
					// Inform Google Analytics of the change
					if ( typeof window.pageTracker !== 'undefined' ) {
						window.pageTracker._trackPageview(relativeUrl);
					}

					// Inform ReInvigorate of a state change
					if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
						reinvigorate.ajax_track(url);
						// ^ we use the full url here as that is what reinvigorate supports
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					document.location.href = url;
					return false;
				}
			}); // end ajax

		}); // end onStateChange


	}); // end onDomLoad

})(window); // end closure