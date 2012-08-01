$(document).ready(function() {
  
  var view = $('#tmpltzr .view-content').html();
  view = '<textarea>' + '<div id="tmpltzr">' + view + '</div><!-- /#tmpltzr -->' + '</textarea>';
  $('#copy-paste').append(view);
  
  
});