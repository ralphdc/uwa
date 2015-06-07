<?php /* PFA Template Cache File. Create Time:2015-06-06 15:22:15 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="ad_space_id">
		<option value="0"><?php echo(L("AD_SPACE")); ?></option>
	<?php if(isset($_ASL) and is_array($_ASL)) : foreach($_ASL as $as) : ?>
		<option value="<?php echo($as['ad_space_id']); ?>"<?php if($as['ad_space_id']==ARequest::get('ad_space_id')) :  ?> selected="selected"<?php endif; ?>><?php echo($as['as_name']); ?></option>
	<?php endforeach; endif; ?>
	</select></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("ad/list_ad")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("AD_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="ad_id"></th>
				<th scope="col" width="70"><?php echo(L("DISPLAY_ORDER")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("AD_SPACE")); ?></th>
				<th scope="col"><?php echo(L("TIME_LIMIT")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_AL) and is_array($_AL)) : foreach($_AL as $a) : ?>
			<tr>
				<td><input name="ad_id[<?php echo($a['ad_id']); ?>]" type="checkbox" value="<?php echo($a['ad_id']); ?>"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="a_display_order[<?php echo($a['ad_id']); ?>]" value="<?php echo($a['a_display_order']); ?>"></td>
				<td><?php echo($a['a_name']); ?></td>
				<td><?php echo($a['as_name']); ?></td>
				<td>
				<?php if(0 == $a['a_time_limit']) :  ?>
					<?php echo(L("NOT_LIMIT")); ?>
				<?php elseif(1 == $a['a_time_limit']) :  ?>
					<?php echo(date('Y-m-d', $a['a_start_time'])); ?> ~ <?php echo(date('Y-m-d', $a['a_end_time'])); ?>
				<?php endif; ?>
				</td>
				<td><a href="<?php echo(Url::U("ad/edit_ad?ad_id={$a['ad_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("ad/delete_ad_do?ad_id={$a['ad_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_l submit" action="<?php echo(Url::U("ad/update_ad_do")); ?>" to="#formList"><?php echo(L("UPDATE_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("ad/delete_ad_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("ad_space/list_space")); ?>"><?php echo(L("AD_SPACE_LIST")); ?></a>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>