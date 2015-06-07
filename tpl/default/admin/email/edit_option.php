<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="{-url:email/send_email-}">{-:@SEND_EMAIL-}</a></span><strong>{-:@EMAIL_OPTION-}</strong><span><a href="{-url:email/edit_template-}">{-:@EMAIL_TEMPLATE-}</a></span></dt>
	<dd>
		<div class="tabCntnt">
			<table id="main_params" class="formTable">
				<tr>
					<td class="inputTitle">{-:@SENDER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i required" type="text" value="{-:$_O['sender']-}" name="sender" maxlength="255" size="40" />
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@SENDER_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@SENDER_NAME-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i required" type="text" value="{-:$_O['sender_name']-}" name="sender_name" maxlength="255" size="20" />
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@SENDER_NAME_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@EMAILER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="mail" onclick="add_params('mail');" name="mailer"{-if:'mail'==$_O['mailer']-} checked="checked"{-:/if-}> mail()</label>
						<label><input type="radio" value="smtp" onclick="add_params('smtp');" name="mailer"{-if:'smtp'==$_O['mailer']-} checked="checked"{-:/if-}> SMTP</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@EMAILER_TIP-}
					</td>
				</tr>
			</table>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:email/edit_option_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<table id="extra_params" style="display:none;">
	<tr params_for="smtp">
		<td class="inputTitle">{-:@SMTP_HOST-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="smtp">
		<td class="inputArea">
			<input class="i required" type="text" value="{-:$_O['smtp']['host']-}" name="smtp[host]" maxlength="255" size="40" />
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@SMTP_HOST_TIP-}
		</td>
	</tr>
	<tr params_for="smtp">
		<td class="inputTitle">{-:@SMTP_PORT-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="smtp">
		<td class="inputArea">
			<input class="i required" type="text" value="{-:$_O['smtp']['port']-}" name="smtp[port]" maxlength="255" size="10" />
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@SMTP_PORT_TIP-}
		</td>
	</tr>
	<tr params_for="smtp">
		<td class="inputTitle">{-:@SMTP_AUTH-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="smtp">
		<td class="inputArea">
			<label><input type="radio" value="0" name="smtp[auth]"{-if:false==$_O['smtp']['auth']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
			<label><input type="radio" value="1" name="smtp[auth]"{-if:true==$_O['smtp']['auth']-} checked="checked"{-:/if-}> {-:@ON-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@SMTP_AUTH_TIP-}
		</td>
	</tr>
	<tr params_for="smtp">
		<td class="inputTitle">{-:@SMTP_SECURE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="smtp">
		<td class="inputArea">
			<label><input type="radio" value="" name="smtp[secure]"{-if:''==$_O['smtp']['secure']-} checked="checked"{-:/if-}> {-:@NONE-}</label>
			<label><input type="radio" value="ssl" name="smtp[secure]"{-if:'ssl'==$_O['smtp']['secure']-} checked="checked"{-:/if-}> {-:@SSL-}</label>
			<label><input type="radio" value="tls" name="smtp[secure]"{-if:'tls'==$_O['smtp']['secure']-} checked="checked"{-:/if-}> {-:@TLS-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@SMTP_SECURE_TIP-}
		</td>
	</tr>
	<tr params_for="smtp">
		<td class="inputTitle">{-:@SMTP_USERNAME-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="smtp">
		<td class="inputArea">
			<input class="i required" type="text" value="{-:$_O['smtp']['username']-}" name="smtp[username]" maxlength="255" size="40" />
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@SMTP_USERNAME_TIP-}
		</td>
	</tr>
	<tr params_for="smtp">
		<td class="inputTitle">{-:@SMTP_PASSWORD-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="smtp">
		<td class="inputArea">
			<input class="i required" type="password" value="{-:$_O['smtp']['password']-}" name="smtp[password]" maxlength="255" size="40" />
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@SMTP_PASSWORD_TIP-}
		</td>
	</tr>
</table>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script>
$(document).ready(function() {
	add_params('{-:$_O['mailer']-}');
});
/* show field params */
function add_params(f_type) {
	$('tr[params_for]').appendTo($('#extra_params'));
	$('tr[params_for*="' + f_type + '"]').appendTo($('#main_params'));
}
</script>
</body>
</html>