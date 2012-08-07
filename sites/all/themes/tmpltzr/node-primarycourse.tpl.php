<?php
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
		if(!empty($terms)) {
        	foreach ($terms as $term){
            	$color = $term->name;
            }
        }      
?>

<?php if (!$page) { ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-module-500 tmpltzr-primary tmpltzr-primarycourse node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
	<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>
	
	<?php if(!empty($node->field_code[0]['view'])){ ?>
  		<div class="tmpltzr-course-code">
  			<?php print $node->field_code[0]['view']; ?>
  		</div>
  	<?php } ?>
  	
  	<h2>
		<?php print $title; ?>
	</h2>
	
	<?php if(!empty($node->field_instructor[0]['view'])){ ?>
  		<div class="tmpltzr-course-instructor">
  			<?php print $node->field_instructor[0]['view']; ?>
  		</div>
  	<?php } ?>
  	

  	<?php if(!empty($node->field_course_points[0]['view'])){ ?>
  		<div class="tmpltzr-course-points">
  			<?php print $node->field_course_points[0]['view']. ' Points'; ?>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->content['body']['#value'])){ ?>
  	
  		<div class="tmpltzr-body">
  			<?php print $node->content['body']['#value']; ?>
  		</div>
  	<?php } ?>
	
	

<?php if ($user->uid == 1 || $user->uid == 4 || $user->uid == 5 || $user->uid == $node->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>
</div> <!-- /.node -->