<?php /* PFA Template Cache File. Create Time:2015-06-06 10:21:57 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><strong><?php echo(L("UPLOAD")); ?></strong><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("UPLOAD_SWITCH")); ?> [upload/switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="upload[switch]"<?php if(0==$_O['upload']['switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="upload[switch]"<?php if(1==$_O['upload']['switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("UPLOAD_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("UPLOAD_IMGTYPE")); ?> [upload/imgtype]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['upload']['imgtype']); ?>" name="upload[imgtype]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("UPLOAD_IMGTYPE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("UPLOAD_FILETYPE")); ?> [upload/filetype]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['upload']['filetype']); ?>" name="upload[filetype]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("UPLOAD_FILETYPE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("UPLOAD_DIR")); ?> [upload/dir]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['upload']['dir']); ?>" name="upload[dir]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("UPLOAD_DIR_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("UPLOAD_SUB_DIR")); ?> [upload/sub_dir]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="<?php echo($_O['upload']['sub_dir']); ?>" name="upload[sub_dir]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<?php echo(L("UPLOAD_SUB_DIR_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("UPLOAD_SPACE")); ?> [upload/space]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['upload']['space']); ?>" name="upload[space]" maxlength="20" size="10" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("UPLOAD_SPACE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("UPLOAD_MAXSIZE")); ?> [upload/maxsize]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['upload']['maxsize']); ?>" name="upload[maxsize]" maxlength="20" size="10" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("UPLOAD_MAXSIZE_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_upload_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script>
var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>
</body>
</html>