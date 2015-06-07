<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/{-:+lang-}.js"></script>
</head>

<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_AD-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@AD_SPACE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					{-:$_ASI['as_name']-}
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@AD_SPACE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TYPE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					{-if:'code' == $_ASI['as_type']-}{-:@CODE-}{-:/if-}
					{-if:'text' == $_ASI['as_type']-}{-:@TEXT-}{-:/if-}
					{-if:'image' == $_ASI['as_type']-}{-:@IMAGE-}{-:/if-}
					{-if:'flash' == $_ASI['as_type']-}{-:@FLASH-}{-:/if-}
					{-if:'slide' == $_ASI['as_type']-}{-:@SLIDE-}{-:/if-}
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AS_TYPE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="a_name" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AD_NAME_TIP-}</span>
				</td>
			</tr>
			<tr {-if:'code' == $_ASI['as_type'] or 'text' == $_ASI['as_type']-} style="display:none"{-:/if-}>
				<td colspan="2" class="inputArea">
					<strong>{-:@FILE-}</strong><br />
					<input id="a_file" class="i" type="text" value="" name="a_file" maxlength="255" size="50">
					<input id="a_file_uploader" to="#a_file" btntext="{-:@UPLOAD-}" typeset='all' class="uploader" type="file" />
					<span id="a_file_finder" to="#a_file" preview="#a_file_preview" typeset='all' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
				</td>
			</tr>
			<tr id="a_content">
				<td colspan="2" class="inputArea">
					<strong>{-:@CONTENT-}</strong> <span class="fc_gry">{-:@AD_CONTENT_TIP-}</span><br />
					<textarea class="i {-if:'code' != $_ASI['as_type']-}editor{-:/if-}" name="a_content" style="width:450px;height:120px;"></textarea>
				</td>
			</tr>
			{-if:1 != $_AI['as_type']-}<tr>
				<td class="inputTitle">{-:@LINK-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="#" name="a_link" id="a_link" maxlength="96" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AD_LINK_TIP-}</span>
				</td>
			</tr>{-:/if-}
			<tr>
				<td class="inputTitle">{-:@TIME_LIMIT-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="a_time_limit" checked="checked"> {-:@NOT_LIMIT-}</label>
					<label><input type="radio" value="1" name="a_time_limit"> {-:@VALIDITY_PERIOD-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AD_TIME_LIMIT_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@VALIDITY_PERIOD-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i calendar" type="text" value="{-php:echo date(C('APP.TIME_FORMAT'), time());-}" format="{-:#APP.TIME_FORMAT-}" id="a_start_time" name="a_start_time" maxlength="20" size="20"> ~
					<input class="i calendar" type="text" value="{-php:echo date(C('APP.TIME_FORMAT'), time()+86400*30);-}" format="{-:#APP.TIME_FORMAT-}" id="a_end_time" name="a_end_time" maxlength="20" size="20">
				</td>
				<td class="inputTip">
					{-:@AD_VALIDITY_PERIOD_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="50" name="a_display_order" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AD_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_ASI['ad_space_id']-}" name="ad_space_id">
	<span class="btn_b submit" action="{-url:ad/add_ad_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:ad/list_ad-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=ad-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=ad-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=ad&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=ad&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		toolbar : 'uwa_simple',
		width : 690, height : 90
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=ad-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=ad-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=ad&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=ad&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type=ad-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type=ad-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type=ad-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
</body>
</html>