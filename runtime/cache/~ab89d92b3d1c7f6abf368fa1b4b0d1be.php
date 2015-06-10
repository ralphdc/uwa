<?php /* PFA Template Cache File. Create Time:2015-06-11 01:08:18 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<div class="mainTips">
	<span class="btn_b" onClick="$('#quick_setting').toggle();"><?php echo(L("QUICK_SETTING")); ?></span>
	<dl id="quick_setting" class="atab" style="display:none;margin-top:10px;">
		<dt><strong><?php echo(L("CHANNEL")); ?></strong><strong><?php echo(L("ARCHIVE")); ?></strong><strong><?php echo(L("OTHER")); ?></strong></dt>
		<dd>
			<div class="tabCntnt">
				<select id="archive_channel_id">
					<?php echo($_ACLStr); ?>
				</select>
				<span class="btn_l" onclick="build_menu_channel();"><?php echo(L("BUILD_MENU")); ?></span>
			</div>
			<div class="tabCntnt">
				<label><?php echo(L("ARCHIVE_ID")); ?> <input id="archive_id" class="required i" type="text" value="1" maxlength="11" size="10"></label>
				<span class="btn_l" onclick="build_menu_archive();"><?php echo(L("BUILD_MENU")); ?></span>
			</div>
			<div class="tabCntnt">
				<span class="btn_l" onclick="build_menu('index');"><?php echo(L("HOME_INDEX")); ?></span>
				<span class="btn_l" onclick="build_menu('member_center');"><?php echo(L("MEMBER_CENTER")); ?></span>
				<span class="btn_l" onclick="build_menu('member_login');"><?php echo(L("MEMBER_LOGIN")); ?></span>
				<span class="btn_l" onclick="build_menu('member_register');"><?php echo(L("MEMBER_REGISTER")); ?></span>
			</div>
		</dd>
	</dl>
</div>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("EDIT_MENU")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("MENU_SPACE")); ?></td>
				<td class="inputTitle"><?php echo(L("PARENT_MENU")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select onchange="get_menuList(this.value);" name="ms_alias" id="ms_alias">
						<option selected="selected" value=''><?php echo(L("MENU_SPACE")); ?></option>
					<?php if(isset($_MSL) and is_array($_MSL)) : foreach($_MSL as $ms) : ?>
						<option <?php if($ms['ms_alias']==$_MI['ms_alias']) :  ?> selected="selected"<?php endif; ?> value="<?php echo($ms['ms_alias']); ?>"><?php echo($ms['ms_name']); ?></option>
					<?php endforeach; endif; ?>
					</select> <span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("MENU_SPACE_TIP")); ?></span>
				</td>
				<td class="inputArea">
					<select name="m_parent_id" id="m_parent_id">
						<option <?php if(0==$_MI['m_parent_id']) :  ?> selected="selected"<?php endif; ?> value="0"><?php echo(L("TOP_MENU")); ?></option>
					<?php if(isset($_ML) and is_array($_ML)) : foreach($_ML as $m) : ?>
						<?php if($m['menu_id']!=$_MI['menu_id']) :  ?>
						<option <?php if($m['menu_id']==$_MI['m_parent_id']) :  ?> selected="selected"<?php endif; ?> value="<?php echo($m['menu_id']); ?>"><?php echo($m['m_name']); ?></option>
						<?php endif; ?>
					<?php endforeach; endif; ?>
					</select>
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("M_PARENT_ID_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("NAME")); ?></td>
				<td class="inputTitle"><?php echo(L("TIP")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="m_name" class="required i" type="text" value="<?php echo($_MI['m_name']); ?>" name="m_name" maxlength="96" size="30"> <span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("M_NAME_TIP")); ?></span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="<?php echo($_MI['m_tip']); ?>" name="m_tip" id="m_tip" maxlength="255" size="50"> <span class="fc_gry"><?php echo(L("M_TIP_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("URL")); ?> <span class="fc_r">*</span> <span class="fc_gry fw_n"><?php echo(L("COMPOSE_URL_TIP")); ?></span></td>
				<td class="inputTitle"></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<input class="required i" type="text" value="<?php echo($_MI['m_url']); ?>" name="m_url" id="m_url" maxlength="255" size="60"> <span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("M_URL_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("TYPE")); ?></td>
				<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input id="compose_btn" type="radio" onclick="$('#compose_url').show();" <?php if(0==$_MI['m_type']) :  ?> checked="checked"<?php endif; ?> value="0" name="m_type"> <?php echo(L("COMPOSE")); ?></label>
					<label><input type="radio" onclick="$('#compose_url').hide();" <?php if(1==$_MI['m_type']) :  ?> checked="checked"<?php endif; ?> value="1" name="m_type"> <?php echo(L("DIRECT")); ?></label> <span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("M_TYPE_TIP")); ?></span>
				</td>
				<td class="inputTip">
					<input class="required i" type="text" value="<?php echo($_MI['m_display_order']); ?>" name="m_display_order" maxlength="20" size="10"> <span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("M_DISPLAY_ORDER_TIP")); ?></span>
				</td>
			</tr>
			<tr id="compose_url"<?php if(1==$_MI['m_type']) :  ?> style="display:none"<?php endif; ?>>
				<td colspan="2" class="inputArea">
					<table class="listTable" style="width:98%">
						<tr>
							<th colspan="7"><?php echo(L("COMPOSE_URL")); ?></th>
						</tr>
						<tr>
							<td>home@</td>
							<td>
							<select onchange="get_actnList(this.value);" id="ctrlr">
								<option selected="selected" value=""><?php echo(L("CONTROLLER")); ?></option>
							<?php if(isset($_CL) and is_array($_CL)) : foreach($_CL as $c) : ?>
								<option value="<?php echo($c['ctrlr']); ?>"><?php echo($c['name']); ?></option>
							<?php endforeach; endif; ?>
							</select>
							</td>
							<td>/</td>
							<td>
							<select id="actn">
							</select>
							</td>
							<td>?</td>
							<td><input class="i" type="text" value="" id="params" maxlength="96" size="40"></td>
							<td><a class="btn_l" onclick='compose_url();'><?php echo(L("COMPOSE")); ?></a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("TARGET")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="m_target" class="required i" type="text" name="m_target" size="20" value="<?php echo($_MI['m_target']); ?>">
					<select id="m_target_select" onchange="$('#m_target').val($('#m_target_select').val());">
						<option value=""><?php echo(L("SELECT")); ?></option>
						<option <?php if('_self'==$_MI['m_target']) :  ?> selected="selected"<?php endif; ?> value="_self"><?php echo(L("SELF_WINDOW")); ?></option>
						<option <?php if('_blank'==$_MI['m_target']) :  ?> selected="selected"<?php endif; ?> value="_blank"><?php echo(L("NEW_WINDOW")); ?></option>
						<option <?php if('_parent'==$_MI['m_target']) :  ?> selected="selected"<?php endif; ?> value="_parent"><?php echo(L("PARENT_FRAME")); ?></option>
						<option <?php if('_top'==$_MI['m_target']) :  ?> selected="selected"<?php endif; ?> value="_top"><?php echo(L("TOP_FRAME")); ?></option>
						<option value=""><?php echo(L("CUSTOM")); ?></option>
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("M_TARGET_TIP")); ?></span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<input type="hidden" value="<?php echo($_MI['menu_id']); ?>" name="menu_id">
	<span class="btn_b submit" action="<?php echo(Url::U("menu/edit_menu_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("menu/list_menu")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
	$('#formEdit').submit(function() {
		if('' == $("select[name='ms_alias']").val()) {
			alert("<?php echo(L("CHOOSE_MENU_SPACE")); ?>");
			return false;
		}
	});
});
/* get menu list by space alias */
function get_menuList(ms_alias) {
	$('#m_parent_id').html('');
	if('' != ms_alias) {
		$.getJSON('<?php echo(Url::U("menu/get_menuList")); ?>'+'&'+Math.random(),{ms_alias:ms_alias},function(data) {
			$('#m_parent_id').append('<option value=""><?php echo(L("TOP_MENU")); ?></option>');
			for(key in data.data) {
				var optionStr = '<option value="' + data.data[key]['menu_id']+'">' + data.data[key]['m_name'] + '</option>';
				$('#m_parent_id').append(optionStr);
			}
		});
	}
}

/* get action list */
function get_actnList(ctrlr) {
	$('#actn').html('');
	$.getJSON('<?php echo(Url::U("menu/get_actnList")); ?>'+'&'+Math.random(),{ctrlr:ctrlr},function(data) {
		for(key in data.data) {
			var optionStr = '<option value="' + data.data[key]+'">' + data.data[key] + '</option>';
			$('#actn').append(optionStr);
		}
	});
}

/* compose url */
function compose_url() {
	var ctrlrVal = parse_name($('#ctrlr').val());
	var actnVal = $('#actn').val();
	var paramsVal = $('#params').val();
	if(ctrlrVal && actnVal) {
		if(paramsVal) {
			var val = 'home@'+ctrlrVal+'/'+actnVal+'?'+paramsVal;
		}
		else {
			var val = 'home@'+ctrlrVal+'/'+actnVal;
		}
		$('#m_url').val(val);
	}
	else {
		alert('<?php echo(L("CTRLR_OR_ACTN_EMPTY")); ?>');
	}
}

/* parse name:AaaBbb -> aaa_bb */
function parse_name(name) {
	name = name.replace(/([A-Z])/g, "_$1").toLowerCase().replace(/(^_)/g, "");
	return name;
}

/* build channel menu */
function build_menu_channel() {
	$('#compose_btn').trigger('click');
	$('#m_url').val('home@archive/show_channel?archive_channel_id=' + $('#archive_channel_id').val());
	$('#m_name').val($('#archive_channel_id').find('option:selected').text()).focus();
}
/* build archive menu */
function build_menu_archive() {
	$('#compose_btn').trigger('click');
	$('#m_url').val('home@archive/show_archive?archive_id=' + $('#archive_id').val());
	$('#m_name').focus();
}
/* build other menu */
function build_menu(url) {
	$('#compose_btn').trigger('click');
	switch(url) {
		case 'index':
			$('#m_url').val('home@index/index');
			$('#m_name').val('<?php echo(L("HOME_INDEX")); ?>').focus();
			break;
		case 'member_center':
			$('#m_url').val('member@member/index');
			$('#m_name').val('<?php echo(L("MEMBER_CENTER")); ?>').focus();
			break;
		case 'member_login':
			$('#m_url').val('member@member/login');
			$('#m_name').val('<?php echo(L("MEMBER_LOGIN")); ?>').focus();
			break;
		case 'member_register':
			$('#m_url').val('member@member/register');
			$('#m_name').val('<?php echo(L("MEMBER_REGISTER")); ?>').focus();
			break;
		default :
			$('#m_url').val(url);
			$('#m_name').focus();
			break;
	}
}
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>