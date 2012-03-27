$(document).ready(function() {
  var view = $('#content-area').html();
  view = '<textarea>' + view + '</textarea>';
  $('#block-block-1').append(view);
  console.log(view);
});