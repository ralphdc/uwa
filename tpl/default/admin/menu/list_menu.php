<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="ms_alias">
		<option value="0">{-:@MENU_SPACE-}</option>
	{-foreach:$_MSL,$ms-}
		<option value="{-:$ms['ms_alias']-}"{-if:$ms['ms_alias']==ARequest::get('ms_alias')-} selected="selected"{-:/if-}>{-:$ms['ms_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><span class="btn_l submit" action="{-url:menu/list_menu-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@MENU_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="menu_id"></th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@MENU_SPACE-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@TIP-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@TARGET-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_ML,$m-}
			<tr s_id="{-:$m['menu_id']-}" p_id="{-:$m['m_parent_id']-}">
				<td><input name="menu_id[{-:$m['menu_id']-}]" type="checkbox" value="{-:$m['menu_id']-}"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="m_display_order[{-:$m['menu_id']-}]" value="{-:$m['m_display_order']-}"></td>
				<td>
					<a href="{-url:menu/list_menu?ms_alias={$m['ms_alias']}-}">{-:$m['ms_name']-} [{-:$m['ms_alias']-}]</a>
				</td>
				<td>{-if:isset($m['m_sub_menu'])-}<span class="toggle_tr fc_gry" toggle_tr_id="{-:$m['menu_id']-}">┣</span>{-else:-}<span class="fc_gry">　 </span>{-:/if-}<input type="text" class="i required" size="16" maxlength="96" name="m_name[{-:$m['menu_id']-}]" value="{-:$m['m_name']-}"></td>
				<td><input type="text" class="i required" size="25" maxlength="96" name="m_tip[{-:$m['menu_id']-}]" value="{-:$m['m_tip']-}"></td>
				<td>{-if:0 == $m['m_type']-}{-:@COMPOSE-}{-elseif:1 == $m['m_type']-}{-:@DIRECT-}{-:/if-}</td>
				<td>{-if:'_self' == $m['m_target']-}{-:@SELF_WINDOW-}{-elseif:'_blank' == $m['m_target']-}{-:@NEW_WINDOW-}{-elseif:'_parent' == $m['m_target']-}{-:@PARENT_FRAME-}{-elseif:'_top' == $m['m_target']-}{-:@TOP_FRAME-}{-else:-}{-:@CUSTOM-}{-:/if-} [ {-:$m['m_target']-} ]</td>
				<td><a href="{-:$m['m_url']|get_url~@me,$m['m_type']-}" target="_blank">{-:@VIEW-}</a> | <a href="{-url:menu/edit_menu?menu_id={$m['menu_id']}-}">{-:@EDIT-}</a> | <a href="{-url:menu/delete_menu_do?menu_id={$m['menu_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
				{-foreach:$m['m_sub_menu'],$sm-}
			<tr s_id="{-:$sm['menu_id']-}" p_id="{-:$sm['m_parent_id']-}">
				<td><input name="menu_id[{-:$sm['menu_id']-}]" type="checkbox" value="{-:$sm['menu_id']-}"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="m_display_order[{-:$sm['menu_id']-}]" value="{-:$sm['m_display_order']-}"></td>
				<td>
					<a href="{-url:menu/list_menu?ms_alias={$sm['ms_alias']}-}">{-:$sm['ms_name']-} [{-:$sm['ms_alias']-}]</a>
					<input name="ms_alias[{-:$sm['menu_id']-}]" type="hidden" value="{-:$sm['ms_alias']-}">
				</td>
				<td><span class="fc_gry">　┗ </span><input type="text" class="i required" size="16" maxlength="96" name="m_name[{-:$sm['menu_id']-}]" value="{-:$sm['m_name']-}"></td>
				<td><input type="text" class="i required" size="25" maxlength="96" name="m_tip[{-:$sm['menu_id']-}]" value="{-:$sm['m_tip']-}"></td>
				<td>{-if:0 == $sm['m_type']-}{-:@COMPOSE-}{-elseif:1 == $sm['m_type']-}{-:@DIRECT-}{-:/if-}</td>
				<td>{-if:'_self' == $sm['m_target']-}{-:@SELF_WINDOW-}{-elseif:'_blank' == $sm['m_target']-}{-:@NEW_WINDOW-}{-elseif:'_parent' == $sm['m_target']-}{-:@PARENT_FRAME-}{-elseif:'_top' == $sm['m_target']-}{-:@TOP_FRAME-}{-else:-}{-:@CUSTOM-}{-:/if-} [ {-:$sm['m_target']-} ]</td>
				<td><a href="{-:$sm['m_url']|get_url~@me,$sm['m_type']-}" target="_blank">{-:@VIEW-}</a> | <a href="{-url:menu/edit_menu?menu_id={$sm['menu_id']}-}">{-:@EDIT-}</a> | <a href="{-url:menu/delete_menu_do?menu_id={$sm['menu_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
				{-:/foreach-}
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:menu/add_menu-}">{-:@ADD_MENU-}</a>
	<span class="btn_l submit" action="{-url:menu/update_menu_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:menu/delete_menu_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:menu_space/list_space-}">{-:@MENU_SPACE_LIST-}</a>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>