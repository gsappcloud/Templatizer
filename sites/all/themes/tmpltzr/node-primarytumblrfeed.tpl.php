<?php
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 9); // vid=9 => color-code
		if(!empty($terms)) {
        	foreach ($terms as $term){
            	$color = $term->name;
            }
        }      
?>

<?php if (!$page) { ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-module-500 tmpltzr-primary tmpltzr-primarytumblrfeed node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
	<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>

	<?php if(!empty($node->field_title[0]['view'])){ ?>
  		<h2>
  			<?php print $node->field_title[0]['view']; ?>
  		</h2>
  	<?php } ?>

<div id="tumblr-results" class="tumblr-results-wrapper">
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
	
<?php if(!empty($node->field_feed_url[0]['view'])){ ?>
	<div class="tumblr-blog-url">
		<?php print '<a href="'.$node->field_feed_url[0]['view'].'" target="_blank">Click for more updates</a>'; ?>
	</div>
<?php } ?>	
	

<?php printEditSectionFooter($user->uid, $node->uid, $node->nid, node_url); ?>
</div> <!-- /.node -->