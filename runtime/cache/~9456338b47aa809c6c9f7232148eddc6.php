<?php /* PFA Template Cache File. Create Time:2015-06-06 10:25:15 */ ?>
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
	<dt><strong><?php echo(L("ADMIN_ROLE_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("RANK")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("TYPE")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_ARL) and is_array($_ARL)) : foreach($_ARL as $ar) : ?>
			<tr>
				<td>
					<?php echo($ar['admin_role_id']); ?>
				</td>
				<td>
					<?php echo($ar['ar_rank']); ?>
				</td>
				<td>
					<?php echo($ar['ar_name']); ?>
				</td>
				<td>
					<?php if(0==$ar['ar_type']) :  ?><?php echo(L("SYSTEM")); ?><?php elseif(1==$ar['ar_type']) :  ?><?php echo(L("CUSTOM")); ?><?php endif; ?>
				</td>
				<td><a href="<?php echo(Url::U("admin/list_admin?admin_role_id={$ar['admin_role_id']}")); ?>"><?php echo(L("ADMIN")); ?></a><?php if(-1!=$ar['ar_rank']) :  ?> | <a href="<?php echo(Url::U("admin_role/edit_role?admin_role_id={$ar['admin_role_id']}")); ?>"><?php echo(L("EDIT")); ?></a><?php endif; ?><?php if(0!=$ar['ar_type']) :  ?> | <a href="<?php echo(Url::U("admin_role/delete_role_do?admin_role_id={$ar['admin_role_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a> <?php endif; ?></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<a class="btn_l" href="<?php echo(Url::U("admin_role/add_role")); ?>"><?php echo(L("ADD_ROLE")); ?></a>
	<a class="btn_l" href="<?php echo(Url::U("admin/list_admin")); ?>"><?php echo(L("ADMIN_LIST")); ?></a>
</div><!--/#operation-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>