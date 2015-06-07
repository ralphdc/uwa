<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<dl class="abox">
	<dt><strong>{-:@ADMIN_ROLE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@RANK-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_ARL,$ar-}
			<tr>
				<td>
					{-:$ar['admin_role_id']-}
				</td>
				<td>
					{-:$ar['ar_rank']-}
				</td>
				<td>
					{-:$ar['ar_name']-}
				</td>
				<td>
					{-if:0==$ar['ar_type']-}{-:@SYSTEM-}{-elseif:1==$ar['ar_type']-}{-:@CUSTOM-}{-:/if-}
				</td>
				<td><a href="{-url:admin/list_admin?admin_role_id={$ar['admin_role_id']}-}">{-:@ADMIN-}</a>{-if:-1!=$ar['ar_rank']-} | <a href="{-url:admin_role/edit_role?admin_role_id={$ar['admin_role_id']}-}">{-:@EDIT-}</a>{-:/if-}{-if:0!=$ar['ar_type']-} | <a href="{-url:admin_role/delete_role_do?admin_role_id={$ar['admin_role_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a> {-:/if-}</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<a class="btn_l" href="{-url:admin_role/add_role-}">{-:@ADD_ROLE-}</a>
	<a class="btn_l" href="{-url:admin/list_admin-}">{-:@ADMIN_LIST-}</a>
</div><!--/#operation-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>