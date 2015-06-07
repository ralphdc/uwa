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
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@ADDON_FIELD-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@ID-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_AMI['archive_model_id']-}<input type="hidden" value="{-:$_AMI['archive_model_id']-}" name="archive_model_id">
					</td>
					<td class="inputTip">
						{-:@ARCHIVE_MODEL_ID_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_AMI['am_name']-}" name="am_name" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@AM_NAME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_AMI['am_display_order']-}" name="am_display_order" maxlength="10" size="6">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@AM_DISPLAY_ORDER_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@ALIAS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_AMI['am_alias']-}
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AM_ALIAS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@ADDON_TABLE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_AMI['am_addon_table']-}
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AM_ADDON_TABLE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MODEL_TYPE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
					{-if:0 == $_AMI['am_type']-}{-:@SYSTEM-}{-elseif:1 == $_AMI['am_type']-}{-:@CUSTOM-}{-:/if-}
					</td>
					<td class="inputTip">
					{-if:0 == $_AMI['am_type']-}
						<span class="fc_r">{-:@AM_TYPE_SYSTEM_TIP-}</span>
					{-else:-}
						{-:@AM_TYPE_TIP-}
					{-:/if-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@STATUS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" name="am_status" {-if:1 == $_AMI['am_status']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
						<label><input type="radio" name="am_status" {-if:0 == $_AMI['am_status']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AM_STATUS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_LIST-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="am_tpl_list" class="required i" type="text" value="{-:$_AMI['am_tpl_list']-}" name="am_tpl_list" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_list">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AM_TPL_LIST_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_ADD-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="am_tpl_add" class="required i" type="text" value="{-:$_AMI['am_tpl_add']-}" name="am_tpl_add" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_add">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AM_TPL_ADD_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_EDIT-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="am_tpl_edit" class="required i" type="text" value="{-:$_AMI['am_tpl_edit']-}" name="am_tpl_edit" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_edit">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AM_TPL_EDIT_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_LIST_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="am_tpl_list_member" class="i" type="text" value="{-:$_AMI['am_tpl_list_member']-}" name="am_tpl_list_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_list_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						{-:@AM_TPL_LIST_MEMBER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_ADD_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="am_tpl_add_member" class="i" type="text" value="{-:$_AMI['am_tpl_add_member']-}" name="am_tpl_add_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_add_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						{-:@AM_TPL_ADD_MEMBER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_EDIT_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="am_tpl_edit_member" class="i" type="text" value="{-:$_AMI['am_tpl_edit_member']-}" name="am_tpl_edit_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_edit_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						{-:@AM_TPL_EDIT_MEMBER_TIP-}
					</td>
				</tr>
			<tr>
				<td class="inputTitle">{-:@AC_TPL_INDEX_DEFAULT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="ac_tpl_index_default" class="i" type="text" value="{-:$_AMI['ac_tpl_index_default']-}" name="ac_tpl_index_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_index_default">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					{-:@AC_TPL_INDEX_DEFAULT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@AC_TPL_LIST_DEFAULT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="ac_tpl_list_default" class="i" type="text" value="{-:$_AMI['ac_tpl_list_default']-}" name="ac_tpl_list_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_list_default">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					{-:@AC_TPL_LIST_DEFAULT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@AC_TPL_ARCHIVE_DEFAULT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="ac_tpl_archive_default" class="i" type="text" value="{-:$_AMI['ac_tpl_archive_default']-}" name="ac_tpl_archive_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_archive_default">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					{-:@AC_TPL_ARCHIVE_DEFAULT_TIP-}
				</td>
			</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<div id="operation">
				<a class="btn_l" href="{-url:archive_model/add_model_field?archive_model_id={$_AMI['archive_model_id']}-}">{-:@ADD_FIELD-}</a>
			</div>
			<table class="listTable">
				<tr>
					<th scope="col">{-:@FIELD_NAME-}</th>
					<th scope="col">{-:@NAME-}</th>
					<th scope="col">{-:@DATA_TYPE-}</th>
					<th scope="col">{-:@FORM_TYPE-}</th>
					<th scope="col">{-:@MANAGE-}</th>
				</tr>
				{-foreach:$_AMI['am_field'],$k,$v-}
				<tr>
					<td>{-:$k-}</td>
					<td>{-:$v['f_item_name']-}</td>
					<td>{-:@FILED_{$v['f_type']}-}</td>
					<td>{-if:1 == $v['f_is_auto']-}{-:@AUTO_FIELD-}{-else:-}{-:@FIXED_FIELD-}{-:/if-}</td>
					<td><a href="{-url:archive_model/edit_model_field?archive_model_id={$_AMI['archive_model_id']}&f_name={$k}-}">{-:@EDIT-}</a> | <a href="{-url:archive_model/delete_model_field_do?archive_model_id={$_AMI['archive_model_id']}&f_name={$k}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
				</tr>
				{-:/foreach-}
			</table>
			<table class="formTable">
				<tr>
					<td colspan="2" class="inputTitle">{-:@AM_FIELDSET-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@AM_FIELDSET_TIP-}</span></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<textarea class="i" name="am_fieldset" style="width:90%;height:150px;">{-:$_AMI['am_fieldset']-}</textarea>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:archive_model/edit_model_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:archive_model/list_model-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>