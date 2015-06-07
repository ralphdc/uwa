<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/{-:+lang-}.js"></script>
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="atab">
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@ADVANCED-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@ADMIN_ROLE-}</td>
					<td></td>
				</tr>
				<tr>
					<td class="inputArea">
						<select name="admin_role_id">
						{-foreach:$_ARL,$ar-}
							<option value="{-:$ar['admin_role_id']-}">{-:$ar['ar_name']-}</option>
						{-:/foreach-}
						</select>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@ADMIN_ROLE_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@USERID-}</td>
					<td class="inputTitle">{-:@PASSWORD-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="m_userid" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_USERID_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="password" value="" name="m_password" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_PASSWORD_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@USERNAME-}</td>
					<td class="inputTitle">{-:@EMAIL-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="m_username" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_USENAME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="m_email" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_EMAIL_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@AUTHORIZE_CHANNEL-}</td>
					<td></td>
				</tr>
				<tr>
					<td class="inputArea">
						<select name="a_ac_id[]" multiple="true" size="10" style="width:300px;">
							<option value="_all">{-:@ALL_CHANNEL-}</option>
							{-:$_ACLStr-}
						</select>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@A_AC_ID_TIP-}</span>
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@MODEL-}</td>
					<td class="inputTitle">{-:@LEVEL-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<select name="member_model_id">
						{-foreach:$_MML,$m-}
							<option value="{-:$m['member_model_id']-}">{-:$m['mm_name']-}</option>
						{-:/foreach-}
						</select>
						<span class="fc_gry">{-:@MEMBER_MODEL_TIP-}</span>
					</td>
					<td class="inputArea">
						<select name="member_level_id">
						{-foreach:$_MLL,$l-}
							<option value="{-:$l['member_level_id']-}">{-:$l['ml_name']-}</option>
						{-:/foreach-}
						</select>
						<span class="fc_gry">{-:@MEMBER_LEVEL_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@STATUS-}</td>
					<td class="inputTitle">{-:@EXPERIENCE-}/{-:@POINTS-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="m_status"> {-:@NOT_PASSED-}</label>
						<label><input type="radio" checked="checked" value="1" name="m_status"> {-:@PASSED-}</label>
						<label><input type="radio" value="2" name="m_status">{-:@FORBIDDEN-} </label>
						<span class="fc_gry">{-:@M_STATUS_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="0" name="m_experience" maxlength="20" size="10">
						<span class="fc_gry">{-:@M_EXPERIENCE_TIP-}</span>
						<input class="i" type="text" value="0" name="m_points" maxlength="20" size="10">
						<span class="fc_gry">{-:@M_POINTS_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@REG_TIME-}</td>
					<td class="inputTitle">{-:@REG_IP-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i calendar" type="text" value="{-php:echo date(C('APP.TIME_FORMAT'));-}" format="{-:#APP.TIME_FORMAT-}" id="m_reg_time" name="m_reg_time" maxlength="255" size="20">
						<span class="fc_gry">{-:@M_REG_TIME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="{-php:echo AServer::get_ip();-}" name="m_reg_ip" maxlength="20" size="15">
						<span class="fc_gry">{-:@M_REG_IP_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@LOGIN_TIME-}</td>
					<td class="inputTitle">{-:@LOGIN_IP-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i calendar" type="text" value="{-php:echo date(C('APP.TIME_FORMAT'));-}" format="{-:#APP.TIME_FORMAT-}" id="m_login_time" name="m_login_time" maxlength="255" size="20">
						<span class="fc_gry">{-:@M_LOGIN_TIME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="{-php:echo AServer::get_ip();-}" name="m_login_ip" maxlength="20" size="15">
						<span class="fc_gry">{-:@M_LOGIN_IP_TIP-}</span>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:admin/add_admin_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:admin/list_admin-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
</body>
</html>