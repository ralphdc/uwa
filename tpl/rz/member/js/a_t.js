/* archive thematic */
$('#add_thematic_node').bind('click', function() {
	var str,
		k;
	if(0 == $('#thematic_node_set li').length) {
		k = 1;
	}
	else {
		k = Number($('#thematic_node_set li:last').attr('k')) + 1;
	}
	str = '<li k="'+ k +'" class="a bg_gry_l">\r\n';
	str += '	<input name="a_t_node['+ k +'][name]" size="20" value="'+ l_node_name + k +'" class="i required" placeholder="'+ l_node_name +'" />'
	str += '	<input name="a_t_node['+ k +'][alias]" size="10" value="alias'+ k +'" class="i" placeholder="'+ l_node_alias +'" />'
	str += '	<span class="btn_l choose_archive" to_id="node_archive_'+ k +'">'+ l_choose_archive +'</span>'
	str += '	<span class="btn_l delete">'+ l_delete_node +'</span>';
	str += '	<div class="archive_set" to_id="node_archive_'+ k +'"></div>';
	str += '	<input id="node_archive_'+ k +'" name="a_t_node['+ k +'][archive_set]" type="hidden" value="" />'
	str += '</li>';
	$('#thematic_node_set').append(str);
});

$(document).on('click', '#thematic_node_set li span.delete', function() {
	$(this).parent().remove();
});