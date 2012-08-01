<?php
// browscap testing - jlh2199
// added 8/1/12
// needs CUIT vetting

$browser = null;
$browser = browscap_get_browser();
print '<!-- BROWSER INFO -->';
foreach($browser as $key=>$value) {
	print '<!-- ' . $key . ' = ' . $value . '-->';
}
print '<!-- END BROWSER INFO -->';

$is_mobile = FALSE;


if (
	($browser['ismobiledevice'] == 1) &&
	((strpos($browser['useragent'], 'iPad') == FALSE))


) {
	
		$is_mobile = TRUE;
}







if ($is_mobile === TRUE) {
	print '<!-- browser is mobile -->'; // switch theme
	
?>	
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
	
	
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/sites/all/themes/tmpltzr/css/mobile-specific.css" />
	
	
	<?php print $scripts; ?>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
	
	<!-- js assets for dashboard -->  
	<script type="text/javascript" src="http://postfog.org/assets/js/fetcher.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.cycle.all.pack.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.masonry.min.js"></script>
  <script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/jquery.scrollTo-1.4.2-min.js"></script>
  <script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/jquery.jcarousel.min.js"></script>
  
  
  <!-- mobile NOT WORKING must be some cache insanity-->
	<script type="text/javascript" src="/templatizer/sites/all/themes/tmpltzr/js/mobile.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('body').css('color', 'red');
	
	
	
	$('#mobile-switch-bar').click(function() {
	
	});
	
	
	$('#about-deans').click(function() {
			alert('click about');
	});
});
	</script>

	<!-- js assets for fonts.com custom font DIN -->
	<script type="text/javascript" src="http://fast.fonts.com/jsapi/83f34eca-2e88-4bbf-b358-062ac880084c.js"></script>
	
	<style>

/** 640 x 960 */

#mobile-wrapper {
	width: 640px;
	min-height: 960px
	background-color: black;
}

#mobile-menu {
	width: 500px;
	border: 1px solid black;
	float: left;
	background-color: yellow;
	height: 2000px;
}

#mobile-switch-bar {
	float: right;
	background-color: blue;
	width: 100px;
	height: 2000px;
	
}

#mobile-content {
	position: absolute;
	left: -2000px;
	height: 2000px;
	width: 600px;
	background-color: green;
	
}
	</style>
</head>
<body class="<?php print $body_classes;?>">

<div id="mobile-wrapper">
	<div id="mobile-menu">
		MENU HERE<br/>
		(non option)<br/>
		(non option)<br/>
		(non option)<br/>
		<a href="#" id="about-deans">ABOUT PAGE</a><br/>
		(non option)<br/>
		(non option)<br/>
		(non option)<br/>
		<a href="#" id="programs-page">PROGRAMS PAGE</a><br/>
		(non option)<br/>
		(non option)<br/>
		(non option)<br/>
	</div>
	<div id="mobile-switch-bar">
&lt;<br/>&lt;<br/>&lt;<br/>&lt;<br/>&lt;<br/>&lt;<br/>&lt;<br/>&lt;<br/>
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

<body class="<?php print $body_classes;?>">

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
						<input id="search-button" type="image" src="http://www.experimentsinmotion.com/images/search.png">
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
			
			<div id="tmpltzr">
				<?php print $content; ?>
				<div id="right-sidebar"></div>
			</div>
				
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