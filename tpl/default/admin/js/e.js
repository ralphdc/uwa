/* extension */
$('#get_hashcode').bind('click', function() {
	var e_alias = $('input[name="e_alias"]').val(),
		e_author = $('input[name="e_author"]').val(),
		e_author_email = $('input[name="e_author_email"]').val();
	$.getJSON(url_get_extension_hashcode+'&e_alias='+e_alias+'&e_author='+e_author+'&e_author_email='+e_author_email+'&'+Math.random(), function(result) {
		$('#e_hashcode').text(result).show();
		$('input[name="e_hashcode"]').val(result);
	});
});

/* toggle field */
$('.toggle_field').bind('click', function() {
	var flag = $(this).prop('checked');
	if(flag) {
		$('#'+$(this).attr('to2')).hide();
		$('#'+$(this).attr('to1')).show();
	}
	else {
		$('#'+$(this).attr('to1')).hide();
		$('#'+$(this).attr('to2')).show();
	}
});

