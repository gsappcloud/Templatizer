<?php
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
		if(!empty($terms)) {
        	foreach ($terms as $term){
            	$color = $term->name;
            }
        }      
?>
<?php if (!$page){ ?>
<div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-module-500 tmpltzr-primary tmpltzr-primaryphotoset node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>
	
	<?php if(!empty($node->field_images)){ ?>
		<div class="tmpltzr-photoset-container">
  			<ul id="tmpltzr-photoset-<?php print $node->nid; ?>" class="tmpltzr-photoset">
  			<?php $count = 0; ?>
  			<?php foreach($node->field_images as $photo){ ?>
  				<li class="tmpltzr-image <?php echo 'image-'.$count; ?>">
  				<?php print $photo['view']; ?>
  				</li>
  				<?php $count = $count + 1; } ?>
  			</ul>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->field_title)){ ?>
  		<h2>
  			<?php print $node->field_title[0]['view']; ?>
  		</h2>
  	<?php } ?>
	
	<?php if(!empty($node->field_caption)){ ?>
  		<div class="tmpltzr-caption">
  			<?php print $node->field_caption[0]['view']; ?>
  		</div>
  	<?php } ?>
  	

<?php printEditSectionFooter($user->uid, $node->uid, $node->nid, node_url); ?>
</div> <!-- /.node -->