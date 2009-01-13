$(document).ready(function(){

	$('#aidform div.box').click(function() {

		$('#aidform div.box').removeClass('active')
		$('#aidform div.box').attr('checked','');
		$(this).addClass('active')
		
		$(this).children('input').attr('checked','checked');
	});

	$('#amount').keyup(function() {

		oldvalue = $(this).attr('value');
		$(this).attr('value',oldvalue.replace(/[a-zåäöü\"\'\@\#\¤\%\&\/\(\)\=\?\_\-\!\~\"\^]/ig,''));

	});


});
