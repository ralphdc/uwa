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
<dl class="abox">
	<dt><strong>{-:@GENERAL-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="mm_name" maxlength="64" size="30">
					<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_NAME_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="required i" type="text" value="50" name="mm_display_order" maxlength="10" size="6">
					<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@ALIAS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="mm_alias" maxlength="64" size="30"> <span class="btn_l" onClick="check_alias('mm_alias');">{-:@CHECK_ALIAS-}</span> <span id="check_alias_result"></span>
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
					<input class="required i" type="text" value="member_addon_" name="mm_addon_table" maxlength="64" size="30"> <span class="btn_l" onClick="check_table('mm_addon_table');">{-:@CHECK_ADDON_TABLE-}</span> <span id="check_table_result"></span>
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
					<label><input type="radio" name="mm_type" value="0"> {-:@SYSTEM-}</label>
					<label><input type="radio" name="mm_type" checked="checked" value="1"> {-:@CUSTOM-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MM_TYPE_TIP-}
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
						<option value="{-:$l['member_level_id']-}">{-:$l['ml_name']-}</option>
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
					<label><input type="radio" name="mm_status" checked="checked" value="1"> {-:@ON-}</label>
					<label><input type="radio" name="mm_status" value="0"> {-:@OFF-}</label>
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
					<input id="mm_tpl_add" class="required i" type="text" value="member/add_member" name="mm_tpl_add" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="mm_tpl_add">{-:@CHOOSE-}</span>
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
					<input id="mm_tpl_edit" class="required i" type="text" value="member/edit_member" name="mm_tpl_edit" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="mm_tpl_edit">{-:@CHOOSE-}</span>
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
					<input id="mm_tpl_add_member" class="required i" type="text" value="member/register" name="mm_tpl_add_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="mm_tpl_add_member">{-:@CHOOSE-}</span>
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
					<input id="mm_tpl_edit_member" class="required i" type="text" value="member/edit_info_addon" name="mm_tpl_edit_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="mm_tpl_edit_member">{-:@CHOOSE-}</span>
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
					<textarea class="i editor" style="width:640px;height:180px;" name="mm_agreement"></textarea>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:member_model/add_model_do-}" to="#formAdd">{-:@SUBMIT-}</span>
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

var url_check_alias = '{-url:ajax/check_model_alias?type=member-}',
	url_check_table = '{-url:ajax/check_table-}',
	checking = '{-:@CHECKING-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/am.js"></script>
</body>
</html>