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
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@TEMPLATE-}</strong><strong>{-:@ADVANCED-}</strong><strong>{-:@CONTENT-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class="inputTitle"></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="cm_name" maxlength="64" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@CM_NAME_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@STATUS-}</td>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" name="cm_status" checked="checked" value="1"> {-:@ON-}</label>
						<label><input type="radio" name="cm_status" value="0"> {-:@OFF-}</label>
						<span class="fc_gry"><span class="fc_r">*</span> {-:@CM_STATUS_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="50" name="cm_display_order" maxlength="10" size="6">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@CM_DISPLAY_ORDER_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@ALIAS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="cm_alias" maxlength="64" size="30"> <span class="btn_l" onClick="check_alias('cm_alias');">{-:@CHECK_ALIAS-}</span> <span id="check_alias_result"></span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_ALIAS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@TABLE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="model_" name="cm_table" maxlength="64" size="30"> <span class="btn_l" onClick="check_table('cm_table');">{-:@CHECK_TABLE-}</span> <span id="check_table_result"></span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TABLE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@PAGE_SIZE-}</td>
					<td class="inputTitle"></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="20" name="cm_page_size" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_PAGE_SIZE_TIP-}
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@CM_TPL_LIST_HOME-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_list_home" class="required i" type="text" value="list_custom_model_content" name="cm_tpl_list_home" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="cm_tpl_list_home">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_LIST_HOME_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_TPL_SHOW_HOME-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_show_home" class="required i" type="text" value="show_custom_model_content" name="cm_tpl_show_home" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="cm_tpl_show_home">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_SHOW_HOME_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_TPL_LIST_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_list_member" class="required i" type="text" value="custom_model/list_content" name="cm_tpl_list_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="cm_tpl_list_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_LIST_MEMBER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_TPL_ADD_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_add_member" class="required i" type="text" value="custom_model/add_content" name="cm_tpl_add_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="cm_tpl_add_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_ADD_MEMBER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_TPL_EDIT_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_edit_member" class="required i" type="text" value="custom_model/edit_content" name="cm_tpl_edit_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="cm_tpl_edit_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_EDIT_MEMBER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_TPL_LIST_ADMIN-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_list_admin" class="required i" type="text" value="custom_model/list_content" name="cm_tpl_list_admin" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="cm_tpl_list_admin">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_LIST_ADMIN_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_TPL_ADD_ADMIN-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_add_admin" class="required i" type="text" value="custom_model/add_content" name="cm_tpl_add_admin" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="cm_tpl_add_admin">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_ADD_ADMIN_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_TPL_EDIT_ADMIN-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="cm_tpl_edit_admin" class="required i" type="text" value="custom_model/edit_content" name="cm_tpl_edit_admin" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="cm_tpl_edit_admin">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TPL_EDIT_ADMIN_TIP-}
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@CM_VIEW_ML_IDS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<select name="cm_view_ml_ids[]" multiple="multiple" size="4" style="width:180px;">
							<option value="-1">{-:@CLOSE_ALL-}</option>
							<option value="0" selected="selected">{-:@OPEN_ALL-}</option>
						{-foreach:$_MLL,$l-}
							<option value="{-:$l['member_level_id']-}">{-:$l['ml_name']-}</option>
						{-:/foreach-}
						</select>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_VIEW_ML_IDS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CM_ADD_ML_IDS-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@CM_ADD_ML_IDS_TIP-}</span></td>
					<td class="inputTitle">{-:@PASS_SWITCH-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label>
							<select name="cm_add_ml_ids[]" multiple="multiple" size="4" style="width:180px;">
								<option value="-1">{-:@CLOSE_ALL-}</option>
								<option value="0" selected="selected">{-:@OPEN_ALL-}</option>
							{-foreach:$_MLL,$l-}
								<option value="{-:$l['member_level_id']-}">{-:$l['ml_name']-}</option>
							{-:/foreach-}
							</select>
						</label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="cm_pass_switch"> {-:@OFF-}</label>
						<label><input type="radio" value="1" name="cm_pass_switch" checked="checked"> {-:@ON-}</label>
						<span class="fc_r">*</span> <span class="fc_gry">{-:@CM_PASS_SWITCH_TIP-}</span>
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@KEYWORDS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="cm_keywords" style="width:360px;height:40px;"></textarea>
					</td>
					<td class="inputTip">
						{-:@CM_KEYWORDS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@DESCRIPTION-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="cm_description" style="width:360px;height:60px;"></textarea>
					</td>
					<td class="inputTip">
						{-:@CM_DESCRIPTION_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CONTENT-} <span class="fc_gry">{-:@CM_CONTENT_TIP-}</span></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea" colspan="2">
						<textarea class="editor" name="cm_content" style="width:95%;height:180px;"></textarea>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:custom_model/add_model_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:custom_model/list_model-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=custom_model-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=all&type=custom_model-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=custom_model&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=custom_model&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});

var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';

var url_check_alias = '{-url:ajax/check_model_alias?type=custom-}',
	url_check_table = '{-url:ajax/check_table-}',
	checking = '{-:@CHECKING-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/am.js"></script>
</body>
</html>