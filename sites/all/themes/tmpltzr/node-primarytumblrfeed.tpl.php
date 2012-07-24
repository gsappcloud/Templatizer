<?php
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
		if(!empty($terms)) {
        	foreach ($terms as $term){
            	$color = $term->name;
            }
        }      
?>

<?php if (!$page) { ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-primary tmpltzr-primarytumblrfeed node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
	<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>
	
	<?php if(!empty($node->field_image[0]['view'])){ ?>
  		<div class="tmpltzr-image">
  			<?php print $node->field_image[0]['view']; ?>
  		</div>
  	<?php } ?>

<div id="tumblr-results">
	&nbsp;</div>
<script type="text/javascript">
	<?php 
		if(!empty($node->field_tumblr_post_count[0]['view'])){ 
			print 'gsappFetcher.setTumblrPosts('.$node->field_tumblr_post_count[0]['view'].');';
		} else {
			print 'gsappFetcher.setTumblrPosts(10);';
		}
		
		try{
			 if(!empty($node->field_feed_url[0]['view'])){ 
				print 'gsappFetcher.getTumblr("'.$node->field_feed_url[0]['view'].'");';
			 }else{
				throw new Exception('Invalid Tumblr feed URL');
			 }
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	?>
</script>
	
	

<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS SECTION</a>
	</div>
<?php } ?>
</div> <!-- /.node -->