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
	<dt>
		<span><a href="{-url:database/list_table-}">{-:@DATABASE_TABLE_LIST-}</a></span>
		<strong>{-:@BACKUPED_FILE_LIST-}</strong>
	</dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="data_file"></th>
				<th scope="col">{-:@FILE_NAME-}</th>
				<th scope="col">{-:@FILESIZE-}</th>
				<th scope="col">{-:@BACKUP_TIME-}</th>
			</tr>
			{-foreach:$_BFL['data_core'],$f-}
			<tr>
				<td><input name="data_file[]" type="checkbox" value="{-:$f['filename']-}" checked="checked"></td>
				<td>{-:$f['filename']-}</td>
				<td>{-:$f['filesize']-}</td>
				<td>{-:$f['backup_time']-}</td>
			</tr>
			{-:/foreach-}
			<tr>
				<th scope="col" width="18"></th>
				<th colspan="3" scope="col">{-:@OTHER_FILE-}</th>
			</tr>
			{-foreach:$_BFL['data_other'],$f-}
			<tr>
				<td><input name="data_file[]" type="checkbox" value="{-:$f['filename']-}"></td>
				<td>{-:$f['filename']-}</td>
				<td>{-:$f['filesize']-}</td>
				<td>{-:$f['backup_time']-}</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<label>
		<input class="i" type="checkbox" name="restore_structure" {-if:empty($_BFL['structure'])-}disabled="disabled" {-:/if-}value="1">{-:@RESTORE_STRUCTURE-}
		{-if:!empty($_BFL['structure'])-}<span class="fs_11 bg_gry_d fc_wht p_2_5 br_3">{-:$_BFL['structure']['filename']-} <b class="fw_n fc_gry">|</b> {-:$_BFL['structure']['filesize']-} <b class="fw_n fc_gry">|</b> {-:$_BFL['structure']['backup_time']-}</span>{-:/if-}
	</label>
	<span class="btn_l submit" action="{-url:database/restore_do-}" to="#formList">{-:@RESTORE-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>