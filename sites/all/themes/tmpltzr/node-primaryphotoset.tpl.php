<?php if (!$page){ ?>
<div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-primary tmpltzr-primaryphotoset node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>
	
	<?php if(!empty($node->field_images)){ ?>
  		<div class="tmpltzr-photoset">
  		<?php $count = 0; ?>
  		<?php foreach($node->field_images as $photo){ ?>
  			<div class="tmpltzr-image <?php if($count != 0){ echo 'image-hidden'; } ?> <?php echo 'image-'.$count; ?>">
  				<?php print $photo['view']; ?>
  			</div>
  			<?php $count = $count + 1; } ?>
  		</div>
  	<?php } ?>
  	
  	<?php if(!empty($node->field_title)){ ?>
  		<div class="tmpltzr-title">
  			<?php print $node->field_title[0]['view']; ?>
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