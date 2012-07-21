<?php //wrapper div with Page Wrapper color code based on color-code taxonomy
	$terms = taxonomy_node_get_terms_by_vocabulary($node, 10); // vid=10 => program
		if(!empty($terms)) {
			foreach ($terms as $term){
				$program = ' '.$term->name;
			}
		} 
?>

<?php if(!empty($node->field_external_link[0]['view'])){ ?>
		<a class="term-index-term gray<?php if($program){ print $program; } ?>" href="<?php print $node->field_external_link[0]['url']; ?>" title="<?php print $node->field_external_link[0]['title']; ?>" target="_blank">
			<?php //wrapper div with Page Wrapper color code based on color-code taxonomy
				$terms = taxonomy_node_get_terms_by_vocabulary($node, 11); // vid=9 => color-code
					if(!empty($terms)) {
						foreach ($terms as $term){
							print $term->name . ' ';
						}
					} 
				print $node->field_external_link[0]['title'];
			?>
		</a>
<?php } ?>
	


