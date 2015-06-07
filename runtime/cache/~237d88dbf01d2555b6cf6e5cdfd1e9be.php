<?php /* PFA Template Cache File. Create Time:2015-06-06 15:12:24 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("ARCHIVE_MODEL_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="archive_model_id"></th>
				<th scope="col" width="70"><?php echo(L("DISPLAY_ORDER")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("ALIAS")); ?></th>
				<th scope="col"><?php echo(L("ADDON_TABLE")); ?></th>
				<th scope="col" width="90"><?php echo(L("STATUS")); ?></th>
				<th scope="col"><?php echo(L("TYPE")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_AML) and is_array($_AML)) : foreach($_AML as $am) : ?>
			<tr>
				<td><input type="checkbox" value="<?php echo($am['archive_model_id']); ?>" name="archive_model_id[<?php echo($am['archive_model_id']); ?>]"></td>
				<td><input class="i required" type="text" value="<?php echo($am['am_display_order']); ?>" name="am_display_order[<?php echo($am['archive_model_id']); ?>]" maxlength="10" size="4"></td>
				<td><input class="i required" type="text" value="<?php echo($am['am_name']); ?>" name="am_name[<?php echo($am['archive_model_id']); ?>]" maxlength="40" size="20"> [ID:<?php echo($am['archive_model_id']); ?>]</td>
				<td><?php echo($am['am_alias']); ?></td>
				<td><?php echo($am['am_addon_table']); ?></td>
				<td>
				<?php if(1 == $am['am_status']) :  ?>
					<span class="status"><b class="on"><?php echo(L("ON")); ?></b><a href="<?php echo(Url::U("archive_model/toggle_model_status_do?archive_model_id={$am['archive_model_id']}&am_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php else : ?>
					<span class="status"><b class="off"><?php echo(L("OFF")); ?></b><a href="<?php echo(Url::U("archive_model/toggle_model_status_do?archive_model_id={$am['archive_model_id']}&am_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php endif; ?>
				</td>
				<td>
				<?php if(0 == $am['am_type']) :  ?><?php echo(L("SYSTEM")); ?><?php elseif(1 == $am['am_type']) :  ?><?php echo(L("CUSTOM")); ?><?php endif; ?>
				</td>
				<td><a href="<?php echo(Url::U("archive_model/export_model?archive_model_id={$am['archive_model_id']}")); ?>"><?php echo(L("EXPORT")); ?></a> | <a href="<?php echo(Url::U("archive_model/edit_model?archive_model_id={$am['archive_model_id']}")); ?>"><?php echo(L("EDIT")); ?></a><?php if(0 != $am['am_type']) :  ?> | <a href="<?php echo(Url::U("archive_model/delete_model_do?archive_model_id={$am['archive_model_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a><?php endif; ?></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<a class="btn_l" href="<?php echo(Url::U("archive_model/add_model")); ?>"><?php echo(L("ADD_MODEL")); ?></a>
	<a class="btn_l" href="<?php echo(Url::U("archive_model/import_model")); ?>"><?php echo(L("IMPORT_MODEL")); ?></a>
	<span class="btn_l submit" action="<?php echo(Url::U("archive_model/update_model_do")); ?>" to="#formList"><?php echo(L("UPDATE_SELECTED")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>