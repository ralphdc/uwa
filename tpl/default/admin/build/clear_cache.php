<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
{-if:!empty($nextUrl)-}<div class="mainTips">
	<span class="fw_b fc_r">{-:@LAST_TASK-}</span> <a class="fc_g td_u" href="{-:$nextUrl-}">{-:$nextUrl|substr~@me,0,20-} ... {-:$nextUrl|substr~@me,-30-} {-:@_GO_NEXT_-}</a>
</div>{-:/if-}
<form id="formClear" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@CLEAR_CACHE-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="runtime" name="type[]" checked="checked" /> {-:@SYSTEM_FRAME_CACHE-}</label>
				</td>
				<td>
					<a href="{-url:build/clear_cache_do?type=runtime&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" class="btn_l">{-:@CLEAR-}</a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="cache" name="type[]" checked="checked" /> {-:@TEMPLATE_CACHE-}</label>
				</td>
				<td>
					<a href="{-url:build/clear_cache_do?type=cache&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" class="btn_l">{-:@CLEAR-}</a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="data" name="type[]" checked="checked" /> {-:@DATA_CACHE-}</label>
				</td>
				<td>
					<a href="{-url:build/clear_cache_do?type=data&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" class="btn_l">{-:@CLEAR-}</a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="temp" name="type[]" checked="checked" /> {-:@TEMPORARY_CACHE-}</label>
				</td>
				<td>
					<a href="{-url:build/clear_cache_do?type=temp&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" class="btn_l">{-:@CLEAR-}</a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="js" name="type[]" /> {-:@JS_CACHE-}</label>
				</td>
				<td>
					<a href="{-url:build/clear_cache_do?type=js&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" class="btn_l">{-:@CLEAR-}</a>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:build/clear_cache_do-}" to="#formClear">{-:@CLEAR_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>