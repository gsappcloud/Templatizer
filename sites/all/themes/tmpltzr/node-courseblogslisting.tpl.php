<div class="title-container">
	<h3 class="title"><?php print $title; ?></h3>
</div>


<div id="fixed-header">
	<div id="program-list">	
		<h5>By Program:</h5>
		<ul class="term-list">
			<?php //list of Programs
	    		$terms = taxonomy_get_tree(10); // vid=10 => program
				if(!empty($terms)) {
        			foreach ($terms as $term){
            			print '<li class="term-list-term">' . $term->name . '</li>';
  		          	}
    	    	}       
			?>
			
		</ul><!-- .term-list -->
	</div><!-- #program-list -->
	<div id="region-list">	
		<h5>By Region:</h5>
		<ul class="term-list">
			<?php //list of Programs
	    		$terms = taxonomy_get_tree(12); // vid=12 => region
				if(!empty($terms)) {
        			foreach ($terms as $term){
            			print '<li class="term-list-term">' . $term->name . '</li>';
  		          	}
    	    	}else{
    	    		print '<li>No terms</li>';
    	    	}    
			?>
			
		</ul><!-- .term-list -->
		<div>Studio-X Affiliation</div>
	</div><!-- #region-list -->
	
	<div id="semester-list">	
		<h5>By Semester:</h5>
		<ul class="term-list">
			<?php //list of Programs
	    		$terms = taxonomy_node_get_terms_by_vocabulary($node, 14); // vid=14 => Year and Semester
				if(!empty($terms)) {
        			foreach ($terms as $term){
            			print '<li class="term-list-term">' . $term->name . '</li>';
  		          	}
    	    	}else{
    	    		print '<li>No terms</li>';
    	    	}    
			?>
			
		</ul><!-- .term-list -->
	</div><!-- #semester-list -->
	
	
	
	
</div><!-- #fixed-header -->
	





<div>
	<?php
	/*
		Use the "Page" view to pull in all the modules associated with this page
	*/
	print 'testing';
		$viewName = 'courseblogs';
		$display_id = 'page_1';
		print views_embed_view($viewName, $display_id, 2012, spring);
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






