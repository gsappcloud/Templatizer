$(document) .ready(function () {
    /* menu */

	

	var resizeFunc = function(){
		var ww = window.innerWidth;
		if(ww >= 1250){
			$('#three_col_rt #content').css('width', '780px');
			$('#tmpltzr .tmpltzr-secondary').parent('.views-row').css('float', 'right');
			
			//$('#tmpltzr .tmpltzr-primary').css('float', 'left');
		}else{
			$('#three_col_rt #content').css('width', '520px');
			//$('#tmpltzr .tmpltzr-secondary').css('float', 'none');
			//$('#tmpltzr .tmpltzr-primary').css('float', 'none');
			$('#tmpltzr .tmpltzr-secondary').parent('.views-row').css('float', 'left');
			
		}
	}
	resizeFunc();
	$(window).resize(resizeFunc);
	
	/*
		Function to test for any primaryquarter modules and make sure they don't
		migrate to the top the way secondary modules do
	*/
	var isEven = false;
	$('#tmpltzr .tmpltzr-primaryquarter').each(function(index){	
		if(index == 0){
			if($(this).parent('.views-row').hasClass('views-row-even')){
				$(this).parent('.views-row').css('clear', 'both');
				isEven = true;
			}else{
				$(this).parent('.views-row').css('clear', 'both');
			}
		}else{
			if(isEven){
				$(this).parent('.views-row-even').css('clear', 'both');
			}else{
				$(this).parent('.views-row-odd').css('clear', 'both');
			}
		}
	});
   
});