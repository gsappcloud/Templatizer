<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
<?php endif; ?>


    <?php if (!$page): ?>
      <header>
        <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
      </header>
	<?php endif; ?>

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
  </article> <!-- /.node -->
<?php endif;?>
