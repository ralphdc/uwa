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
	<label><select name="l_alias">
		<option value=""{-if:'' == ARequest::get('l_alias')-} selected="selected"{-:/if-}>{-:@SELECT_LINKAGE-}</option>
		{-foreach:$_LL,$l-}
		<option value="{-:$l['l_alias']-}"{-if:$l['l_alias'] == ARequest::get('l_alias')-} selected="selected"{-:/if-}>{-:$l['l_name']-} | {-:$l['l_alias']-}</option>
		{-:/foreach-}
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==ARequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==ARequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==ARequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==ARequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==ARequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<label><span class="btn_l submit" action="{-url:linkage_item/list_item-}" to="#formSearch">{-:@SEARCH-}</span></label>
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@LINKAGE_ITEM_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			{-if:isset($_V['l_name'])-}<tr>
				<td colspan="7"><span class="bg_gry_d br_3 p_2_5 fc_wht fs_11">{-:$_V['l_name']-} | {-:$_V['l_alias']-}</span> <span class="fw_b">{-:@CURRENT_POSITION-}: <span class="fc_gry">{-:$_V['position']-}</span></span></td>
			</tr>{-:/if-}
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="linkage_item_id"></th>
				<th scope="col" width="50">{-:@ID-}</th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@LINKAGE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_LIL,$li-}
			<tr>
				<td><input name="linkage_item_id[{-:$li['linkage_item_id']-}]" type="checkbox" value="{-:$li['linkage_item_id']-}"></td>
				<td>{-:$li['linkage_item_id']-}</td>
				<td><input name="li_display_order[{-:$li['linkage_item_id']-}]" value="{-:$li['li_display_order']-}" class="i" maxlength="10" size="6" /></td>
				<td><input name="li_name[{-:$li['linkage_item_id']-}]" value="{-:$li['li_name']-}" class="i" size="20" /></td>
				<td>{-:$li['l_name']-} | {-:$li['l_alias']-}</td>
				<td><a href="{-url:linkage_item/list_item?l_alias={$li['l_alias']}&li_parent_id={$li['linkage_item_id']}-}">{-:@VIEW_SUB_ITEM-}</a> | <a href="{-url:linkage_item/add_item?l_alias={$li['l_alias']}&li_parent_id={$li['linkage_item_id']}-}">{-:@ADD_SUB_ITEM-}</a> | <a href="{-url:linkage_item/edit_item?linkage_item_id={$li['linkage_item_id']}-}">{-:@EDIT-}</a> | <a href="{-url:linkage_item/delete_item_do?linkage_item_id={$li['linkage_item_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="li_parent_id" type="hidden" value="{-:$_V['li_parent_id']-}">
	<input name="l_alias" type="hidden" value="{-:$_V['l_alias']-}">
	{-if:!empty($_V['l_alias'])-}<span class="btn_l submit" action="{-url:linkage_item/add_item-}" to="#formList">{-:@ADD_LINKAGE_ITEM-}</span>{-:/if-}
	<span class="btn_l submit" action="{-url:linkage_item/update_item_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:linkage_item/delete_item_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:linkage/list_linkage-}">{-:@LINKAGE_LIST-}</a>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>