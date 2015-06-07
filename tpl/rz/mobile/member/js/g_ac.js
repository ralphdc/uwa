/* get archive channel select */

$(document).ready(function() {
	$('.channel_select').each(function() {
		var container_id = $(this).attr('id'),
			archive_model_id = $(this).attr('archive_model_id'),
			archive_channel_id = $($(this).attr('to')).val();
		get_channel_select(container_id, archive_model_id, archive_channel_id, 'current');
	});
});

/* listen channel_select change */
$(document).on('change', '.channel_select select', function() {
	$(this).nextAll().remove();
	var container_id = $(this).parent().attr('id'),
		archive_model_id = $(this).parent().attr('archive_model_id'),
		archive_channel_id = $(this).val();

	if('' != archive_channel_id) {
		get_channel_select(container_id, archive_model_id, archive_channel_id, 'sub');
		archive_channel_id = $(this).parent().children().last().val();
	}
	else {
		archive_channel_id = ('' != $(this).parent().children().eq(-2).val() ? $(this).parent().children().eq(-2).val() : 0);
	}

	$($(this).parent().attr('to')).val(archive_channel_id);
});

/* get archive channel select */
function get_channel_select(container_id, archive_model_id, archive_channel_id, select_type) {
	$.getJSON(url_get_channel_select + '&archive_model_id=' + archive_model_id + '&archive_channel_id=' + archive_channel_id + '&select_type=' + select_type + '&' + Math.random(), function(result) {
		if(1 == result.data) {
			if('sub' == select_type) {
				$('#' + container_id).append(result.info);
			}
			else if('current' == select_type) {
				$('#' + container_id).html(result.info);
			}
		}
		else if('' != result.info) {
			//alert(result.info);
		}
	});
}
