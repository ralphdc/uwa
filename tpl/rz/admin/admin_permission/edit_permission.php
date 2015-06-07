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
	<dt><strong>{-:@EDIT_ADMIN_PERMISSION-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@GROUP-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_API['ap_group']-}" name="ap_group" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AP_GROUP_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_API['ap_name']-}" name="ap_name" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AP_NAME_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CONTENT-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<table id="permission_list" class="listTable" style="width:80%">
						<tr>
							<th>{-:@PERMISSION-}</th>
							<th>{-:@MANAGE-}</th>
						</tr>
					{-foreach:$_API['ap_content'],$c-}
						<tr>
							<td><input type="text" class="i" size="50" value="{-:$c-}" name="permission[]" /></td>
							<td><a class="btn_l" onclick="$(this).parent().parent().remove();">{-:@DELETE-}</a></td>
						</tr>
					{-:/foreach-}
					</table>
					<table class="listTable" style="width:80%">
						<tr>
							<td>
							{-:@ADD_PERMISSION-}
							<select onchange="get_actnList(this.value);" id="ctrlr">
								<option selected="selected" value="">{-:@CONTROLLER-}</option>
							{-foreach:$_CL,$c-}
								<option value="{-:$c['ctrlr']-}">{-:$c['name']-}</option>
							{-:/foreach-}
							</select>
							:
							<select id="actn">
							</select>
							<a class="btn_l" onclick='create_permission();'>{-:@ADD-}</a>
							</td>
						</tr>
					</table>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AP_CONTENT_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_API['admin_permission_id']-}" name="admin_permission_id">
	<span class="btn_b submit" action="{-url:admin_permission/edit_permission_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:admin_permission/list_permission-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script type='text/javascript'>

/* get action list */
function get_actnList(ctrlr) {
	$('#actn').html('');
	$.getJSON('{-url:admin_permission/get_actnList-}'+'&'+Math.random(),{ctrlr:ctrlr},function(data) {
		for(key in data.data) 		{
			var optionStr = '<option value="' + data.data[key]+'">' + data.data[key] + '</option>';
			$('#actn').append(optionStr);
		}
	});
}

/* create permission code */
function create_permission() {
	var ctrlrVal = $('#ctrlr').val();
	var actnVal = $('#actn').val();
	if(ctrlrVal && actnVal) {
		var val = ctrlrVal+':'+actnVal;
		var permissionStr = '<tr><td><input type="text" class="i" size="50" value="'+val+'" name="permission[]" /></td><td><a class="btn_l" onclick="$(this).parent().parent().remove();">{-:@DELETE-}</a></td></tr>';
		$('#permission_list').append(permissionStr);
	}
	else {
		alert('{-:@CTRLR_OR_ACTN_EMPTY-}');
	}
}
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>