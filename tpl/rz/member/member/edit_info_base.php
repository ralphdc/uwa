<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@EDIT_INFO_BASE-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<dl class="atab_1 adiv">
			<dt><strong class="on">{-:@BASE_INFO-}</strong><strong><a href="{-url:member/edit_info_addon-}">{-:@ADDON_INFO-}</a></strong></dt>
			<dd class="p_20">
				<form id="edit_info_base" action="{-url:member/edit_info_base_do-}" method="post"><table class="formTable">
					<tr>
						<td class="inputTitle">{-:@USERID-}</td>
						<td class="inputTitle">{-:@USER_TYPE-}</td>
					</tr>
					<tr>
						<td class="inputArea">
							<label>{-:$_MI['m_userid']-}</label>
						</td>
						<td class="inputArea">
							<label>{-:$_MI['mm_name']-}</label>
						</td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@USERNAME-}</td>
						<td></td>
					</tr>
					<tr>
						<td class="inputArea">
							<label><input id="m_username" class="required i" type="text" size="30" name="m_username" value="{-:$_MI['m_username']-}" /></label>
						</td>
						<td class="inputTip"><span id="m_username_tip"></span></td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@PASSWORD-}</td>
						<td></td>
					</tr>
					<tr>
						<td class="inputArea">
							<label><input id="m_password" class="required i" type="password" size="30" name="m_password" /></label>
						</td>
						<td class="inputTip"><span id="m_password_tip"></span></td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@NEW_PASSWORD-}</td>
						<td></td>
					</tr>
					<tr>
						<td class="inputArea">
							<label><input id="m_new_password" class="i" type="password" size="30" name="m_new_password" /></label>
						</td>
						<td class="inputTip"><span id="m_new_password_tip"></span></td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@NEW_PASSWORD_REPEAT-}</td>
						<td></td>
					</tr>
					<tr>
						<td class="inputArea">
							<label><input id="m_new_password_repeat" class="i" type="password" size="30" name="m_new_password_repeat" /></label>
						</td>
						<td class="inputTip"><span id="m_new_password_repeat_tip"></span></td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@EMAIL-}</td>
						<td></td>
					</tr>
					<tr>
						<td class="inputArea">
							<label><input id="m_email" class="required i" type="text" size="40" name="m_email" value="{-:$_MI['m_email']-}" /></label>
						</td>
						<td class="inputTip"><span id="m_email_tip"></span></td>
					</tr>
					{-if:$_G['interaction']['captcha']-}
					<tr>
						<td class="inputTitle">{-:@CAPTCHA-}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2" class="inputArea">
						<label>
							<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
							<img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" />
							<span class="fc_gry">{-:@CAPTCHA_TIP-}</span>
						</label>
						</td>
					</tr>{-:/if-}
					<tr>
						<td colspan="2" class="operation">
						<label>
							<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
							<input name="token" type="hidden" value="{-:$_TK['token']-}">
							<input type="submit" class="btn_b" value="{-:@SUBMIT-}" />
							<input class="btn_l" type="reset" value="{-:@RESET-}" />
						</label>
						</td>
					</tr>
				</table></form>
			</dd>
		</dl>
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
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
	})

	var userid_min_length = {-:$_G['member']['userid_min_length']-},
		password_min_length = {-:$_G['member']['password_min_length']-};
	/* check change */
	$('#m_username').change(function() {
		var sUsername = /^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[\w])*$/;
		if(!sUsername.exec($("#m_username").val())) {
			$('#m_username_tip').html("<span class='fc_r'>{-:@USERNAME_FORMAT_ERROR-}</span>");
			$('#m_username').focus();
		}
		else {
			$.get('{-url:member/register_check?type=m_username-}', {m_username : $("#m_username").val()}, function(data) {
				$('#m_username_tip').html(data);
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
			$('#m_email_tip').html('');
		}
	});

	$('#m_new_password').change(function() {
		if($('#m_new_password').val().length > 0) {
			if($('#m_new_password').val().length < password_min_length) {
				$('#m_new_password_tip').html("<span class='fc_r'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
			}
			else if($('#m_new_password').val() != $('#m_new_password_repeat').val()) {
				$('#m_new_password_repeat_tip').html("<span class='fc_r'>{-:@PASSWORD_NOT_MATCH-}</span>");
			}
			else {
				$('#m_new_password_tip').html("<span class='fc_g'>{-:@AVAILABLE-}</span>");
				$('#m_new_password_repeat_tip').html("<span class='fc_g'>{-:@MATCH-}</span>");
			}
		}
	});
	$('#m_new_password_repeat').change(function() {
		if($('#m_new_password').val().length > 0) {
			if($('#m_new_password_repeat').val().length < password_min_length) {
				$('#m_new_password_repeat_tip').html("<span class='fc_r'>{-:@PASSWORD_TOO_SHORT-} (&gt;" + password_min_length +")</span>");
			}
			else if($('#m_new_password').val() != $('#m_new_password_repeat').val()) {
				$('#m_new_password_repeat_tip').html("<span class='fc_r'>{-:@PASSWORD_NOT_MATCH-}</span>");
			}
			else {
				$('#m_new_password_tip').html("<span class='fc_g'>{-:@AVAILABLE-}</span>");
				$('#m_new_password_repeat_tip').html("<span class='fc_g'>{-:@MATCH-}</span>");
			}
		}
	});
	/*e: form check */
});

document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>