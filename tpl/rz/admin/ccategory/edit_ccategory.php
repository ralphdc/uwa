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
	<dt><strong>{-:@EDIT_CCATEGORY-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_SPI['ccategory_title']-}" name="ccategory_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CCATEGORY_TITLE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@GROUP-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['ccategory_group']-}" name="ccategory_group" maxlength="32" size="16"> <span class="fc_gry">{-:@CCATEGORY_GROUP_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['ccategory_display_order']-}" name="ccategory_display_order" maxlength="10" size="4"> <span class="fc_gry">{-:@CCATEGORY_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			<!-- 
			<tr>
				<td class="inputTitle">{-:@CCATEGORY-} <span class="fc_gry">{-:@CCATEGORY_CCATEGORY_TIP-}</span></td>
				<td class=""></td>
			</tr>
			
			<tr>
				<td colspan="2" class="inputArea">
					<textarea class="editor" name="ccategory_ccategory" style="width:95%;height:240px;">{-:$_SPI['ccategory_ccategory']|htmlspecialchars~@me-}</textarea>
				</td>
			</tr>
			 -->
			<tr>
				<td class="inputTitle">{-:@KEYWORDS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['ccategory_keywords']-}" name="ccategory_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					{-:@CCATEGORY_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="ccategory_description" style="width:360px;height:60px;">{-:$_SPI['ccategory_description']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@CCATEGORY_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_SPI['ccategory_id']-}" name="ccategory_id">
	<span class="btn_b submit" action="{-url:ccategory/edit_ccategory_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:ccategory/list_ccategory-}">{-:@BACK-}</a>
	<!-- <label><input type="checkbox" name="build_now" value="1" checked="checked" /> {-:@BUILD_NOW-}</label>  -->
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
/*
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=ccategory-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=ccategory-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=ccategory&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=ccategory&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
	*/
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>