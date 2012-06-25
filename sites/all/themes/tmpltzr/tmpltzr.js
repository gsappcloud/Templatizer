var head = document.getElementsByTagName('head')[0];
script = document.createElement('script');
script.src = "http://postfog.org/assets/js/jquery.masonry.min.js";
script.type = 'text/javascript';
head.appendChild(script);

script = document.createElement('script');
script.src = "http://postfog.org/assets/js/fetcher.js";
script.type = 'text/javascript';
head.appendChild(script);

script = document.createElement('script');
script.src = "http://postfog.org/assets/js/jquery.cycle.all.pack.js";
script.type = 'text/javascript';
head.appendChild(script);

$(document).ready(function() {
  
  gsappFetcher.start();
  
  
  var view = $('#tmpltzr .view-content').html();
  view = '<textarea>' + view + '</textarea>';
  $('#copy-paste').append(view);
  
	
  
  
  
});