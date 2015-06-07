/* choose linkage */

$(document).ready(function() {
	$('.choose_linkage').bind('click', function() {
		var to_id = $(this).attr('to_id');
		dialog({
			url: url_choose_linkage,
			data: {'linkage': $('#' + to_id).val()},
			title: l_choose_linkage,
			width: 600, height: 400,
			id:'OM' + to_id,
			onclose: function () {
				var linkage = this.returnValue.linkage;
				if('undefined' != typeof(linkage) && '' != linkage) {
					$('#' + to_id).val(linkage);
				}
			}
		}).showModal();
	});
});

