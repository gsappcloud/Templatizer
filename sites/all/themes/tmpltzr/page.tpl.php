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
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/css/html-elements.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/css/tabs.css" />
	<link type="text/css" rel="stylesheet" media="all" href="/templatizer/css/gsapp.css" />
	<link type="text/css" rel="stylesheet" media="print" href="/templatizer/css/print.css" />
	
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