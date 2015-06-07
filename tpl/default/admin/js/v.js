/* vote */
function append_vote_option_set(data) {
	var str,
		k;
	if(0 == $('#vote_option_set li').length) {
		k = 0;
	}
	else {
		k = Number($('#vote_option_set li:last').attr('k')) + 1;
	}
	str = '<li k="'+ k +'" class="a">\r\n';
	str += '<p><textarea name="v_option_set['+ k +'][description]" class="i required" style="width:260px;height:40px;" placeholder="'+ l_description +'" >' + data + '</textarea> </p>\r\n';
	str += '<p><input type="text" name="v_option_set['+ k +'][link]" value="http://" size="40" class="i" placeholder="'+ l_link +'" /></p>\r\n';
	str += '<p><input type="text" name="v_option_set['+ k +'][votes]" value="0" size="6" class="i required" placeholder="'+ l_votes +'" /></p>\r\n';
	str += '<p><span class="btn_l delete">'+ l_delete +'</span></p>\r\n';
	str += '</li>';
	$('#vote_option_set').append(str);
}

$('#add_vote_option').bind('click', function() {
	append_vote_option_set(l_description);
});

$(document).on('click', '#vote_option_set li span.delete', function() {
	$(this).parent().parent().remove();
});
