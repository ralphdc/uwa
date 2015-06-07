{-include:header.php-}
<script>
function show_progress(message, barLength) {
	$('#progressInfo').html(barLength + ' ' + message);
	$('#progressBar').css({'width':barLength});
}
</script>
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
					<li class="ongoing">{-:@WRITE_DATA-}</li>
					<li>{-:@LOCK-}</li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle">{-:@WRITE_DATA-}</strong><span id="stepTip" class="stepTip">{-:@WRITE_DATA_TIP-}</span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<div class="progressBarBox"><div id="progressBar" class="progressBar"></div></div>
					<div id="progressInfo">progressInfo</div>
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
				<input type="hidden" name="step" value="6">
				<input type="submit" value="{-:@SUCCESS_AND_LOCK-}" />
			</dd>
		</dl>
		</form>
	</div><!--id/stepMain-->
	<div class="c"></div>
</div><!--id/main-->
{-include:footer.php-}