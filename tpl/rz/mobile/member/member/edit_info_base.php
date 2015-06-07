<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@EDIT_INFO_BASE-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
{-include:../header-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-user"></i> {-:@EDIT_INFO_BASE-}</h5><span class="float-right"><a class="btn_l" href="{-url:member/edit_info_addon-}"><i class="icon icon-info-circle"></i> {-:@EDIT_INFO_ADDON-}</a></span></dt>
	<dd>
		<form id="edit_info_base" class="form" action="{-url:member/edit_info_base_do-}" method="post">
			<div class="alert" data-alert>
				<a href="#" class="alert-close close"></a>
				<dl class="dl-horizontal">
					<dt>{-:@MEMBER_TYPE-}</dt><dd>{-:$_MI['mm_name']-}</dd>
					<dt>{-:@USERID-}</dt><dd>{-:$_MI['m_userid']-}</dd>
				</dl>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@USERNAME-}</label>
				<input id="m_username" required="required" type="text" name="m_username" value="{-:$_MI['m_username']-}" class="control-input" maxlength="40">
				<p id="m_username_tip" class="control-help">{-:@USERNAME_TIP-}</p>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@PASSWORD-}</label>
				<input id="m_password" required="required" type="password" name="m_password" value="" class="control-input" maxlength="255">
			</div>
			<div class="form-group">
				<label class="control-label">{-:@NEW_PASSWORD-}</label>
				<input id="m_new_password" type="password" name="m_new_password" value="" class="control-input" maxlength="255">
				<p id="m_new_password_tip" class="control-help"></p>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@NEW_PASSWORD_REPEAT-}</label>
				<input id="m_new_password_repeat" type="password" name="m_new_password_repeat" value="" class="control-input" maxlength="255">
				<p id="m_new_password_repeat_tip" class="control-help"></p>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@EMAIL-}</label>
				<input id="m_email" required="required" type="email" name="m_email" value="{-:$_MI['m_email']-}" class="control-input" maxlength="255">
				<p id="m_email_tip" class="control-help"></p>
			</div>
			{-if:$_G['interaction']['captcha']-}<div class="grid">
				<div class="row">
					<div class="col-sm-4"><input required="required" type="text" placeholder="{-:@CAPTCHA-}" name="vcode" autocomplete="off" value="" class="required control-input" size="5" maxlength="5"></div>
					<div class="col-sm-8 text-muted"><img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> {-:@CAPTCHA_TIP-}</div>
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
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
$(document).ready(function() {
	/*s: form check */
	$('#edit_info_base').submit(function() {
		if('' == $('#m_username').val()) {
			$('#m_username').focus();
			alert("{-:@USERNAME_NO_EMPTY-}");
			return false;
		}
		if('' == $('#m_password').val()) {
			$('#m_password').focus();
			alert("{-:@PASSWORD_NO_EMPTY-}");
			return false;
		}
		if($('#m_new_password').val() != $('#m_new_password_repeat').val()) {
			$('#m_new_password_repeat').focus();
			alert("{-:@PASSWORD_NOT_MATCH-}");
			return false;
		}
		if('' == $('#m_email').val()) {
			$('#m_email').focus();
			alert("{-:@EMAIL_NO_EMPTY-}");
			return false;
		}
	});

	var userid_min_length = {-:$_G['member']['userid_min_length']-},
		password_min_length = {-:$_G['member']['password_min_length']-};
	/* check change */
	$('#m_username').change(function() {
		var sUsername = /^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[\w])*$/;
		if(!sUsername.exec($("#m_username").val())) {
			$('#m_username_tip').html("<span class='text-danger'>{-:@USERNAME_FORMAT_ERROR-}</span>");
			$('#m_username').addClass('input-danger').focus();
		}
		else {
			$.getJSON('{-url:member/register_check?type=m_username-}', {m_username : $("#m_username").val()}, function(result) {
				if(1 == result.data) {
					$('#m_username_tip').html("<span class='text-success'>" + result.info + "</span>");
					$('#m_username').removeClass('input-danger').focus();
				}
				else {
					$('#m_username_tip').html("<span class='text-danger'>" + result.info + "</span>");
					$('#m_username').addClass('input-danger').focus();
				}
			});
		}
	});
	$("#m_email").change(function() {
		var sEmail = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
		if(!sEmail.exec($("#m_email").val())) {
			$('#m_email_tip').html("<span class='text-danger'>{-:@EMAIL_FORMAT_ERROR-}</span>");
			$('#m_email').addClass('input-danger').focus();
		}
		else {
			$.getJSON('{-url:member/register_check?type=m_email-}', {m_email : $("#m_email").val()}, function(result) {
				if(1 == result.data) {
					$('#m_email_tip').html("<span class='text-success'>" + result.info + "</span>");
					$('#m_email').removeClass('input-danger').focus();
				}
				else {
					$('#m_email_tip').html("<span class='text-danger'>" + result.info + "</span>");
					$('#m_email').addClass('input-danger').focus();
				}
			});
		}
	});

	$('#m_new_password').change(function() {
		if($('#m_new_password').val().length < password_min_length) {
			$('#m_new_password_tip').html("<span class='text-danger'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
			$('#m_new_password').addClass('input-danger').focus();
		}
		else if($('#m_new_password').val() != $('#m_new_password_repeat').val()) {
			$('#m_new_password_repeat_tip').html("<span class='text-danger'>{-:@PASSWORD_NOT_MATCH-}</span>");
			$('#m_new_password').addClass('input-danger').focus();
		}
		else {
			$('#m_new_password_tip').html("<span class='text-success'>{-:@AVAILABLE-}</span>");
			$('#m_new_password').removeClass('input-danger');
			$('#m_new_password_repeat_tip').html("<span class='text-success'>{-:@MATCH-}</span>");
			$('#m_new_password_repeat').removeClass('input-danger');
		}
	});
	$('#m_new_password_repeat').change(function() {
		if($('#m_new_password_repeat').val().length < password_min_length) {
			$('#m_new_password_repeat_tip').html("<span class='text-danger'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
			$('#m_new_password_repeat').addClass('input-danger').focus();
		}
		else if($('#m_new_password').val() != $('#m_new_password_repeat').val()) {
			$('#m_new_password_repeat_tip').html("<span class='text-danger'>{-:@PASSWORD_NOT_MATCH-}</span>");
			$('#m_new_password_repeat').addClass('input-danger').focus();
		}
		else {
			$('#m_new_password_tip').html("<span class='text-success'>{-:@AVAILABLE-}</span>");
			$('#m_new_password').removeClass('input-danger');
			$('#m_new_password_repeat_tip').html("<span class='text-success'>{-:@MATCH-}</span>");
			$('#m_new_password_repeat').removeClass('input-danger');
		}
	});
	/*e: form check */
});

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
