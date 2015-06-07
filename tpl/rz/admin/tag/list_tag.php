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
	<dt><strong>{-:@TAG_LIST-}</strong><span><a href="{-url:tag/edit_option-}">{-:@TAG_OPTION-}</a></span></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="tag_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@ARCHIVE_COUNT-}</th>
				<th scope="col">{-:@VIEW_COUNT-}</th>
				<th scope="col">{-:@ADD_TIME-}</th>
				<th scope="col">{-:@UPDATE_TIME-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_TL,$t-}
			<tr>
				<td>
					<input name="tag_id[{-:$t['tag_id']-}]" type="checkbox" value="{-:$t['tag_id']-}">
				</td>
				<td>{-:$t['tag_id']-}</td>
				<td>{-:$t['t_name']-}</td>
				<td>{-:$t['t_archive_count']-}</td>
				<td>{-:$t['t_view_count']-}</td>
				<td>
					{-:$t['t_add_time']|date~C('APP.TIME_FORMAT'),@me-}
				</td>
				<td>
					{-:$t['t_update_time']|date~C('APP.TIME_FORMAT'),@me-}
				</td>
				<td><a target="_blank" href="{-url:home@tag/show_tag?t_name={$t['t_name']}-}">{-:@PREVIEW-}</a> | <a href="{-url:tag/edit_tag?tag_id={$t['tag_id']}-}">{-:@EDIT-}</a> | <a href="{-url:tag/delete_tag_do?tag_id={$t['tag_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:tag/add_tag-}">{-:@ADD_TAG-}</a>
	<span class="btn_l submit" action="{-url:tag/delete_tag_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>