// https://gist.github.com/854622
(function(window,undefined){
	// Prepare our Variables
	var
		History = window.History,
		$ = window.jQuery,
		document = window.document,
		TOGGLE_TIME = 500,
		templatizer = true;

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
		
		
		
		
		
		
		
		
		
		
		/* 	function: level()
		 *	Returns the menu level of the item
		*/
		$.fn.level = function(){
			var classes = $(this).closest('.menu').attr('class');
			var levelIdx = classes.indexOf('level-') + 6;
			return classes.substring(levelIdx, levelIdx+1);
		}
		
		
		/* 	function: internalRedirect()
		 *	Checks if the selected menu item redirects to an item in a lower menu with
		 *	a different parent.
		*/
		$.fn.internalRedirect = function($active){
			
			var thisHREF = $(this).attr('href');
			if(templatizer == true){
				var idx = thisHREF.indexOf('templatizer');
				thisHREF = thisHREF.substring(idx + 12); // offset by: templatizer/
			}else{
				var idx = thisHREF.indexOf('/', 1);
				thisHREF = thisHREF.substring(idx + 1); // offset by: /
			}
			thisHREF = thisHREF.substring(0,4);
			
			var activeHREF = $active.closest('.level-1').closest('li').children('a').attr('href');
			if(activeHREF != undefined){
				if(templatizer == true){
					idx = activeHREF.indexOf('templatizer');
					activeHREF = activeHREF.substring(idx + 12); // offset by: templatizer/
				}else{
					idx = activeHREF.indexOf('/', 1);
					activeHREF = activeHREF.substring(idx + 1); // offset by: /
				}
				activeHREF = activeHREF.substring(0,4);
				if( ( thisHREF != undefined ) && (activeHREF != undefined) ){
					if( thisHREF != activeHREF ){
						return thisHREF;
					}else{
						return false;
					}
				}else{
					return false;
				}
			
			}else{
				return false;
			}
			return false;
		}
		
		
		/* 	function: digRedirect()
		 *	Checks if the selected menu item redirects to an item in a nested menu.
		*/
		$.fn.digRedirect = function(){
			var returnval = false;
			var href = $(this).attr('href');
			var $menu = $(this).parent('li').children('.menu');
			
			if( $menu.length > 0 ){
				$menu.children('li').each(function(){
					if( href == $(this).children('a').attr('href') ){
						returnval = $(this).children('a');
					}
				});
				
			}
			return returnval;
		}
		
		/* 	function: hideMenu()
		 *	Hide the menu (but don't change the active settings)
		*/
		$.fn.hideMenu = function(){
			
		}
		
		/* 	function: scrollMenu()
		 *	Scrolls the menu to the branch two levels above
		*/
		$.fn.scrollMenu = function(){
			$branch = $(this).closest('.level-1').parent('li');
			
			var $target;
			if( $branch.hasClass('first') ){
				$target = $branch.children('a:eq(0)');
			}else if( $branch.prev().hasClass('first') ){
				$target = $branch.prev().children('a:eq(0)');
			}else{
				$target = $branch.prev().prev().children('a:eq(0)');
			}
			
			$target = $branch.children('a:eq(0)');
			$('#menu').scrollTo( $target, 500 );	
		}
		
		/* 	function: expandBranch()
		 *	Expand the menu and add active settings.
		*/
		$.fn.expandBranch = function(internalRedirect){
			var $clicked = $(this);
			var selector = 'a[href="' + $clicked.attr('href') + '"]';
			$('#navigation .menu:eq(0)').children('li').each(function(){
				var href = $(this).children('a').attr('href');
				if( href.indexOf(internalRedirect) > 0){					
					$(this).find(selector).parents('li').each(function(){
						$(this).removeClass('collapsed').addClass('expanded active-trail');
						$(this).children('a').css('color', 'white');
						if($(this).hasClass('leaf')){
							$(this).children('.menu-arrow-small').css('backgroundPosition','-9px 0');
						}else{
							$(this).children('.menu-arrow-large, .menu-arrow-small').css('backgroundPosition','0 0');
						}
						
						$(this).children('.menu').slideToggle(TOGGLE_TIME);
					});	
					$(this).find(selector).addClass('active');
					$(this).find(selector).scrollMenu();
					return false;
				}
			});
			
			
		}
		
		/* 	function: expandMenus()
		 *	Expands all the menus above $(this) and adds active settings.
		*/
		$.fn.expandMenus = function(){
			$(this).parents('li').removeClass('collapsed').addClass('expanded active-trail');
			
			$(this).parents('li').each(function(){
				if($(this).hasClass('leaf')){
					$(this).children('.menu-arrow-small').css('backgroundPosition','-9px 0');
				}else{
					$(this).children('.menu-arrow-large, .menu-arrow-small').css('backgroundPosition','0 0');
				}
				$(this).children('a:eq(0)').css('color', 'white');
				if( !( $(this).children('.menu').is(':visible') ) ){
					$(this).children('.menu').slideToggle(TOGGLE_TIME);
				}
			});
			$(this).addClass('active').css('color', 'white');
		}
		
		/* 	function: expandMenu()
		 *	Expand the menu and add active settings.
		*/
		$.fn.expandMenu = function(){
			$(this).parent('li').removeClass('collapsed').addClass('expanded active-trail');
			var $parent = $(this).parent('li');
			if($parent.hasClass('leaf')){
				$parent.children('.menu-arrow-small').css('backgroundPosition','-9px 0');
			}else{
				$parent.children('.menu-arrow-large, .menu-arrow-small').css('backgroundPosition','0 0');
			}
			$(this).addClass('active').css('color', 'white');
			
			$(this).parent('li').children('.menu').slideToggle(TOGGLE_TIME);
		}
		
		/* 	function: collapseMenus()
		 *	Collapse all menus lower in the DOM than $(this) except the immediate child.
		*/
		$.fn.collapseMenus = function(){
			$(this).children('.menu').find('li').each(function(){
				$(this).collapseMenu();
			});
		}
		
		
		/* 	function: collapseMenuInterval()
		 *	Collapse all menus lower in the DOM than $(this) except the immediate child.
		*/
		$.fn.collapseMenuInterval = function($active, lev){
			$this = $(this);
			
			if(lev < 0){
				$active.parents('li').each(function(){
					if( $(this).children('a:eq(0)').get(0) === $this.get(0) ){
						return false;
					}else{
						$(this).collapseMenu();
					}
				});
			}else{
				$active.parents('li').each(function(){
					if( $(this).level() >= lev ){
						$(this).collapseMenu();
					}
				});
			}
			
		
		
		}
		

		/* 	function: collapseMenu()
		 *	Collapse the menu and remove active settings.
		*/
		$.fn.collapseMenu = function(){
			$(this).removeClass('expanded').removeClass('active-trail').addClass('collapsed');
			$(this).children('a').css('color','');
			$(this).children('.menu-arrow-large, .menu-arrow-small').css('backgroundPosition', '');
			$(this).children('.menu:visible').slideToggle(TOGGLE_TIME);
		}
		
		/* 	function: collapseBranch()
		 *	Collapse the branch above $(this).
		*/
		$.fn.collapseBranch = function(){
			$(this).parents('li.active-trail').each(function(){	
				$(this).collapseMenu();
			});
		}
		
		/* 	function: _is_branch()
		 *	Checks if the selected menu item is in the same branch as the current.
		 *
		 *	$active: the active menu link (anchor).
		*/
		$.fn._is_branch = function($active){
			var returnval = false;
			$(this).parents('li').each(function(){
				if( $(this).hasClass('active-trail') ){
					returnval = true;
				}
			});
			return returnval;
		}
		
		/* 	function: dig()
		 *	This function is called when a menu or item deeper within the current menu
		 *	is selected. It checks for hard-wired redirects and internal-redirects.
		*/
		$.fn.dig = function($active){
			safelog('called dig');
			var $redir = $(this).digRedirect();
			if($active != undefined){
				var internalRedir = $(this).internalRedirect($active);
			}else{
				var internalRedir = false;
			}
			
			if( $redir != false ){
				/*	
				*/
				safelog('redirecting');
				$(this).parent('li').addClass('redirect-active');
				$redir.expandMenus();
				setCurrentState(3);
			}else if( internalRedir != false ){
				/*	
				*/
				safelog('internal redirecting');
				$active.collapseBranch();
				$(this).expandBranch(internalRedir);
				setCurrentState(1);
			}else{
				/* dig code here */
				safelog('digging');
				$(this).expandMenu();
				setCurrentState(1);
			}	
			if($active != undefined){
				$active.removeClass('active');
			}
		}
		
		/* 	function: _is_dig()
		 *	Checks if the selected menu item is in a menu in the active-trail path or not.
		 *
		 *	$active: the active menu link (anchor).
		*/
		$.fn._is_dig = function($active){
			if($(this)._is_branch($active) && ( $(this).level() > $active.level() ) ){
				return true;
			}else{
				return false;
			}
		}
		
		/* 	function: sibling()
		 *	This function is called when the selected item is a sibling of the active item.
		*/
		$.fn.sibling = function($active){
			var $redir = $(this).digRedirect();
			if($active != undefined){
				var internalRedir = $(this).internalRedirect($active);
			}else{
				var internalRedir = false;
			}
			var currentState = getCurrentState();
			
			if( $redir != false ){
				/*	
				*/
				safelog('sibling redirecting');
				$active.parent('li').collapseMenu();
				$(this).parent('li').addClass('redirect-active');//add it to the list item
				$redir.expandMenus();
				$active.removeClass('active');
				setCurrentState(3);
			}else if( internalRedir != false ){
				/*	
				*/
				safelog('sibling internal redirecting');
				$active.collapseBranch();
				if($active != undefined){
					$active.removeClass('active');
				}
				$(this).expandBranch(internalRedir);
				if( (currentState == 'redirect') ){
					$('.redirect-active').removeClass('redirect-active');
				}
				setCurrentState(1);
			}else{
				/* dig code here */
				safelog('sibling digging');
				$active.parent('li').collapseMenu();
				$(this).expandMenu();
				if($active != undefined){
					$active.removeClass('active');
				}
				if( currentState == 'home'){
					setCurrentState(1);
				}
			}	
		}
		
		
		/* 	function: _is_sibling()
		 *	Checks if the selected menu item a sibling of the currently active item.
		 *
		 *	$active: the active menu link (anchor).
		*/
		$.fn._is_sibling = function($active){
			safelog('active href: ' + $active.attr('href'));
			safelog('sib test, this href: ' + $(this).parent('li').parent('.menu').parent('li').children('a:eq(0)').attr('href'));
			safelog('sib test, active href: ' + $active.parent('li').parent('.menu').parent('li').children('a:eq(0)').attr('href'));
			if( $(this).parent('li').parent('.menu').parent('li').children('a:eq(0)').attr('href') == $active.parent('li').parent('.menu').parent('li').children('a:eq(0)').attr('href')){
				safelog('is sibling!!');
				return true;
			}
			return false;
		}
		
		/* 	function: climb()
		 *	This function is called when a menu or item higher within the current menu
		 *	is selected. It checks for hard-wired redirects and internal-redirects.
		*/
		$.fn.climb = function($active){
			var $redir = $(this).digRedirect();
			if($active != undefined){
				var internalRedir = $(this).internalRedirect($active);
			}else{
				var internalRedir = false;
			}
			
			if( $redir != false ){
				/*	TODO
				*/
				safelog('climb redirecting');
				if( $(this).parent('li').hasClass('active-trail') ){
					$redir.collapseMenuInterval($active, $(this).level()+1 );
				}else{
					$(this).collapseMenuInterval($active, $(this).level() );
					$redir.expandMenus();
				}
				
				$(this).parent('li').addClass('redirect-active');
				setCurrentState(3);
			}else if( internalRedir != false ){
				/*
				*/
				safelog('climb internalRedir');
				$active.collapseBranch();
				$(this).expandBranch(internalRedir);
				setCurrentState(1);
			}else{
				/* climb code here */
				safelog('climb dig');
				
				if( $(this).parent('li').hasClass('active-trail') ){
					$(this).collapseMenuInterval($active, -1);
				}else{
					$(this).collapseMenuInterval($active, $(this).level() );
					$(this).expandMenu();
				}
				setCurrentState(1);
				$(this).addClass('active');
			}
			if($active != undefined){
				$active.removeClass('active');
			}	
		}
		
		/* 	function: _is_climb()
		 *	Checks if the selected item is in the tree above the current active item.
		 *
		 *	$active: the active menu link (anchor).
		*/
		$.fn._is_climb = function($active){
			if($(this)._is_branch($active) && ( $(this).level() < $active.level() ) ){
				return true;
			}else{
				return false;
			}
		}
		
		/* 	function: branch()
		 *	This function is called when the selected item is in a different top-level
		 *	menu.
		*/
		$.fn.branch = function($active){
			$(this).collapseMenuInterval($active, 0 );
			$active.removeClass('active');
			$active = undefined;
			$(this).dig($active);
		}
		
		/* 	function: menuToggleVisibility()
		 *	Toggles the visibility of the menu
		*/
		$.fn.menuToggleVisibility = function(){
			if( $(this).children('.menu').is(':visible') ){
				$(this).children('.menu-arrow-large').css('backgroundPosition', '-15px 0');
				$(this).children('.menu-arrow-small').css('backgroundPosition', '-9px 0');
			}else{
				$(this).children('.menu-arrow-large, .menu-arrow-small').css('backgroundPosition', '');
			}
			$(this).children('.menu').slideToggle(TOGGLE_TIME);
		}
		
		
		// Ajaxify Helper - binds function to menu clicks that are internal links
		$.fn.ajaxify = function(){	
			//Prepare 
			var $this = $(this);
			// Ajaxify
			$(this).find('a:internal:not(#gsapplogo)').click(function(event){ //exempt GSAPP Logo so it reloads everything
				safelog('***********CLICK');
				
				// Prepare
				var
					$this = $(this),
					$active = $('.active'),
					url = $this.attr('href'),
					fetch = true,
					title = $this.attr('title')||null;
				
				// Continue as normal for cmd clicks etc
				if ( event.which == 2 || event.metaKey ) { return true; }
				
				switch(getCurrentState()){
					case 'home':
						$this.dig($active);
						break;
					case 'menu':
						if( $this.hasClass('active') ){//clicked self
							if( !($this.parent('li').hasClass('leaf')) ){
								$this.parent('li').menuToggleVisibility();
							}
							fetch = false;
							break;
						}else if( $this._is_dig($active) ){
							safelog('MENU, this is dig');
							$this.dig($active);
						}else if( ($active != undefined) && $this._is_sibling($active) ){
							safelog('MENU, this is sibling');
							$this.sibling($active);
						}else if( ($active != undefined) && $this._is_climb($active) ){/* need to climb */
							safelog('MENU, this is climb');
							$this.climb($active);
						}else{
							safelog('MENU, this is branch');
							$this.branch($active);
						}
						break;
					case 'redirected':
						if( $this._is_dig($active) ){
							safelog('REDIRECT, this is dig');
							$this.dig($active);
						}else if( ($active != undefined) && $this._is_sibling($active) ){
							safelog('REDIRECT, this is sibling');
							$this.sibling($active);
						}else if( ($active != undefined) && $this._is_climb($active) ){/* need to climb */
							safelog('REDIRECT, this is climb');
							if( $this.parent('li').hasClass('redirect-active') ){
								$this.parent('li').menuToggleVisibility();
								fetch = false;
								break;
							}else if( ( $this.parent('li').hasClass('active-trail') ) && ($this.level() <= $('.redirect-active').level()) ){
								safelog('wrong!!');
								$('redirect-active').removeClass('redirect-active');
							}
							$this.climb($active);
						}else{
							safelog('REDIRECT, this is branch');
							$('redirect-active').removeClass('redirect-active');
							$this.branch($active);
						}
						break;
					default:
						safelog('error: the current state is not recognized');
						break;
				}
				
				
				if(fetch == true){
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