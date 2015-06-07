<?php /* PFA Template Cache File. Create Time:2015-06-06 01:27:09 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt>
		<strong><?php echo(L("DATABASE_TABLE_LIST")); ?></strong>
		<span><a href="<?php echo(Url::U("database/list_backup_file")); ?>"><?php echo(L("BACKUPED_FILE_LIST")); ?></a></span>
	</dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="table"></th>
				<th scope="col"><?php echo(L("TABLE_NAME")); ?></th>
				<th scope="col"><?php echo(L("ROW")); ?></th>
				<th scope="col"><?php echo(L("INDEX_LENGTH")); ?></th>
				<th scope="col"><?php echo(L("DATA_LENGTH")); ?></th>
				<th scope="col"><?php echo(L("DATA_FREE")); ?></th>
				<th scope="col"><?php echo(L("ENGINE")); ?></th>
				<th scope="col"><?php echo(L("COLLATION")); ?></th>
				<th scope="col"><?php echo(L("COMMENT")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_TL['core']) and is_array($_TL['core'])) : foreach($_TL['core'] as $t) : ?>
			<tr>
				<td><input name="table[]" type="checkbox" value="<?php echo($t['Name']); ?>" checked="checked"></td>
				<td><?php echo($t['Name']); ?></td>
				<td><?php echo($t['Rows']); ?></td>
				<td><?php echo($t['Index_length']); ?></td>
				<td><?php echo($t['Data_length']); ?></td>
				<td><?php echo($t['Data_free']); ?></td>
				<td><?php echo($t['Engine']); ?></td>
				<td><?php echo($t['Collation']); ?></td>
				<td><?php echo($t['Comment']); ?></td>
				<td><a href="<?php echo(Url::U("database/repair_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("REPAIR")); ?></a> <a href="<?php echo(Url::U("database/optimize_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("OPTIMIZE")); ?></a> <span class="btn_l list_field" table="<?php echo($t['Name']); ?>"><?php echo(L("STRUCTURE")); ?></span></td>
			</tr>
			<?php endforeach; endif; ?>
			<tr>
				<th scope="col" width="18"></th>
				<th colspan="9" scope="col"><?php echo(L("OTHER_TABLE")); ?></th>
			</tr>
			<?php if(isset($_TL['other']) and is_array($_TL['other'])) : foreach($_TL['other'] as $t) : ?>
			<tr>
				<td><input name="table[]" type="checkbox" value="<?php echo($t['Name']); ?>"></td>
				<td><?php echo($t['Name']); ?></td>
				<td><?php echo($t['Rows']); ?></td>
				<td><?php echo($t['Index_length']); ?></td>
				<td><?php echo($t['Data_length']); ?></td>
				<td><?php echo($t['Data_free']); ?></td>
				<td><?php echo($t['Engine']); ?></td>
				<td><?php echo($t['Collation']); ?></td>
				<td><?php echo($t['Comment']); ?></td>
				<td><a href="<?php echo(Url::U("database/repair_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("REPAIR")); ?></a> <a href="<?php echo(Url::U("database/optimize_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("OPTIMIZE")); ?></a> <span class="btn_l list_field" table="<?php echo($t['Name']); ?>"><?php echo(L("STRUCTURE")); ?></span></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<label><input class="i" type="checkbox" name="backup_structure" value="1"><?php echo(L("BACKUP_STRUCTURE")); ?></label>
	<label class="bg_gry_d fc_wht fs_11 p_2_5 br_3"><?php echo(L("VOLUME_SIZE")); ?>: <input class="i required" type="text" name="volume_size" value="2048" size="5">KB</label>
	<span class="btn_l submit" action="<?php echo(Url::U("database/backup_do")); ?>" to="#formList"><?php echo(L("BACKUP")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("database/repair_do")); ?>" to="#formList"><?php echo(L("REPAIR")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("database/optimize_do")); ?>" to="#formList"><?php echo(L("OPTIMIZE")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
$(".list_field").bind('click', function() {
	var table = $(this).attr('table');
	$.get('<?php echo(Url::U("database/list_field")); ?>' + '&table=' + table, function(data) {
		dialog({
			content:data,
			id:'ab_d',
			title:table+' <?php echo(L("STRUCTURE")); ?>',
			padding:'10px'
		}).showModal();
	});
});
</script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>