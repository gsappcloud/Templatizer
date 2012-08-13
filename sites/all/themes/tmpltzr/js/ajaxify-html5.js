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
	
		var collapseMenu = function($this){
			var selector = '';
			var classes = $this.parent('li').attr('class');
			var levelIdx = classes.indexOf('menu-level-') + 11;
			var level = classes.substring(levelIdx, levelIdx+1);
			
			
			
			for(i = 0; i <= MAX_MENU_LEVELS; i++){
				selector = '#navigation ul li.menu-level-'+i;
				$(selector).removeClass('expanded').removeClass('active-trail').addClass('collapsed');
				$(selector).children('a').css('color','');
				selectorArrow = selector + ' .menu-arrow-large, ' + selector + ' .menu-arrow-small';
				$(selectorArrow).css('backgroundPosition', '');
			}
			
			return level;
		};
	
	
		var menuParser = function($this){	
			var level = collapseMenu($this);			
			$('a.active').removeClass('active');

			//in case of redirect to a lower item, like About > Dean's Statement
			if($this.parent('li').children('ul.menu').length > 0){
				$this.parent('li').children('ul.menu').children('li').each(function(){
					if( $this.attr('href') == $(this).children('a').attr('href')){
						$(this).children('a').addClass('active');
					}else{
						$this.addClass('active');
					}
				});
			}else{
				$this.addClass('active');
			}
			//assign classes to menu items clicked and higher in the tree
			$('a.active').parents('li').addClass("expanded").removeClass("collapsed").addClass("active-trail");
			
			//make each .active-trail element white
			$('a.active').parents('li').each(function(){
				$(this).children('a:eq(0)').css('color','white');
			});
		}
		
		
		// Ajaxify Helper - binds function to menu clicks that are internal links
		$.fn.ajaxify = function(){
			// Prepare
			var $this = $(this);
						
			// Ajaxify
			$this.find('a:internal:not(#gsapplogo)').click(function(event){ //exempt GSAPP Logo so it reloads everything
				// Prepare
				var
					$this = $(this),
					url = $this.attr('href'),
					title = $this.attr('title')||null;
				
				// Continue as normal for cmd clicks etc
				if ( event.which == 2 || event.metaKey ) { return true; }
				menuParser($this);
				
				$parent = $this.parent('li')
				if($parent.hasClass('leaf')){
					$('.menu-arrow-small',$parent).css('backgroundPosition', '-9px 0');
				}
				
				// Ajaxify this link
				History.pushState(null,title,url);
				event.preventDefault();
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