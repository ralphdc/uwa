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
<script src="{-:*__PUBLIC__-}js/calendar/lang/zh-cn.js"></script>
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@EDIT_PRODUCT-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_SPI['product_title']-}" name="product_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@PRODUCT_TITLE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@GROUP-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['product_group']-}" name="product_group" maxlength="32" size="16"> <span class="fc_gry">{-:@PRODUCT_GROUP_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['product_display_order']-}" name="product_display_order" maxlength="10" size="4"> <span class="fc_gry">{-:@PRODUCT_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			
			<tr>
				<td class="inputTitle">{-:@PRODUCT-} <span class="fc_gry">{-:@PRODUCT_PRODUCT_TIP-}</span></td>
				<td class=""></td>
			</tr>
			<tr>
					<td class="inputTitle">{-:@THUMB-}</td>
					<td class="inputArea" rowspan="2">
					{-if:!empty($_AI['product_img'])-}
						<img id="product_img_preview" src="{-:$_AI['product_img']-}" width="160" />
					{-else:-}
						<img id="product_img_preview" src="{-:*__APP__-}u/site/no_thumb.png" width="160" />
					{-:/if-}
					</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="product_img" class="i" type="text" value="{-:$_AI['product_img']-}" name="product_img" maxlength="255" size="70">
						<input id="product_img_uploader" to="#product_img" preview="#product_img_preview" btntext="{-:@UPLOAD-}" typeset='image' thumb='yes' class="uploader" type="file" />
						<span id="product_img_finder" to="#product_img" preview="#product_img_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
					</td>
				</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<textarea class="editor" name="product_content" style="width:95%;height:240px;">{-:$_SPI['product_content']|htmlspecialchars~@me-}</textarea>
				</td>
			</tr>
			 
			<tr>
				<td class="inputTitle">{-:@KEYWORDS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_SPI['product_keywords']-}" name="product_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					{-:@PRODUCT_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="product_description" style="width:360px;height:60px;">{-:$_SPI['product_description']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@PRODUCT_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_SPI['product_id']-}" name="product_id">
	<span class="btn_b submit" action="{-url:product/edit_product_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:product/list_product-}">{-:@BACK-}</a>
	<!-- <label><input type="checkbox" name="build_now" value="1" checked="checked" /> {-:@BUILD_NOW-}</label>  -->
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>

$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=product-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=product-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=product&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=product&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
	var editor_option_paging = {
			filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type={$_AI['am_alias']}-}',
			filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type={$_AI['am_alias']}-}',
			filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
			filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
			extraPlugins : 'uwapaging'
		};
		$('.editor_paging').each(function(){
			CKEDITOR.replace(this, editor_option_paging);
		});
		
});
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
var url_choose_template_file = '{-url:template/choose_template_file-}',
l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
uploader_all = '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}-}',
uploader_image = '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes-}',
uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&thumb=yes-}',
uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type={$_AI['am_alias']}-}',
finder_browse_url_image = '{-url:finder/browse?typeset=image&type={$_AI['am_alias']}-}',
finder_browse_url_file = '{-url:finder/browse?typeset=file&type={$_AI['am_alias']}-}';

var url_get_linkage_select = '{-url:ajax/get_linkage_select-}';

var url_choose_template_file = '{-url:template/choose_template_file-}',
l_choose_template = '{-:@CHOOSE_TEMPLATE-}';

var url_choose_archive = '{-url:archive/choose_archive-}',
l_choose_archive = '{-:@CHOOSE_ARCHIVE-}';

var url_check_duplicate_archive = '{-url:ajax/check_duplicate_archive-}',
url_show_archive = '{-url:home@archive/show_archive-}',
l_archive_duplicate_tip = '{-:@ARCHIVE_DUPLICATE_TIP-}';

var url_get_channel_select = '{-url:ajax/get_channel_select-}';
	
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/l.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/c_a.js"></script>
<script src="{-:*__THEME__-}admin/js/a.js"></script>
<script src="{-:*__THEME__-}admin/js/g_ac.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>