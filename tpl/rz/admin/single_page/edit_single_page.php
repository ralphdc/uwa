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
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@EDIT_SINGLE_PAGE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_SPI['sp_title']-}" name="sp_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@SP_TITLE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@GROUP-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['sp_group']-}" name="sp_group" maxlength="32" size="16"> <span class="fc_gry">{-:@SP_GROUP_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['sp_display_order']-}" name="sp_display_order" maxlength="10" size="4"> <span class="fc_gry">{-:@SP_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@IS_HTML-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="sp_is_html"{-if:0==$_SPI['sp_is_html']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="sp_is_html"{-if:1==$_SPI['sp_is_html']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputArea">
					<span class="fc_gry">{-:@SP_IS_HTML_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TEMPLATE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="sp_tpl" class="required i" type="text" value="{-:$_SPI['sp_tpl']-}" name="sp_tpl" maxlength="96" size="30"> <span class="btn_l choose_template" base_dir="home" to_id="sp_tpl">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@SP_TPL_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@HTML_NAMING-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['sp_html_naming']-}" name="sp_html_naming" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_gry">{-:@SP_HTML_NAMING_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CONTENT-} <span class="fc_gry">{-:@SP_CONTENT_TIP-}</span></td>
				<td class=""></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<textarea class="editor" name="sp_content" style="width:95%;height:240px;">{-:$_SPI['sp_content']|htmlspecialchars~@me-}</textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@KEYWORDS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['sp_keywords']-}" name="sp_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					{-:@SP_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="sp_description" style="width:360px;height:60px;">{-:$_SPI['sp_description']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@SP_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_SPI['single_page_id']-}" name="single_page_id">
	<span class="btn_b submit" action="{-url:single_page/edit_single_page_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:single_page/list_single_page-}">{-:@BACK-}</a>
	<label><input type="checkbox" name="build_now" value="1" checked="checked" /> {-:@BUILD_NOW-}</label>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=single_page-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=single_page-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=single_page&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=single_page&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
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