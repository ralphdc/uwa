<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" enctype="multipart/form-data" method="post">
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
						<input class="required i" type="text" value="" name="e_name" maxlength="64" size="30"> <span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="e_alias" maxlength="64" size="20"> <span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						<label><input type="radio" name="e_type" value="module"> {-:@MODULE-}</label>
						<label><input type="radio" name="e_type" value="plugin" checked="checked"> {-:@PLUGIN-}</label>
						<label><input type="radio" name="e_type" value="template"> {-:@TEMPLATE-}</label>
						<label><input type="radio" name="e_type" value="patch"> {-:@PATCH-}</label>
						<label><input type="radio" name="e_type" value="other"> {-:@OTHER-}</label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AUTHOR-}</td>
					<td class="inputTitle">{-:@AUTHOR_EMAIL-}</td>
					<td class="inputTitle">{-:@AUTHOR_SITE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="e_author" maxlength="64" size="20"> <span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="" name="e_author_email" maxlength="255" size="30"> <span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="" name="e_author_site" maxlength="255" size="40" placeholder="http://">
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@EXTENSION_HASHCODE-}</td>
					<td class="inputTitle">{-:@VERSION-}</td>
					<td class="inputTitle">{-:@PUBLISH_DATE-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input type="hidden" value="" name="e_hashcode">
						<span id="e_hashcode" class="p_0_2 br_gry bg_gry fc_wht fs_11 fw_b br_3" style="display:none"></span>
						<span id="get_hashcode" class="p_0_2 bg_b br_b fc_wht fw_b br_3 fs_11 a">{-:@BUILD-}</span> <span class="fc_gry"><span class="fc_r">*</span> {-:@EXTENSION_HASHCODE_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="1.0.0" name="e_version" maxlength="64" size="10">
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="{-php: echo(date('Y-m-d', time()));-}" name="e_publish_date" maxlength="64" size="10">
					</td>
				</tr>
				<tr>
					<td colspan="3" class="inputTitle">{-:@INSTRUCTION-}</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
<textarea class="editor_simple" name="e_instruction" style="width:640px;height:120px;">
</textarea>
					</td>
					<td class="inputArea">
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
<textarea class="i" name="file_list" style="width:640px;height:300px;">
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
					<td colspan="2" class="inputTitle">{-:@MANAGE_MENU-}</td>
				</tr>
				<tr>
					<td class="inputArea">
<textarea class="i" name="e_manage_menu" style="width:640px;height:40px;">
</textarea>
					</td>
					<td class="inputTip">
						{-:@EXTENSION_MANAGE_MENU_TIP-}
					</td>
				</tr>
				<tr>
					<td colspan="2"  class="inputTitle">{-:@INSTALL-} SQL <label class="fw_n fs_12"><input type="checkbox" to1="e_install_upload" to2="e_install" class="toggle_field"> {-:@UPLOAD-}</label></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="e_install_upload" type="file" name="e_install_upload" style="display:none;" >
						<textarea id="e_install" class="i" name="e_install" style="width:640px;height:120px;"></textarea>
					</td>
					<td class="inputTip">{-:@EXTENSION_INSTALL_TIP-}</td>
				</tr>
				<tr>
					<td colspan="2"  class="inputTitle">{-:@UNINSTALL-} SQL <label class="fw_n fs_12"><input type="checkbox" to1="e_uninstall_upload" to2="e_uninstall" class="toggle_field"> {-:@UPLOAD-}</label></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="e_uninstall_upload" type="file" name="e_uninstall_upload" style="display:none;" >
						<textarea id="e_uninstall" class="i" name="e_uninstall" style="width:640px;height:120px;"></textarea>
					</td>
					<td class="inputTip">{-:@EXTENSION_UNINSTALL_TIP-}</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td colspan="2"  class="inputTitle">{-:@LANGUAGE-} <label class="fw_n fs_12"><input type="checkbox" to1="e_lang_upload" to2="e_lang" class="toggle_field"> {-:@UPLOAD-}</label></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="e_lang_upload" type="file" name="e_lang_upload" style="display:none;" >
						<textarea id="e_lang" class="i" name="e_lang" style="width:640px;height:80px;"></textarea>
					</td>
					<td class="inputTip">{-:@UWA_PACKAGE_LANG_TIP-}</td>
				</tr>
				<tr>
					<td colspan="2"  class="inputTitle">{-:@ROUTE-} <label class="fw_n fs_12"><input type="checkbox" to1="e_route_upload" to2="e_route" class="toggle_field"> {-:@UPLOAD-}</label></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="e_route_upload" type="file" name="e_route_upload" style="display:none;" >
						<textarea id="e_route" class="i" name="e_route" style="width:640px;height:80px;"></textarea>
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
	<label>{-:@COMPRESS-} <input name="compressed" type="checkbox" checked="checked" value="1" /></label>
	<span class="btn_b submit" action="{-url:extension/package_extension_do-}" to="#formEdit">{-:@PACKAGE-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:extension/list_extension-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script>
$(document).ready(function() {
	var editor_option_simple = {
		toolbar : 'uwa_simple',
		width : 650, height : 120
	};
	$('.editor_simple').each(function(){
		CKEDITOR.replace(this, editor_option_simple);
	});
});
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script>
var url_get_extension_hashcode = '{-url:ajax/get_extension_hashcode-}';
</script>
<script src="{-:*__THEME__-}admin/js/e.js"></script>
</body>
</html>