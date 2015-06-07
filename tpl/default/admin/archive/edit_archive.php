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
<form id="formEdit" action="" method="post">
<dl class="atab">
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@ADVANCED-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@TITLE-}</td>
					<td class="inputTitle">{-:@SHORT_TITLE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_AI['a_title']-}" name="a_title" maxlength="255" size="70"><span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="{-:$_AI['a_short_title']-}" name="a_short_title" maxlength="30" size="20">
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><strong>{-:@KEYWORDS-}</strong>: <input class="i" type="text" value="{-:$_AI['a_keywords']-}" name="a_keywords" maxlength="255" size="50"></label> <span class="fc_gry">{-:@A_KEYWORDS_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><strong>{-:@CHANNEL-}</strong>:
						<input id="archive_channel_id" type="hidden" value="{-:$_AI['archive_channel_id']-}" name="archive_channel_id" />
						<span id="archive_channel_id_channel_select" class="channel_select" to='#archive_channel_id' archive_model_id="{-:$_AI['archive_model_id']-}"></span></label>
						<strong>{-:@FLAG-}</strong>: {-foreach:$_AFL,$af-}<label><input type="checkbox" value="{-:$af['af_alias']-}" name="af_alias[]" {-if:
		in_array($af['af_alias'], $_AI['af_alias'])-} checked="checked"{-:/if-}> {-:$af['af_name']-}[{-:$af['af_alias']-}]</label>{-:/foreach-}
						<label><strong>{-:@RANK-}</strong>: <input class="i" type="text" value="{-:$_AI['a_rank']-}" name="a_rank" maxlength="6" size="6"></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@THUMB-}</td>
					<td class="inputArea" rowspan="2">
					{-if:!empty($_AI['a_thumb'])-}
						<img id="a_thumb_preview" src="{-:$_AI['a_thumb']-}" width="160" />
					{-else:-}
						<img id="a_thumb_preview" src="{-:*__APP__-}u/site/no_thumb.png" width="160" />
					{-:/if-}
					</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="a_thumb" class="i" type="text" value="{-:$_AI['a_thumb']-}" name="a_thumb" maxlength="255" size="70">
						<input id="a_thumb_uploader" to="#a_thumb" preview="#a_thumb_preview" btntext="{-:@UPLOAD-}" typeset='image' thumb='yes' class="uploader" type="file" />
						<span id="a_thumb_finder" to="#a_thumb" preview="#a_thumb_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
					</td>
				</tr>
				{-:$_FI-}
				<tr>
					<td class="inputTitle">{-:@DESCRIPTION-}</td>
					<td class="inputTitle">{-:@RELATED_CONTENT-} <span class="btn_l choose_archive" to_id="a_related">{-:@CHOOSE_ARCHIVE-}</span></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="a_description" style="width:360px;height:60px;" placeholder="{-:@A_DESCRIPTION_TIP-}">{-:$_AI['a_description']-}</textarea>
					</td>
					<td class="inputArea">
						<div class="archive_set" to_id="a_related">
						{-if:!empty($_AI['a_related'])-}<uwa:a_list titlelen="20" aid="$_AI.a_related">
							<span class="bg_wht br_b br_3 p_0_2 fc_b fw_b" aid="{-:$item['archive_id']-}"><a href="{-:$item['a_url']-}" target="_blank">{-:$item['a_title']-}</a><b class="a p_0_5">╳</b></span>
						</uwa:a_list>{-:/if-}
						</div>
						<input id="a_related" type="hidden" name="a_related" value="{-:$_AI['a_related']-}" />
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@MEMBER_ID-}</td>
					<td class="inputTitle">{-:@USERNAME-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_AI['member_id']-}
					</td>
					<td class="inputArea">
						{-:$_AI['m_username']-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@STATUS-}</td>
					<td class="inputTitle">{-:@REVIEW_SWITCH-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_status"{-if:0 == $_AI['a_status']-} checked="checked"{-:/if-}> {-:@NOT_PASSED-}</label>
						<label><input type="radio" value="1" name="a_status"{-if:1 == $_AI['a_status']-} checked="checked"{-:/if-}> {-:@PASSED-}</label>
						<label><input type="radio" value="2" name="a_status"{-if:2 == $_AI['a_status']-} checked="checked"{-:/if-}> {-:@REFUNDED-}</label>
						<label><input type="checkbox" name="send_notify" checked="checked" value="y"> {-:@SEND_NOTIFY-}</label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_review_switch"{-if:0 == $_AI['a_review_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
						<label><input type="radio" value="1" name="a_review_switch"{-if:1 == $_AI['a_review_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@COST_POINTS-}</td>
					<td class="inputTitle">{-:@COUNT-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_AI['a_cost_points']-}" name="a_cost_points" maxlength="10" size="6">{-:@POINTS-}
					</td>
					<td class="inputArea">
						<label>{-:@VIEW-}: <input class="required i" type="text" value="{-:$_AI['a_view_count']-}" name="a_view_count" maxlength="20" size="10"></label>
						<label>{-:@REVIEW-}: <input class="required i" type="text" value="{-:$_AI['a_review_count']-}" name="a_review_count" maxlength="20" size="10"></label>
						<label>{-:@SUPPORT-}: <input class="required i" type="text" value="{-:$_AI['a_support_count']-}" name="a_support_count" maxlength="20" size="10"></label>
						<label>{-:@OPPOSE-}: <input class="required i" type="text" value="{-:$_AI['a_oppose_count']-}" name="a_oppose_count" maxlength="20" size="10"></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">HTML{-:@SWITCH-}</td>
					<td class="inputTitle">{-:@EDIT_TIME-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_is_html"{-if:0 == $_AI['a_is_html']-} checked="checked"{-:/if-}> {-:@NOT_HTML-}</label>
						<label><input type="radio" value="1" name="a_is_html"{-if:1 == $_AI['a_is_html']-} checked="checked"{-:/if-}> {-:@IS_HTML-}</label>
					</td>
					<td class="inputArea">
						{-:$_AI['a_edit_time']|date~C('APP.TIME_FORMAT'),@me-}
						<input class="i calendar" type="text" value="{-php:echo date(C('APP.TIME_FORMAT'), time());-}" format="{-:#APP.TIME_FORMAT-}" id="a_edit_time" name="a_edit_time" maxlength="255" size="20">
						<label><input type="checkbox" name="not_upodate_edit_time" value="n"> {-:@NOT_UPDATE_EDIT_TIME-}</label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@TEMPLATE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="a_tpl" class="i" type="text" value="{-:$_AI['a_tpl']-}" name="a_tpl" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="a_tpl">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						{-:@A_TPL_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@A_HTML_PATH-}</td>
					<td></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_html_path"{-if:0 == $_AI['a_html_path']-} checked="checked"{-:/if-}> {-:@EXTEND_CHANNEL_SETTING-}</label>
						<label><input type="radio" value="1" name="a_html_path"{-if:1 == $_AI['a_html_path']-} checked="checked"{-:/if-}> {-:@CUSTOM-}</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@A_HTML_PATH_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@A_HTML_NAMING-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="{-:$_AI['a_html_naming']-}" name="a_html_naming" maxlength="255" size="50">
					</td>
					<td class="inputTip">
						{-:@A_HTML_NAMING_TIP-}
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_AI['archive_id']-}" name="archive_id">
	<input type="hidden" value="{-:$_AI['am_alias']-}" name="am_alias">
	<span class="btn_b submit" action="{-url:archive/edit_archive_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:archive/list_archive?archive_model_id={$_AI['archive_model_id']}-}">{-:@BACK-}</a>
	<label><input type="checkbox" name="build_now" value="1" checked="checked" /> {-:@BUILD_NOW-}</label>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type={$_AI['am_alias']}-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type={$_AI['am_alias']}-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
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

	$('#formEdit').submit(function() {
		if('' == $("input[name='archive_channel_id']").val() || 0 == $("input[name='archive_channel_id']").val()) {
			alert("{-:@CHOOSE_CHANNEL-}");
			return false;
		}
	});
});

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

var url_get_channel_select = '{-url:ajax/get_channel_select-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/l.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/c_a.js"></script>
<script src="{-:*__THEME__-}admin/js/g_ac.js"></script>
</body>
</html>