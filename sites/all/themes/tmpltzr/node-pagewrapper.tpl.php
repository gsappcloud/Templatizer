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