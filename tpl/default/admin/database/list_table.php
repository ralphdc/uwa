<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt>
		<strong>{-:@DATABASE_TABLE_LIST-}</strong>
		<span><a href="{-url:database/list_backup_file-}">{-:@BACKUPED_FILE_LIST-}</a></span>
	</dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="table"></th>
				<th scope="col">{-:@TABLE_NAME-}</th>
				<th scope="col">{-:@ROW-}</th>
				<th scope="col">{-:@INDEX_LENGTH-}</th>
				<th scope="col">{-:@DATA_LENGTH-}</th>
				<th scope="col">{-:@DATA_FREE-}</th>
				<th scope="col">{-:@ENGINE-}</th>
				<th scope="col">{-:@COLLATION-}</th>
				<th scope="col">{-:@COMMENT-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_TL['core'],$t-}
			<tr>
				<td><input name="table[]" type="checkbox" value="{-:$t['Name']-}" checked="checked"></td>
				<td>{-:$t['Name']-}</td>
				<td>{-:$t['Rows']-}</td>
				<td>{-:$t['Index_length']-}</td>
				<td>{-:$t['Data_length']-}</td>
				<td>{-:$t['Data_free']-}</td>
				<td>{-:$t['Engine']-}</td>
				<td>{-:$t['Collation']-}</td>
				<td>{-:$t['Comment']-}</td>
				<td><a href="{-url:database/repair_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@REPAIR-}</a> <a href="{-url:database/optimize_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@OPTIMIZE-}</a> <span class="btn_l list_field" table="{-:$t['Name']-}">{-:@STRUCTURE-}</span></td>
			</tr>
			{-:/foreach-}
			<tr>
				<th scope="col" width="18"></th>
				<th colspan="9" scope="col">{-:@OTHER_TABLE-}</th>
			</tr>
			{-foreach:$_TL['other'],$t-}
			<tr>
				<td><input name="table[]" type="checkbox" value="{-:$t['Name']-}"></td>
				<td>{-:$t['Name']-}</td>
				<td>{-:$t['Rows']-}</td>
				<td>{-:$t['Index_length']-}</td>
				<td>{-:$t['Data_length']-}</td>
				<td>{-:$t['Data_free']-}</td>
				<td>{-:$t['Engine']-}</td>
				<td>{-:$t['Collation']-}</td>
				<td>{-:$t['Comment']-}</td>
				<td><a href="{-url:database/repair_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@REPAIR-}</a> <a href="{-url:database/optimize_do?table={$t['Name']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@OPTIMIZE-}</a> <span class="btn_l list_field" table="{-:$t['Name']-}">{-:@STRUCTURE-}</span></td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<label><input class="i" type="checkbox" name="backup_structure" value="1">{-:@BACKUP_STRUCTURE-}</label>
	<label class="bg_gry_d fc_wht fs_11 p_2_5 br_3">{-:@VOLUME_SIZE-}: <input class="i required" type="text" name="volume_size" value="2048" size="5">KB</label>
	<span class="btn_l submit" action="{-url:database/backup_do-}" to="#formList">{-:@BACKUP-}</span>
	<span class="btn_l submit" action="{-url:database/repair_do-}" to="#formList">{-:@REPAIR-}</span>
	<span class="btn_l submit" action="{-url:database/optimize_do-}" to="#formList">{-:@OPTIMIZE-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(".list_field").bind('click', function() {
	var table = $(this).attr('table');
	$.get('{-url:database/list_field-}' + '&table=' + table, function(data) {
		dialog({
			content:data,
			id:'ab_d',
			title:table+' {-:@STRUCTURE-}',
			padding:'10px'
		}).showModal();
	});
});
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>