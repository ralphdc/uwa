<?php /* PFA Template Cache File. Create Time:2015-06-06 01:26:51 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<form id="formImport" action="" method="post" enctype="multipart/form-data">
<dl class="abox">
	<dt><strong><?php echo(L("UPLOAD_EXTENSION")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td colspan="2" class="inputTitle"><?php echo(L("PACKAGE_FILE")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="file" name="uwa_package_file" /></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">* <?php echo(L("UWA_PACKAGE_FILE_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="compressed" value="0"> <?php echo(L("UNCOMPRESSED")); ?></label>
					<label><input type="radio" name="compressed" value="1" checked="checked"> <?php echo(L("COMPRESSED")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("EXTENSION_COMPRESSED_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2"  class="inputTitle"><?php echo(L("EXIST_EXTENSION")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="overwrite" value="0" checked="checked"> <?php echo(L("SKIP")); ?></label>
					<label><input type="radio" name="overwrite" value="1"> <?php echo(L("OVERWRITE")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("EXTENSION_OVERWRITE_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("extension/upload_extension_do")); ?>" to="#formImport"><?php echo(L("UPLOAD")); ?></span>
	<a class="btn_l" href="<?php echo(Url::U("extension/list_extension")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>