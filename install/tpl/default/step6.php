{-include:header.php-}
<div id="main">
	<div id="stepList">
		<dl>
			<dt><strong>{-:@INSTALL_WIZARD-}</strong></dt>
			<dd>
				<ul>
					<li>{-:@INTRODUCE_SOFT-}</li>
					<li>{-:@SHOW_LICENSE-}</li>
					<li>{-:@CHECK_ENVIRONMENT-}</li>
					<li>{-:@SETUP_INSTALLATION-}</li>
					<li>{-:@WRITE_DATA-}</li>
					<li class="ongoing">{-:@LOCK-}</li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle">{-:@LOCK-}</strong><span id="stepTip" class="stepTip">{-:@LOCK_TIP-}</span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<div id="finalShow">
						<div id="safetyTips">
							{-:@SAFETY_TIPS-}
						</div>
						<h2>{-:@GOTO_INDEX-}</h2>
						<p>
							<a href="{-:*SITE_URL-}" target="_blank">{-:*SITE_URL-}</a>
						</p>
						<h2>{-:@GOTO_MANAGE_INDEX-}</h2>
						<p>
							<a href="{-:*SITE_MANAGE_URL-}" target="_blank">{-:*SITE_MANAGE_URL-}</a>
						</p>
						<h2>{-:@UPGRADE_INFO-}</h2>
						<p id="upgradeInfo">
							<script src="{-:*SOFT_UPGRADE_URL-}"></script>
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
{-include:footer.php-}