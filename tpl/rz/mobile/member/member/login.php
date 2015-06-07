<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@LOGIN-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
{-include:header_login-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-sign-in"></i> {-:@LOGIN-}</h5><span class="float-right"><a class="btn_l" href="{-url:member/register-}"><i class="icon icon-plus-circle"></i> {-:@REGISTER-}</a></span></dt>
	<dd>
		<form id="loginForm" class="form" action="{-url:member/login_do-}" method="post">
			<div class="form-group">
				<label class="control-label">{-:@USERID-}</label>
				<input required="required" type="text" name="m_userid" value="" class="control-input" maxlength="40" autocomplete="off">
			</div>
			<div class="form-group">
				<label class="control-label">{-:@PASSWORD-}</label>
				<input id="password" name="m_password" type="hidden" />
				<input id="password_origin" required="required" type="password" name="password" value="" class="control-input" maxlength="255" autocomplete="off">
			</div>
			<div class="form-group">
				<label class="control-label">{-:@EXPRIE_TIME-}</label>
				<div>
					<label><input type="radio" name="expire_time" value="86400" /> {-:@A_DAY-}</label>
					<label><input type="radio" name="expire_time" value="3600" checked="checked" /> {-:@AN_HOUR-}</label>
				</div>
			</div>
			{-if:$_G['interaction']['captcha']-}<div class="grid">
				<div class="row">
					<div class="col-sm-4"><input required="required" type="text" placeholder="{-:@CAPTCHA-}" name="vcode" autocomplete="off" value="" class="required control-input" size="5" maxlength="5"></div>
					<div class="col-sm-8 text-muted"><img src="{-url:home@common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> {-:@CAPTCHA_TIP-}</div>
				</div>
			</div>{-:/if-}
			<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
			<input name="token" type="hidden" value="{-:$_TK['token']-}">
			<input type="submit" class="btn btn-block" value="{-:@SUBMIT-}" />
		</form>
	</dd>
</dl>

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script src="{-:*__PUBLIC__-}js/md5.js"></script>
<script>
$('#loginForm').submit(function() {
	encode_pwd()
});
function encode_pwd() {
	var password_origin = $('#password_origin').val();
	if('' != password_origin) {
		$('#password').val(hex_md5(password_origin));
	}
	else {
		$('#password').val('');
	}
}
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
