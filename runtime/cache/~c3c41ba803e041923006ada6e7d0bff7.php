<?php /* PFA Template Cache File. Create Time:2015-06-06 01:14:42 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<?php if(!empty($nextUrl)) :  ?><div class="mainTips">
	<span class="fw_b fc_r"><?php echo(L("LAST_TASK")); ?></span> <a class="fc_g td_u" href="<?php echo($nextUrl); ?>"><?php echo(substr($nextUrl, 0, 20)); ?> ... <?php echo(substr($nextUrl, -30)); ?> <?php echo(L("_GO_NEXT_")); ?></a>
</div><?php endif; ?>
<form id="formClear" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("CLEAR_CACHE")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col"><?php echo(L("TYPE")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="runtime" name="type[]" checked="checked" /> <?php echo(L("SYSTEM_FRAME_CACHE")); ?></label>
				</td>
				<td>
					<a href="<?php echo(Url::U("build/clear_cache_do?type=runtime&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" class="btn_l"><?php echo(L("CLEAR")); ?></a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="cache" name="type[]" checked="checked" /> <?php echo(L("TEMPLATE_CACHE")); ?></label>
				</td>
				<td>
					<a href="<?php echo(Url::U("build/clear_cache_do?type=cache&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" class="btn_l"><?php echo(L("CLEAR")); ?></a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="data" name="type[]" checked="checked" /> <?php echo(L("DATA_CACHE")); ?></label>
				</td>
				<td>
					<a href="<?php echo(Url::U("build/clear_cache_do?type=data&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" class="btn_l"><?php echo(L("CLEAR")); ?></a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="temp" name="type[]" checked="checked" /> <?php echo(L("TEMPORARY_CACHE")); ?></label>
				</td>
				<td>
					<a href="<?php echo(Url::U("build/clear_cache_do?type=temp&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" class="btn_l"><?php echo(L("CLEAR")); ?></a>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" value="js" name="type[]" /> <?php echo(L("JS_CACHE")); ?></label>
				</td>
				<td>
					<a href="<?php echo(Url::U("build/clear_cache_do?type=js&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" class="btn_l"><?php echo(L("CLEAR")); ?></a>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("build/clear_cache_do")); ?>" to="#formClear"><?php echo(L("CLEAR_SELECTED")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>