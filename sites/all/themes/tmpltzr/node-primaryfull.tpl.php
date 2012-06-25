<?php dsm($node); ?>
<?php if (!$page): ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-primary tmpltzr-primaryfull node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
	<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php endif; ?>
	
	<?php if(!empty($node->field_image[0]['view'])){ ?>
<?php dsm($node->field_title); ?>
<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-primary node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
<?php endif; ?>
	
	<?php if(!empty($node->field_image)){ ?>
  		<div class="tmpltzr-image">
  			<?php print $node->field_image[0]['view']; ?>
  		</div>
  	<?php } ?>
	
	<?php if(!empty($node->field_title[0]['view'])){ ?>
	<?php if(!empty($node->field_title)){ ?>
  		<div class="tmpltzr-title">
  			<?php print $node->field_title[0]['view']; ?>
  		</div>
  	<?php } ?>
  	

  	<?php if(!empty($node->field_subtitle[0]['view'])){ ?>
  	<?php if(!empty($node->field_subtitle)){ ?>
  		<div class="tmpltzr-subtitle">
  			<?php print $node->field_subtitle[0]['view']; ?>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->field_body[0]['view'])){ ?>
  	<?php if(!empty($node->field_body)){ ?>
  		<div class="tmpltzr-body">
  			<?php print $node->field_body[0]['view']; ?>
  		</div>
  	<?php } ?>
	
	

<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>
</div> <!-- /.node -->
	
<?php if (!$page): ?>
	<div class="tmpltzr-edit">
		<a href="<?php print $node_url ?>" title="<?php print $title ?>">EDIT THIS SECTION</a>
	</div>
  </article> <!-- /.node -->
<?php endif;?>
