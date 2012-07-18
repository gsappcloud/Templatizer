<?php if (!$page){ ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-primary tmpltzr-primaryquarter node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
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
	
	

<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>
</div> <!-- /.node -->
