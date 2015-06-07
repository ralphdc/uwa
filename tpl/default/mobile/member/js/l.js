/* linkage */

$(document).ready(function() {
	$('.linkage').each(function() {
		var container_id = $(this).attr('id'),
			l_alias = $(this).attr('l_alias'),
			linkage_item_id = $($(this).attr('to')).val(),
			linkage_select;
		get_linkage_select(container_id, l_alias, linkage_item_id, 'current');
	});
});

function get_linkage_select(container_id, l_alias, linkage_item_id, select_type) {
	$.getJSON(url_get_linkage_select + '&l_alias=' + l_alias + '&linkage_item_id=' + linkage_item_id + '&select_type=' + select_type + '&' + Math.random(), function(result) {
		if(1 == result.data) {
			$('#' + container_id).append(result.info);
		}
		else if('' != result.info) {
			//alert(result.info);
		}
	});
}

/* listen linkage change */
$(document).on('change', '.linkage select', function() {
	$(this).nextAll().remove();
	var container_id = $(this).parent().attr('id'),
		l_alias = $(this).parent().attr('l_alias'),
		linkage_item_id = $(this).val();

	if('' != linkage_item_id) {
		get_linkage_select(container_id, l_alias, linkage_item_id, 'sub');
		linkage_item_id = $(this).parent().children().last().val();
	}
	else {
		linkage_item_id = $(this).parent().children().eq(-2).val();
	}

	$($(this).parent().attr('to')).val(linkage_item_id);
});
