/* add archive channel */

$(document).ready(function() {
	$('.channel_select').each(function() {
		var container_id = $(this).attr('id'),
			archive_model_id = $(this).attr('archive_model_id'),
			archive_channel_id = $($(this).attr('to')).val();
		get_channel_select(container_id, archive_model_id, archive_channel_id, 'current');
	});
});

$(document).on('change', 'select[name="archive_model_id"]', function() {
	$('#ac_parent_id_channel_select').html('');
	$($('#ac_parent_id_channel_select').attr('to')).val('');
	$('#ac_parent_id_channel_select').attr('archive_model_id', $(this).val());
	get_channel_select("ac_parent_id_channel_select", $(this).val(), 0, "current");
	get_tpl($(this).val());
	get_parent_html_dir(0);
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
		archive_channel_id = ('' == $(this).parent().children().eq(-2).val() ? $(this).parent().children().eq(-2).val() : 0);
	}

	$($(this).parent().attr('to')).val(archive_channel_id);
	get_model(archive_channel_id);
	get_parent_html_dir(archive_channel_id);
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
/* get archive model template */
function get_tpl(archive_model_id) {
	$.getJSON(url_get_tpl + '&archive_model_id=' + archive_model_id + '&' + Math.random(), function(result) {
		if(1 == result.data) {
			var k, s, tpls = result.info;
			for(k in tpls) {
				$('input[name="' + k + '"]').val(tpls[k]);
			}
		}
	});
}
/* get archive model */
function get_model(archive_channel_id) {
	$.getJSON(url_get_model + '&archive_channel_id=' + archive_channel_id + '&' + Math.random(), function(result) {
		if(1 == result.data) {
			var archive_model_id = result.info;
			$('select[name="archive_model_id"] option[value="' + archive_model_id + '"]').attr('selected','selected'); /* select model */
			get_tpl(archive_model_id);
		}
	});
}
/* get parent html dir */
function get_parent_html_dir(archive_channel_id) {
	$.getJSON(url_get_html_dir+'&archive_channel_id=' + archive_channel_id + '&' + Math.random(), function(result) {
		if(1 == result.data) {
			$('input[name="ac_parent_dir"]').val(result.info);
			$('#ac_parent_dir').html(result.info);
		}
	});
}