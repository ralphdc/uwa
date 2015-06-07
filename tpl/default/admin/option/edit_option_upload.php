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
<dl class="abox">
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><strong>{-:@UPLOAD-}</strong><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@UPLOAD_SWITCH-} [upload/switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="upload[switch]"{-if:0==$_O['upload']['switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="upload[switch]"{-if:1==$_O['upload']['switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@UPLOAD_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@UPLOAD_IMGTYPE-} [upload/imgtype]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['upload']['imgtype']-}" name="upload[imgtype]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@UPLOAD_IMGTYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@UPLOAD_FILETYPE-} [upload/filetype]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['upload']['filetype']-}" name="upload[filetype]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@UPLOAD_FILETYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@UPLOAD_DIR-} [upload/dir]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['upload']['dir']-}" name="upload[dir]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@UPLOAD_DIR_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@UPLOAD_SUB_DIR-} [upload/sub_dir]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_O['upload']['sub_dir']-}" name="upload[sub_dir]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					{-:@UPLOAD_SUB_DIR_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@UPLOAD_SPACE-} [upload/space]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['upload']['space']-}" name="upload[space]" maxlength="20" size="10" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@UPLOAD_SPACE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@UPLOAD_MAXSIZE-} [upload/maxsize]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['upload']['maxsize']-}" name="upload[maxsize]" maxlength="20" size="10" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@UPLOAD_MAXSIZE_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_upload_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>