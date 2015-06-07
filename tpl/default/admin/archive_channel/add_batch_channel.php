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
<dl class="atab">
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@ADVANCED-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class="inputTitle">{-:@MODEL-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="required i" name="ac_name_list" style="width:200px;height:120px;"></textarea> <span class="fc_r">*</span> <span class="fc_gry">{-:@AC_NAME_LIST_TIP-}</span>
					</td>
					<td class="inputArea">
						<select name="archive_model_id">
						{-foreach:$_AML,$m-}
							<option value="{-:$m['archive_model_id']-}"{-if:$m['archive_model_id']==$_ACI['archive_model_id']-} selected="selected"{-:/if-}>{-:$m['am_name']-} | {-:$m['am_alias']-}</option>
						{-:/foreach-}
						</select> <span class="fc_r">*</span> <span class="fc_gry">{-:@ARCHIVE_MODEL_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@PARENT_CHANNEL-}</td>
					<td class="inputTitle">{-:@DISPLAY_SWITCH-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_parent_id" type="hidden" value="{-:$_ACI['archive_channel_id']-}" name="ac_parent_id" />
						<span id="ac_parent_id_channel_select" class="channel_select" to='#ac_parent_id' archive_model_id="{-:$_ACI['archive_model_id']-}"></span>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_display_switch"> {-:@HIDDEN-}</label>
						<label><input type="radio" value="1" name="ac_display_switch" checked="checked"> {-:@SHOW-}</label>
						<span class="fc_gry"><span class="fc_r">*</span> {-:@AC_DISPLAY_SWITCH_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CHANNEL_TYPE-}</td>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="1" name="ac_type"> {-:@CHANNEL_COVER-}</label>
						<label><input type="radio" value="2" name="ac_type" checked="checked"> {-:@CHANNEL_LIST-}</label>
					</td>
					<td class="inputTip">
						<input class="required i" type="text" value="50" name="ac_display_order" maxlength="10" size="6"> <span class="fc_r">*</span> {-:@AC_DISPLAY_ORDER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_TPL_INDEX-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_tpl_index" class="required i" type="text" value="{-if:!empty($_ACI['ac_tpl_index'])-}{-:$_ACI['ac_tpl_index']-}{-else:-}index_channel{-:/if-}" name="ac_tpl_index" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_index">{-:@CHOOSE-}</span>
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
						<input id="ac_tpl_list" class="required i" type="text" value="{-if:!empty($_ACI['ac_tpl_list'])-}{-:$_ACI['ac_tpl_list']-}{-else:-}list_archive{-:/if-}" name="ac_tpl_list" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_list">{-:@CHOOSE-}</span>
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
						<input id="ac_tpl_archive" class="required i" type="text" value="{-if:!empty($_ACI['ac_tpl_archive'])-}{-:$_ACI['ac_tpl_archive']-}{-else:-}show_archive{-:/if-}" name="ac_tpl_archive" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_archive">{-:@CHOOSE-}</span>
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
						<input class="required i" type="text" value="{-if:!empty($_ACI['ac_page_size'])-}{-:$_ACI['ac_page_size']-}{-else:-}20{-:/if-}" name="ac_page_size" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AC_PAGE_SIZE_TIP-}
					</td>
				</tr>
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
					<td colspan="2" class="inputTitle">{-:@AC_HTML_DIR-} <span class="fw_n fc_gry">[{-:@PARENT_CHANNEL_DIR-}:<span id="ac_parent_dir" class="bg_gry fc_wht p_0_2 br_3">{-:$_ACI['ac_html_dir']-}</span><input type="hidden" name="ac_parent_dir" value="{-:$_ACI['ac_html_dir']-}" >]</span></td>
					</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><input type="checkbox" value="1" name="pinyin_as_dirname" disabled="disabled" checked="checked" /> {-:@PINYIN_AS_DIRNAME-}</label>
					</td>
					</tr>
				<tr>
					<td class="inputTitle">{-:@DIR_RELATIVE_POSITION-}</td>
					<td></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="1" name="ac_html_path" checked="checked"> {-:@PARENT_CHANNEL_DIR-}</label>
						<label><input type="radio" value="2" name="ac_html_path"> {-:@SITE_ROOT-}</label>
						<label><input type="radio" value="3" name="ac_html_path"> {-:@HTML_ROOT-}</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@DIR_RELATIVE_POSITION_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_HTML_INDEX-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="{-if:!empty($_ACI['ac_html_index'])-}{-:$_ACI['ac_html_index']-}{-else:-}index{-:/if-}" name="ac_html_index" maxlength="255" size="30">
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
						<input class="i" type="text" value="{-if:!empty($_ACI['ac_html_naming_list'])-}{-:$_ACI['ac_html_naming_list']-}{-else:-}list_{ac_id}_{page}{-:/if-}" name="ac_html_naming_list" maxlength="255" size="30">
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
						<input class="i" type="text" value="{-if:!empty($_ACI['ac_html_naming_archive'])-}{-:$_ACI['ac_html_naming_archive']-}{-else:-}{Y}{M}/{D}/{a_id}{-:/if-}" name="ac_html_naming_archive" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						{-:@AC_HTML_NAMING_ARCHIVE_TIP-}
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:archive_channel/add_batch_channel_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:archive_channel/list_channel-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';

var url_get_model = '{-url:ajax/get_model_id-}',
	url_get_html_dir = '{-url:ajax/get_html_dir-}',
	url_get_channel_select = '{-url:ajax/get_channel_select-}',
	url_get_tpl = '{-url:ajax/get_default_show_template-}';

{-if:0 == $_ACI['archive_channel_id']-}
$(document).ready(function() {
	$('#ac_parent_id_channel_select').html('');
	$('#ac_parent_id_channel_select').attr('archive_model_id', $('select[name="archive_model_id"]').val());
	get_channel_select("ac_parent_id_channel_select", $('select[name="archive_model_id"]').val(), 0, "current");
	get_tpl($('select[name="archive_model_id"]').val());
	get_parent_html_dir(0);
});
{-:/if-}
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/a_ac.js"></script>
</body>
</html>