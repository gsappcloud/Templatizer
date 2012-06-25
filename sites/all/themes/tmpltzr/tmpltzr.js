$(document).ready(function() {
  var view = $('#tmpltzr .view-content').html();
  view = '<textarea>' + view + '</textarea>';
  $('#copy-paste').append(view);
});