<?php
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
		if(!empty($terms)) {
        	foreach ($terms as $term){
            	$color = $term->name;
            }
        }      
?>
<?php if (!$page){ ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-module-240 tmpltzr-primary tmpltzr-primaryquarter node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
	<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>
	

	
	<?php if(!empty($node->field_quarter_image[0]['view'])){ ?>
  		<div class="tmpltzr-image">
  			<?php print $node->field_quarter_image[0]['view']; ?>
  		</div>
  	<?php } ?>
	
	<div class="tmpltzr-title-container">
	<?php if(!empty($node->field_title[0]['view'])){ ?>
  		<h2>
  			<?php print $node->field_title[0]['view']; ?>
  		</h2>
  	<?php } ?>
  	

  	<?php if(!empty($node->field_subtitle[0]['view'])){ ?>
  		<div class="tmpltzr-subtitle">
  			<?php print $node->field_subtitle[0]['view']; ?>
  		</div>
  	<?php } ?>
  	</div><!-- .tmpltzr-title-container -->
  	
  	
  	<?php if(!empty($node->field_body[0]['view'])){ ?>

  		<div class="tmpltzr-body">
  			<?php print $node->field_body[0]['view']; ?>
  		</div>
  	<?php } ?>
	
	

<?php printEditSectionFooter($user->uid, $node->uid, $node->nid, node_url); ?>
</div> <!-- /.node -->
