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
	<dt><strong>{-:@INLINK_LIST-}</strong><span><a href="{-url:inlink/edit_option-}">{-:@INLINK_OPTION-}</a></span></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="inlink_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@WORD-}</th>
				<th scope="col">{-:@URL-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_IL,$il-}
			<tr>
				<td>
					<input name="inlink_id[{-:$il['inlink_id']-}]" type="checkbox" value="{-:$il['inlink_id']-}">
				</td>
				<td>{-:$il['inlink_id']-}</td>
				<td>{-:$il['il_word']-}</td>
				<td>{-:$il['il_url']-}</td>
				<td><a href="{-url:inlink/edit_inlink?inlink_id={$il['inlink_id']}-}">{-:@EDIT-}</a> | <a href="{-url:inlink/delete_inlink_do?inlink_id={$il['inlink_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:inlink/add_inlink-}">{-:@ADD_INLINK-}</a>
	<span class="btn_l submit" action="{-url:inlink/delete_inlink_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>