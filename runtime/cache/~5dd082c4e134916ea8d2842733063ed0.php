<?php /* PFA Template Cache File. Create Time:2015-06-11 01:08:10 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="ms_alias">
		<option value="0"><?php echo(L("MENU_SPACE")); ?></option>
	<?php if(isset($_MSL) and is_array($_MSL)) : foreach($_MSL as $ms) : ?>
		<option value="<?php echo($ms['ms_alias']); ?>"<?php if($ms['ms_alias']==ARequest::get('ms_alias')) :  ?> selected="selected"<?php endif; ?>><?php echo($ms['ms_name']); ?></option>
	<?php endforeach; endif; ?>
	</select></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("menu/list_menu")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("MENU_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="menu_id"></th>
				<th scope="col" width="70"><?php echo(L("DISPLAY_ORDER")); ?></th>
				<th scope="col"><?php echo(L("MENU_SPACE")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("TIP")); ?></th>
				<th scope="col"><?php echo(L("TYPE")); ?></th>
				<th scope="col"><?php echo(L("TARGET")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_ML) and is_array($_ML)) : foreach($_ML as $m) : ?>
			<tr s_id="<?php echo($m['menu_id']); ?>" p_id="<?php echo($m['m_parent_id']); ?>">
				<td><input name="menu_id[<?php echo($m['menu_id']); ?>]" type="checkbox" value="<?php echo($m['menu_id']); ?>"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="m_display_order[<?php echo($m['menu_id']); ?>]" value="<?php echo($m['m_display_order']); ?>"></td>
				<td>
					<a href="<?php echo(Url::U("menu/list_menu?ms_alias={$m['ms_alias']}")); ?>"><?php echo($m['ms_name']); ?> [<?php echo($m['ms_alias']); ?>]</a>
				</td>
				<td><?php if(isset($m['m_sub_menu'])) :  ?><span class="toggle_tr fc_gry" toggle_tr_id="<?php echo($m['menu_id']); ?>">┣</span><?php else : ?><span class="fc_gry">　 </span><?php endif; ?><input type="text" class="i required" size="16" maxlength="96" name="m_name[<?php echo($m['menu_id']); ?>]" value="<?php echo($m['m_name']); ?>"></td>
				<td><input type="text" class="i required" size="25" maxlength="96" name="m_tip[<?php echo($m['menu_id']); ?>]" value="<?php echo($m['m_tip']); ?>"></td>
				<td><?php if(0 == $m['m_type']) :  ?><?php echo(L("COMPOSE")); ?><?php elseif(1 == $m['m_type']) :  ?><?php echo(L("DIRECT")); ?><?php endif; ?></td>
				<td><?php if('_self' == $m['m_target']) :  ?><?php echo(L("SELF_WINDOW")); ?><?php elseif('_blank' == $m['m_target']) :  ?><?php echo(L("NEW_WINDOW")); ?><?php elseif('_parent' == $m['m_target']) :  ?><?php echo(L("PARENT_FRAME")); ?><?php elseif('_top' == $m['m_target']) :  ?><?php echo(L("TOP_FRAME")); ?><?php else : ?><?php echo(L("CUSTOM")); ?><?php endif; ?> [ <?php echo($m['m_target']); ?> ]</td>
				<td><a href="<?php echo(get_url($m['m_url'], $m['m_type'])); ?>" target="_blank"><?php echo(L("VIEW")); ?></a> | <a href="<?php echo(Url::U("menu/edit_menu?menu_id={$m['menu_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("menu/delete_menu_do?menu_id={$m['menu_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
			</tr>
				<?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $sm) : ?>
			<tr s_id="<?php echo($sm['menu_id']); ?>" p_id="<?php echo($sm['m_parent_id']); ?>">
				<td><input name="menu_id[<?php echo($sm['menu_id']); ?>]" type="checkbox" value="<?php echo($sm['menu_id']); ?>"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="m_display_order[<?php echo($sm['menu_id']); ?>]" value="<?php echo($sm['m_display_order']); ?>"></td>
				<td>
					<a href="<?php echo(Url::U("menu/list_menu?ms_alias={$sm['ms_alias']}")); ?>"><?php echo($sm['ms_name']); ?> [<?php echo($sm['ms_alias']); ?>]</a>
					<input name="ms_alias[<?php echo($sm['menu_id']); ?>]" type="hidden" value="<?php echo($sm['ms_alias']); ?>">
				</td>
				<td><span class="fc_gry">　┗ </span><input type="text" class="i required" size="16" maxlength="96" name="m_name[<?php echo($sm['menu_id']); ?>]" value="<?php echo($sm['m_name']); ?>"></td>
				<td><input type="text" class="i required" size="25" maxlength="96" name="m_tip[<?php echo($sm['menu_id']); ?>]" value="<?php echo($sm['m_tip']); ?>"></td>
				<td><?php if(0 == $sm['m_type']) :  ?><?php echo(L("COMPOSE")); ?><?php elseif(1 == $sm['m_type']) :  ?><?php echo(L("DIRECT")); ?><?php endif; ?></td>
				<td><?php if('_self' == $sm['m_target']) :  ?><?php echo(L("SELF_WINDOW")); ?><?php elseif('_blank' == $sm['m_target']) :  ?><?php echo(L("NEW_WINDOW")); ?><?php elseif('_parent' == $sm['m_target']) :  ?><?php echo(L("PARENT_FRAME")); ?><?php elseif('_top' == $sm['m_target']) :  ?><?php echo(L("TOP_FRAME")); ?><?php else : ?><?php echo(L("CUSTOM")); ?><?php endif; ?> [ <?php echo($sm['m_target']); ?> ]</td>
				<td><a href="<?php echo(get_url($sm['m_url'], $sm['m_type'])); ?>" target="_blank"><?php echo(L("VIEW")); ?></a> | <a href="<?php echo(Url::U("menu/edit_menu?menu_id={$sm['menu_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("menu/delete_menu_do?menu_id={$sm['menu_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
			</tr>
				<?php endforeach; endif; ?>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<a class="btn_l" href="<?php echo(Url::U("menu/add_menu")); ?>"><?php echo(L("ADD_MENU")); ?></a>
	<span class="btn_l submit" action="<?php echo(Url::U("menu/update_menu_do")); ?>" to="#formList"><?php echo(L("UPDATE_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("menu/delete_menu_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("menu_space/list_space")); ?>"><?php echo(L("MENU_SPACE_LIST")); ?></a>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>