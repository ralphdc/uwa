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
	<dt><strong>{-:@EDIT_LEVEL-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_MLI['ml_name']-}" name="ml_name" maxlength="64" size="30">
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
					<input class="required i" type="text" value="{-:$_MLI['ml_rank']-}" name="ml_rank" maxlength="10" size="6">
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
					<input class="required i" type="text" value="{-:$_MLI['ml_min_experience']-}" name="ml_min_experience" maxlength="20" size="10">
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
					<label><input type="radio" name="ml_type"{-if:0 == $_MLI['ml_type']-} checked="checked"{-:/if-} value="0"> {-:@SYSTEM-}</label>
					<label><input type="radio" name="ml_type"{-if:1 == $_MLI['ml_type']-} checked="checked"{-:/if-} value="1"> {-:@CUSTOM-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@ML_TYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@PERMISSION-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@ML_PERMISSION_TIP-}</span></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<table id="permission_list" class="listTable" style="width:90%">
						<tr>
							<th colspan="2">{-:@SUPER_PERMISSION-} <label style="padding-left:10px;font-weight:normal"><input type="checkbox" name="ml_permission" value="_all"{-if:'_all' == $_MLI['ml_permission']-} checked="checked"{-:/if-}> {-:@SUPER_PERMISSION_TIP-}</label></th>
						</tr>
					{-foreach:$_MPL,$mpGroup,$mp-}
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:$mpGroup-}<strong> <label style="padding-left:10px;font-weight:normal"><input type="checkbox" class="select_all" to="member_permission_id[{-:$mpGroup-}]"> {-:@SELECT_ALL-}</label></td>
							<td>
						{-foreach:$mp,$p-}
							<label><input type="checkbox" name="member_permission_id[{-:$mpGroup-}][]" value="{-:$p['member_permission_id']-}" {-if:in_array($p['member_permission_id'], $_MLI['member_permission_id'])-} checked="checked"{-:/if-} /> {-:$p['mp_name']-}</label>
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
								<label><input type="radio" value="0" name="ml_upload_option[switch]"{-if:0==$_MLI['ml_upload_option']['switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
								<label><input type="radio" value="1" name="ml_upload_option[switch]"{-if:1==$_MLI['ml_upload_option']['switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_IMGTYPE-}<strong> <label style="padding-left:10px;font-weight:normal"><input type="checkbox" class="select_all" to="ml_upload_option[imgtype]"> {-:@SELECT_ALL-}</label></td>
							<td>
						{-foreach:$_o_u['imgtype'],$oui-}
							<label><input type="checkbox" name="ml_upload_option[imgtype][]" value="{-:$oui-}" {-if:in_array($oui, $_MLI['ml_upload_option']['imgtype'])-} checked="checked"{-:/if-} /> {-:$oui-}</label>
						{-:/foreach-}
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_FILETYPE-}<strong> <label style="padding-left:10px;font-weight:normal"><input type="checkbox" class="select_all" to="ml_upload_option[filetype]"> {-:@SELECT_ALL-}</label></td>
							<td>
						{-foreach:$_o_u['filetype'],$ouf-}
							<label><input type="checkbox" name="ml_upload_option[filetype][]" value="{-:$ouf-}" {-if:in_array($ouf, $_MLI['ml_upload_option']['filetype'])-} checked="checked"{-:/if-} /> {-:$ouf-}</label>
						{-:/foreach-}
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_SPACE-}<strong></td>
							<td>
								<label><input class="required i" type="text" value="{-:$_MLI['ml_upload_option']['space']-}" name="ml_upload_option[space]" maxlength="20" size="10" />
								<span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@ML_UPLOAD_SPACE_TIP-}</span></label>
							</td>
						</tr>
						<tr>
							<td width="200" valign="top" align="right"><strong>{-:@UPLOAD_MAXSIZE-}<strong></td>
							<td>
								<label><input class="required i" type="text" value="{-:$_MLI['ml_upload_option']['maxsize']-}" name="ml_upload_option[maxsize]" maxlength="20" size="10" />
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
	<input type="hidden" value="{-:$_MLI['member_level_id']-}" name="member_level_id">
	<span class="btn_b submit" action="{-url:member_level/edit_level_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:member_level/list_level-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>