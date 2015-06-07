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
					<td colspan="2" class="inputTitle">{-:@DISPLAY_ORDER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-:$_AMI['am_name']-}" name="am_name" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@AM_NAME_TIP-}</span>
					</td>
					<td colspan="2" class="inputArea">
						<input class="required i" type="text" value="50" name="am_display_order" maxlength="10" size="6">
<span class="fc_gry"><span class="fc_r">*</span> {-:@AM_DISPLAY_ORDER_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td colspan="3" class="inputTitle">{-:@ALIAS-}</td>
				</tr>
				<tr>
					<td colspan="3" class="inputArea">
						<input class="required i" type="text" value="{-:$_AMI['am_alias']-}" name="am_alias" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@AM_ALIAS_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td colspan="3" class="inputTitle">{-:@ADDON_TABLE-}</td>
				</tr>
				<tr>
					<td colspan="3" class="inputArea">
						<input class="required i" type="text" value="{-:$_AMI['am_addon_table']-}" name="am_addon_table" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> {-:@AM_ADDON_TABLE_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@MODEL_TYPE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" name="am_type" value="0"> {-:@SYSTEM-}</label>
						<label><input type="radio" name="am_type" checked="checked" value="1"> {-:@CUSTOM-}</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AM_TYPE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_LIST-}</td>
					<td class="inputTitle">{-:@AM_TPL_ADD-}</td>
					<td class="inputTitle">{-:@AM_TPL_EDIT-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['am_tpl_list']-}" size="40">
						<input type="hidden" value="{-:$_AMI['am_tpl_list']-}" name="am_tpl_list">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['am_tpl_add']-}" size="40">
						<input type="hidden" value="{-:$_AMI['am_tpl_add']-}" name="am_tpl_add">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['am_tpl_edit']-}" size="40">
						<input type="hidden" value="{-:$_AMI['am_tpl_edit']-}" name="am_tpl_edit">
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AM_TPL_LIST_MEMBER-}</td>
					<td class="inputTitle">{-:@AM_TPL_ADD_MEMBER-}</td>
					<td class="inputTitle">{-:@AM_TPL_EDIT_MEMBER-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['am_tpl_list_member']-}" size="40">
						<input type="hidden" value="{-:$_AMI['am_tpl_list_member']-}" name="am_tpl_list_member">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['am_tpl_add_member']-}" size="40">
						<input type="hidden" value="{-:$_AMI['am_tpl_add_member']-}" name="am_tpl_add_member">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['am_tpl_edit_member']-}" size="40">
						<input type="hidden" value="{-:$_AMI['am_tpl_edit_member']-}" name="am_tpl_edit_member">
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AC_TPL_INDEX_DEFAULT-}</td>
					<td class="inputTitle">{-:@AC_TPL_LIST_DEFAULT-}</td>
					<td class="inputTitle">{-:@AC_TPL_ARCHIVE_DEFAULT-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['ac_tpl_index_default']-}" size="40">
						<input type="hidden" value="{-:$_AMI['ac_tpl_index_default']-}" name="ac_tpl_index_default">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['ac_tpl_list_default']-}" size="40">
						<input type="hidden" value="{-:$_AMI['ac_tpl_list_default']-}" name="ac_tpl_list_default">
					</td>
					<td class="inputArea">
						<input disabled="disabled" class="i" type="text" value="{-:$_AMI['ac_tpl_archive_default']-}" size="40">
						<input type="hidden" value="{-:$_AMI['ac_tpl_archive_default']-}" name="ac_tpl_archive_default">
					</td>
				</tr>
				<tr>
					<td colspan="3" class="inputTitle">{-:@AM_FIELDSET-}</td>
				</tr>
				<tr>
					<td colspan="3" class="inputArea">
						<textarea disabled="disabled" class="i" style="width:95%;height:120px;">{-:$_AMI['am_fieldset']-}</textarea>
						<textarea name="am_fieldset" style="display:none;">{-:$_AMI['am_fieldset']-}</textarea>
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
					{-foreach:$_AMI['file_list'],$k,$file-}
						<p><input disabled="disabled" class="i" type="text" value="{-:$file['filename']-}" size="80">
						<label><input class="i" checked="checked" type="checkbox" name="file_list[{-:$k-}][overwrite]" value="1"> {-:@OVERWRITE-}</label>
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
						<textarea id="up_lang" class="i" name="up_lang" style="width:640px;height:240px;">{-:$_AMI['up_lang']-}</textarea>
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
	<span class="btn_b submit" action="{-url:archive_model/import_model_do-}" to="#formEdit">{-:@IMPORT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:archive_model/list_model-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>