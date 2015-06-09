<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_CONTENT-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="content_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CT_TITLE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@GROUP-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="default" name="content_group" maxlength="32" size="16"> <span class="fc_gry">{-:@CT_GROUP_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="50" name="content_display_order" maxlength="10" size="4"> <span class="fc_gry">{-:@CT_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CONTENT-} <span class="fc_gry">{-:@CT_CONTENT_TIP-}</span></td>
				<td class=""></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<textarea class="editor" name="content_content" style="width:95%;height:240px;"></textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@KEYWORDS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="" name="content_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					{-:@CT_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="content_description" style="width:360px;height:60px;"></textarea>
				</td>
				<td class="inputTip">
					{-:@CT_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:content/add_content_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:single_page/list_single_page-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=content-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=content-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=content&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=content&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>