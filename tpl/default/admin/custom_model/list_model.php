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
	<dt><strong>{-:@CUSTOM_MODEL_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="custom_model_id"></th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@ALIAS-}</th>
				<th scope="col">{-:@TABLE-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_CML,$cm-}
			<tr>
				<td><input type="checkbox" value="{-:$cm['custom_model_id']-}" name="custom_model_id[{-:$cm['custom_model_id']-}]"></td>
				<td><input class="i required" type="text" value="{-:$cm['cm_display_order']-}" name="cm_display_order[{-:$cm['custom_model_id']-}]" maxlength="10" size="4"></td>
				<td><input class="i required" type="text" value="{-:$cm['cm_name']-}" name="cm_name[{-:$cm['custom_model_id']-}]" maxlength="40" size="20"> [ID:{-:$cm['custom_model_id']-}]</td>
				<td>{-:$cm['cm_alias']-}</td>
				<td>{-:$cm['cm_table']-}</td>
				<td>
				{-if:1 == $cm['cm_status']-}
					<span class="status"><b class="on">{-:@ON-}</b><a href="{-url:custom_model/toggle_model_status_do?custom_model_id={$cm['custom_model_id']}&cm_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@OFF-}</b><a href="{-url:custom_model/toggle_model_status_do?custom_model_id={$cm['custom_model_id']}&cm_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td><a target="_blank" href="{-url:home@custom_model/list_content?custom_model_id={$cm['custom_model_id']}-}">{-:@PREVIEW-}</a> | <a href="{-url:custom_model/list_content?custom_model_id={$cm['custom_model_id']}-}">{-:@CONTENT_LIST-}</a> | <a href="{-url:custom_model/edit_model?custom_model_id={$cm['custom_model_id']}-}">{-:@EDIT-}</a> | <a href="{-url:custom_model/delete_model_do?custom_model_id={$cm['custom_model_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:custom_model/add_model-}">{-:@ADD_CUSTOM_MODEL-}</a>
	<span class="btn_l submit" action="{-url:custom_model/update_model_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:custom_model/delete_model_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>