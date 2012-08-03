<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS PAGE</a>
	</div>
<?php } ?>




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


<?php 
	$pg = array(); //array to store all the programs this course might belong to
    $programs = taxonomy_node_get_terms_by_vocabulary($node, 10); // vid=10 => program
		if(!empty($programs)) {
        	foreach ($programs as $program){
            	$pg[] = $program->name;
            }
        }         
?>

<?php 
	$sm = array(); //array to store all the programs this course might belong to
    $semesters = taxonomy_node_get_terms_by_vocabulary($node, 2); // vid=2 => semester
		if(!empty($semesters)) {
        	foreach ($semesters as $semester){
            	$sm[] = $semester->name;
            }
        }      
           
?>


<?php if (!$page) { ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-module-500 tmpltzr-primary tmpltzr-courselisting node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
	<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>

<?php if(!empty($node->field_title[0]['view'])){ ?>
		<h2><?php print $node->field_title[0]['view']; ?></h2>
<?php } ?>
	
	<div class="course-listing">
	<?php
	/*
		Use the "Page" view to pull in all the modules associated with this page
	*/
		$viewName = 'course_listing_wrapper';
		$display_id = 'page_1';
		print views_embed_view($viewName, $display_id, $pg[0], $sm[0]);
	?>
	</div>
	


</div>




