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
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@ADVANCED-}</strong><strong>{-:@CONTENT-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class="inputTitle">{-:@MODEL-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_ACI['ac_name']-}" name="ac_name" maxlength="64" size="30"> <span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						{-:$_ACI['am_name']-} | {-:$_ACI['am_alias']-} <span class="fc_r">*</span> <span class="fc_gry">{-:@ARCHIVE_MODEL_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@PARENT_CHANNEL-}</td>
					<td class="inputTitle">{-:@DISPLAY_SWITCH-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_parent_id" type="hidden" value="{-:$_ACI['ac_parent_id']-}" name="ac_parent_id" />
						<span id="ac_parent_id_channel_select" class="channel_select" to='#ac_parent_id' archive_model_id="{-:$_ACI['archive_model_id']-}"></span>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_display_switch"{-if:0==$_ACI['ac_display_switch']-} checked="checked"{-:/if-}> {-:@HIDDEN-}</label>
						<label><input type="radio" value="1" name="ac_display_switch"{-if:1==$_ACI['ac_display_switch']-} checked="checked"{-:/if-}> {-:@SHOW-}</label>
						<span class="fc_gry"><span class="fc_r">*</span> {-:@AC_DISPLAY_SWITCH_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CHANNEL_TYPE-}</td>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="1" name="ac_type"{-if:1==$_ACI['ac_type']-} checked="checked"{-:/if-}> {-:@CHANNEL_COVER-}</label>
						<label><input type="radio" value="2" name="ac_type"{-if:2==$_ACI['ac_type']-} checked="checked"{-:/if-}> {-:@CHANNEL_LIST-}</label>
					</td>
					<td class="inputTip">
						<input class="required i" type="text" value="{-:$_ACI['ac_display_order']-}" name="ac_display_order" maxlength="10" size="6"> <span class="fc_r">*</span> {-:@AC_DISPLAY_ORDER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_TPL_INDEX-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_tpl_index" class="required i" type="text" value="{-:$_ACI['ac_tpl_index']-}" name="ac_tpl_index" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_index">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AC_TPL_INDEX_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_TPL_LIST-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_tpl_list" class="required i" type="text" value="{-:$_ACI['ac_tpl_list']-}" name="ac_tpl_list" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_list">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AC_TPL_LIST_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_TPL_ARCHIVE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_tpl_archive" class="required i" type="text" value="{-:$_ACI['ac_tpl_archive']-}" name="ac_tpl_archive" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_archive">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AC_TPL_ARCHIVE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@PAGE_SIZE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_ACI['ac_page_size']-}" name="ac_page_size" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AC_PAGE_SIZE_TIP-}
					</td>
				</tr>
				{-if:0==$_ACI['ac_parent_id']-}<tr>
					<td class="inputTitle">{-:@UPDATE_SUB-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="checkbox" value="1" name="update_sub"> {-:@UPDATE-}</label>
					</td>
					<td class="inputTip">
						{-:@UPDATE_SUB_TIP-}
					</td>
				</tr>{-:/if-}
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@AC_VIEW_ML_IDS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<select name="ac_view_ml_ids[]" multiple="multiple" size="4" style="width:180px;">
							<option value="-1"{-if:in_array(-1, $_ACI['ac_view_ml_ids'])-} selected="selected"{-:/if-}>{-:@CLOSE_ALL-}</option>
							<option value="0"{-if:empty($_ACI['ac_view_ml_ids']) or in_array(0, $_ACI['ac_view_ml_ids'])-} selected="selected"{-:/if-}>{-:@OPEN_ALL-}</option>
						{-foreach:$_MLL,$l-}
							<option value="{-:$l['member_level_id']-}"{-if:in_array($l['member_level_id'], $_ACI['ac_view_ml_ids'])-} selected="selected"{-:/if-}>{-:$l['ml_name']-}</option>
						{-:/foreach-}
						</select>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AC_VIEW_ML_IDS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_ADD_ML_IDS-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@AC_ADD_ML_IDS_TIP-}</span></td>
					<td class="inputTitle">{-:@PASS_SWITCH-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label>
							<select name="ac_add_ml_ids[]" multiple="multiple" size="4" style="width:180px;">
								<option value="-1"{-if:in_array(-1, $_ACI['ac_add_ml_ids'])-} selected="selected"{-:/if-}>{-:@CLOSE_ALL-}</option>
								<option value="0"{-if:empty($_ACI['ac_add_ml_ids']) or in_array(0, $_ACI['ac_add_ml_ids'])-} selected="selected"{-:/if-}>{-:@OPEN_ALL-}</option>
							{-foreach:$_MLL,$l-}
								<option value="{-:$l['member_level_id']-}"{-if:in_array($l['member_level_id'], $_ACI['ac_add_ml_ids'])-} selected="selected"{-:/if-}>{-:$l['ml_name']-}</option>
							{-:/foreach-}
							</select>
						</label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_pass_switch"{-if:0==$_ACI['ac_pass_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
						<label><input type="radio" value="1" name="ac_pass_switch"{-if:1==$_ACI['ac_pass_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
						<span class="fc_r">*</span> <span class="fc_gry">{-:@AC_PASS_SWITCH_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">HTML{-:@SWITCH-}</td>
					<td class="inputTitle">{-:@REVIEW_SWITCH-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_is_html"{-if:0==$_ACI['ac_is_html']-} checked="checked"{-:/if-}> {-:@NOT_HTML-}</label>
						<label><input type="radio" value="1" name="ac_is_html"{-if:1==$_ACI['ac_is_html']-} checked="checked"{-:/if-}> {-:@IS_HTML-}</label>
						<label><input type="radio" value="2" name="ac_is_html"{-if:2==$_ACI['ac_is_html']-} checked="checked"{-:/if-}> {-:@ONLY_ARCHIVE_IS_HTML-}</label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_review_switch"{-if:0==$_ACI['ac_review_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
						<label><input type="radio" value="1" name="ac_review_switch"{-if:1==$_ACI['ac_review_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_HTML_DIR-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<input class="i" type="text" value="{-:$_ACI['ac_html_dir']-}" name="ac_html_dir" maxlength="255" size="40">
						<span class="fc_gry">{-:@AC_HTML_DIR_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_HTML_INDEX-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="{-:$_ACI['ac_html_index']-}" name="ac_html_index" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						{-:@AC_HTML_INDEX_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_HTML_NAMING_LIST-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="{-:$_ACI['ac_html_naming_list']-}" name="ac_html_naming_list" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						{-:@AC_HTML_NAMING_LIST_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_HTML_NAMING_ARCHIVE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="{-:$_ACI['ac_html_naming_archive']-}" name="ac_html_naming_archive" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						{-:@AC_HTML_NAMING_ARCHIVE_TIP-}
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@CHANNEL_THUMB-}</td>
					<td class="inputArea" rowspan="6" valign="top" style="padding-left:20px;">
					{-if:!empty($_ACI['ac_thumb'])-}
						<img id="ac_thumb_preview" src="{-:$_ACI['ac_thumb']-}" /></td>
					{-else:-}
						<img id="ac_thumb_preview" src="{-:*__APP__-}u/site/default_channel_thumb.png" /></td>
					{-:/if-}
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_thumb" class="i" type="text" value="{-:$_ACI['ac_thumb']-}" name="ac_thumb" maxlength="255" size="70">
						<input id="ac_thumb_uploader" to="#ac_thumb" preview="#ac_thumb_preview" btntext="{-:@UPLOAD-}" typeset='image' thumb='no' class="uploader" type="file" />
						<span id="ac_thumb_finder" to="#ac_thumb" preview="#ac_thumb_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@KEYWORDS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="ac_keywords" style="width:360px;height:40px;">{-:$_ACI['ac_keywords']-}</textarea> <span class="fc_gry">{-:@AC_KEYWORDS_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@DESCRIPTION-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="ac_description" style="width:360px;height:60px;">{-:$_ACI['ac_description']-}</textarea> <span class="fc_gry">{-:@AC_DESCRIPTION_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CONTENT-} <span class="fc_gry">{-:@AC_CONTENT_TIP-}</span></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea" colspan="2">
						<textarea class="editor" name="ac_content" style="width:95%;height:180px;">{-:$_ACI['ac_content']|htmlspecialchars~@me-}</textarea>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_ACI['archive_channel_id']-}" name="archive_channel_id">
	<input type="hidden" value="{-:$_ACI['archive_model_id']-}" name="archive_model_id">
	<span class="btn_b submit" action="{-url:archive_channel/edit_channel_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:archive_channel/list_channel-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=channel-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=all&type=channel-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=channel&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=channel&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=channel-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=channel&watermark=yes-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=channel&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=channel&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type=channel-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type=channel-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type=channel-}';

var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';

var url_get_channel_select = '{-url:ajax/get_channel_select-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/g_ac.js"></script>
</body>
</html>