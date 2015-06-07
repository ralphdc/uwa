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
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@FILE_LIST-}</strong><strong>{-:@ADVANCE-}</strong><strong>{-:@OTHER-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@EXTENSION_NAME-}</td>
					<td class="inputTitle">{-:@EXTENSION_ALIAS-}</td>
					<td class="inputTitle">{-:@EXTENSION_TYPE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_EI['e_name']-}
					</td>
					<td class="inputArea">
						{-:$_EI['e_alias']-}
					</td>
					<td class="inputArea">
				{-if:'module' == $_EI['e_type']-}
					{-:@MODULE-}
				{-elseif:'plugin' == $_EI['e_type']-}
					{-:@PLUGIN-}
				{-elseif:'template' == $_EI['e_type']-}
					{-:@TEMPLATE-}
				{-elseif:'patch' == $_EI['e_type']-}
					{-:@PATCH-}
				{-elseif:'other' == $_EI['e_type']-}
					{-:@OTHER-}
				{-:/if-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AUTHOR-}</td>
					<td class="inputTitle">{-:@AUTHOR_EMAIL-}</td>
					<td class="inputTitle">{-:@AUTHOR_SITE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_EI['e_author']-}
					</td>
					<td class="inputArea">
						{-:$_EI['e_author_email']-}
					</td>
					<td class="inputArea">
						{-:$_EI['e_author_site']-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@EXTENSION_HASHCODE-}</td>
					<td class="inputTitle">{-:@VERSION-}</td>
					<td class="inputTitle">{-:@PUBLISH_DATE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<span id="e_hashcode" class="p_0_2 br_gry bg_gry fc_wht fs_11 fw_b br_3">{-:$_EI['e_hashcode']-}</span>
					</td>
					<td class="inputArea">
						{-:$_EI['e_version']-}
					</td>
					<td class="inputArea">
						{-:$_EI['e_publish_date']-}
					</td>
				</tr>
				<tr>
					<td colspan="3" class="inputTitle">{-:@INSTRUCTION-}</td>
				</tr>
				<tr>
					<td colspan="3">
						<div class="br_gry bg_gry_l p_20 br_5">{-:$_EI['e_instruction']-}</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@EXTENSION_FILE_LIST-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
<textarea class="i"  disabled="disabled" style="width:640px;height:300px;">{-foreach:$_EI['file_list'],$file-}
{-:$file['filename']-} 
{-:/foreach-}</textarea>
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
					<td colspan="2" class="inputTitle">{-:@MANAGE_MENU-}</td>
				</tr>
				<tr>
					<td class="inputArea">
<textarea class="i" disabled="disabled" style="width:640px;height:40px;">{-:$_EI['e_manage_menu']-}</textarea>
					</td>
					<td class="inputTip">
						{-:@EXTENSION_MANAGE_MENU_TIP-}
					</td>
				</tr>
				<tr>
					<td colspan="2"  class="inputTitle">{-:@INSTALL-} SQL</td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea id="e_install" class="i" disabled="disabled" style="width:640px;height:120px;">{-:$_EI['e_install']-}</textarea>
					</td>
					<td class="inputTip">{-:@EXTENSION_INSTALL_TIP-}</td>
				</tr>
				<tr>
					<td colspan="2"  class="inputTitle">{-:@UNINSTALL-} SQL</td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea id="e_uninstall" class="i" disabled="disabled" style="width:640px;height:120px;">{-:$_EI['e_uninstall']-}</textarea>
					</td>
					<td class="inputTip">{-:@EXTENSION_UNINSTALL_TIP-}</td>
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
						<textarea id="e_lang" class="i" disabled="disabled" style="width:640px;height:80px;">{-:$_EI['e_lang']-}</textarea>
					</td>
					<td class="inputTip">{-:@UWA_PACKAGE_LANG_TIP-}</td>
				</tr>
				<tr>
					<td colspan="2"  class="inputTitle">{-:@ROUTE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea id="e_route" class="i" disabled="disabled" style="width:640px;height:80px;">{-:$_EI['e_route']-}</textarea>
					</td>
					<td class="inputTip">{-:@UWA_PACKAGE_ROUTE_TIP-}</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="e_hashcode" type="hidden" value="{-:$_EI['e_hashcode']-}">
	{-if:1 == $_EI['e_status']-}
	<span class="btn_l submit" action="{-url:extension/uninstall_extension_do-}" to="#formEdit">{-:@UNINSTALL-}</span>
	{-else:-}
	<span class="btn_l submit" action="{-url:extension/install_extension-}" to="#formEdit">{-:@INSTALL-}</span>
	<span class="btn_l submit" action="{-url:extension/delete_extension_do-}" to="#formEdit">{-:@DELETE-}</span>
	{-:/if-}
	<a class="btn_l" href="{-url:extension/list_extension-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>