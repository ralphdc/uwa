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
	<dt><strong>{-:@EDIT_ADMIN-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@ADMIN_ROLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="admin_role_id">
					{-foreach:$_ARL,$ar-}
						<option value="{-:$ar['admin_role_id']-}"{-if:$ar['admin_role_id']==$_AI['admin_role_id']-} selected="selected"{-:/if-}>{-:$ar['ar_name']-}</option>
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
					{-:$_AI['m_userid']-}
					<span class="fc_r">*</span> <span class="fc_gry">{-:@M_USERID_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="password" value="" name="m_password" maxlength="96" size="30">
					<span class="fc_gry">{-:@M_PASSWORD_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@USERNAME-}</td>
				<td class="inputTitle">{-:@EMAIL-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_AI['m_username']-}" name="m_username" maxlength="96" size="30">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@M_USENAME_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_AI['m_email']-}" name="m_email" maxlength="96" size="30">
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
						<option value="_all"{-if:in_array('_all', $_AI['a_ac_id'])-} selected="selected"{-:/if-}>{-:@ALL_CHANNEL-}</option>
						{-:$_ACLStr-}
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@A_AC_ID_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_AI['admin_id']-}" name="admin_id">
	<input type="hidden" value="{-:$_AI['member_id']-}" name="member_id">
	<input type="hidden" value="{-:$_AI['m_userid']-}" name="m_userid">
	<span class="btn_b submit" action="{-url:admin/edit_admin_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:admin/list_admin-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>