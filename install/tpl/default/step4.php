{-include:header.php-}
<script>
function check_next_step(){
	var numWarnings = $('#stepForm .warning').length;
	if(0 == numWarnings) {
		$('#stepNext').removeAttr("disabled");
		$('#stepNext').val('{-:@STEP_NEXT-}');
	}
	else {
		$('#stepNext').attr("disabled", "disabled");
		$('#stepNext').val('{-:@STEP_NEED_FIXED-}');
	}
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
					<li class="ongoing">{-:@SETUP_INSTALLATION-}</li>
					<li>{-:@WRITE_DATA-}</li>
					<li>{-:@LOCK-}</li>
				</ul>
			</dd>
		</dl>
	</div><!--id/stepList-->
	<div id="stepMain">
		<form action="" method="post" id="stepForm">
		<dl>
			<dt><strong id="stepTitle">{-:@SETUP_INSTALLATION-}</strong><span id="stepTip" class="stepTip">{-:@SETUP_INSTALLATION_TIP-}</span></dt>
			<dd id="stepContentBox">
				<div id="stepContent">
					<fieldset>
						<legend>{-:@DB_SETUP-}</legend>
						<p>
							<label for="db_host">{-:@DB_HOST-}</label>
							<input type="text" id="dbHost" class="i required" name="dbHost" value="{-:$formV.dbHost-}" />
							<span id="dbHostTip" class="inputTip">{-:@DB_HOST_TIP-}</span>
						</p>
						<p>
							<label for="db_port">{-:@DB_PORT-}</label>
							<input type="text" id="dbPort" class="i required" name="dbPort" value="{-:$formV.dbPort-}" />
							<span id="dbPortTip" class="inputTip">{-:@DB_PORT_TIP-}</span>
						</p>
						<p>
							<label for="dbUser">{-:@DB_USER-}</label>
							<input type="text" id="dbUser" class="i required" name="dbUser" value="{-:$formV.dbUser-}" />
							<span id="dbUserTip" class="inputTip">{-:@DB_USER_TIP-}</span>
						</p>
						<p>
							<label for="dbPassword">{-:@DB_PASSWORD-}</label>
							<input type="text" id="dbPassword" class="i" name="dbPassword" value="{-:$formV.dbPassword-}" />
							<span id="dbPasswordTip" class="inputTip">{-:@DB_PASSWORD_TIP-}</span>
						</p>
						<p>
							<label for="dbDatabase">{-:@DB_DATABASE-}</label>
							<input type="text" id="dbDatabase" class="i required" name="dbDatabase" value="{-:$formV.dbDatabase-}" />
							<span id="dbDatabaseTip" class="inputTip">{-:@DB_DATABASE_TIP-}</span>
						</p>
						<p>
							<label for="dbPrefix">{-:@DB_PREFIX-}</label>
							<input type="text" id="dbPrefix" class="i required" name="dbPrefix" value="{-:$formV.dbPrefix-}" />
							<span id="dbPrefixTip" class="inputTip">{-:@DB_PREFIX_TIP-}</span>
						</p>
						<p>
							<label for="dbConnection">{-:@DB_CONNECTION-}</label>
							<select name="dbConnection" class="i">
								<option value="mysql" {-if: 'mysql'==$formV['dbConnection']-} selected{-:/if-}>MySQL</option>
								<option value="mysqli"{-if: 'mysqli'==$formV['dbConnection']-} selected{-:/if-}>MySQLi</option>
							</select>
							<span id="dbConnectionTip" class="inputTip">{-:@DB_CONNECTION_TIP-}</span>
						</p>
					</fieldset>
					<fieldset>
						<legend>{-:@FOUNDER_SETUP-}</legend>
						<p>
							<label for="founderName">{-:@FOUNDER_NAME-}</label>
							<input type="text" id="founderName" class="i required" name="founderName" value="{-:$formV.founderName-}" />
							<span id="founderNameTip" class="inputTip">{-:@FOUNDER_NAME_TIP-}</span>
						</p>
						<p>
							<label for="founderPassword">{-:@FOUNDER_PASSWORD-}</label>
							<input type="text" id="founderPassword" class="i required" name="founderPassword" value="{-:$formV.founderPassword-}" />
							<span id="founderPasswordTip" class="inputTip">{-:@FOUNDER_PASSWORD_TIP-}</span>
						</p>
						<p>
							<label for="founderEmail">{-:@FOUNDER_EMAIL-}</label>
							<input type="text" id="founderEmail" class="i required" name="founderEmail" value="{-:$formV.founderEmail-}" />
							<span id="founderEmailTip" class="inputTip">{-:@FOUNDER_EMAIL_TIP-}</span>
						</p>
					</fieldset>
					<fieldset>
						<legend>{-:@OTHER-}</legend>
						<p>
							<label for="cookieKey">{-:@COOKIE_KEY-}</label>
							<input type="text" id="cookieKey" class="i required" name="cookieKey" value="{-:$formV.cookieKey-}" />
							<span id="cookieKeyTip" class="inputTip">{-:@COOKIE_KEY_TIP-}</span>
						</p>
					</fieldset>
					{-if:''!=$errorMessage-}
					<div id="errorMessage">
						{-:$errorMessage-}
					</div>
					{-:/if-}
				</div><!--id/stepContent-->
			</dd><!--id/stepContentBox-->
			<dd id="operation">
				<input type="hidden" name="step" value="5">
				<input type="button" onclick="history.back()" value="{-:@STEP_BACK-}" />
				<input type="submit" disabled="disabled" id="stepNext" value="{-:@STEP_NEED_FIXED-}" />
				<script>check_next_step();</script>
			</dd>
		</dl>
		</form>
	</div><!--id/stepMain-->
	<div class="c"></div>
</div><!--id/main-->
{-include:footer.php-}