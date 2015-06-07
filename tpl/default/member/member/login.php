<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@LOGIN-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div id="login" class="m w_960">
	<uwa:ad id="4">
	<dl id="login_main" class="adl">
		<dt><strong>{-:@LOGIN-}</strong></dt>
		<dd>
			<form id="loginForm" action="{-url:member/login_do-}" method="post">
			<ul class="aul_form">
				<li>
					<strong style="width:80px">{-:@USERID-}</strong> <label><input class="required i" type="text" size="20" name="m_userid" autocomplete="off" /></label>
				</li>
				<li>
					<strong style="width:80px">{-:@PASSWORD-}</strong>
					<label>
						<input id="password_origin" type="text" class="required i" size="20" maxlength="64" autocomplete="off" />
						<input id="password" name="m_password" type="hidden" />
					</label>
				</li>
				{-if:$_G['interaction']['captcha']-}
				<li><strong style="width:80px">{-:@CAPTCHA-}</strong><label>
					<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
					<img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" />
				</label></li>{-:/if-}
				<li>
					<strong style="width:80px">{-:@EXPRIE_TIME-}</strong>
					<label><input type="radio" name="expire_time" value="86400" /> {-:@A_DAY-}</label>
					<label><input type="radio" name="expire_time" value="3600" checked="checked" /> {-:@AN_HOUR-}</label>
				</li>
				<li><label><strong style="width:80px"></strong>
					<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
					<input name="token" type="hidden" value="{-:$_TK['token']-}">
					<input type="submit" class="btn_b" value="{-:@LOGIN-}" />
					<a class="btn_l" href="{-url:member/register-}">{-:@REGISTER-}</a>
				</label></li>
			</ul>
			</form>
		</dd>
	</dl>
</div><!--/.w_960-->
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/md5.js"></script>
<script>
document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
<script>
$(document).ready(function() {
	$('#password_origin').on('focus', function(){
		$(this).attr('type', 'password');
	});
});
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
</script>
{-:$_SITE['stat_code']-}
</body>
</html>