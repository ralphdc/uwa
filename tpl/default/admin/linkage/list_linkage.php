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
	<dt><strong>{-:@LINKAGE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="linkage_id"></th>
				<th scope="col" width="50">{-:@ID-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@ALIAS-}</th>
				<th scope="col">{-:@DESCRIPTION-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_LL,$l-}
			<tr>
				<td>
					<input name="linkage_id[{-:$l['linkage_id']-}]" type="checkbox" value="{-:$l['linkage_id']-}">
				</td>
				<td>{-:$l['linkage_id']-}</td>
				<td>{-:$l['l_name']-}</td>
				<td>
					<input name="l_alias[{-:$l['linkage_id']-}]" type="hidden" value="{-:$l['l_alias']-}">
					{-:$l['l_alias']-}
				</td>
				<td>{-:$l['l_description']-}</td>
				<td>
				{-if:0 == $l['l_type']-}
					<span>{-:@SYSTEM-}</span>
				{-elseif:1 == $l['l_type']-}
					<span>{-:@CUSTOM-}</span>
				{-:/if-}
				</td>
				<td><a href="{-url:linkage_item/list_item?l_alias={$l['l_alias']}-}">{-:@VIEW_ITEM-}</a> | <a href="{-url:linkage/edit_linkage?linkage_id={$l['linkage_id']}-}">{-:@EDIT-}</a> | <a href="{-url:linkage/delete_linkage_do?linkage_id={$l['linkage_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a> | <a class="btn_l" href="{-url:linkage/update_cache_do?l_alias={$l['l_alias']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@UPDATE_LINKAGE_CACHE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:linkage/add_linkage-}">{-:@ADD_LINKAGE-}</a>
	<span class="btn_l submit" action="{-url:linkage/delete_linkage_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:linkage/update_cache_do-}" to="#formList">{-:@UPDATE_LINKAGE_CACHE-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>