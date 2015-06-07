<?php /* PFA Template Cache File. Create Time:2015-06-04 01:43:28 */ ?>
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
function show_progress(message, barLength) {
	$('#progressInfo').html(barLength + ' ' + message);
	$('#progressBar').css({'width':barLength});
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
					<li><?php echo(L("SETUP_INSTALLATION")); ?></li>
					<li class="ongoing"><?php echo(L("WRITE_DATA")); ?></li>
					<li><?php echo(L("LOCK")); ?></li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle"><?php echo(L("WRITE_DATA")); ?></strong><span id="stepTip" class="stepTip"><?php echo(L("WRITE_DATA_TIP")); ?></span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<div class="progressBarBox"><div id="progressBar" class="progressBar"></div></div>
					<div id="progressInfo">progressInfo</div>
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
				<input type="hidden" name="step" value="6">
				<input type="submit" value="<?php echo(L("SUCCESS_AND_LOCK")); ?>" />
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