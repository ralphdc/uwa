<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@MENU_SPACE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="menu_space_id"></th>
				<th scope="col">{-:@ALIAS-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@DESCRIPTION-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_MSL,$ms-}
			<tr>
				<td><input name="menu_space_id[{-:$ms['menu_space_id']-}]" type="checkbox" value="{-:$ms['menu_space_id']-}"></td>
				<td><input type="text" class="required i" size="10" maxlength="96" name="ms_alias[{-:$ms['menu_space_id']-}]" value="{-:$ms['ms_alias']-}"></td>
				<td><input type="text" class="required i" size="16" maxlength="96" name="ms_name[{-:$ms['menu_space_id']-}]" value="{-:$ms['ms_name']-}"></td>
				<td>{-:$ms['ms_description']-}</td>
				<td>
					<a href="{-url:menu/list_menu?ms_alias={$ms['ms_alias']}-}">{-:@MENU_LIST-}</a> | <a href="{-url:menu_space/edit_space?menu_space_id={$ms['menu_space_id']}-}">{-:@EDIT-}</a> | <a href="{-url:menu_space/delete_space_do?menu_space_id={$ms['menu_space_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a>
					<span class="btn_l" onclick="javascript:get_menu_code('{-:$ms['ms_alias']-}');" >{-:@GET_CODE-}</span>
				</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:menu_space/add_space-}">{-:@ADD_MENU_SPACE-}</a>
	<span class="btn_l submit" action="{-url:menu_space/update_space_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:menu_space/delete_space_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:menu/list_menu-}">{-:@MENU_LIST-}</a>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
function get_menu_code(ms_alias) {
	var content = "<span>HTML{-:@CODE-}</span>";
		content += "<code style=\"font-family:'Courier New'; display:block\" class=\"fs_14 bg_gry_d fc_wht p_10 br_5\">";
		content += "&lt;uwa:menu alias=&quot;"+ ms_alias +"&quot;&gt;<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href=&quot;{-php:echo '{';-}-:$m['url']-}&quot; title=&quot;{-php:echo '{';-}-:$m['m_tip']-}&quot; target=&quot;{-php:echo '{';-}-:$m['m_target']-}&quot;&gt;{-php:echo '{';-}-:$m['m_name']-}&lt;/a&gt;<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;{-php:echo '{';-}-if:!empty($m['m_sub_menu'])-}&lt;span&gt;<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;{-php:echo '{';-}-foreach:$m['m_sub_menu'],$ms-}<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href=&quot;{-php:echo '{';-}-:$ms['url']-}&quot; title=&quot;{-php:echo '{';-}-:$ms['m_tip']-}&quot; target=&quot;{-php:echo '{';-}-:$ms['m_target']-}&quot;&gt;{-php:echo '{';-}-:$ms['m_name']-}&lt;/a&gt;<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;{-php:echo '{';-}-:/foreach-}<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;&lt;/span&gt;{-php:echo '{';-}-:/if-}<br />";
		content += "&lt;/uwa:menu&gt;";
		content += "</code>";
	dialog({
		content:content,
		id:'ab_d',
		title:'{-:@GET_CODE-}'
	}).showModal();
}
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>