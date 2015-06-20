<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@REGISTER-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/zh-cn.js"></script>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_650 adiv">
	<form id="member_register" action="{-url:member/register_do-}" method="post">
	<table class="formTable p_20">
		<tr>
			<th colspan="2" scope="col" class="fc_b">{-:@BASE_INFO-}</th>
		</tr>
		<tr>
			<td class="inputTitle">{-:@MEMBER_TYPE-}</td>
			<td class="inputTitle"></td>
		</tr>
		<tr>
			<td class="inputArea">{-:$_MI['mm_name']-}</td>
			<td class="inputTip"></td>
		</tr>
		<tr>
			<td colspan="2" class="inputTitle">{-:@USERID-}</td>
		</tr>
		<tr>
			<td colspan="2" class="inputArea">
				<label><input id="m_userid" type="text" name="m_userid" class="i required" value="" size="30" /> <span id="m_userid_tip">{-:@USERID_TIP-}</span></label>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="inputTitle">{-:@USERNAME-}</td>
		</tr>
		<tr>
			<td colspan="2" class="inputArea">
				<label><input id="m_username" type="text" name="m_username" class="i required" value="" size="30"/> <span id="m_username_tip">{-:@USERNAME_TIP-}</span></label>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="inputTitle">{-:@PASSWORD-}</td>
		</tr>
		<tr>
			<td colspan="2" class="inputArea">
				<label><input id="m_password" type="password" name="m_password" class="i required" value="" size="30" /> <span id="m_password_tip">{-:@PASSWORD_TIP-}</span></label>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="inputTitle">{-:@PASSWORD_REPEAT-}</td>
		</tr>
		<tr>
			<td colspan="2" class="inputArea">
				<label><input id="m_password_repeat" type="password" name="m_password_repeat" class="i required" value="" size="30" /> <span id="m_password_repeat_tip">{-:@PASSWORD_REPEAT_TIP-}</span></label>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="inputTitle">{-:@EMAIL-}</td>
		</tr>
		<tr>
			<td colspan="2" class="inputArea">
				<label><input id="m_email" type="text" name="m_email" class="i required" value="" size="30" /> <span id="m_email_tip"></span></label>
			</td>
		</tr>
		<tr>
			<th colspan="2" scope="col" class="fc_b">{-:@ADDON_INFO-}</th>
		</tr>
		{-:$_FI-}
		<tr>
			<th colspan="2" scope="col" class="fc_b">{-:@AGREEMENT-}</th>
		</tr>
		<tr>
			<td colspan="2" class="">
				<div id="member_usage_agreement" style="display:none">{-:$_MI['mm_agreement']-}</div>
			</td>
		</tr>
		<tr>
			<td class="inputArea"><label><input id="agreement" type="checkbox" name="agreement" value="1" /> <span>{-:@ACCEPT-}</span></label> <span onclick="$('#member_usage_agreement').toggle()" class="bg_gry_d fc_wht p_2_5 br_3 fs_11 a">{-:@AGREEMENT_DETAIL-}</span></td>
			<td class="inputTip"></td>
		</tr>
		{-if:$_G['interaction']['captcha']-}<tr>
			<td colspan="2" class="inputTitle">{-:@CAPTCHA-}</td>
		</tr>
		<tr>
			<td colspan="2" class="inputArea">
				<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
				<img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> <span class="fc_gry">{-:@CAPTCHA_TIP-}</span>
			</td>
		</tr>{-:/if-}
		<tr>
			<td colspan="2" class="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<input id="member_model_id" type="hidden" name="member_model_id" value="{-:$_MI['member_model_id']-}" />
				<input type="submit" class="btn_b" value="{-:@SUBMIT-}" />
			</td>
		</tr>
	</table>
	</form>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		toolbar : 'uwa_simple'
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
			$('#m_userid_tip').html("<span class='fc_r'>{-:@USERID_FORMAT_ERROR-}</span>");
			$('#m_userid').focus();
		}
		else if($('#m_userid').val().length < userid_min_length) {
			$('#m_userid_tip').html("<span class='fc_r'>{-:@USERID_TOO_SHORT-} (&gt;" + userid_min_length + ")</span>");
		}
		else {
			$.getJSON('{-url:member/register_check?type=m_userid-}', {m_userid : $("#m_userid").val()}, function(result) {
				if(1 == result.data) {
					$('#m_userid_tip').html("<span class='fc_g'>" + result.info + "</span>");
				}
				else {
					$('#m_userid_tip').html("<span class='fc_r'>" + result.info + "</span>");
				}
			});
		}
	});
	$('#m_username').change(function() {
		var sUsername = /^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[\w])*$/;
		if(!sUsername.exec($("#m_username").val())) {
			$('#m_username_tip').html("<span class='fc_r'>{-:@USERNAME_FORMAT_ERROR-}</span>");
			$('#m_username').focus();
		}
		else {
			$.getJSON('{-url:member/register_check?type=m_username-}', {m_username : $("#m_username").val()}, function(result) {
				if(1 == result.data) {
					$('#m_username_tip').html("<span class='fc_g'>" + result.info + "</span>");
				}
				else {
					$('#m_username_tip').html("<span class='fc_r'>" + result.info + "</span>");
				}
			});
		}
	});
	$("#m_email").change(function() {
		var sEmail = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
		if(!sEmail.exec($("#m_email").val())) {
			$('#m_email_tip').html("<span class='fc_r'>{-:@EMAIL_FORMAT_ERROR-}</span>");
			$('#m_email').focus();
		}
		else {
			$.getJSON('{-url:member/register_check?type=m_email-}', {m_email : $("#m_email").val()}, function(result) {
				if(1 == result.data) {
					$('#m_email_tip').html("<span class='fc_g'>" + result.info + "</span>");
				}
				else {
					$('#m_email_tip').html("<span class='fc_r'>" + result.info + "</span>");
				}
			});
		}
	});

	$('#m_password').change(function() {
		if($('#m_password').val().length < password_min_length) {
			$('#m_password_tip').html("<span class='fc_r'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
		}
		else if($('#m_password').val() != $('#m_password_repeat').val()) {
			$('#m_password_repeat_tip').html("<span class='fc_r'>{-:@PASSWORD_NOT_MATCH-}</span>");
		}
		else {
			$('#m_password_tip').html("<span class='fc_g'>{-:@AVAILABLE-}</span>");
			$('#m_password_repeat_tip').html("<span class='fc_g'>{-:@MATCH-}</span>");
		}
	});
	$('#m_password_repeat').change(function() {
		if($('#m_password_repeat').val().length < password_min_length) {
			$('#m_password_repeat_tip').html("<span class='fc_r'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
		}
		else if($('#m_password').val() != $('#m_password_repeat').val()) {
			$('#m_password_repeat_tip').html("<span class='fc_r'>{-:@PASSWORD_NOT_MATCH-}</span>");
		}
		else {
			$('#m_password_tip').html("<span class='fc_g'>{-:@AVAILABLE-}</span>");
			$('#m_password_repeat_tip').html("<span class='fc_g'>{-:@MATCH-}</span>");
		}
	});
	/*e: register */
});

var url_get_linkage_select = '{-url:common/get_linkage_select-}';

document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/u.js"></script>
<script src="{-:*__THEME__-}member/js/cal.js"></script>
<script src="{-:*__THEME__-}member/js/l.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>