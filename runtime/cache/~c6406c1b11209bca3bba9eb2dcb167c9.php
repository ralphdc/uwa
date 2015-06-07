<?php /* PFA Template Cache File. Create Time:2015-06-06 15:10:05 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo(L("MANAGE_LOGIN")); ?></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/l.css" />
</head>
<body>
<dl id="loginForm" class="acbox">
<form id="adminLoginForm" action="<?php echo(Url::U("login/login_do")); ?>" method="post">
	<dt><?php echo(L("MANAGE_LOGIN")); ?></dt>
	<dd>
		<table class="formTable" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="inputTitle"><?php echo(L("USERID")); ?></td>
				<td><input name="m_userid" type="text" class="required i" size="20" maxlength="64" autocomplete="off"></td>
				<td rowspan="4" id="loginTipBox">
					<div id="loginTip">&nbsp;</div>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("PASSWORD")); ?></td>
				<td>
					<input id="password_origin" type="text" class="required i" size="20" maxlength="64" autocomplete="off">
					<input id="password" name="password" type="hidden">
				</td>
			</tr>
			<?php if($mcs) :  ?><tr>
				<td class="inputTitle"><?php echo(L("CAPTCHA")); ?></td>
				<td><input type="text" name="vcode" autocomplete="off" class="required i" size="6" maxlength="6"><img src="<?php echo(Url::U("common/captcha_img?name=vcode")); ?>" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /></td>
			</tr><?php endif; ?>
			<tr>
				<td class="inputTitle"><?php echo(L("LANGUAGE")); ?></td>
				<td>
					<select name="<?php echo(C("VAR.LANG")); ?>">
						<?php if(isset($_LANGSET) and is_array($_LANGSET)) : foreach($_LANGSET as $lang) : ?>
							<option value="<?php echo($lang['alias']); ?>"<?php if($lang['alias']==$hal) :  ?> selected="selected"<?php endif; ?>><?php echo($lang['name']); ?></option>
						<?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="2">
					<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
					<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
					<input type="submit" name="button" class="btn_b" value="<?php echo(L("SUBMIT")); ?>">
					<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
					<span id="browser" class="p_2_5 fc_r fs_11"></span>
				</td>
			</tr>
		</table>
	</dd>
	<dd class="fs_11 ta_r p_5 bg_gry_l fc_gry" style="border-top: 1px solid #e5e5e5;">
		&copy;<?php echo date('Y'); ?> <a href="<?php echo(SOFT_AUTHOR_URL); ?>" class="fw_b" target="_blank"><?php echo(SOFT_AUTHOR); ?></a>, Powered by <span class="fc_b fw_b"><?php echo(SOFT_NAME); ?><?php echo(SOFT_CODENAME); ?>(<?php echo(SOFT_VERSION); ?>) <?php echo(SOFT_CHARSET); ?> </span>
	</dd>
</form>
</dl><!--/#loginForm-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/md5.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
<script>
$(document).ready(function() {
	/* forbidden iframe */
	if(top!=self) {
		top.location=self.location;
	}
	/* not support ie6, and display limit in ie7 */
	var isIE = !!window.ActiveXObject;
	var isIE6 = isIE && !window.XMLHttpRequest;
	var isIE8 = isIE && !!document.documentMode;
	var isIE7 = isIE && !isIE6 && !isIE8;
	if(isIE6) {
		$('input').attr("disabled","disabled");
		$("#browser").html('<?php echo(L("MANAGE_IE6_TIP")); ?>');
	}
	else if(isIE7) {
		$("#browser").html('<?php echo(L("MANAGE_IE7_TIP")); ?>');
	}

	/* forbidden remeber id and password */
	$('#password_origin').on('focus', function(){
		$(this).attr('type', 'password');
	});
});
$('#adminLoginForm').submit(function() {
	encode_pwd()
});
function encode_pwd() {
	var password_origin = $('#password_origin').val();
	if('' != password_origin) {
		$('#password').val(hex_md5(password_origin));
	}
	else {
		$('#password').val('');
	}
}

</script>
</body>
</html>