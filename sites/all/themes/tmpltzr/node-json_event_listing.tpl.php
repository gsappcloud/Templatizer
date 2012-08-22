<?php printEditPageHeader($user->uid, $node->uid, $node->nid, $node_url); ?>

<?php if (!$page) { ?>
  <div id="node-<?php print $node->nid; ?>" class="tmpltzr-module tmpltzr-module-500 tmpltzr-primary tmpltzr-jsoneventlisting node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php if ($color) { print ' '.$color; } ?> clearfix">
	<a id="<?php print $node->title; ?>" name="<?php print $node->title; ?>" class="anchorhash"></a>
<?php } ?>


    <?php if(!empty($node->field_title[0]['view'])){ ?>
  		<h2>
  			<?php print $node->field_title[0]['view']; ?>
  		</h2>
  	<?php } ?>

  <div class="content">
  	<?php
		$url = $node->field_json_url[0]['url'];
		print '<div id="event-output"></div>' .
			'<script type="text/javascript">' .
			'gsappFetcher.getEventData("'. $url . '?callback=?","#event-output");' .
			'</script>';
  	?>
  </div>

<?php if (!$page): ?>
  </div> <!-- /.node -->
<?php endif;?>
