/* uploadify */
$(document).ready(function() {
	$('.uploader').each(function() {
		var btntext = $(this).attr('btntext'), to_id = $(this).attr('to'), preview_id = $(this).attr('preview'),  file_queue_id = $(this).attr('to') + '_file_queue',
			fileTypeDesc, fileTypeExts, uploader, multiUpload = false;
		if('all' == $(this).attr('typeset')) {
			fileTypeDesc = type_desc_all;
			fileTypeExts = file_type_exts_all;
			uploader = uploader_all;
		}
		else if('image' == $(this).attr('typeset')) {
			fileTypeDesc = type_desc_image;
			fileTypeExts = file_type_exts_image;
			uploader = uploader_image;
			if('yes' == $(this).attr('thumb')) {
				uploader = uploader_image_thumb;
			}
			else if('both' == $(this).attr('thumb')) {
				uploader = uploader_image_thumb_both;
			}
		}
		if('yes' == $(this).attr('multi_upload')) {
			multiUpload = true;
		}
		/* add uploadify file queue */
		file_queue_id = file_queue_id.replace('#', '');
		$(to_id).after('<div id="' + file_queue_id + '" class="uploadify-queue"></div>');
		$(this).uploadify({
			'buttonClass' : 'btn_upload', 'buttonImage' : '', 'fileObjName' : 'upload',
			'formData' : form_data,
			'swf' : uploadify_swf, 'queueID' : file_queue_id,
			'buttonText' : btntext, 'fileTypeDesc' : fileTypeDesc, 'fileTypeExts' : fileTypeExts,
			'uploader' : uploader, 'multi' : multiUpload, 'height' : 24, 'width' : 80,
			'onInit': function() {
				$('#' + file_queue_id).hide();
			},
			'onUploadStart' : function(file) {
				is_uploading = true;
			},
			'onUploadProgress' : function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
				//$(to_id).val(byte_format(totalBytesUploaded, 2) + '/' + byte_format(totalBytesTotal, 2));
			},
			'onUploadSuccess' : function(file, data, response) {
				if(multiUpload) {
					$(to_id).val($(to_id).val() + data + "\r\n");
				}
				else {
					$(to_id).val(data);
				}
				if(preview_id) {
					$(preview_id).attr('src', data);
				}
			},
			'onQueueComplete' : function(queueData) {
				is_uploading = false;
			},
			'onUploadError' : function(file, errorCode, errorMsg, errorString) {
				alert(errorString);
			}
		});
	});
});

