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
						<input class="required i" type="text" value="{-:$_CMI['cm_name']-}" name="cm_name" maxlength="64" size="30"> [{-:@ID-} {-:$_CMI['custom_model_id']-}]
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
						<label><input type="radio" name="cm_status" {-if:1 == $_CMI['cm_status']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
						<label><input type="radio" name="cm_status" {-if:0 == $_CMI['cm_status']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
						<span class="fc_gry"><span class="fc_r">*</span> {-:@CM_STATUS_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_CMI['cm_display_order']-}" name="cm_display_order" maxlength="10" size="6">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@CM_DISPLAY_ORDER_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@ALIAS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_CMI['cm_alias']-}
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
						{-:$_CMI['cm_table']-}
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@CM_TABLE_TIP-}
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputTitle">
						{-:@ADDON_FIELD-}
						<a class="btn_l" href="{-url:custom_model/add_model_field?custom_model_id={$_CMI['custom_model_id']}-}">{-:@ADD_FIELD-}</a>
						<span class="fc_gry fw_n">{-:@CM_TABLE_FIELD_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<table class="listTable">
							<tr>
								<th scope="col">{-:@FIELD_NAME-}</th>
								<th scope="col">{-:@NAME-}</th>
								<th scope="col">{-:@DATA_TYPE-}</th>
								<th scope="col">{-:@FORM_TYPE-}</th>
								<th scope="col">{-:@MANAGE-}</th>
							</tr>
							{-foreach:$_CMI['cm_field'],$k,$v-}
							<tr>
								<td>{-:$k-}</td>
								<td>{-:$v['f_item_name']-}</td>
								<td>{-:@FILED_{$v['f_type']}-}</td>
								<td>{-if:1 == $v['f_is_auto']-}{-:@AUTO_FIELD-}{-else:-}{-:@FIXED_FIELD-}{-:/if-}</td>
								<td><a href="{-url:custom_model/edit_model_field?custom_model_id={$_CMI['custom_model_id']}&f_name={$k}-}">{-:@EDIT-}</a> | <a href="{-url:custom_model/delete_model_field_do?custom_model_id={$_CMI['custom_model_id']}&f_name={$k}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
							</tr>
							{-:/foreach-}
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputTitle">{-:@CM_FIELDSET-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@CM_FIELDSET_TIP-}</span></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<textarea class="i" name="cm_fieldset" style="width:90%;height:150px;">{-:$_CMI['cm_fieldset']-}</textarea>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@PAGE_SIZE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_CMI['cm_page_size']-}" name="cm_page_size" maxlength="10" size="6">
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
						<input id="cm_tpl_list_home" class="required i" type="text" value="{-:$_CMI['cm_tpl_list_home']-}" name="cm_tpl_list_home" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="cm_tpl_list_home">{-:@CHOOSE-}</span>
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
						<input id="cm_tpl_show_home" class="required i" type="text" value="{-:$_CMI['cm_tpl_show_home']-}" name="cm_tpl_show_home" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="cm_tpl_show_home">{-:@CHOOSE-}</span>
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
						<input id="cm_tpl_list_member" class="required i" type="text" value="{-:$_CMI['cm_tpl_list_member']-}" name="cm_tpl_list_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="cm_tpl_list_member">{-:@CHOOSE-}</span>
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
						<input id="cm_tpl_add_member" class="required i" type="text" value="{-:$_CMI['cm_tpl_add_member']-}" name="cm_tpl_add_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="cm_tpl_add_member">{-:@CHOOSE-}</span>
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
						<input id="cm_tpl_edit_member" class="required i" type="text" value="{-:$_CMI['cm_tpl_edit_member']-}" name="cm_tpl_edit_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="cm_tpl_edit_member">{-:@CHOOSE-}</span>
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
						<input id="cm_tpl_list_admin" class="required i" type="text" value="{-:$_CMI['cm_tpl_list_admin']-}" name="cm_tpl_list_admin" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="cm_tpl_list_admin">{-:@CHOOSE-}</span>
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
						<input id="cm_tpl_add_admin" class="required i" type="text" value="{-:$_CMI['cm_tpl_add_admin']-}" name="cm_tpl_add_admin" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="cm_tpl_add_admin">{-:@CHOOSE-}</span>
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
						<input id="cm_tpl_edit_admin" class="required i" type="text" value="{-:$_CMI['cm_tpl_edit_admin']-}" name="cm_tpl_edit_admin" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="cm_tpl_edit_admin">{-:@CHOOSE-}</span>
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
							<option value="-1"{-if:in_array(-1, $_CMI['cm_view_ml_ids'])-} selected="selected"{-:/if-}>{-:@CLOSE_ALL-}</option>
							<option value="0"{-if:empty($_CMI['cm_view_ml_ids']) or in_array(0, $_CMI['cm_view_ml_ids'])-} selected="selected"{-:/if-}>{-:@OPEN_ALL-}</option>
						{-foreach:$_MLL,$l-}
							<option value="{-:$l['member_level_id']-}"{-if:in_array($l['member_level_id'], $_CMI['cm_view_ml_ids'])-} selected="selected"{-:/if-}>{-:$l['ml_name']-}</option>
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
								<option value="-1"{-if:in_array(-1, $_CMI['cm_add_ml_ids'])-} selected="selected"{-:/if-}>{-:@CLOSE_ALL-}</option>
								<option value="0"{-if:empty($_CMI['cm_add_ml_ids']) or in_array(0, $_CMI['cm_add_ml_ids'])-} selected="selected"{-:/if-}>{-:@OPEN_ALL-}</option>
							{-foreach:$_MLL,$l-}
								<option value="{-:$l['member_level_id']-}"{-if:in_array($l['member_level_id'], $_CMI['cm_add_ml_ids'])-} selected="selected"{-:/if-}>{-:$l['ml_name']-}</option>
							{-:/foreach-}
							</select>
						</label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="cm_pass_switch"{-if:0==$_CMI['cm_pass_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
						<label><input type="radio" value="1" name="cm_pass_switch"{-if:1==$_CMI['cm_pass_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
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
						<textarea class="i" name="cm_keywords" style="width:360px;height:40px;">{-:$_CMI['cm_keywords']-}</textarea>
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
						<textarea class="i" name="cm_description" style="width:360px;height:60px;">{-:$_CMI['cm_description']-}</textarea>
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
						<textarea class="editor" name="cm_content" style="width:95%;height:180px;">{-:$_CMI['cm_content']|htmlspecialchars~@me-}</textarea>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="custom_model_id" type="hidden" value="{-:$_CMI['custom_model_id']-}">
	<span class="btn_b submit" action="{-url:custom_model/edit_model_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}-}">{-:@CONTENT_LIST-}</a>
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
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>