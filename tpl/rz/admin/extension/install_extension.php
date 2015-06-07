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
	<dt><strong>{-:@INSTALL_EXTENSION-} [{-:$_EI['e_name']-}]</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td colspan="2" class="inputTitle">{-:@MANAGE_MENU-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="e_manage_menu" style="width:640px;height:40px;">{-:$_EI['e_manage_menu']-}</textarea>
					</td>
					<td class="inputTip">
						{-:@EXTENSION_MANAGE_MENU_TIP-}
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputTitle">{-:@EXTENSION_FILE_LIST-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@TREATMENT_OF_EXISTING_FILE-}: {-:@TREATMENT_OF_EXISTING_FILE_TIP-}</span></td>
				</tr>
				<tr>
					<td class="inputArea">
					{-foreach:$_EI['file_list'],$k,$file-}
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
	<span class="btn_b submit" action="{-url:extension/install_extension_do-}" to="#formEdit">{-:@INSTALL-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:extension/list_extension-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>