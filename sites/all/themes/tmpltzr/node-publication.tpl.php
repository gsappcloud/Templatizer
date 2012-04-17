<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clearfix">
  <?php endif;?>

<?php //dsm($node); ?>

  <div class="content">
  
  	<?php if(!empty($node->field_thumbnail)){ ?>
  		<div class="publication-listing-image">
  			<?php print $node->field_thumbnail[0]['view']; ?>
  		</div>
  	<?php } ?>

  	<div class="publication-description">
  		<a name="<?php print $title  ?>" id="<?php print $title ?>" title="<?php print $title ?>" class="publication-title"><?php print $title ?></a>
  	
  		<?php if(!empty($node->field_credits)){ ?>
			<div class="publication-credit">
				<?php print $node->field_credits[0]['view']; ?>
			</div>
		<?php } ?>
	
		<?php if(!empty($node->content['body']['#value'])){ ?>
			<div class="publication-body">
				<?php print $node->content['body']['#value']; ?>
			</div>
		<?php } ?>
	
		<?php if(!empty($node->field_information)){ ?>
			<div class="publication-information">
				<?php print $node->field_information[0]['view']; ?>
			</div>
		<?php } ?>
		
		<?php if(!empty($node->field_issuu_link)){ ?>
			<div class="publication-link">
				<?php print '<a href=""' . $node->field_issuu_link[0]['view'] . '" target="_blank">Look inside</a>'; ?>
			</div>
		<?php } ?>
		<?php if(!empty($node->field_buy_link)){ ?>
			<div class="publication-link">
				<?php print '<a href=""' . $node->field_buy_link[0]['view'] . '" target="_blank">Buy this book</a>'; ?>
			</div>
		<?php } ?>
	</div><!-- .publication-description -->
  </div><!-- .content -->


<?php if (!$page): ?>
  </article> <!-- /.node -->
<?php endif;?>
