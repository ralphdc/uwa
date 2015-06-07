{-include:header.php-}
<div id="main">
	<div id="stepList">
		<dl>
			<dt><strong>{-:@INSTALL_WIZARD-}</strong></dt>
			<dd>
				<ul>
					<li class="ongoing">{-:@INTRODUCE_SOFT-}</li>
					<li>{-:@SHOW_LICENSE-}</li>
					<li>{-:@CHECK_ENVIRONMENT-}</li>
					<li>{-:@SETUP_INSTALLATION-}</li>
					<li>{-:@WRITE_DATA-}</li>
					<li>{-:@LOCK-}</li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle">{-:@INTRODUCE_SOFT-}</strong><span id="stepTip" class="stepTip">{-:@INTRODUCE_SOFT_TIP-}</span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<div id="softIntroduction">{-:@SOFT_INTRODUCTION-}
					</div><!--id/softIntroduction-->
				</div>
			</dd><!--id/stepContent-->
			<dd id="operation">
				<input type="hidden" name="step" value="2">
				<input type="submit" value="{-:@START-}" />
			</dd>
		</dl>
		</form>
	</div><!--id/stepMain-->
	<div class="c"></div>
</div><!--id/main-->
{-include:footer.php-}