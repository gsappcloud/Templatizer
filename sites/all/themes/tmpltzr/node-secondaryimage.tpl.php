<?php if (!$page): ?>
<div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-secondary tmpltzr-secondary-float tmpltzr-secondaryimage node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php endif; ?>
	
	<?php if(!empty($node->field_image)){ ?>
  		<div class="tmpltzr-image">
  			<?php print $node->field_image[0]['view']; ?>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->field_image_title)){ ?>
  		<div class="tmpltzr-title">
  			<?php print $node->field_image_title[0]['view']; ?>
  		</div>
  	<?php } ?>
	
	<?php if(!empty($node->field_caption)){ ?>
  		<div class="tmpltzr-caption">
  			<?php print $node->field_caption[0]['view']; ?>
  		</div>
  	<?php } ?>
  	

<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>

</div> <!-- /.node -->

