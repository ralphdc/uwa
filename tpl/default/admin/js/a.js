/* archive */

/* Judgments the uniqueness of the archive */
$('input[name="a_title"]').blur(function() {
	var a_title = $(this).val();
	$.getJSON(url_check_duplicate_archive+'&a_title='+a_title+'&'+Math.random(), function(result) {
		if(1 == result.data) {
			dialog({
				quickClose: true,
				padding: '5px 10px',
				follow: document.getElementById('a_title'),
				content: '<a target="_blank" href="'+url_show_archive+'&archive_id='+result.info+'">'+l_archive_duplicate_tip+'</a>'
			}).show(document.getElementById('a_title'));
		}
	});
});
