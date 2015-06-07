{-include:header.php-}
<script>
function check_next_step() {
{-if:true == $checkNextStep-}
	$('#stepNext').removeAttr("disabled");
	$('#stepNext').val('{-:@STEP_NEXT-}');
{-else:-}
	$('#stepNext').attr("disabled", "disabled");
	$('#stepNext').val('{-:@STEP_NEED_FIXED-}');
{-:/if-}
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
					<li class="ongoing">{-:@CHECK_ENVIRONMENT-}</li>
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
			<dt><strong id="stepTitle">{-:@CHECK_ENVIRONMENT-}</strong><span id="stepTip" class="stepTip">{-:@CHECK_ENVIRONMENT_TIP-}</span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
				{-if:!empty($systemItems)-}
					<h2>{-:@SYSTEM_CHECK-}</h2>
					<table>
						<tr>
							<th>{-:@ITEM_NAME-}</th>
							<th>{-:@ITEM_REQUIREMENT-}</th>
							<th>{-:@ITEM_BEST-}</th>
							<th>{-:@ITEM_CURRENT-}</th>
						</tr>
						{-foreach:$systemItems,$k,$v-}
						<tr>
							<td>{-:$k-}</td>
							<td>{-:$v.r-}</td>
							<td>{-:$v.b-}</td>
							<td {-:$v.c_c-}>{-:$v.c-}</td>
						</tr>
						{-:/foreach-}
					</table>
				{-:/if-}

				{-if:!empty($dirFileItems)-}
					<h2>{-:@DIR_FILE_CHECK-}</h2>
					<table>
						<tr>
							<th>{-:@ITEM_NAME-}</th>
							<th>{-:@DIR_FILE_TYPE-}</th>
							<th>{-:@DIR_FILE_PATH-}</th>
							<th>{-:@ITEM_STATUS-}</th>
						</tr>
						{-foreach:$dirFileItems,$k,$v-}
						<tr>
							<td>{-:$k-}</td>
							<td>{-:$v.type-}</td>
							<td>{-:$v.path-}</td>
							<td {-:$v.c_c-}>{-:$v.c-}</td>
						</tr>
						{-:/foreach-}
					</table>
				{-:/if-}

				{-if:!empty($phpConfigItems)-}
					<h2>{-:@PHP_CONFIG_CHECK-}</h2>
					<table>
						<tr>
							<th>{-:@ITEM_NAME-}</th>
							<th>{-:@ITEM_REQUIREMENT-}</th>
							<th>{-:@ITEM_CURRENT-}</th>
						</tr>
						{-foreach:$phpConfigItems,$k,$v-}
						<tr>
							<td>{-:$k-}</td>
							<td>{-:$v.r-}</td>
							<td {-:$v.c_c-}>{-:$v.c-}</td>
						</tr>
						{-:/foreach-}
					</table>
				{-:/if-}

				{-if:!empty($extensionItems)-}
					<h2>{-:@EXTENSION_CHECK-}</h2>
					<table>
						<tr>
							<th>{-:@ITEM_NAME-}</th>
							<th>{-:@ITEM_STATUS-}</th>
						</tr>
						{-foreach:$extensionItems,$k,$v-}
						<tr>
							<td>{-:$v.name-}</td>
							<td {-:$v.c_c-}>{-:$v.s-}</td>
						</tr>
						{-:/foreach-}
					</table>
				{-:/if-}

				{-if:!empty($functionItems)-}
					<h2>{-:@FUNCTION_CHECK-}</h2>
					<table>
						<tr>
							<th>{-:@ITEM_NAME-}</th>
							<th>{-:@ITEM_STATUS-}</th>
						</tr>
						{-foreach:$functionItems,$k,$v-}
						<tr>
							<td>{-:$v.name-}</td>
							<td {-:$v.c_c-}>{-:$v.s-}</td>
						</tr>
						{-:/foreach-}
					</table>
				{-:/if-}
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
				<input type="hidden" name="step" value="4">
				<input type="button" onclick="history.back()" value="{-:@STEP_BACK-}" />
				<input type="button" onclick="history.go(0)" value="{-:@RECHECK-}" />
				<input type="submit" disabled="disabled" id="stepNext" value="{-:@STEP_NEED_FIXED-}" />
				<script>check_next_step();</script>
			</dd>
		</dl>
		</form>
	</div><!--id/stepMain-->
	<div class="c"></div>
</div><!--id/main-->
{-include:footer.php-}