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
	<dt><strong>{-:@SITE-}</strong><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@SITE_NAME-} [site/name]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['site']['name']-}" name="site[name]" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SITE_NAME_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_HOST-} [site/host]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['site']['host']-}" name="site[host]" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SITE_HOST_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_LOGO-} [site/logo]</td>
				<td rowspan="2" class="inputArea">
					<img id="site_logo_preview" src="{-:$_O['site']['logo']-}" />
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="site_logo" class="required i" type="text" value="{-:$_O['site']['logo']-}" name="site[logo]" maxlength="255" size="50">
					<input id="site_logo_uploader" to="#site_logo" preview="#site_logo_preview" btntext="{-:@UPLOAD-}" typeset='image' class="uploader" type="file" />
					<span id="site_logo_finder" to="#site_logo" preview="#site_logo_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_LOGO_MOBILE-} [site/logo_mobile]</td>
				<td rowspan="2" class="inputArea">
					<img id="site_logo_mobile_preview" src="{-:$_O['site']['logo_mobile']-}" />
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="site_logo_mobile" class="required i" type="text" value="{-:$_O['site']['logo_mobile']-}" name="site[logo_mobile]" maxlength="255" size="50">
					<input id="site_logo_mobile_uploader" to="#site_logo_mobile" preview="#site_logo_mobile_preview" btntext="{-:@UPLOAD-}" typeset='image' class="uploader" type="file" />
					<span id="site_logo_mobile_finder" to="#site_logo_mobile" preview="#site_logo_mobile_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_LANGUAGE-} [site/language]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="site[language]">
					{-foreach:$_LANGSET,$lang-}
						<option value="{-:$lang['alias']-}"{-if:$lang['alias']==$_O['site']['language']-} selected="selected"{-:/if-}>{-:$lang['name']-}</option>
					{-:/foreach-}
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SITE_LANGUAGE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@LANG_DETECT-} [site/lang_detect]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="site[lang_detect]"{-if:0==$_O['site']['lang_detect']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="site[lang_detect]"{-if:1==$_O['site']['lang_detect']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					{-:@LANG_DETECT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_THEME-} [site/theme]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="site[theme]">
					{-foreach:$_TPL,$tpl-}
						<option value="{-:$tpl['alias']-}"{-if:$tpl['alias']==$_O['site']['theme']-} selected="selected"{-:/if-}>{-:$tpl['name']-}</option>
					{-:/foreach-}
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SITE_THEME_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MOBILE_VERSION-} [site/mobile_version]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="site[mobile_version]"{-if:0==$_O['site']['mobile_version']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="site[mobile_version]"{-if:1==$_O['site']['mobile_version']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					{-:@MOBILE_VERSION_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TPL_PROTECTION-} [site/tpl_protection]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="site[tpl_protection]"{-if:0==$_O['site']['tpl_protection']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="site[tpl_protection]"{-if:1==$_O['site']['tpl_protection']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					{-:@TPL_PROTECTION_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_TIMEZONE-} [site/timezone]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="site[timezone]">
					{-foreach:$_TZL,$k,$v-}
						<option value="{-:$k-}"{-if:$k==$_O['site']['timezone']-} selected="selected"{-:/if-}>{-:$v-}</option>
					{-:/foreach-}
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SITE_TIMEZONE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_TIME_FORMAT-} [site/time_format]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['site']['time_format']-}" name="site[time_format]" maxlength="50" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SITE_TIME_FORMAT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_KEYWORDS-} [site/keywords]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="site[keywords]" style="width:360px;height:40px;">{-:$_O['site']['keywords']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@SITE_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_DESCRIPTION-} [site/description]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="site[description]" style="width:360px;height:60px;">{-:$_O['site']['description']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@SITE_DESCRIPTION_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_COPYRIGHT-} [site/copyright]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="editor_simple" name="site[copyright]">{-:$_O['site']['copyright']|htmlspecialchars~@me-}</textarea>
				</td>
				<td class="inputTip">
					{-:@SITE_COPYRIGHT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_STAT_CODE-} [site/stat_code]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="site[stat_code]" style="width:360px;height:60px;">{-:$_O['site']['stat_code']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@SITE_STAT_CODE_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_site_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option_simple = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=site-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=site-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		toolbar : 'uwa_simple',
		width : 640, height : 90
	};
	$('.editor_simple').each(function(){
		CKEDITOR.replace(this, editor_option_simple);
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=site-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=site-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=site&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=member&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type=site-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type=site-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type=site-}';

var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>