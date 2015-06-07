<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@TEMPLATE_FILE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<td colspan="6"><span class="bg_gry_d br_3 p_2_5 fc_wht fs_11">{-:@TEMPLATE-}: {-:$_FL['template']-}</span> <span class="fw_b">{-:@CURRENT_DIR-}: {-:$_FL['template']-}{-:$_FL['current_dir']|str_replace~'\*','\/',@me-}</span></td>
			</tr>
			<tr>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@DESCRIPTION-}</th>
				<th scope="col">{-:@SIZE-}</th>
				<th scope="col">{-:@EDIT_TIME-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-if:!empty($_FL['current_dir'])-}<tr>
				<td colspan="5"><i class="ai ai_16 ai_16_file_type_folder"></i> <a href="{-url:template/list_template_file?template={$_FL['template']}&dir={$_FL['parent_dir']}-}">.. [{-:@PARENT_DIR-}]</a></td>
			</tr>{-:/if-}
			{-foreach:$_FL['list']['dir'],$dir-}
			<tr>
				<td><i class="ai ai_16 ai_16_file_type_folder"></i> <a href="{-url:template/list_template_file?template={$_FL['template']}&dir={$_FL['current_dir']}*{$dir['name']}-}">{-:$dir['name']-}</a></td>
				<td>
				{-if:!$_FL['is_locked'] and !empty($_FL['current_dir'])-}
					<input name="file[]" type="hidden" value="{-:$_FL['current_dir']-}*{-:$dir['name']-}">
					<input name="description[]" value="{-:$dir['description']-}" class="i" size="20" /></td>
				{-else:-}
					{-:$dir['description']-}
				{-:/if-}</td>
				<td></td>
				<td></td>
				<td>
				{-if:!$_FL['is_locked'] and !empty($_FL['current_dir'])-}
					<a href="{-url:template/delete_template_dir_do?template={$_FL['template']}&dir={$_FL['current_dir']}&dirname={$dir['name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a>
				{-:/if-}</td>
			</tr>
			{-:/foreach-}
			{-foreach:$_FL['list']['file'],$file-}
			<tr>
				<td><i class="ai ai_16 ai_16_file_type_{-:$file['type']-}"></i> {-:$file['name']-}</td>
				<td>
				{-if:!$_FL['is_locked'] and !empty($_FL['current_dir'])-}
					<input name="file[]" type="hidden" value="{-:$_FL['current_dir']-}*{-:$file['name']-}">
					<input name="description[]" value="{-:$file['description']-}" class="i" size="20" />
				{-else:-}
					{-:$file['description']-}
				{-:/if-}</td>
				<td>{-:$file['size']-}</td>
				<td>{-:$file['edit_time']-}</td>
				<td>
				{-if:!$_FL['is_locked'] and !empty($_FL['current_dir'])-}
					<a href="{-url:template/edit_template_file?template={$_FL['template']}&dir={$_FL['current_dir']}&file={$file['name']}-}">{-:@EDIT-}</a>
					| <a href="{-url:template/delete_template_file_do?template={$_FL['template']}&dir={$_FL['current_dir']}&file={$file['name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a>
				{-else:-}
					{-:@LOCKED-}
				{-:/if-}</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="template" type="hidden" value="{-:$_FL['template']-}" />
	<input name="dir" type="hidden" value="{-:$_FL['current_dir']-}" />
{-if:!$_FL['is_locked'] and !empty($_FL['current_dir'])-}
	<span class="btn_l submit" action="{-url:template/update_template_description_do-}" to="#formList">{-:@UPDATE_TEMPLATE_DESCRIPTION-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:template/add_template_dir?template={$_FL['template']}&dir={$_FL['current_dir']}-}">{-:@ADD_TEMPLATE_DIR-}</a>
	<a class="btn_l" href="{-url:template/add_template_file?template={$_FL['template']}&dir={$_FL['current_dir']}-}">{-:@ADD_TEMPLATE_FILE-}</a>
{-:/if-}
	<a class="btn_l" href="{-url:template/list_template-}">{-:@TEMPLATE_LIST-}</a>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>