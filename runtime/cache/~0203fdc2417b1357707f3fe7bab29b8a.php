<?php /* PFA Template Cache File. Create Time:2015-06-06 10:25:42 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>

<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("EDIT_ADMIN_PERMISSION")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("GROUP")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_API['ap_group']); ?>" name="ap_group" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AP_GROUP_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("NAME")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_API['ap_name']); ?>" name="ap_name" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AP_NAME_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("CONTENT")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<table id="permission_list" class="listTable" style="width:80%">
						<tr>
							<th><?php echo(L("PERMISSION")); ?></th>
							<th><?php echo(L("MANAGE")); ?></th>
						</tr>
					<?php if(isset($_API['ap_content']) and is_array($_API['ap_content'])) : foreach($_API['ap_content'] as $c) : ?>
						<tr>
							<td><input type="text" class="i" size="50" value="<?php echo($c); ?>" name="permission[]" /></td>
							<td><a class="btn_l" onclick="$(this).parent().parent().remove();"><?php echo(L("DELETE")); ?></a></td>
						</tr>
					<?php endforeach; endif; ?>
					</table>
					<table class="listTable" style="width:80%">
						<tr>
							<td>
							<?php echo(L("ADD_PERMISSION")); ?>
							<select onchange="get_actnList(this.value);" id="ctrlr">
								<option selected="selected" value=""><?php echo(L("CONTROLLER")); ?></option>
							<?php if(isset($_CL) and is_array($_CL)) : foreach($_CL as $c) : ?>
								<option value="<?php echo($c['ctrlr']); ?>"><?php echo($c['name']); ?></option>
							<?php endforeach; endif; ?>
							</select>
							:
							<select id="actn">
							</select>
							<a class="btn_l" onclick='create_permission();'><?php echo(L("ADD")); ?></a>
							</td>
						</tr>
					</table>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AP_CONTENT_TIP")); ?></span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<input type="hidden" value="<?php echo($_API['admin_permission_id']); ?>" name="admin_permission_id">
	<span class="btn_b submit" action="<?php echo(Url::U("admin_permission/edit_permission_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("admin_permission/list_permission")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script type='text/javascript'>

/* get action list */
function get_actnList(ctrlr) {
	$('#actn').html('');
	$.getJSON('<?php echo(Url::U("admin_permission/get_actnList")); ?>'+'&'+Math.random(),{ctrlr:ctrlr},function(data) {
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
		var permissionStr = '<tr><td><input type="text" class="i" size="50" value="'+val+'" name="permission[]" /></td><td><a class="btn_l" onclick="$(this).parent().parent().remove();"><?php echo(L("DELETE")); ?></a></td></tr>';
		$('#permission_list').append(permissionStr);
	}
	else {
		alert('<?php echo(L("CTRLR_OR_ACTN_EMPTY")); ?>');
	}
}
</script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>