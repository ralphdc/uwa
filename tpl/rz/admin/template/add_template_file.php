<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_TEMPLATE_FILE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td><span class="bg_gry_d br_3 p_2_5 fc_wht fs_11">{-:@TEMPLATE-}: {-:$_V['template']-}</span> <span class="fw_b">{-:@CURRENT_DIR-}: {-:$_V['template']-}{-:$_V['current_dir']|str_replace~'\*','\/',@me-}</span></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><strong>{-:@TEMPLATE_FILE-}</strong> <input class="i required" type="text" value="{-:$_V['file']-}" name="file" maxlength="255" size="30" /></label>
					<label><strong>{-:@TEMPLATE_DESCRIPTION-}</strong> <input class="i" type="text" value="{-:$_V['description']-}" name="description" maxlength="255" size="20" /></label>
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea name="content" style="width:98%;height:300px">{-:$_V['content']-}</textarea>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="template" type="hidden" value="{-:$_V['template']-}" />
	<input name="dir" type="hidden" value="{-:$_V['current_dir']-}" />
	<span class="btn_b submit" action="{-url:template/add_template_file_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:template/list_template_file?template={$_V['template']}&dir={$_V['current_dir']}-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>