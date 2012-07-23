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
	<link type="text/css" rel="stylesheet" media="all" href="<?php print $includes_dir; ?>/html-elements.css" />
	<link type="text/css" rel="stylesheet" media="all" href="<?php print $includes_dir; ?>/tabs.css" />
	<link type="text/css" rel="stylesheet" media="all" href="<?php print $includes_dir; ?>/gsapp.css" />
	<link type="text/css" rel="stylesheet" media="print" href="<?php print $includes_dir; ?>/print.css" />
	
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
	<script type="text/javascript" src="<?php print $includes_dir; ?>/gsapp.js"></script>
	<script type="text/javascript" src="<?php print $includes_dir; ?>/ccwidget.js"></script>
	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
	
	<!-- js assets for dashboard -->  
	<script type="text/javascript" src="<?php print $includes_dir; ?>/fetcher.js"></script>
	<script type="text/javascript" src="<?php print $includes_dir; ?>/jquery.cycle.all.pack.js"></script>
	<script type="text/javascript" src="<?php print $includes_dir; ?>/jquery.masonry.min.js"></script>
	<script type="text/javascript" src="<?php print $includes_dir; ?>/jquery.scrollTo-1.4.2-min.js"></script>
	<script type="text/javascript" src="<?php print $includes_dir; ?>/jquery.jcarousel.min.js"></script>
	
	<script type="text/javascript"> 
	  google.load('search', '1', {language : 'en'});
	  google.setOnLoadCallback(function() {
		var customSearchOptions = {};
		var customSearchControl = new google.search.CustomSearchControl(
		  '004033327063740628517:awygqf_dy3q', customSearchOptions);
		customSearchControl.setResultSetSize(google.search.Search.SMALL_RESULTSET);
		customSearchControl.draw('cse');
	  }, true);
	</script>
	
	<!-- js assets for fonts.com custom font DIN -->
	
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
			
				<div id="search-container">
					<div id="searchbar">
						<div id="cse">Loading search</div>
					</div>
				</div>
				
				<?php if (!$user->uid): ?>
					<div id="login"><?php print l("Login", "user/wind"); ?></div>
				<?php else:?>
					<div id="login"><?php print l("My Site", "my-site"); ?></div>
				<?php endif; ?>
			
			</header>
			
			<nav id="navigation">
				<?php print $navigation_main; ?>
			</nav><!-- #navigation -->
  
		</section><!-- #menu -->

		<!-- #content -->
		<section id="content" class="clearfix">
			<?php if ($tabs): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
			<?php print $messages . $help . $header; ?>
			
			<div id="tmpltzr">
				<?php print $content; ?>
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