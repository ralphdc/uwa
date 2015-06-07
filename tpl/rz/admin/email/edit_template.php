<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><strong>{-:@SELECT_TEMPLATE-}</strong> <select id="template_file">
	{-foreach:$_TL,$t-}
		<option value="{-url:email/edit_template?template={$t['file']}-}"{-if:$t['file']==$_V['file']-} selected="selected"{-:/if-}>{-:$t['name']-}</option>
	{-:/foreach-}
	</select></label>
	<input name="template" type="hidden" value="{-:$t['file']-}">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:email/delete_template_do-}" to="#formSearch">{-:@DELETE-}</span>
</div><!--/.mainTips-->
</form>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="{-url:email/send_email-}">{-:@SEND_EMAIL-}</a></span><span><a href="{-url:email/edit_option-}">{-:@EMAIL_OPTION-}</a></span><strong>{-:@EMAIL_TEMPLATE-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputArea">
						<textarea class="editor" name="content">{-:$_V['content']-}</textarea>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@EMAIL_TEMPLATE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputArea" colspan="2">
						<label><strong>{-:@TEMPLATE_NAME-}</strong> <input class="i required" type="text" value="{-:$_V['name']-}" name="name" maxlength="255" size="20" /></label>
						<label><strong>{-:@TEMPLATE_FILE-}</strong> <input class="i required" type="text" value="{-:$_V['file']-}" name="file" maxlength="255" size="30" /></label>
					</td>
				</tr>
			</table>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:email/edit_template_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=site-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=site-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		width : 690, height : 210
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
	var editor_option_simple = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=site-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=site-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		toolbar : 'uwa_simple',
		width : 640, height : 210
	};
	$('.editor_simple').each(function(){
		CKEDITOR.replace(this, editor_option_simple);
	});
});
</script>
<script>
$(document).ready(function() {
	$('#template_file').change(function() {
		var t = $(this).children('option:selected').val();
		window.location.href = t;
	});
});
</script>
</body>
</html>