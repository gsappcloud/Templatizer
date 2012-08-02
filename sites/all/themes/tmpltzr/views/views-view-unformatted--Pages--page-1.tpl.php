<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>


<?php foreach ($rows as $id => $row): ?>

<?php
$pos = strpos($row, 'tmpltzr-module-') + 15;
$sizeClass = 'width-'. substr($row, $pos, 3) . ' ';
?>
	

  <div class="<?php print $sizeClass; print $classes[$id]; ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>