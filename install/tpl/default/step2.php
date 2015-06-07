{-include:header.php-}
<div id="main">
	<div id="stepList">
		<dl>
			<dt><strong>{-:@INSTALL_WIZARD-}</strong></dt>
			<dd>
				<ul>
					<li>{-:@INTRODUCE_SOFT-}</li>
					<li class="ongoing">{-:@SHOW_LICENSE-}</li>
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
			<dt><strong id="stepTitle">{-:@SHOW_LICENSE-}</strong><span id="stepTip" class="stepTip">{-:@SHOW_LICENSE_TIP-}</span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<div id="softLicense">{-:@SOFT_LICENSE-}
					</div><!--id/softLicense-->
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
				<input type="hidden" name="step" value="3">
				<input type="button" onclick="history.back()" value="{-:@AGREEMENT_NO-}" />
				<input type="submit" id="agreementYes" value="{-:@AGREEMENT_YES-}" />
			</dd>
		</dl>
		</form>
	</div><!--id/stepMain-->
	<div class="c"></div>
</div><!--id/main-->
{-include:footer.php-}