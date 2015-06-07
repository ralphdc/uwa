<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>

<body>
<form id="formAssign" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ASSIGN_ADMIN-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@USERID-}</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					{-:$_MI['m_userid']-}
					<span class="fc_r">*</span> <span class="fc_gry">{-:@M_USERID_TIP-}</span>
				</td>
			</tr>
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
				<td class="inputTitle">{-:@AUTHORIZE_CHANNEL-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="a_ac_id[]" multiple="true" size="10" style="width:300px;">
						<option value="_all" selected="selected">{-:@ALL_CHANNEL-}</option>
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
	<input type="hidden" value="{-:$_MI['member_id']-}" name="member_id">
	<span class="btn_b submit" action="{-url:admin/assign_admin_do-}" to="#formAssign">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:member/list_member-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>