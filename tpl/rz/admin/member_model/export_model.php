<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="atab">
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@FILE_LIST-}</strong><strong>{-:@LANGUAGE-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td colspan="2" class="inputTitle">{-:@NAME-}</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_name']-}" name="mm_name" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_NAME_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputTitle">{-:@ALIAS-}</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_alias']-}" name="mm_alias" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_ALIAS_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputTitle">{-:@ADDON_TABLE-}</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_addon_table']-}" name="mm_addon_table" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_ADDON_TABLE_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_TPL_ADD-}</td>
					<td class="inputTitle">{-:@MM_TPL_EDIT-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_tpl_add']-}" name="mm_tpl_add" maxlength="255" size="40">
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_tpl_edit']-}" name="mm_tpl_edit" maxlength="255" size="40">
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_TPL_ADD_MEMBER-}</td>
					<td class="inputTitle">{-:@MM_TPL_EDIT_MEMBER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_tpl_add_member']-}" name="mm_tpl_add_member" maxlength="255" size="40">
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_tpl_edit_member']-}" name="mm_tpl_edit_member" maxlength="255" size="40">
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_FIELDSET-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<textarea class="i" name="mm_fieldset" style="width:95%;height:120px;">{-:$_MMI['mm_fieldset']-}</textarea>
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
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@PACKAGE_FILE_LIST-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
<textarea class="i" name="file_list" style="width:640px;height:300px;">
{uwa_path}/{-:*TPL_DIR-}/{-:*THEME_NAME-}/admin/{-:$_MMI['mm_tpl_add']-}.php
{uwa_path}/{-:*TPL_DIR-}/{-:*THEME_NAME-}/admin/{-:$_MMI['mm_tpl_edit']-}.php
{uwa_path}/{-:*TPL_DIR-}/{-:*THEME_NAME-}/member/{-:$_MMI['mm_tpl_add_member']-}.php
{uwa_path}/{-:*TPL_DIR-}/{-:*THEME_NAME-}/member/{-:$_MMI['mm_tpl_edit_member']-}.php
</textarea>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@FILE_LIST_TIP-}
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td colspan="2"  class="inputTitle">{-:@LANGUAGE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea id="up_lang" class="i" name="up_lang" style="width:640px;height:240px;"></textarea>
					</td>
					<td class="inputTip">{-:@UWA_PACKAGE_LANG_TIP-}</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<label>{-:@COMPRESS-} <input name="compressed" type="checkbox" checked="checked" value="1" /></label>
	<span class="btn_b submit" action="{-url:member_model/export_model_do-}" to="#formEdit">{-:@EXPORT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:member_model/list_model-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
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
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>