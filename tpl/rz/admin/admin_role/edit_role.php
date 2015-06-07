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
	<dt><strong>{-:@EDIT_ADMIN_ROLE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_ARI['ar_name']-}" name="ar_name" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AR_NAME_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@RANK-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_ARI['ar_rank']-}" name="ar_rank" maxlength="10" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AR_RANK_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@PERMISSION-} <span class="fc_gry"><span class="fc_r">*</span> <span class="fc_gry">{-:@AR_PERMISSION_TIP-}</span></span></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<table id="permission_list" class="listTable" style="width:90%">
						<tr>
							<th colspan="2">{-:@SUPER_PERMISSION-} <label style="padding-left:10px;font-weight:normal"><input type="checkbox" name="ar_permission" value="_all"{-if:'_all' == $_ARI['ar_permission']-} checked="checked"{-:/if-}> {-:@SUPER_PERMISSION_TIP-}</label></th>
						</tr>
					{-foreach:$_APL,$apGroup,$ap-}
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:$apGroup-}</strong> <label style="padding-left:10px;font-weight:normal"><input type="checkbox" class="select_all" to="admin_permission_id[{-:$apGroup-}]"> {-:@SELECT_ALL-}</label></td>
							<td>
						{-foreach:$ap,$p-}
							<label><input type="checkbox" name="admin_permission_id[{-:$apGroup-}][]" value="{-:$p['admin_permission_id']-}" {-if:in_array($p['admin_permission_id'], $_ARI['admin_permission_id'])-} checked="checked"{-:/if-} /> {-:$p['ap_name']-}</label>
						{-:/foreach-}
							</td>
						</tr>
					{-:/foreach-}
					</table>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_ARI['admin_role_id']-}" name="admin_role_id">
	<span class="btn_b submit" action="{-url:admin_role/edit_role_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:admin_role/list_role-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>