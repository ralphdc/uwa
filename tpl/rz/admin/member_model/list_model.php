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
	<dt><strong>{-:@MEMBER_MODEL_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_model_id"></th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@ALIAS-}</th>
				<th scope="col">{-:@ADDON_TABLE-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_MML,$mm-}
			<tr>
				<td><input type="checkbox" value="{-:$mm['member_model_id']-}" name="member_model_id[{-:$mm['member_model_id']-}]"></td>
				<td><input class="i required" type="text" value="{-:$mm['mm_display_order']-}" name="mm_display_order[{-:$mm['member_model_id']-}]" maxlength="10" size="4"></td>
				<td><input class="i required" type="text" value="{-:$mm['mm_name']-}" name="mm_name[{-:$mm['member_model_id']-}]" maxlength="40" size="20"> [ID:{-:$mm['member_model_id']-}]</td>
				<td>{-:$mm['mm_alias']-}</td>
				<td>{-:$mm['mm_addon_table']-}</td>
				<td>
				{-if:1 == $mm['mm_status']-}
					<span class="status"><b class="on">{-:@ON-}</b><a href="{-url:member_model/toggle_model_status_do?member_model_id={$mm['member_model_id']}&mm_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@OFF-}</b><a href="{-url:member_model/toggle_model_status_do?member_model_id={$mm['member_model_id']}&mm_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td>
				{-if:0 == $mm['mm_type']-}{-:@SYSTEM-}{-elseif:1 == $mm['mm_type']-}{-:@CUSTOM-}{-:/if-}
				</td>
				<td><a href="{-url:member_model/export_model?member_model_id={$mm['member_model_id']}-}">{-:@EXPORT-}</a> | <a href="{-url:member_model/edit_model?member_model_id={$mm['member_model_id']}-}">{-:@EDIT-}</a>{-if:0 != $mm['mm_type']-} | <a href="{-url:member_model/delete_model_do?member_model_id={$mm['member_model_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a>{-:/if-}</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:member_model/add_model-}">{-:@ADD_MODEL-}</a>
	<a class="btn_l" href="{-url:member_model/import_model-}">{-:@IMPORT_MODEL-}</a>
	<span class="btn_l submit" action="{-url:member_model/update_model_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>