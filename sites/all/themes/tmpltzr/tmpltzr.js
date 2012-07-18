$(document).ready(function() {
  
  gsappFetcher.start();
  
  
  var view = $('#tmpltzr .view-content').html();
  view = '<textarea>' + '<div id="tmpltzr">' + view + '</div><!-- /#tmpltzr -->' + '</textarea>';
  $('#copy-paste').append(view);
  
  
  /*
  
  

embedded-event-date-box north-america

#tmpltzr .north-america {
	color:#00D6FF;
}

#tmpltzr .latin-america {
	color:#00E652;
}

#tmpltzr .none {

}

#tmpltzr .south-asia {
	color:#FF9E00;
}

#tmpltzr .middle-east {
	color:#FF00A6;
}

#tmpltzr .africa {
	color:#008AFF;
}

#tmpltzr .europe {
	color:#AD20FF;
}

#tmpltzr .asia {
	color:#FF555A;
}

#tmpltzr .other {
	color:gray;
}

*/
  
  
  
  
  
});