<?php
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
		if(!empty($terms)) {
        	foreach ($terms as $term){
            	$color = $term->name;
            }
        }      
?>
<?php if (!$page){ ?>
<div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-module-240 tmpltzr-secondary tmpltzr-secondaryembed node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>
	
	<?php if(!empty($node->field_html)){ ?>
  		<div class="tmpltzr-embed-html">
  			<?php print $node->field_html[0]['view']; ?>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->field_title)){ ?>
  		<h2>
  			<?php print $node->field_title[0]['view']; ?>
  		</h2>
  	<?php } ?>
	
	<?php if(!empty($node->field_body)){ ?>
  		<div class="tmpltzr-body">
  			<?php print $node->field_body[0]['view']; ?>
  		</div>
  	<?php } ?>
  	

<?php if ($user->uid == 1 || $user->uid == 4 || $user->uid == 5 || $user->uid == $node->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>
</div> <!-- /.node -->