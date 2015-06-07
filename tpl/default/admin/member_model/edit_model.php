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
						{-:$_MMI['member_model_id']-}<input type="hidden" value="{-:$_MMI['member_model_id']-}" name="member_model_id">
					</td>
					<td class="inputTip">
						{-:@MEMBER_MODEL_ID_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_name']-}" name="mm_name" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_NAME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_display_order']-}" name="mm_display_order" maxlength="10" size="6">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_DISPLAY_ORDER_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@ALIAS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_MMI['mm_alias']-}
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_ALIAS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@ADDON_TABLE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_MMI['mm_addon_table']-}
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_ADDON_TABLE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MODEL_TYPE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
					{-if:0 == $_MMI['mm_type']-}{-:@SYSTEM-}{-elseif:1 == $_MMI['mm_type']-}{-:@CUSTOM-}{-:/if-}
					</td>
					<td class="inputTip">
					{-if:0 == $_MMI['mm_type']-}
						<span class="fc_r">{-:@MM_TYPE_SYSTEM_TIP-}</span>
					{-else:-}
						{-:@MM_TYPE_TIP-}
					{-:/if-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@DEFAULT_LEVEL-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<select name="mm_default_level">
						{-foreach:$_MLL,$l-}
							<option value="{-:$l['member_level_id']-}"{-if:$l['member_level_id']==$_MMI['mm_default_level']-} selected="selected"{-:/if-}>{-:$l['ml_name']-}</option>
						{-:/foreach-}
						</select>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_DEFAULT_LEVEL_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@STATUS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" name="mm_status" {-if:1 == $_MMI['mm_status']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
						<label><input type="radio" name="mm_status" {-if:0 == $_MMI['mm_status']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_STATUS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_TPL_ADD-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="mm_tpl_add" class="required i" type="text" value="{-:$_MMI['mm_tpl_add']-}" name="mm_tpl_add" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="mm_tpl_add">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_TPL_ADD_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_TPL_EDIT-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="mm_tpl_edit" class="required i" type="text" value="{-:$_MMI['mm_tpl_edit']-}" name="mm_tpl_edit" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="mm_tpl_edit">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_TPL_EDIT_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_TPL_ADD_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="mm_tpl_add_member" class="required i" type="text" value="{-:$_MMI['mm_tpl_add_member']-}" name="mm_tpl_add_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="mm_tpl_add_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_TPL_ADD_MEMBER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_TPL_EDIT_MEMBER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="mm_tpl_edit_member" class="required i" type="text" value="{-:$_MMI['mm_tpl_edit_member']-}" name="mm_tpl_edit_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="mm_tpl_edit_member">{-:@CHOOSE-}</span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MM_TPL_EDIT_MEMBER_TIP-}
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputTitle">{-:@AGREEMENT-} <span class="fw_n fc_gry">{-:@MM_AGREEMENT_TIP-}</span></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<textarea class="i editor" style="width:640px;height:180px;" name="mm_agreement">{-:$_MMI['mm_agreement']-}</textarea>
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<div id="operation">
				<a class="btn_l" href="{-url:member_model/add_model_field?member_model_id={$_MMI['member_model_id']}-}">{-:@ADD_FIELD-}</a>
			</div>
			<table class="listTable">
				<tr>
					<th scope="col">{-:@FIELD_NAME-}</th>
					<th scope="col">{-:@NAME-}</th>
					<th scope="col">{-:@DATA_TYPE-}</th>
					<th scope="col">{-:@FORM_TYPE-}</th>
					<th scope="col">{-:@MANAGE-}</th>
				</tr>
				{-foreach:$_MMI['mm_field'],$k,$v-}
				<tr>
					<td>{-:$k-}</td>
					<td>{-:$v['f_item_name']-}</td>
					<td>{-:@FILED_{$v['f_type']}-}</td>
					<td>{-if:1 == $v['f_is_auto']-}{-:@AUTO_FIELD-}{-else:-}{-:@FIXED_FIELD-}{-:/if-}</td>
					<td><a href="{-url:member_model/edit_model_field?member_model_id={$_MMI['member_model_id']}&f_name={$k}-}">{-:@EDIT-}</a> | <a href="{-url:member_model/delete_model_field_do?member_model_id={$_MMI['member_model_id']}&f_name={$k}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
				</tr>
				{-:/foreach-}
			</table>
			<table class="formTable">
				<tr>
					<td colspan="2" class="inputTitle">{-:@MM_FIELDSET-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@MM_FIELDSET_TIP-}</span></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<textarea class="i" name="mm_fieldset" style="width:90%;height:150px;">{-:$_MMI['mm_fieldset']-}</textarea>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:member_model/edit_model_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:member_model/list_model-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		toolbar : 'uwa_simple',
		width : 640, height : 180
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