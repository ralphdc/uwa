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
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><strong>{-:@MEMBER-}</strong><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@MEMBER_SWITCH-} [member/switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="member[switch]"{-if:0==$_O['member']['switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="member[switch]"{-if:1==$_O['member']['switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMBER_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MEMBER_REGISTER-} [member/register]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="member[register]"{-if:0==$_O['member']['register']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="member[register]"{-if:1==$_O['member']['register']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMBER_REGISTER_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MEMBER_NAME_BAN-} [member/name_ban]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="member[name_ban]" style="width:360px;height:60px;">{-:$_O['member']['name_ban']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@MEMBER_NAME_BAN_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MEMBER_USERID_MIN_LENGTH-} [member/userid_min_length]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['member']['userid_min_length']-}" name="member[userid_min_length]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMBER_USERID_MIN_LENGTH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MEMBER_PASSWORD_MIN_LENGTH-} [member/password_min_length]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['member']['password_min_length']-}" name="member[password_min_length]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMBER_PASSWORD_MIN_LENGTH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MEMBER_PASS_TYPE-} [member/pass_type]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="member[pass_type]"{-if:0==$_O['member']['pass_type']-} checked="checked"{-:/if-}> {-:@AUTO-}</label>
					<label><input type="radio" value="1" name="member[pass_type]"{-if:1==$_O['member']['pass_type']-} checked="checked"{-:/if-}> {-:@MANUAL-}</label>
					<label><input type="radio" value="2" name="member[pass_type]"{-if:2==$_O['member']['pass_type']-} checked="checked"{-:/if-}> {-:@EMAIL-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMBER_PASS_TYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@VERIFY_EMAIL_VALIDITY-} [member/verify_email_validity]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['member']['verify_email_validity']-}" name="member[verify_email_validity]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@VERIFY_EMAIL_VALIDITY_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@LOGIN_CREDIT-} [member/login_credit]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input class="required i" type="text" value="{-:$_O['member']['login_credit']['m_experience']-}" name="member[login_credit][m_experience]" maxlength="4" size="4"> {-:@EXPERIENCE-}</label>
					<label><input class="required i" type="text" value="{-:$_O['member']['login_credit']['m_points']-}" name="member[login_credit][m_points]" maxlength="4" size="4"> {-:@POINTS-}</label>
				</td>
				<td class="inputArea">
					<table class="listTable">
						<tr>
							{-foreach:$_MCTL,$ct-}
							<th scope="col">{-:$ct['mct_name']-}[{-:$ct['mct_unit']-}]</th>
							{-:/foreach-}
						</tr>
						<tr>
							{-foreach:$_MCTL,$ct-}<td>
								<label><input class="required i" type="text" value="{-if:$_O['member']['login_credit'][$ct['mct_alias']]-}{-:$_O['member']['login_credit'][$ct['mct_alias']]-}{-else:-}0{-:/if-}" name="member[login_credit][{-:$ct['mct_alias']-}]" maxlength="4" size="4"></label>
							</td>{-:/foreach-}
						</tr>
					</table><!--/credit table-->
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@PUBLISH_CREDIT-} [member/publish_credit]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input class="required i" type="text" value="{-:$_O['member']['publish_credit']['m_experience']-}" name="member[publish_credit][m_experience]" maxlength="4" size="4"> {-:@EXPERIENCE-}</label>
					<label><input class="required i" type="text" value="{-:$_O['member']['publish_credit']['m_points']-}" name="member[publish_credit][m_points]" maxlength="4" size="4"> {-:@POINTS-}</label>
				</td>
				<td class="inputArea">
					<table class="listTable">
						<tr>
							{-foreach:$_MCTL,$ct-}
							<th scope="col">{-:$ct['mct_name']-}[{-:$ct['mct_unit']-}]</th>
							{-:/foreach-}
						</tr>
						<tr>
							{-foreach:$_MCTL,$ct-}<td>
								<label><input class="required i" type="text" value="{-if:$_O['member']['publish_credit'][$ct['mct_alias']]-}{-:$_O['member']['publish_credit'][$ct['mct_alias']]-}{-else:-}0{-:/if-}" name="member[publish_credit][{-:$ct['mct_alias']-}]" maxlength="4" size="4"></label>
							</td>{-:/foreach-}
						</tr>
					</table><!--/credit table-->
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@REVIEW_CREDIT-} [member/review_credit]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input class="required i" type="text" value="{-:$_O['member']['review_credit']['m_experience']-}" name="member[review_credit][m_experience]" maxlength="4" size="4"> {-:@EXPERIENCE-}</label>
					<label><input class="required i" type="text" value="{-:$_O['member']['review_credit']['m_points']-}" name="member[review_credit][m_points]" maxlength="4" size="4"> {-:@POINTS-}</label>
				</td>
				<td class="inputArea">
					<table class="listTable">
						<tr>
							{-foreach:$_MCTL,$ct-}
							<th scope="col">{-:$ct['mct_name']-}[{-:$ct['mct_unit']-}]</th>
							{-:/foreach-}
						</tr>
						<tr>
							{-foreach:$_MCTL,$ct-}<td>
								<label><input class="required i" type="text" value="{-if:$_O['member']['review_credit'][$ct['mct_alias']]-}{-:$_O['member']['review_credit'][$ct['mct_alias']]-}{-else:-}0{-:/if-}" name="member[review_credit][{-:$ct['mct_alias']-}]" maxlength="4" size="4"></label>
							</td>{-:/foreach-}
						</tr>
					</table><!--/credit table-->
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_member_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>