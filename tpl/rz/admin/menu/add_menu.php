<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<div class="mainTips">
	<span class="btn_b" onClick="$('#quick_setting').toggle();">{-:@QUICK_SETTING-}</span>
	<dl id="quick_setting" class="atab" style="display:none;margin-top:10px;">
		<dt><strong>{-:@CHANNEL-}</strong><strong>{-:@ARCHIVE-}</strong><strong>{-:@OTHER-}</strong></dt>
		<dd>
			<div class="tabCntnt">
				<select id="archive_channel_id">
					{-:$_ACLStr-}
				</select>
				<span class="btn_l" onclick="build_menu_channel();">{-:@BUILD_MENU-}</span>
			</div>
			<div class="tabCntnt">
				<label>{-:@ARCHIVE_ID-} <input id="archive_id" class="required i" type="text" value="1" maxlength="11" size="10"></label>
				<span class="btn_l" onclick="build_menu_archive();">{-:@BUILD_MENU-}</span>
			</div>
			<div class="tabCntnt">
				<span class="btn_l" onclick="build_menu('index');">{-:@HOME_INDEX-}</span>
				<span class="btn_l" onclick="build_menu('member_center');">{-:@MEMBER_CENTER-}</span>
				<span class="btn_l" onclick="build_menu('member_login');">{-:@MEMBER_LOGIN-}</span>
				<span class="btn_l" onclick="build_menu('member_register');">{-:@MEMBER_REGISTER-}</span>
			</div>
		</dd>
	</dl>
</div>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_MENU-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@MENU_SPACE-}</td>
				<td class="inputTitle">{-:@PARENT_MENU-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<select onchange="get_menuList(this.value);" name="ms_alias" id="ms_alias">
						<option selected="selected" value=''>{-:@MENU_SPACE-}</option>
					{-foreach:$_MSL,$ms-}
						<option value="{-:$ms['ms_alias']-}">{-:$ms['ms_name']-}</option>
					{-:/foreach-}
					</select> <span class="fc_r">*</span> <span class="fc_gry">{-:@MENU_SPACE_TIP-}</span>
				</td>
				<td class="inputArea">
					<select name="m_parent_id" id="m_parent_id">
					</select>
					<span class="fc_r">*</span> <span class="fc_gry">{-:@M_PARENT_ID_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class="inputTitle">{-:@TIP-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="m_name" class="required i" type="text" value="" name="m_name" maxlength="96" size="30"> <span class="fc_r">*</span> <span class="fc_gry">{-:@M_NAME_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="" name="m_tip" id="m_tip" maxlength="255" size="50"> <span class="fc_gry">{-:@M_TIP_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@URL-} <span class="fc_r">*</span> <span class="fc_gry fw_n">{-:@COMPOSE_URL_TIP-}</span></td>
				<td class="inputTitle"></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<input class="required i" type="text" value="" name="m_url" id="m_url" maxlength="255" size="90"> <span class="fc_r">*</span> <span class="fc_gry">{-:@M_URL_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TYPE-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input id="compose_btn" type="radio" onclick="$('#compose_url').show();" value="0" name="m_type"> {-:@COMPOSE-}</label>
					<label><input type="radio" onclick="$('#compose_url').hide();" checked="checked" value="1" name="m_type"> {-:@DIRECT-}</label> <span class="fc_r">*</span> <span class="fc_gry">{-:@M_TYPE_TIP-}</span>
				</td>
				<td class="inputTip">
					<input class="required i" type="text" value="50" name="m_display_order" maxlength="20" size="10"> <span class="fc_r">*</span> <span class="fc_gry">{-:@M_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			<tr id="compose_url" style="display:none">
				<td colspan="2" class="inputArea">
					<table class="listTable" style="width:98%">
						<tr>
							<th colspan="7">{-:@COMPOSE_URL-}</th>
						</tr>
						<tr>
							<td>home@</td>
							<td>
							<select onchange="get_actnList(this.value);" id="ctrlr">
								<option selected="selected" value="">{-:@CONTROLLER-}</option>
							{-foreach:$_CL,$c-}
								<option value="{-:$c['ctrlr']-}">{-:$c['name']-}</option>
							{-:/foreach-}
							</select>
							</td>
							<td>/</td>
							<td>
							<select id="actn">
							</select>
							</td>
							<td>?</td>
							<td><input class="i" type="text" value="" id="params" maxlength="96" size="40"></td>
							<td><a class="btn_l" onclick='compose_url();'>{-:@COMPOSE-}</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TARGET-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="m_target" class="required i" type="text" name="m_target" size="20" value="_self">
					<select id="m_target_select" onchange="$('#m_target').val($('#m_target_select').val());">
						<option value="">{-:@SELECT-}</option>
						<option value="_self">{-:@SELF_WINDOW-}</option>
						<option value="_blank">{-:@NEW_WINDOW-}</option>
						<option value="_parent">{-:@PARENT_FRAME-}</option>
						<option value="_top">{-:@TOP_FRAME-}</option>
						<option value="">{-:@CUSTOM-}</option>
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@M_TARGET_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:menu/add_menu_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:menu/list_menu-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
	$('#formAdd').submit(function() {
		if('' == $("select[name='ms_alias']").val()) {
			alert("{-:@CHOOSE_MENU_SPACE-}");
			return false;
		}
	});
});

/* get menu list by space alias */
function get_menuList(ms_alias) {
	$('#m_parent_id').html('');
	if('' != ms_alias) {
		$.getJSON('{-url:menu/get_menuList-}'+'&'+Math.random(),{ms_alias:ms_alias},function(data) {
			$('#m_parent_id').append('<option value="">{-:@TOP_MENU-}</option>');
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
	$.getJSON('{-url:menu/get_actnList-}'+'&'+Math.random(),{ctrlr:ctrlr},function(data) {
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
		alert('{-:@CTRLR_OR_ACTN_EMPTY-}');
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
			$('#m_name').val('{-:@HOME_INDEX-}').focus();
			break;
		case 'member_center':
			$('#m_url').val('member@member/index');
			$('#m_name').val('{-:@MEMBER_CENTER-}').focus();
			break;
		case 'member_login':
			$('#m_url').val('member@member/login');
			$('#m_name').val('{-:@MEMBER_LOGIN-}').focus();
			break;
		case 'member_register':
			$('#m_url').val('member@member/register');
			$('#m_name').val('{-:@MEMBER_REGISTER-}').focus();
			break;
		default :
			$('#m_url').val(url);
			$('#m_name').focus();
			break;
	}
}
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>