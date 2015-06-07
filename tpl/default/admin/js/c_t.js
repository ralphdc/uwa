/* choose template */

$(document).ready(function() {
	$('.choose_template').bind('click', function() {
		var to_id = $(this).attr('to_id'),
			base_dir = $(this).attr('base_dir');
		dialog({
			url: url_choose_template_file + '&base_dir=' + base_dir,
			data: {'templateFile': $('#' + to_id).val()},
			title: l_choose_template,
			width: 600, height: 400,
			id:'OM' + to_id,
			onclose: function () {
				var templateFile = this.returnValue.templateFile;
				if('undefined' != typeof(templateFile) && '' != templateFile) {
					$('#' + to_id).val(templateFile);
				}
			}
		}).showModal();
	});
});

