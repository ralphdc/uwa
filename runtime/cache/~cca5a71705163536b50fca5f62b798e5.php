<?php /* PFA Template Cache File. Create Time:2015-06-06 10:25:14 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<dl class="abox">
	<dt><strong><?php echo(L("ADMIN_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col"><?php echo(L("USERID")); ?></th>
				<th scope="col"><?php echo(L("USERNAME")); ?></th>
				<th scope="col"><?php echo(L("ADMIN_ROLE")); ?> <a href="<?php echo(Url::U("admin/list_admin")); ?>">[<?php echo(L("ALL")); ?>]</a></th>
				<th scope="col"><?php echo(L("LAST_LOGIN")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_AL) and is_array($_AL)) : foreach($_AL as $a) : ?>
			<tr>
				<td>
					<a href="<?php echo(Url::U("admin/edit_admin?admin_id={$a['admin_id']}")); ?>"><?php echo($a['m_userid']); ?></a>
				</td>
				<td>
					<?php echo($a['m_username']); ?><br />
					<span class="fc_gry fs_11"><?php echo($a['m_email']); ?></span>
				</td>
				<td>
					<a href="<?php echo(Url::U("admin/list_admin?admin_role_id={$a['admin_role_id']}")); ?>"><?php echo($a['ar_name']); ?></a>
				</td>
				<td>
					<?php echo(date(C('APP.TIME_FORMAT'), $a['a_login_time'])); ?><br />
					<span class="fc_gry fs_11"><?php echo($a['a_login_ip']); ?></span>
				</td>
				<td><a href="<?php echo(Url::U("admin/edit_admin?admin_id={$a['admin_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("admin/delete_admin_do?admin_id={$a['admin_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a> | <a href="<?php echo(Url::U("archive/list_archive?member_id={$a['member_id']}")); ?>"><?php echo(L("ARCHIVE")); ?></a></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<a class="btn_l" href="<?php echo(Url::U("admin/add_admin")); ?>"><?php echo(L("ADD_ADMIN")); ?></a>
	<a class="btn_l" href="<?php echo(Url::U("admin_role/list_role")); ?>"><?php echo(L("ADMIN_ROLE")); ?></a>
</div><!--/#operation-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>