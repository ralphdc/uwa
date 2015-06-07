<?php /* PFA Template Cache File. Create Time:2015-06-04 01:43:03 */ ?>
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
function check_next_step(){
	var numWarnings = $('#stepForm .warning').length;
	if(0 == numWarnings) {
		$('#stepNext').removeAttr("disabled");
		$('#stepNext').val('<?php echo(L("STEP_NEXT")); ?>');
	}
	else {
		$('#stepNext').attr("disabled", "disabled");
		$('#stepNext').val('<?php echo(L("STEP_NEED_FIXED")); ?>');
	}
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
					<li><?php echo(L("CHECK_ENVIRONMENT")); ?></li>
					<li class="ongoing"><?php echo(L("SETUP_INSTALLATION")); ?></li>
					<li><?php echo(L("WRITE_DATA")); ?></li>
					<li><?php echo(L("LOCK")); ?></li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle"><?php echo(L("SETUP_INSTALLATION")); ?></strong><span id="stepTip" class="stepTip"><?php echo(L("SETUP_INSTALLATION_TIP")); ?></span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<fieldset>
						<legend><?php echo(L("DB_SETUP")); ?></legend>
						<p>
							<label for="db_host"><?php echo(L("DB_HOST")); ?></label>
							<input type="text" id="dbHost" class="i required" name="dbHost" value="<?php echo($formV['dbHost']); ?>" />
							<span id="dbHostTip" class="inputTip"><?php echo(L("DB_HOST_TIP")); ?></span>
						</p>
						<p>
							<label for="db_port"><?php echo(L("DB_PORT")); ?></label>
							<input type="text" id="dbPort" class="i required" name="dbPort" value="<?php echo($formV['dbPort']); ?>" />
							<span id="dbPortTip" class="inputTip"><?php echo(L("DB_PORT_TIP")); ?></span>
						</p>
						<p>
							<label for="dbUser"><?php echo(L("DB_USER")); ?></label>
							<input type="text" id="dbUser" class="i required" name="dbUser" value="<?php echo($formV['dbUser']); ?>" />
							<span id="dbUserTip" class="inputTip"><?php echo(L("DB_USER_TIP")); ?></span>
						</p>
						<p>
							<label for="dbPassword"><?php echo(L("DB_PASSWORD")); ?></label>
							<input type="text" id="dbPassword" class="i" name="dbPassword" value="<?php echo($formV['dbPassword']); ?>" />
							<span id="dbPasswordTip" class="inputTip"><?php echo(L("DB_PASSWORD_TIP")); ?></span>
						</p>
						<p>
							<label for="dbDatabase"><?php echo(L("DB_DATABASE")); ?></label>
							<input type="text" id="dbDatabase" class="i required" name="dbDatabase" value="<?php echo($formV['dbDatabase']); ?>" />
							<span id="dbDatabaseTip" class="inputTip"><?php echo(L("DB_DATABASE_TIP")); ?></span>
						</p>
						<p>
							<label for="dbPrefix"><?php echo(L("DB_PREFIX")); ?></label>
							<input type="text" id="dbPrefix" class="i required" name="dbPrefix" value="<?php echo($formV['dbPrefix']); ?>" />
							<span id="dbPrefixTip" class="inputTip"><?php echo(L("DB_PREFIX_TIP")); ?></span>
						</p>
						<p>
							<label for="dbConnection"><?php echo(L("DB_CONNECTION")); ?></label>
							<select name="dbConnection" class="i">
								<option value="mysql" <?php if('mysql'==$formV['dbConnection']) :  ?> selected<?php endif; ?>>MySQL</option>
								<option value="mysqli"<?php if('mysqli'==$formV['dbConnection']) :  ?> selected<?php endif; ?>>MySQLi</option>
							</select>
							<span id="dbConnectionTip" class="inputTip"><?php echo(L("DB_CONNECTION_TIP")); ?></span>
						</p>
					</fieldset>
					<fieldset>
						<legend><?php echo(L("FOUNDER_SETUP")); ?></legend>
						<p>
							<label for="founderName"><?php echo(L("FOUNDER_NAME")); ?></label>
							<input type="text" id="founderName" class="i required" name="founderName" value="<?php echo($formV['founderName']); ?>" />
							<span id="founderNameTip" class="inputTip"><?php echo(L("FOUNDER_NAME_TIP")); ?></span>
						</p>
						<p>
							<label for="founderPassword"><?php echo(L("FOUNDER_PASSWORD")); ?></label>
							<input type="text" id="founderPassword" class="i required" name="founderPassword" value="<?php echo($formV['founderPassword']); ?>" />
							<span id="founderPasswordTip" class="inputTip"><?php echo(L("FOUNDER_PASSWORD_TIP")); ?></span>
						</p>
						<p>
							<label for="founderEmail"><?php echo(L("FOUNDER_EMAIL")); ?></label>
							<input type="text" id="founderEmail" class="i required" name="founderEmail" value="<?php echo($formV['founderEmail']); ?>" />
							<span id="founderEmailTip" class="inputTip"><?php echo(L("FOUNDER_EMAIL_TIP")); ?></span>
						</p>
					</fieldset>
					<fieldset>
						<legend><?php echo(L("OTHER")); ?></legend>
						<p>
							<label for="cookieKey"><?php echo(L("COOKIE_KEY")); ?></label>
							<input type="text" id="cookieKey" class="i required" name="cookieKey" value="<?php echo($formV['cookieKey']); ?>" />
							<span id="cookieKeyTip" class="inputTip"><?php echo(L("COOKIE_KEY_TIP")); ?></span>
						</p>
					</fieldset>
					<?php if(''!=$errorMessage) :  ?>
					<div id="errorMessage">
						<?php echo($errorMessage); ?>
					</div>
					<?php endif; ?>
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
				<input type="hidden" name="step" value="5">
				<input type="button" onclick="history.back()" value="<?php echo(L("STEP_BACK")); ?>" />
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