<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/{-:+lang-}.js"></script>
</head>

<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_TASK-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class="inputTitle">{-:@STATUS-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="t_name" maxlength="96" size="30">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@TASK_NAME_TIP-}</span>
				</td>
				<td class="inputArea">
					<label><input type="radio" value="0" name="t_status"> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="t_status" checked="checked"> {-:@ON-}</label>
					<span class="fc_r">*</span> <span class="fc_gry">{-:@TASK_STATUS_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">
					{-:@FILE-}
					<span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@TASK_FILE_TIP-}</span>
				</td>
				<td class="inputTitle">
					{-:@ADDON_PARAMS-}
					<span class="fc_gry fw_n">{-:@TASK_ADDON_PARAMS_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="t_file">
					{-foreach:$_TFL,$tf-}
						<option value="{-:$tf['file']-}">{-:$tf['name']-} | {-:$tf['file']-}</option>
					{-:/foreach-}
					</select>
				</td>
				<td class="inputArea">
					<textarea class="i" name="t_addon_params" style="width:360px;height:60px;"></textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@RUN_TIME-}</td>
				<td class="inputTitle">{-:@CYCLE_TIME-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="06:00:00" name="t_run_time" id="t_run_time" maxlength="8" size="8">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@TASK_RUN_TIME_TIP-}</span>
				</td>
				<td class="inputArea">
					<label><input id="t_cycle_time" class="i" checked="checked" type="radio" name="t_cycle_time" size="10" value="86400"> 1 {-:@_DAYS_-}</label>
					<label><input id="t_cycle_time" class="i" type="radio" name="t_cycle_time" size="10" value="604800"> 1 {-:@_WEEKS_-}</label>
					<label><input id="t_cycle_time" class="i" type="radio" name="t_cycle_time" size="10" value="2592000"> 1 {-:@_MONTHS_-}</label>
					<span class="fc_r">*</span> <span class="fc_gry">{-:@TASK_CYCLE_TIME_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TIME_LIMIT-}</td>
				<td class="inputTitle">{-:@VALIDITY_PERIOD-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="t_time_limit" checked="checked"> {-:@NOT_LIMIT-}</label>
					<label><input type="radio" value="1" name="t_time_limit"> {-:@VALIDITY_PERIOD-}</label>
					<span class="fc_r">*</span> <span class="fc_gry">{-:@TASK_TIME_LIMIT_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i calendar" type="text" value="{-php:echo date('Y-m-d', time());-}" format="Y-m-d" id="t_start_time" name="t_start_time" maxlength="10" size="10"> ~
					<input class="i calendar" type="text" value="{-php:echo date('Y-m-d', time()+86400*30);-}" format="Y-m-d" id="t_end_time" name="t_end_time" maxlength="10" size="10">
					<span class="fc_gry">{-:@TASK_VALIDITY_PERIOD_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="inputTitle">{-:@DESCRIPTION-}</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<textarea class="i" name="t_description" style="width:360px;height:90px;"></textarea>
					<span class="fc_gry">{-:@TASK_DESCRIPTION_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:task/add_task_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:task/list_task-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
</body>
</html>