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
	<dt><strong>{-:@ARCHIVE_MODEL_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="archive_model_id"></th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@ALIAS-}</th>
				<th scope="col">{-:@ADDON_TABLE-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_AML,$am-}
			<tr>
				<td><input type="checkbox" value="{-:$am['archive_model_id']-}" name="archive_model_id[{-:$am['archive_model_id']-}]"></td>
				<td><input class="i required" type="text" value="{-:$am['am_display_order']-}" name="am_display_order[{-:$am['archive_model_id']-}]" maxlength="10" size="4"></td>
				<td><input class="i required" type="text" value="{-:$am['am_name']-}" name="am_name[{-:$am['archive_model_id']-}]" maxlength="40" size="20"> [ID:{-:$am['archive_model_id']-}]</td>
				<td>{-:$am['am_alias']-}</td>
				<td>{-:$am['am_addon_table']-}</td>
				<td>
				{-if:1 == $am['am_status']-}
					<span class="status"><b class="on">{-:@ON-}</b><a href="{-url:archive_model/toggle_model_status_do?archive_model_id={$am['archive_model_id']}&am_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@OFF-}</b><a href="{-url:archive_model/toggle_model_status_do?archive_model_id={$am['archive_model_id']}&am_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td>
				{-if:0 == $am['am_type']-}{-:@SYSTEM-}{-elseif:1 == $am['am_type']-}{-:@CUSTOM-}{-:/if-}
				</td>
				<td><a href="{-url:archive_model/export_model?archive_model_id={$am['archive_model_id']}-}">{-:@EXPORT-}</a> | <a href="{-url:archive_model/edit_model?archive_model_id={$am['archive_model_id']}-}">{-:@EDIT-}</a>{-if:0 != $am['am_type']-} | <a href="{-url:archive_model/delete_model_do?archive_model_id={$am['archive_model_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a>{-:/if-}</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:archive_model/add_model-}">{-:@ADD_MODEL-}</a>
	<a class="btn_l" href="{-url:archive_model/import_model-}">{-:@IMPORT_MODEL-}</a>
	<span class="btn_l submit" action="{-url:archive_model/update_model_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>