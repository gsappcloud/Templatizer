<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
<?php endif; ?>


    <?php if (!$page): ?>
      <header>
        <h1><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h1>
      </header>
	<?php endif; ?>

  <div class="content">
    <?php print $content ?>
  </div>

  

<?php if (!$page): ?>
  </article> <!-- /.node -->
<?php endif;?>
