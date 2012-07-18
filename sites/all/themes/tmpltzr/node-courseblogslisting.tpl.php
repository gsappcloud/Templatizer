<?php if ($user->uid) { ?>
	<div class="tmpltzr-edit">
		<a href="http://postfog.org/templatizer/node/<?php print $node->nid; ?>/edit" title="<?php print $node_url; ?>">EDIT THIS PAGE</a>
	</div>
<?php } ?>

<div class="title-container">
	<h3 class="title"><?php print $title; ?></h3>
</div>


<div id="fixed-header">
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
            			print '<li><a class="term-index-term">' . $term->name . '</a></li>';
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
	    		$terms_semester = taxonomy_node_get_terms_by_vocabulary($node, 14); // vid=14 => Year and Semester
				if(!empty($terms_semester)) {
        			foreach ($terms_semester as $term){
            			print '<li><a class="term-index-term">' . $term->name . '</a></li>';
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
		$start = strlen($semester->name) - 4;
		$year = substr($semester->name , $start);
		$term = substr($semester->name , 0, $start - 1);
		
		print "<h4>".$term." ".$year."</h4>";
		print views_embed_view('courseblogs', 'page_1', $year, $term);
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






