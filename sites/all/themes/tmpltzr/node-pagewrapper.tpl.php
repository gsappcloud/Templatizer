<?php printEditPageHeader($user->uid, $node->uid, $node->nid, $node_url); ?>


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
	


	<?php if(!empty($node->field_image[0]['view'])){ ?>
  		<div class="tmpltzr-image">
  			<?php print $node->field_image[0]['view']; ?>
  		</div>
  	<?php } ?>
  	
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




