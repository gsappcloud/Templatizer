<?php
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
	if(!empty($terms)) {
		foreach ($terms as $term){
			$color = $term->name;
		}
	}    
	
	$sidebar = false;
	if(!empty($node->field_sidebar)){
		if($node->field_sidebar[0]['view'] == 'Yes'){
			$sidebar = true;
		}
	}

?>
<?php if (!$page){ ?>
<div id="node-<?php print $node->nid; ?>" class="tmpltzr-module <?php if($sidebar){ print 'tmpltzr-module-240 tmpltzr-secondary-float'; }else{ print 'tmpltzr-module-500'; } ?> tmpltzr-secondary tmpltzr-secondaryvideo node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>
	
	<?php if(!empty($node->field_embedded_video_sec)){ ?>
  		<div class="tmpltzr-embed-video">
  			<?php print $node->field_embedded_video_sec[0]['view']; ?>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->field_embedded_flickr_set_sec)){ ?>
  		<div class="tmpltzr-embed-flickr">
  			<?php print $node->field_embedded_flickr_set_sec[0]['view']; ?>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->field_caption)){ ?>
  		<div class="tmpltzr-caption">
  			<?php print $node->field_caption[0]['view']; ?>
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
  	

<?php printEditSectionFooter($user->uid, $node->uid, $node->nid, node_url); ?>
</div> <!-- /.node -->