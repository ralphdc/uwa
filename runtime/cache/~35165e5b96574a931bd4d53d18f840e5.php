<?php /* PFA Template Cache File. Create Time:2015-06-06 15:13:11 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<dl class="atab">
	<dt><strong><?php echo(L("ARCHIVE_FLAG_LIST")); ?></strong><strong><?php echo(L("ADD_FLAG")); ?></strong></dt>
	<dd>
		<div class="tabCntnt">
			<form id="formList" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="18"><input type="checkbox" class="select_all" to="af_alias"></th>
					<th scope="col" width="70"><?php echo(L("DISPLAY_ORDER")); ?></th>
					<th scope="col"><?php echo(L("ALIAS")); ?></th>
					<th scope="col"><?php echo(L("NAME")); ?></th>
				</tr>
				<?php if(isset($_AFL) and is_array($_AFL)) : foreach($_AFL as $af) : ?><tr>
					<td><input name="af_alias[<?php echo($af['af_alias']); ?>]" type="checkbox" value="<?php echo($af['af_alias']); ?>"></td>
					<td><input type="text" class="i required" size="6" maxlength="10" name="af_display_order[<?php echo($af['af_alias']); ?>]" value="<?php echo($af['af_display_order']); ?>"></td>
					<td><?php echo($af['af_alias']); ?></td>
					<td><input type="text" class="i required" size="20" maxlength="64" name="af_name[<?php echo($af['af_alias']); ?>]" value="<?php echo($af['af_name']); ?>"></td>
				</tr><?php endforeach; endif; ?>
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
				<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
				<span class="btn_l submit" action="<?php echo(Url::U("archive_flag/update_flag_do")); ?>" to="#formList"><?php echo(L("UPDATE_SELECTED")); ?></span>
				<span class="btn_l submit" action="<?php echo(Url::U("archive_flag/delete_flag_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
				<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
			</div><!--/#operation-->
			</form>
		</div><!--/.tabCntnt-->
		<div class="tabCntnt">
			<form id="formAdd" action="" method="post">
			<table class="formTable">
				<tr>
					<td class="inputTitle"><?php echo(L("ALIAS")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="af_alias" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AF_ALIAS_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("NAME")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="af_name" maxlength="64" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AF_NAME_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="50" name="af_display_order" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AF_DISPLAY_ORDER_TIP")); ?>
					</td>
				</tr>
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
				<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
				<span class="btn_b submit" action="<?php echo(Url::U("archive_flag/add_flag_do")); ?>" to="#formAdd"><?php echo(L("SUBMIT")); ?></span>
				<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
			</div>
			</form>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>