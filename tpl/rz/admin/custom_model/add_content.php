<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/{-:+lang-}.js"></script>
</head>

<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_CUSTOM_MODEL_CONTENT-}</strong></dt>
	<dd>
		<table class="formTable">
			{-:$_FI-}
			<tr>
				<td colspan="2" class="inputTitle">{-:@STATUS-}</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<label><input type="radio" value="0" name="status"> {-:@NOT_PASSED-}</label>
					<label><input type="radio" value="1" name="status" checked="checked"> {-:@PASSED-}</label>
					<label><input type="radio" value="2" name="status"> {-:@REFUNDED-}</label>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="custom_model_id" type="hidden" value="{-:$_CMI['custom_model_id']-}">
	<input name="cm_alias" type="hidden" value="{-:$_CMI['cm_alias']-}">
	<span class="btn_b submit" action="{-url:custom_model/add_content_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type={$_CMI['cm_alias']}-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type={$_CMI['cm_alias']}-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_CMI['cm_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_CMI['cm_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
	var editor_option_paging = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type={$_CMI['cm_alias']}-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type={$_CMI['cm_alias']}-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_CMI['cm_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_CMI['cm_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		extraPlugins : 'uwapaging'
	};
	$('.editor_paging').each(function(){
		CKEDITOR.replace(this, editor_option_paging);
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type={$_CMI['cm_alias']}-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type={$_CMI['cm_alias']}&watermark=yes-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type={$_CMI['cm_alias']}&watermark=yes&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type={$_CMI['cm_alias']}-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type={$_CMI['cm_alias']}-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type={$_CMI['cm_alias']}-}';

var url_get_linkage_select = '{-url:ajax/get_linkage_select-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/l.js"></script>
</body>
</html>