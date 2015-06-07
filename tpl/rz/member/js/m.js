/*s: member */
$(document).ready(function() {
	setInterval(function() { $('#uwa_now_time').html(new Date().toLocaleString()); }, 1000);
});
/*e: member */

/*s: select all */
$('.select_all').bind('click', function() {
	var flag = $(this).prop('checked');
	$('input[name^="' + $(this).attr('to') + '"]').prop('checked', flag);
});
/*e: select all */

/*s: toggle tr */
$('.toggle_tr').click(function() {
	$('[p_id='+$(this).attr('toggle_tr_id')+']').toggle();
});
/*e: toggle tr */

