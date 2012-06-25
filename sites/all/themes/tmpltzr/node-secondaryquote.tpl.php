<?php if (!$page): ?>
<div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-secondary tmpltzr-secondaryquote node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php endif; ?>
	
<?php dsm($node->field_title); ?>
<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-secondary scalable node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> <?php if($node->field_scalable[0]['view']){ print 'scalable'; } ?> clearfix">
<?php endif; ?>
	
	<?php if(!empty($node->field_quote)){ ?>
  		<div class="tmpltzr-quote">
  			<?php print $node->field_quote[0]['view']; ?>
  		</div>
  	<?php } ?>
  	

<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>

</div> <!-- /.node -->

	
	
	<?php 
	// You must include this next line
	global $user;

	// if visitor is not logged in
	if ($user->uid) { ?>
  		<div class="tmpltzr-edit">
		<a href="<?php print $node_url ?>" title="<?php print $title ?>">EDIT THIS SECTION</a>
		</div>
	<?php } ?>

<?php if (!$page): ?>
  </article> <!-- /.node -->
<?php endif;?>
