<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS PAGE</a>
	</div>
<?php } ?>

<div id="fixed-header">
	<h1><?php print $title; ?></h1>



<?php 
	function applyRegionClass($term){
		switch($term){
			case 'Africa':
				return 'africa';
				break;
			case 'North America':
				return 'north-america';
				break;
			case 'Latin America':
				return 'latin-america';
				break;
			case 'Europe':
				return 'europe';
				break;
			case 'Middle East':
				return 'middle-east';
				break;
			case 'South Asia':
				return 'south-asia';
				break;
			case 'Asia':
				return 'asia';
				break;
			case 'Other':
				return 'other';
				break;
			default:
				return 'none';
				break;
			
		}
	}

?>


	<div id="program-list">	
		<h4>By Program:</h4>
		<ul class="term-list">
			<?php //list of Programs
	    		$terms = taxonomy_get_tree(10); // vid=10 => program
				if(!empty($terms)) {
        			foreach ($terms as $term){
            			print '<li><a class="term-index-term">' . $term->name . '</a></li>';
  		          	}
    	    	}       
			?>
			
		</ul><!-- .term-list -->
	</div><!-- #program-list -->
	<div id="region-list">	
		<h4>By Region:</h4>
		<ul class="term-list">
			<?php //list of Programs
	    		$terms = taxonomy_get_tree(12); // vid=12 => region
				if(!empty($terms)) {
        			foreach ($terms as $term){
            			print '<li><a class="term-index-term ' . applyRegionClass($term->name) .'">' . $term->name . '</a></li>';
  		          	}
    	    	}else{
    	    		print '<li>No terms</li>';
    	    	}    
			?>
			
		</ul><!-- .term-list -->
		<div id="x-affiliation"><span class="x-affiliated">X</span>Studio-X Affiliation</div>
	</div><!-- #region-list -->
	
	<div id="semester-list">	
		<h4>By Semester:</h4>
		<ul class="term-list">
			<?php //list of Programs
	    		$semesters = taxonomy_node_get_terms_by_vocabulary($node, 14); // vid=14 => Year and Semester
				if(!empty($semesters)) {
        			foreach ($semesters as $semester){
        				$start = strlen($semester->name) - 4;
						$year = substr($semester->name , $start);
						$term = substr($semester->name , 0, $start - 1);
            			print '<li><a class="term-index-term" href="'.$term."-".$year.'">' . $semester->name . '</a></li>';
  		          	}
    	    	}else{
    	    		print '<li>No terms</li>';
    	    	}    
			?>
			
		</ul><!-- .term-list -->
	</div><!-- #semester-list -->
	
	
	
	
</div><!-- #fixed-header -->
	





<div id="course-blogs-index-listing">
	<?php

	$semesters = taxonomy_node_get_terms_by_vocabulary($node, 14); // vid=14 => Year and Semester
	foreach ($semesters as $semester){
		if(!empty($semesters)) {
			$start = strlen($semester->name) - 4;
			$year = substr($semester->name , $start);
			$term = substr($semester->name , 0, $start - 1);
			
			print '<h2 id="'.$term."-".$year.'">'.$term." ".$year.'</h2>';
			print views_embed_view('courseblogs', 'page_1', $year, $term);
		}
	}
	?>
	
	</div>

	<footer id="page-wrapper-footer">
		<div id="gsapp-url">
			<h4>GSAPP website url:</h4>
			<?php print $node->field_url[0]['view']; ?>
		</div>
		<div id="copy-paste">
			<h4>Copy-paste the code below into the GSAPP website:</h4>
		</div>
	</footer>






