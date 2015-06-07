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
					<td class="inputTitle">{-:@NAME-}</td>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_MMI['mm_name']-}" name="mm_name" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_NAME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="50" name="mm_display_order" maxlength="10" size="6">
<span class="fc_gry"><span class="fc_r">*</span> {-:@MM_DISPLAY_ORDER_TIP-}</span>
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
					<td class="inputTitle">{-:@MM_TPL_ADD-}</td>
					<td class="inputTitle">{-:@MM_TPL_EDIT-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_MMI['mm_tpl_add']-}" size="40">
						<input type="hidden" value="{-:$_MMI['mm_tpl_add']-}" name="mm_tpl_add">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_MMI['mm_tpl_edit']-}" size="40">
						<input type="hidden" value="{-:$_MMI['mm_tpl_edit']-}" name="mm_tpl_edit">
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_TPL_ADD_MEMBER-}</td>
					<td class="inputTitle">{-:@MM_TPL_EDIT_MEMBER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_MMI['mm_tpl_add_member']-}" size="40">
						<input type="hidden" value="{-:$_MMI['mm_tpl_add_member']-}" name="mm_tpl_add_member">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_MMI['mm_tpl_edit_member']-}" size="40">
						<input type="hidden" value="{-:$_MMI['mm_tpl_edit_member']-}" name="mm_tpl_edit_member">
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MM_FIELDSET-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<textarea disabled="disabled" class="i" style="width:95%;height:120px;">{-:$_MMI['mm_fieldset']-}</textarea>
						<textarea name="mm_fieldset" style="display:none;">{-:$_MMI['mm_fieldset']-}</textarea>
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
					<td colspan="2" class="inputArea">
						<span class="fw_b">{-:@TREATMENT_OF_EXISTING_FILE-}</span> <span class="fc_gry"><span class="fc_r">*</span> {-:@TREATMENT_OF_EXISTING_FILE_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@PACKAGE_FILE_LIST-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
					{-foreach:$_MMI['file_list'],$k,$file-}
						<p><input disabled="disabled" class="i" type="text" value="{-:$file['filename']-}" size="80">
						<label><input checked="checked" type="checkbox" name="file_list[{-:$k-}][overwrite]" value="1"> {-:@OVERWRITE-}</label>
						<input type="hidden" value="{-:$file['filename']-}" name="file_list[{-:$k-}][filename]">
						<input type="hidden" value="{-:$file['content']-}" name="file_list[{-:$k-}][content]"></p>
					{-:/foreach-}
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
						<textarea id="up_lang" class="i" name="up_lang" style="width:640px;height:240px;">{-:$_MMI['up_lang']-}</textarea>
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
	<span class="btn_b submit" action="{-url:member_model/import_model_do-}" to="#formEdit">{-:@IMPORT-}</span>
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