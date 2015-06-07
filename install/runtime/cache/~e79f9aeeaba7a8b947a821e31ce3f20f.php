<?php /* PFA Template Cache File. Create Time:2015-06-04 01:43:52 */ ?>
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
					<li><?php echo(L("WRITE_DATA")); ?></li>
					<li class="ongoing"><?php echo(L("LOCK")); ?></li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle"><?php echo(L("LOCK")); ?></strong><span id="stepTip" class="stepTip"><?php echo(L("LOCK_TIP")); ?></span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<div id="finalShow">
						<div id="safetyTips">
							<?php echo(L("SAFETY_TIPS")); ?>
						</div>
						<h2><?php echo(L("GOTO_INDEX")); ?></h2>
						<p>
							<a href="<?php echo(SITE_URL); ?>" target="_blank"><?php echo(SITE_URL); ?></a>
						</p>
						<h2><?php echo(L("GOTO_MANAGE_INDEX")); ?></h2>
						<p>
							<a href="<?php echo(SITE_MANAGE_URL); ?>" target="_blank"><?php echo(SITE_MANAGE_URL); ?></a>
						</p>
						<h2><?php echo(L("UPGRADE_INFO")); ?></h2>
						<p id="upgradeInfo">
							<script src="<?php echo(SOFT_UPGRADE_URL); ?>"></script>
						</p>
					</div><!--id/finalShow-->
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
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