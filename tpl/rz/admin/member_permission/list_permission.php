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
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="member_permission_id"{-if:'member_permission_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="mp_group"{-if:'mp_group'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@GROUP-}</option>
		<option value="mp_name"{-if:'mp_name'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@NAME-}</option>
	</select></label>
	<label><select name="order_turn">
		<option value="asc"{-if:'asc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
		<option value="desc"{-if:'desc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==ARequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==ARequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==ARequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==ARequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==ARequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<label>{-:@NAME-} <input class="i" type="text" size="10" maxlength="64" name="mp_name" value="{-php:echo ARequest::get('mp_name');-}"></label>
	<label><span class="btn_l submit" action="{-url:member_permission/list_permission-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@MEMBER_PERMISSION_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_permission_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@GROUP-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_MPL,$mp-}
			<tr>
				<td>
					<input name="member_permission_id[]" type="checkbox" value="{-:$mp['member_permission_id']-}">
				</td>
				<td>
					{-:$mp['member_permission_id']-}
				</td>
				<td>
					<a href="{-url:member_permission/list_permission?mp_group={$mp['mp_group']}-}">{-:$mp['mp_group']-}</a>
				</td>
				<td>
					{-:$mp['mp_name']-}
				</td>
				<td><a href="{-url:member_permission/edit_permission?member_permission_id={$mp['member_permission_id']}-}">{-:@EDIT-}</a> | <a href="{-url:member_permission/delete_permission_do?member_permission_id={$mp['member_permission_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:member_permission/add_permission-}">{-:@ADD_PERMISSION-}</a>
	<span class="btn_l submit" action="{-url:member_permission/delete_permission_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>