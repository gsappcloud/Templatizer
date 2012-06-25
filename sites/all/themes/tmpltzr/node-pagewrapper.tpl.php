<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS PAGE</a>
	</div>
<?php } ?>

<?php if(!empty($node->field_page_title[0]['view'])){ ?>
	<h3 class="title"><?php print $node->field_page_title[0]['view']; ?></h3>
<?php } ?>


<?php
	$viewName = 'Pages';
	$display_id = 'page_1';
	print views_embed_view($viewName, $display_id, $node->nid);
?>

<footer id="page-wrapper-footer">
	<div id="gsapp-url">
		<h4>GSAPP website url:</h4>
		<?php print $node->field_url[0]['view']; ?>
	</div>
	<div id="copy-paste">
		<h4>Copy-paste the code below into the GSAPP website:</h4>
	</div>
</div>