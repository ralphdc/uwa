<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@REGISTER-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/{-:+lang-}.js"></script>
</head>

<body>
{-include:header_login-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-plus-circle"></i> {-:@REGISTER-}</h5><span class="float-right"><a class="btn_l" href="{-url:member/login-}"><i class="icon icon-sign-in"></i> {-:@LOGIN-}</a></span></dt>
	<dd>
		<form id="member_register" class="form" action="{-url:member/register_do-}" method="post">
			<fieldset>
				<legend>{-:@BASE_INFO-}</legend>
				<div class="form-group">
					<label class="control-label">{-:@MEMBER_TYPE-}</label>
					<div>{-:$_MI['mm_name']-}</div>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@USERID-}</label>
					<input id="m_userid" required="required" type="text" name="m_userid" value="" class="control-input" maxlength="40">
					<p id="m_userid_tip" class="control-help">{-:@USERID_TIP-}</p>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@USERNAME-}</label>
					<input id="m_username" required="required" type="text" name="m_username" value="" class="control-input" maxlength="40">
					<p id="m_username_tip" class="control-help">{-:@USERNAME_TIP-}</p>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@PASSWORD-}</label>
					<input id="m_password" required="required" type="password" name="m_password" value="" class="control-input" maxlength="255">
					<p id="m_username_tip" class="control-help">{-:@PASSWORD_TIP-}</p>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@PASSWORD_REPEAT-}</label>
					<input id="m_password_repeat" required="required" type="password" name="m_password_repeat" value="" class="control-input" maxlength="255">
					<p id="m_password_repeat_tip" class="control-help">{-:@PASSWORD_REPEAT_TIP-}</p>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@EMAIL-}</label>
					<input id="m_email" required="required" type="email" name="m_email" value="" class="control-input" maxlength="255">
					<p id="m_email_tip" class="control-help"></p>
				</div>
			</fieldset>
			<fieldset>
				<legend>{-:@ADDON_INFO-}</legend>
				{-:$_FI-}
			</fieldset>
			<fieldset>
				<legend>{-:@AGREEMENT-}</legend>
				<div class="form-group">
					<label><input id="agreement" type="checkbox" name="agreement" value="1" checked /> <span>{-:@ACCEPT-}</span></label> <span class="btn btn-sm" data-modal="{target:'#memberUsageAgreement'}">{-:@AGREEMENT_DETAIL-}</span>
				</div>
				<div id="memberUsageAgreement" class="modal">
					<div class="modal-dialog">
						<a href="" class="modal-close close"></a>
						{-:$_MI['mm_agreement']-}
					</div>
				</div>
			</fieldset>
			{-if:$_G['interaction']['captcha']-}<div class="grid">
				<div class="row">
					<div class="col-sm-4"><input required="required" type="text" placeholder="{-:@CAPTCHA-}" name="vcode" autocomplete="off" value="" class="required control-input" size="5" maxlength="5"></div>
					<div class="col-sm-8 text-muted"><img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> {-:@CAPTCHA_TIP-}</div>
				</div>
			</div>{-:/if-}
			<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
			<input name="token" type="hidden" value="{-:$_TK['token']-}">
			<input id="member_model_id" type="hidden" name="member_model_id" value="{-:$_MI['member_model_id']-}" />
			<input type="submit" class="btn btn-block" value="{-:@SUBMIT-}" />
		</form>
	</dd>
</dl>

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		toolbar : 'uwa_mini'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=member-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=member-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=member&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=member&thumb=both-}';

$(document).ready(function() {
	/*s: register */
	$('#member_register').submit(function() {
		if(!$('#agreement').get(0).checked) {
			alert("{-:@AGREEMENT_MUST_BE_ACCEPT-}");
			return false;
		}
		if('' == $('#m_userid').val()) {
			$('#m_userid').focus();
			alert("{-:@USERID_NO_EMPTY-}");
			return false;
		}
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
		if($('#m_password').val() != $('#m_password_repeat').val()) {
			$('#m_password_repeat').focus();
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
	$('#m_userid').change(function() {
		var sUserId = /^[a-zA-Z_][a-zA-Z0-9_]+$/;
		if(!sUserId.exec($("#m_userid").val())) {
			$('#m_userid_tip').html("<span class='text-danger'>{-:@USERID_FORMAT_ERROR-}</span>");
			$('#m_userid').addClass('input-danger').focus();
		}
		else if($('#m_userid').val().length < userid_min_length) {
			$('#m_userid_tip').html("<span class='text-danger'>{-:@USERID_TOO_SHORT-} (&gt;" + userid_min_length + ")</span>");
			$('#m_userid').addClass('input-danger').focus();
		}
		else {
			$.getJSON('{-url:member/register_check?type=m_userid-}', {m_userid : $("#m_userid").val()}, function(result) {
				if(1 == result.data) {
					$('#m_userid_tip').html("<span class='text-success'>" + result.info + "</span>");
					$('#m_userid').removeClass('input-danger');
				}
				else {
					$('#m_userid_tip').html("<span class='text-danger'>" + result.info + "</span>");
					$('#m_userid').addClass('input-danger').focus();
				}
			});
		}
	});
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

	$('#m_password').change(function() {
		if($('#m_password').val().length < password_min_length) {
			$('#m_password_tip').html("<span class='text-danger'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
			$('#m_password').addClass('input-danger').focus();
		}
		else if($('#m_password').val() != $('#m_password_repeat').val()) {
			$('#m_password_repeat_tip').html("<span class='text-danger'>{-:@PASSWORD_NOT_MATCH-}</span>");
			$('#m_password').addClass('input-danger').focus();
		}
		else {
			$('#m_password_tip').html("<span class='text-success'>{-:@AVAILABLE-}</span>");
			$('#m_password').removeClass('input-danger');
			$('#m_password_repeat_tip').html("<span class='text-success'>{-:@MATCH-}</span>");
			$('#m_password_repeat').removeClass('input-danger');
		}
	});
	$('#m_password_repeat').change(function() {
		if($('#m_password_repeat').val().length < password_min_length) {
			$('#m_password_repeat_tip').html("<span class='text-danger'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
			$('#m_password_repeat').addClass('input-danger').focus();
		}
		else if($('#m_password').val() != $('#m_password_repeat').val()) {
			$('#m_password_repeat_tip').html("<span class='text-danger'>{-:@PASSWORD_NOT_MATCH-}</span>");
			$('#m_password_repeat').addClass('input-danger').focus();
		}
		else {
			$('#m_password_tip').html("<span class='text-success'>{-:@AVAILABLE-}</span>");
			$('#m_password').removeClass('input-danger');
			$('#m_password_repeat_tip').html("<span class='text-success'>{-:@MATCH-}</span>");
			$('#m_password_repeat').removeClass('input-danger');
		}
	});
	/*e: register */
});

var url_get_linkage_select = '{-url:common/get_linkage_select-}';

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/u.js"></script>
<script src="{-:*__THEME__-}member/js/cal.js"></script>
<script src="{-:*__THEME__-}member/js/l.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
