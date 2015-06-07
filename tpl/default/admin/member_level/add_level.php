<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_LEVEL-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="ml_name" maxlength="64" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@ML_NAME_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@RANK-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="50" name="ml_rank" maxlength="10" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@ML_RANK_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MIN_EXPERIENCE-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="50" name="ml_min_experience" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@ML_MIN_EXPERIENCE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@LEVEL_TYPE-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="ml_type" value="0"> {-:@SYSTEM-}</label>
					<label><input type="radio" name="ml_type" checked="checked" value="1"> {-:@CUSTOM-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@ML_TYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@PERMISSION-} <span class="fc_gry"><span class="fc_r">*</span> <span class="fc_gry">{-:@ML_PERMISSION_TIP-}</span></span></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<table id="permission_list" class="listTable" style="width:90%">
						<tr>
							<th colspan="2">{-:@SUPER_PERMISSION-} <label style="padding-left:10px;font-weight:normal"><input type="checkbox" name="ml_permission" value="_all"> {-:@SUPER_PERMISSION_TIP-}</label></th>
						</tr>
					{-foreach:$_MPL,$mpGroup,$mp-}
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:$mpGroup-}</strong> <label style="padding-left:10px;font-weight:normal"><input type="checkbox" class="select_all" to="member_permission_id[{-:$mpGroup-}]"> {-:@SELECT_ALL-}</label></td>
							<td>
						{-foreach:$mp,$p-}
							<label><input type="checkbox" name="member_permission_id[{-:$mpGroup-}][]" value="{-:$p['member_permission_id']-}" /> {-:$p['mp_name']-}</label>
						{-:/foreach-}
							</td>
						</tr>
					{-:/foreach-}
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<table class="listTable" style="width:90%">
						<tr>
							<th colspan="2">{-:@UPLOAD_OPTION-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@ML_UPLOAD_OPTION_TIP-}</span></th>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_SWITCH-}<strong></td>
							<td>
								<label><input type="radio" value="0" name="ml_upload_option[switch]"{-if:0==$_o_u['switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
								<label><input type="radio" value="1" name="ml_upload_option[switch]"{-if:1==$_o_u['switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_IMGTYPE-}<strong> <label style="padding-left:10px;font-weight:normal"><input type="checkbox" class="select_all" to="ml_upload_option[imgtype]"> {-:@SELECT_ALL-}</label></td>
							<td>
						{-foreach:$_o_u['imgtype'],$oui-}
							<label><input type="checkbox" name="ml_upload_option[imgtype][]" value="{-:$oui-}" checked="checked" /> {-:$oui-}</label>
						{-:/foreach-}
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_FILETYPE-}<strong> <label style="padding-left:10px;font-weight:normal"><input type="checkbox" class="select_all" to="ml_upload_option[filetype]"> {-:@SELECT_ALL-}</label></td>
							<td>
						{-foreach:$_o_u['filetype'],$ouf-}
							<label><input type="checkbox" name="ml_upload_option[filetype][]" value="{-:$ouf-}" checked="checked" /> {-:$ouf-}</label>
						{-:/foreach-}
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_SPACE-}<strong></td>
							<td>
								<label><input class="required i" type="text" value="{-:$_o_u['space']-}" name="ml_upload_option[space]" maxlength="20" size="10" />
								<span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@ML_UPLOAD_SPACE_TIP-}</span></label>
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_MAXSIZE-}<strong></td>
							<td>
								<label><input class="required i" type="text" value="{-:$_o_u['maxsize']-}" name="ml_upload_option[maxsize]" maxlength="20" size="10" />
								<span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@ML_UPLOAD_MAXSIZE_TIP-}</span></label>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:member_level/add_level_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:member_level/list_level-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>