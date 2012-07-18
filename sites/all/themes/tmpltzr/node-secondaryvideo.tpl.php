<?php if (!$page){ ?>
<div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-secondary tmpltzr-secondaryvideo node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
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
  	

<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>
</div> <!-- /.node -->