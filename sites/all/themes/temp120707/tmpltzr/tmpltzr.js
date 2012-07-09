$(document).ready(function() {
  
  gsappFetcher.start();
  
  
  var view = $('#tmpltzr .view-content').html();
  view = '<textarea>' + view + '</textarea>';
  $('#copy-paste').append(view);
  
	
  
  
  
});