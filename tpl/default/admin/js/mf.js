/* model field */
$(document).ready(function() {
	add_params($('select[name="f_type"]').val());
});
$('select[name="f_type"]').change(function() {
	add_params($(this).val());
});
/* show field params */
function add_params(f_type) {
	$('tr[params_for]').appendTo($('#extra_params'));
	$('tr[params_for*="' + f_type + '"]').appendTo($('#main_params'));
}

