/* finder */
$('.finder').bind('click', function() {
	var to_id = $(this).attr('to'), preview_id = $(this).attr('preview');
	if('yes' == $(this).attr('multi_upload')) {
		window.KCFinder = {
			callBackMultiple: function(files) {
				window.KCFinder = null;
				$(to_id).value = '';
				for(var i = 0; i < files.length; i++) {
					$(to_id).val($(to_id).val() + files[i] + "\r\n");
					if(preview_id) {
						$(preview_id).attr('src', files[i]);
					}
				}
			}
		};
	}
	else {
		window.KCFinder = {
			callBack : function(url) {
				window.KCFinder = null;
				$(to_id).val(url);
				if(preview_id) {
					$(preview_id).attr('src', url);
				}
			}
		};
	}
	if('all' == $(this).attr('typeset')) {
		window.open(finder_browse_url_all,
			'finder', 'status=0, toolbar=0, location=0, menubar=0, ' +
			'directories=0, resizable=1, scrollbars=0, width=800, height=600');
	}
	else if('image' == $(this).attr('typeset')) {
		window.open(finder_browse_url_image,
			'finder', 'status=0, toolbar=0, location=0, menubar=0, ' +
			'directories=0, resizable=1, scrollbars=0, width=800, height=600');
	}
	else if('file' == $(this).attr('typeset')) {
		window.open(finder_browse_url_file,
			'finder', 'status=0, toolbar=0, location=0, menubar=0, ' +
			'directories=0, resizable=1, scrollbars=0, width=800, height=600');
	}
});

