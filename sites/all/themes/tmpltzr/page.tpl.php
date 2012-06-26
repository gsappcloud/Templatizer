<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if gt IE 8]> <!--> <html class="" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <!--<![endif]-->
<head>
  <?php print $head; ?>
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />
  <title><?php print $head_title; ?></title>
  	<link type="text/css" rel="stylesheet" media="all" href="http://www.columbia.edu/cu/arch/tmpltzr/html-elements.css" />
	<link type="text/css" rel="stylesheet" media="all" href="http://www.columbia.edu/cu/arch/tmpltzr/tabs.css" />
	<link type="text/css" rel="stylesheet" media="all" href="http://www.columbia.edu/cu/arch/tmpltzr/gsapp.css" />
	<link type="text/css" rel="stylesheet" media="print" href="http://www.columbia.edu/cu/arch/tmpltzr/print.css" />
  
  <?php print $styles; ?>
  <?php print $scripts; ?>
  
  
  <script type="text/javascript" src="http://postfog.org/assets/js/fetcher.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.cycle.all.pack.js"></script>
  <script type="text/javascript" src="http://postfog.org/assets/js/jquery.masonry.min.js"></script>
  <script type="text/javascript" src="http://www.columbia.edu/cu/arch/tmpltzr/gsapp.js"></script>


  
  
  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body class="<?php print $body_classes; ?>">

  <div class="wrapper clearfix">

    <header id="header" role="banner" class="clearfix">
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>
      
      <?php print $header; ?>
      
      <?php if ($search_box): ?><?php print $search_box ?><?php endif; ?>
      
      <img id="searchBar" src="/templatizer/sites/default/files/assets/searchBar.png" />
      
    </header> <!-- /#header -->

    <section id="content" role="main" class="clearfix">
    	<div id="one_col_lt" class="left_outer">
    		<?php if (!empty($left)): ?>
        		<?php print $left; ?>
		    <?php endif; ?>
    	</div>
    	<div id="three_col_rt">
    		<div id="content">
    			<div id="tmpltzr">
      				<!-- #content -->
      				<?php print $content; ?>
      				<!-- /#content -->
      			</div>
    		
    		</div>
    </section> <!-- /#main -->

    <?php if (!empty($right)): ?>
      <aside id="sidebar-right" role="complementary" class="sidebar clearfix">
        <?php print $right; ?>
      </aside> <!-- /sidebar-right -->
    <?php endif; ?>

    <footer id="footer" role="contentinfo" class="clearfix">
      <?php print $footer_message; ?>
      <?php if (!empty($footer)): print $footer; endif; ?>
      <?php print $feed_icons ?>
    </footer> <!-- /#footer -->

    <?php print $closure ?>

  </div> <!-- /#wrapper -->

</body>
</html>