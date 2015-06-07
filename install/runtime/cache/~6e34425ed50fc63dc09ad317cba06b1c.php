<?php /* PFA Template Cache File. Create Time:2015-06-04 01:43:00 */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo(SOFT_NAME); ?> <?php echo(SOFT_CODENAME); ?> - <?php echo(L("INSTALL_WIZARD")); ?></title>
	<link rel="stylesheet" href="http://localhost:90/install/tpl/default/css/c.css" media="screen" type="text/css" />
	<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
</head>

<body>
<div id="container">
<div id="header">
	<h1><span id="softName"><?php echo(SOFT_NAME); ?> <?php echo(SOFT_CODENAME); ?></span><span id="INSTALL_WIZARD"><?php echo(L("INSTALL_WIZARD")); ?></span></h1>
	<span id="softInfo">
		<?php echo(SOFT_NAME); ?> <span id="softCodename"><?php echo(SOFT_CODENAME); ?></span> <span id="softCharset"><?php echo(SOFT_CHARSET); ?></span> <span id="softVersion">(<?php echo(SOFT_VERSION); ?>)</span>
	</span>
</div><!--id/header-->

<script>
function check_next_step() {
<?php if(true == $checkNextStep) :  ?>
	$('#stepNext').removeAttr("disabled");
	$('#stepNext').val('<?php echo(L("STEP_NEXT")); ?>');
<?php else : ?>
	$('#stepNext').attr("disabled", "disabled");
	$('#stepNext').val('<?php echo(L("STEP_NEED_FIXED")); ?>');
<?php endif; ?>
}
</script>
<div id="main">
	<div id="stepList">
		<dl>
			<dt><strong><?php echo(L("INSTALL_WIZARD")); ?></strong></dt>
			<dd>
				<ul>
					<li><?php echo(L("INTRODUCE_SOFT")); ?></li>
					<li><?php echo(L("SHOW_LICENSE")); ?></li>
					<li class="ongoing"><?php echo(L("CHECK_ENVIRONMENT")); ?></li>
					<li><?php echo(L("SETUP_INSTALLATION")); ?></li>
					<li><?php echo(L("WRITE_DATA")); ?></li>
					<li><?php echo(L("LOCK")); ?></li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle"><?php echo(L("CHECK_ENVIRONMENT")); ?></strong><span id="stepTip" class="stepTip"><?php echo(L("CHECK_ENVIRONMENT_TIP")); ?></span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
				<?php if(!empty($systemItems)) :  ?>
					<h2><?php echo(L("SYSTEM_CHECK")); ?></h2>
					<table>
						<tr>
							<th><?php echo(L("ITEM_NAME")); ?></th>
							<th><?php echo(L("ITEM_REQUIREMENT")); ?></th>
							<th><?php echo(L("ITEM_BEST")); ?></th>
							<th><?php echo(L("ITEM_CURRENT")); ?></th>
						</tr>
						<?php if(isset($systemItems) and is_array($systemItems)) : foreach($systemItems as $k => $v) : ?>
						<tr>
							<td><?php echo($k); ?></td>
							<td><?php echo($v['r']); ?></td>
							<td><?php echo($v['b']); ?></td>
							<td <?php echo($v['c_c']); ?>><?php echo($v['c']); ?></td>
						</tr>
						<?php endforeach; endif; ?>
					</table>
				<?php endif; ?>

				<?php if(!empty($dirFileItems)) :  ?>
					<h2><?php echo(L("DIR_FILE_CHECK")); ?></h2>
					<table>
						<tr>
							<th><?php echo(L("ITEM_NAME")); ?></th>
							<th><?php echo(L("DIR_FILE_TYPE")); ?></th>
							<th><?php echo(L("DIR_FILE_PATH")); ?></th>
							<th><?php echo(L("ITEM_STATUS")); ?></th>
						</tr>
						<?php if(isset($dirFileItems) and is_array($dirFileItems)) : foreach($dirFileItems as $k => $v) : ?>
						<tr>
							<td><?php echo($k); ?></td>
							<td><?php echo($v['type']); ?></td>
							<td><?php echo($v['path']); ?></td>
							<td <?php echo($v['c_c']); ?>><?php echo($v['c']); ?></td>
						</tr>
						<?php endforeach; endif; ?>
					</table>
				<?php endif; ?>

				<?php if(!empty($phpConfigItems)) :  ?>
					<h2><?php echo(L("PHP_CONFIG_CHECK")); ?></h2>
					<table>
						<tr>
							<th><?php echo(L("ITEM_NAME")); ?></th>
							<th><?php echo(L("ITEM_REQUIREMENT")); ?></th>
							<th><?php echo(L("ITEM_CURRENT")); ?></th>
						</tr>
						<?php if(isset($phpConfigItems) and is_array($phpConfigItems)) : foreach($phpConfigItems as $k => $v) : ?>
						<tr>
							<td><?php echo($k); ?></td>
							<td><?php echo($v['r']); ?></td>
							<td <?php echo($v['c_c']); ?>><?php echo($v['c']); ?></td>
						</tr>
						<?php endforeach; endif; ?>
					</table>
				<?php endif; ?>

				<?php if(!empty($extensionItems)) :  ?>
					<h2><?php echo(L("EXTENSION_CHECK")); ?></h2>
					<table>
						<tr>
							<th><?php echo(L("ITEM_NAME")); ?></th>
							<th><?php echo(L("ITEM_STATUS")); ?></th>
						</tr>
						<?php if(isset($extensionItems) and is_array($extensionItems)) : foreach($extensionItems as $k => $v) : ?>
						<tr>
							<td><?php echo($v['name']); ?></td>
							<td <?php echo($v['c_c']); ?>><?php echo($v['s']); ?></td>
						</tr>
						<?php endforeach; endif; ?>
					</table>
				<?php endif; ?>

				<?php if(!empty($functionItems)) :  ?>
					<h2><?php echo(L("FUNCTION_CHECK")); ?></h2>
					<table>
						<tr>
							<th><?php echo(L("ITEM_NAME")); ?></th>
							<th><?php echo(L("ITEM_STATUS")); ?></th>
						</tr>
						<?php if(isset($functionItems) and is_array($functionItems)) : foreach($functionItems as $k => $v) : ?>
						<tr>
							<td><?php echo($v['name']); ?></td>
							<td <?php echo($v['c_c']); ?>><?php echo($v['s']); ?></td>
						</tr>
						<?php endforeach; endif; ?>
					</table>
				<?php endif; ?>
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
				<input type="hidden" name="step" value="4">
				<input type="button" onclick="history.back()" value="<?php echo(L("STEP_BACK")); ?>" />
				<input type="button" onclick="history.go(0)" value="<?php echo(L("RECHECK")); ?>" />
				<input type="submit" disabled="disabled" id="stepNext" value="<?php echo(L("STEP_NEED_FIXED")); ?>" />
				<script>check_next_step();</script>
			</dd>
		</dl>
		</form>
	</div><!--id/stepMain-->
	<div class="c"></div>
</div><!--id/main-->

<div id="footer">
	<div id="copyright">&copy; <?php echo(SOFT_COPYRIGHT_YEAR); ?> <span id="softAuthor"><a href="<?php echo(SOFT_AUTHOR_URL); ?>" target="_blank"><?php echo(SOFT_AUTHOR); ?></a></span></div>
</div><!--id/footer-->
</div><!--id/container-->

<!--install stat-->

<script src="http://localhost:90/install/tpl/default/js/c.js"></script>
</body>
</html>