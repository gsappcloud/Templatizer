<?php
// browscap testing - jlh2199
// added 8/1/12
// needs CUIT vetting

$browser = null;
$browser = browscap_get_browser();
$is_mobile = FALSE;

// evaluate request URI to force mobile or desktop content
// used only for ajax requests
$r_uri = null;
$r_uri = $_SERVER["REQUEST_URI"];
$strpos_mobile_true = strpos($r_uri, 'mobile=true');
$strpos_mobile_false = strpos($r_uri, 'mobile=false');


if ($strpos_mobile_false > 0) {
	// force non-mobile theme
	$is_mobile = FALSE;
} else if ($strpos_mobile_true > 0) {
	$is_mobile = TRUE;
} else if ( 
	// run regular browser detection
	($browser['ismobiledevice'] == 1) &&
	((strpos($browser['useragent'], 'iPad') == FALSE))
	// add more clauses here as they come up
) {
		$is_mobile = TRUE;
}


// force theme based on mobile detection
if ($is_mobile === TRUE) { ?>	
<!DOCTYPE html>
<html class="" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" xml:lang="<?php print $language->language; ?>"> 
<head>
	<title>m: <?php print $head_title; ?></title>
	<?php print $head; ?>
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
	<?php print $styles; ?>
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/html-elements.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/tabs.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/gsapp.css" />
	<!--[if IE]>
	  <link rel="stylesheet" href="<?php print $includes_dir; ?>/ie.css" type="text/css">
	<![endif]-->
	<!--[if IE 6]>
	  <link rel="stylesheet" href="<?php print $includes_dir; ?>/ie6.css" type="text/css">
	<![endif]-->
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/mobile-specific.css" />

	<?php print $scripts; ?>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
	
	<!-- js assets for dashboard -->  
	<script type="text/javascript" src="http://postfog.org/assets/js/fetcher.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.cycle.all.pack.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.masonry.min.js"></script>
  <script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/jquery.scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/jquery.jcarousel.min.js"></script>
  
  
  <!-- mobile  js -->
	<script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/mobile.js"></script>

	<!-- js assets for fonts.com custom font DIN -->
	<script type="text/javascript" src="http://fast.fonts.com/jsapi/83f34eca-2e88-4bbf-b358-062ac880084c.js"></script>
</head>
<body class="<?php print $body_classes;?>">
<div id="mobile-wrapper">
	<div id="mobile-header">
		<a href="http://postfog.org/templatizer?mobile=true">
			<div id="gsapp-logo" class="mobile-header-item">
			<img src="/templatizer/sites/all/themes/tmpltzr/assets/mobile/gsapp-logo_237x49.jpg" width="237" height="49" alt="GSAPP logo" />
			</div>
		</a>
		<a href="http://news.gsapp.org">
			<div id="gsapp-news"  class="mobile-header-item">
				<img src="/templatizer/sites/all/themes/tmpltzr/assets/mobile/gsapp_news_83x81.jpg" width="83" height="81" alt="GSAPP News" />
			</div>
		</a>
		<div id="gsapp-search"  class="mobile-header-item">
			<img src="/templatizer/sites/all/themes/tmpltzr/assets/mobile/search_56x54.jpg" width="56" height="54" alt="Search" />
		</div>
		<div id="gsapp-login"  class="mobile-header-item">
			<a href="#">Login</a>
		</div>
	</div>
	<div id="mobile-menu">
	<?php
	global $previous_depth;
	$previous_depth = 1;

	function print_children($item) {
		global $previous_depth;
		if ($item['link']['depth'] > $previous_depth) {
			print '<ul>';
		} elseif ($item['link']['depth'] < $previous_depth) {
			$levels = $previous_depth - $item['link']['depth'];
			for ($x = 0; $x < $levels; $x++) {
				print '</ul></li>';
			}
		}
		if ($item['link']['has_children'] > 0) {
			if ($item['link']['depth'] != 1) {
				print '<li class="menu-level-' . $item['link']['depth'] .
				' children child"><a href="' . $item['link']['link_path'] . '">' . 
				$item['link']['title'] . '</a>';
			} else {
				print '<li class="menu-level-' . $item['link']['depth'] .
				' children"><a href="' . $item['link']['link_path'] . '">' . 
				$item['link']['title'] . '</a>';

}
		
			$previous_depth = $item['link']['depth'];
			foreach($item['below'] as $k=>$v) {
				print_children($v, $level);
			}
		} else {
		
					if ($item['link']['depth'] != 1) {
			print '<li class="menu-level-' . $item['link']['depth'] . ' child">' . 
				'<a href="' . $item['link']['link_path'] . '">' . 
				$item['link']['title'] . '</a>';
			
			} else {
			
						print '<li class="menu-level-' . $item['link']['depth'] . '">' . 
				'<a href="' . $item['link']['link_path'] . '">' . 
				$item['link']['title'] . '</a>';

}
		
	
			$previous_depth = $item['link']['depth'];
		}	
	}

	$pl = menu_tree_all_data('primary-links');
	print '<ul>';
	
	

	foreach($pl as $key=>$value) {
		
		print_children($value);
		
	}
	
	
	
	print '</ul>';
	
	
	?>
	
		<ul>
			<li><a href="#" id="about-deans">ABOUT</a></li>
			<li><a href="#" id="programs-page">PROGRAMS</a></li>
			<li><a href="#" >STUDIO-X-GLOBAL</a></li>
			<li><a href="#" >CENTERS</a></li>
		</ul>			
	</div>
	<div id="mobile-switch-bar">
		<div>
		<img src="/templatizer/sites/all/themes/tmpltzr/assets/mobile/view_page_arrow_26x33.jpg" width="26" height="33" alt="VIEW PAGE" />
		<img src="/templatizer/sites/all/themes/tmpltzr/assets/mobile/view_page_26x155.jpg" width="26" height="155" alt="VIEW PAGE" />
		<img src="/templatizer/sites/all/themes/tmpltzr/assets/mobile/view_page_arrow_26x33.jpg" width="26" height="33" alt="VIEW PAGE" />
		</div>
	</div>
	<div id="mobile-content">
		<?php print $content; ?>
	</div>
</div>

<?php print $closure; ?>

</body>
</html>

	
<?php	

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
//             STANDARD, NON MOBILE BROWSER
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------


} else {
	print '<!-- non mobile browser, return stock theme -->';
?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if gt IE 8]> <!--> <html class="" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" xml:lang="<?php print $language->language; ?>"> <!--<![endif]-->

<head>
	<title><?php print $head_title; ?></title>
	<?php print $head; ?>
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
	
	<?php print $styles; ?>
		<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/html-elements.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/tabs.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/gsapp.css" />
	
	<link type="text/css" rel="stylesheet" media="print" href="/templatizer/sites/all/themes/tmpltzr/css/print.css" />
	
	
	<!--[if IE]>
	  <link rel="stylesheet" href="<?php print $includes_dir; ?>/ie.css" type="text/css">
	<![endif]-->
	
	<!--[if IE 6]>
	  <link rel="stylesheet" href="<?php print $includes_dir; ?>/ie6.css" type="text/css">
	<![endif]-->

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php print $scripts; ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
	
	<!-- js assets for dashboard -->  
	<script type="text/javascript" src="http://postfog.org/assets/js/fetcher.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.cycle.all.pack.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.masonry.min.js"></script>
  <script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/jquery.scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/jquery.jcarousel.min.js"></script>


	
	<!-- js assets for fonts.com custom font DIN -->
	<script type="text/javascript" src="http://fast.fonts.com/jsapi/83f34eca-2e88-4bbf-b358-062ac880084c.js"></script>
	
</head>

<body class="<?php if($is_mobile === TRUE) { print 'mobile '; }?><?php print $body_classes;?>">

	<!-- .wrapper -->
	<div class="wrapper <?php print (array_intersect(array('Faculty','TA','Student','Director','Alumni'),$user->roles) ? 'faculty' : ''); ?>">

		<!-- #menu -->
		<section id="menu">
			<header id="header">
				<a href="<?php print base_path(); ?>" title="<?php print t('Home'); ?>" id="gsapplogo">
          			<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        		</a>
			
				<div id="search-login-container">
					<form id="search" method="get" action="search/" class="clearfix">
						<input id="q" name="q" type="text">
						<input id="search-button" type="image" src="/templatizer/sites/all/themes/tmpltzr/assets/search.png">
					</form>
					
					<?php if (!$user->uid): ?>
						<div id="login"><?php print l("Login", "user/wind"); ?></div>
					<?php else:?>
						<div id="login"><?php print l("My Site", "my-site"); ?></div>
					<?php endif; ?>
				</div>

			</header>
			
			<nav id="navigation">
				<?php print $left; ?>
			</nav><!-- #navigation -->
  
		</section><!-- #menu -->

		<!-- #content -->
		<section id="content" class="clearfix">
			<?php if ($tabs): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
			<?php print $messages . $help . $header; ?>
			<!--starttmpltzr-->
			<div id="tmpltzr">
					<?php print $content; ?>
			</div>
			<!--endtmpltzr-->
				
			<!-- Footer -->
			<footer id="footer">
				<?php $block_copyr = module_invoke('copyright', 'block', 'view', 7); ?>
				<div id="footer-inner" class="clearfix"><?php print $footer . $block_copyr['content'] ; ?></div>
			</footer><!-- /#footer -->
		</section><!-- /#content -->
	</div><!-- .wrapper -->

<?php print $closure; ?>

</body>
</html>

<?php } // end browser check 
?>