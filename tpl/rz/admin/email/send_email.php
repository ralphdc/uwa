<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post" enctype="multipart/form-data">
<dl class="abox">
	<dt><strong>{-:@SEND_EMAIL-}</strong><span><a href="{-url:email/edit_option-}">{-:@EMAIL_OPTION-}</a></span><span><a href="{-url:email/edit_template-}">{-:@EMAIL_TEMPLATE-}</a></span></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputArea" colspan="2">
						<label><strong>{-:@RECIPIENT_EMAIL-}</strong> <input class="i required" type="text" value="{-:$_V['recipient_email']-}" name="recipient[email]" maxlength="255" size="30" /><span class="fc_r">*</span></label>
						<label><strong>{-:@RECIPIENT_NAME-}</strong> <input class="i" type="text" value="{-:$_V['recipient_name']-}" name="recipient[name]" maxlength="255" size="20" /></label>
					</td>
				</tr>
				<tr>
					<td class="inputArea" colspan="2">
						<label><strong>{-:@TITLE-}</strong> <input class="i" type="text" value="{-:@TITLE-}" name="title" maxlength="255" size="50" /></label>
						<label><strong>{-:@SELECT_TEMPLATE-}</strong> <select id="template_file">
						{-foreach:$_TL,$t-}
							<option value="{-url:email/send_email?template={$t['file']}-}"{-if:$t['file']==$_V['file']-} selected="selected"{-:/if-}>{-:$t['name']-}</option>
						{-:/foreach-}
						</select></label>
					</td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="editor" name="content">{-:$_V['content']-}</textarea>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@EMAIL_CONTENT_TIP-}
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputTitle">{-:@ATTACHMENT-} <span class="btn_l" id="add_attachment">{-:@ADD-}</span></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<table id="attachment_list">
							<tr>
								<td class="inputArea">
									<label><input type="file" name="attachment[]" /></label> <span class="btn_l delete_attachment">{-:@DELETE-}</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:email/send_email_do-}" to="#formEdit">{-:@SUBMIT-}</span>
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
	$('#add_attachment').click(function() {
		var str;
		str += '<tr>';
		str += '<td colspan="2" class="inputArea">';
		str += '<label><input type="file" name="attachment[]" /></label> <span class="btn_l delete_attachment">{-:@DELETE-}</span>';
		str += '</td>';
		str += '</tr>';
		$('#attachment_list').append(str);
	});
	$(document).on('click', '.delete_attachment', function() {
		$(this).parent().parent().remove();
	});
});
</script>
</body>
</html>