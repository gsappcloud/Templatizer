<?php if ($user->uid == 1 || $user->uid == 4 || $user->uid == 5 || $user->uid == $node->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS PAGE</a>
	</div>
<?php } dsm($node);?>




<?php //wrapper div with Page Wrapper color code based on color-code taxonomy
	print '<div class="';
    $terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
		if(!empty($terms)) {
        	foreach ($terms as $term){
            	print $term->name;
            }
        } else {
            print 'none';
        }      
        print '" >';       
?>
	<header id="global-header">
		<div></div>
	</header>

<?php if(!empty($node->field_page_title[0]['view'])){ ?>
	<div class="title-container">
		<h1><?php print $node->field_page_title[0]['view']; ?></h1>
	</div>
<?php } ?>

	<div id="main">
	<?php
	/*
		Use the "Page" view to pull in all the modules associated with this page
	*/
		$viewName = 'Pages';
		$display_id = 'page_1';
		print views_embed_view($viewName, $display_id, $node->nid);
	?>
	</div>
	<div id="right-sidebar"></div>

	<footer id="page-wrapper-footer">
		<div id="gsapp-url">
			<h4>GSAPP website url:</h4>
			<?php print $node->field_url[0]['view']; ?>
		</div>
		<div id="copy-paste">
			<h4>Copy-paste the code below into the GSAPP website:</h4>
		</div>
	</footer>

</div>




