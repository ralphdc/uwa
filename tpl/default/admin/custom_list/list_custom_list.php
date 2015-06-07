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
	<dt><strong>{-:@CUSTOM_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="custom_list_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@TITLE-}</th>
				<th scope="col">{-:@TEMPLATE-}</th>
				<th scope="col">{-:@BUILD_NAMING-}</th>
				<th scope="col">{-:@CONTENT_TYPE-}</th>
				<th scope="col">{-:@IS_BUILD-}</th>
				<th scope="col">{-:@UPDATE_TIME-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_CLL,$cl-}
			<tr>
				<td>
					<input name="custom_list_id[{-:$cl['custom_list_id']-}]" type="checkbox" value="{-:$cl['custom_list_id']-}">
				</td>
				<td>{-:$cl['custom_list_id']-}</td>
				<td>{-:$cl['cl_title']-}</td>
				<td>{-:$cl['cl_tpl']-}</td>
				<td>{-:$cl['cl_build_naming']-}</td>
				<td>{-:$cl['cl_content_type']-}</td>
				<td>{-if:0==$cl['cl_is_build']-}<span class="br_3 br_r p_0_2 fs_11 fc_r">{-:@OFF-}</span>{-else:-}<span class="br_3 br_g p_0_2 fs_11 fc_g">{-:@ON-}</span>{-:/if-}</td>
				<td>
					{-:$cl['cl_update_time']|date~C('APP.TIME_FORMAT'),@me-}
				</td>
				<td><a href="{-url:home@custom_list/show_custom_list?custom_list_id={$cl['custom_list_id']}-}" target="_blank">{-:@PREVIEW-}</a> | <a href="{-url:custom_list/edit_custom_list?custom_list_id={$cl['custom_list_id']}-}">{-:@EDIT-}</a> | <a href="{-url:custom_list/delete_custom_list_do?custom_list_id={$cl['custom_list_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a> <a class="btn_l" href="{-url:custom_list/build_custom_list_do?custom_list_id={$cl['custom_list_id']}-}">{-:@BUILD_LIST-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:custom_list/add_custom_list-}">{-:@ADD_CUSTOM_LIST-}</a>
	<span class="btn_l submit" action="{-url:custom_list/delete_custom_list_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>