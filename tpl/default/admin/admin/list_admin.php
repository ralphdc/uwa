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
	<dt><strong>{-:@ADMIN_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col">{-:@USERID-}</th>
				<th scope="col">{-:@USERNAME-}</th>
				<th scope="col">{-:@ADMIN_ROLE-} <a href="{-url:admin/list_admin-}">[{-:@ALL-}]</a></th>
				<th scope="col">{-:@LAST_LOGIN-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_AL,$a-}
			<tr>
				<td>
					<a href="{-url:admin/edit_admin?admin_id={$a['admin_id']}-}">{-:$a['m_userid']-}</a>
				</td>
				<td>
					{-:$a['m_username']-}<br />
					<span class="fc_gry fs_11">{-:$a['m_email']-}</span>
				</td>
				<td>
					<a href="{-url:admin/list_admin?admin_role_id={$a['admin_role_id']}-}">{-:$a['ar_name']-}</a>
				</td>
				<td>
					{-:$a['a_login_time']|date~C('APP.TIME_FORMAT'),@me-}<br />
					<span class="fc_gry fs_11">{-:$a['a_login_ip']-}</span>
				</td>
				<td><a href="{-url:admin/edit_admin?admin_id={$a['admin_id']}-}">{-:@EDIT-}</a> | <a href="{-url:admin/delete_admin_do?admin_id={$a['admin_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a> | <a href="{-url:archive/list_archive?member_id={$a['member_id']}-}">{-:@ARCHIVE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<a class="btn_l" href="{-url:admin/add_admin-}">{-:@ADD_ADMIN-}</a>
	<a class="btn_l" href="{-url:admin_role/list_role-}">{-:@ADMIN_ROLE-}</a>
</div><!--/#operation-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>