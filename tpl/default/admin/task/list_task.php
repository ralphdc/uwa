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
	<dt><strong>{-:@TASK_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="task_id"></th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@DESCRIPTION-}</th>
				<th scope="col">{-:@CYCLE_TIME-}</th>
				<th scope="col">{-:@TIME_LIMIT-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_TL,$t-}
			<tr>
				<td><input name="task_id[{-:$t['task_id']-}]" type="checkbox" value="{-:$t['task_id']-}"></td>
				<td>
					{-:$t['t_name']-} <br />
					<span class="p_0_2 br_3 br_gry_l fc_b">{-:$t['t_file']-}</span>
				</td>
				<td>{-:$t['t_description']-}</td>
				<td>{-:@AT-} <span class="p_0_2 br_3 br_gry_l fc_g">{-:$t['t_run_time']-}</span> / {-:@PER-} <span class="p_0_2 br_3 br_gry_l fc_g">{-:$t['t_cycle_time']|second_format~@me-}</span></td>
				<td>
				{-if:0 == $t['t_time_limit']-}
					{-:@NOT_LIMIT-} <br />
				{-elseif:1 == $t['t_time_limit']-}
					{-:$t['t_start_time']|date~'Y-m-d',@me-} ~ {-:$t['t_end_time']|date~'Y-m-d',@me-} <br />
				{-:/if-}
					{-:@LAST_RUN_TIME-}: {-if:0 < $t['t_last_run_time']-}{-:$t['t_last_run_time']|date~C('APP.TIME_FORMAT'),@me-}{-else:-}{-:@NEVER_RUN-}{-:/if-}
				</td>
				<td>
				{-if:1 == $t['t_status']-}
					<span class="status"><b class="on">{-:@ON-}</b><a href="{-url:task/toggle_task_status_do?task_id={$t['task_id']}&t_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@OFF-}</b><a href="{-url:task/toggle_task_status_do?task_id={$t['task_id']}&t_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td><a href="{-url:task/run_task?task_id={$t['task_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@RUN_NOW-}</a> | <a href="{-url:task/edit_task?task_id={$t['task_id']}-}">{-:@EDIT-}</a> | <a href="{-url:task/delete_task_do?task_id={$t['task_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:task/add_task-}">{-:@ADD_TASK-}</a>
	<span class="btn_l submit" action="{-url:task/delete_task_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>