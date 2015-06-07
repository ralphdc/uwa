/* common */

/* view more */
$(document).on('click', '#viewMore', function (e) {
	e.preventDefault();
	var to = $(this).attr('to'),
		nextPage = $(this).attr('nextpage') + '&type=clip';
	$.get(nextPage, function(data){
		$(to).append(data);
	});
});
