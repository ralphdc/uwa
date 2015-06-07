<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@EDIT_FLINK-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@CATEGORY-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="flink_category_id">
					{-foreach:$_FCL,$fc-}
						<option value="{-:$fc['flink_category_id']-}"{-if:$_FI['flink_category_id']==$fc['flink_category_id']-} selected="selected"{-:/if-}>{-:$fc['fc_name']-}</option>
					{-:/foreach-}
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_gry">{-:@FLINK_CATEGORY_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_NAME-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_FI['f_site_name']-}" name="f_site_name" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@F_SITE_NAME_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_URL-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_FI['f_site_url']-}" name="f_site_url" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@F_SITE_URL_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WEBMASTER_EMAIL-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_FI['f_webmaster_email']-}" name="f_webmaster_email" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_gry">{-:@F_WEBMASTER_EMAIL_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_DESCRIPTION-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="f_site_description" style="width:360px;height:60px;">{-:$_FI['f_site_description']-}</textarea>
				</td>
				<td class="inputTip">
					<span class="fc_gry">{-:@F_SITE_DESCRIPTION_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SITE_LOGO-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="f_site_log" class="i" type="text" value="{-:$_FI['f_site_logo']-}" name="f_site_logo" maxlength="255" size="50">
					<input id="f_site_logo_uploader" to="#f_site_log" preview="#f_site_logo_preview" btntext="{-:@UPLOAD-}" typeset='image' class="uploader" type="file" />
					<span id="f_site_logo_finder" to="#f_site_log" preview="#f_site_logo_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
				</td>
				<td class="inputArea">
					<img id="f_site_logo_preview" src="{-:$_FI['f_site_logo']-}" />
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SHOW_TYPE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="f_show_type"{-if:0==$_FI['f_show_type']-} checked="checked"{-:/if-}> {-:@TEXT_LINK-}</label>
					<label><input type="radio" value="1" name="f_show_type"{-if:1==$_FI['f_show_type']-} checked="checked"{-:/if-}> {-:@LOGO_LINK-}</label>
				</td>
				<td class="inputArea">
					<span class="fc_gry">{-:@F_SHOW_TYPE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@STATUS-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="f_status"{-if:0==$_FI['f_status']-} checked="checked"{-:/if-}> {-:@NOT_PASSED-}</label>
					<label><input type="radio" value="1" name="f_status"{-if:1==$_FI['f_status']-} checked="checked"{-:/if-}> {-:@PASSED-}</label>
				</td>
				<td class="inputArea">
					<span class="fc_gry">{-:@F_STATUS_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_FI['f_display_order']-}" name="f_display_order" maxlength="20" size="10">
				</td>
				<td class="inputArea">
					<span class="fc_gry">{-:@F_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_FI['flink_id']-}" name="flink_id">
	<span class="btn_b submit" action="{-url:flink/edit_flink_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:flink/list_flink-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script>
var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=flink-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=flink-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=flink&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=flink&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type=flink-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type=flink-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type=flink-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
</body>
</html>