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
		<option value="member_favorite_id"{-if:'member_favorite_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="member_id"{-if:'member_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@MEMBER_ID-}</option>
		<option value="archive_id"{-if:'archive_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ARCHIVE_ID-}</option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"{-if:'desc'==arequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
		<option value="asc"{-if:'asc'==arequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==arequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==arequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==arequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==arequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==arequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<label>{-:@KEYWORDS-} <input class="i" type="text" size="10" maxlength="64" name="mf_title" value="{-php:echo ARequest::get('mf_title');-}"></label>
	<label><span class="btn_l submit" action="{-url:member_favorite/list_favorite-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@FAVORITE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_favorite_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@TITLE-}</th>
				<th scope="col">{-:@ADD_TIME-}</th>
				<th scope="col">{-:@ARCHIVE_ID-}</th>
				<th scope="col">{-:@MEMBER_ID-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_MFL,$mf-}
			<tr>
				<td><input name="member_favorite_id[]" type="checkbox" value="{-:$mf['member_favorite_id']-}"></td>
				<td>{-:$mf['member_favorite_id']-}</td>
				<td>{-:$mf['mf_title']-}</td>
				<td>{-:$mf['mf_add_time']|date~C('APP.TIME_FORMAT'),@me-}</td>
				<td><a href="{-url:member_favorite/list_favorite?archive_id={$mf['archive_id']}-}">{-:$mf['archive_id']-}</a></td>
				<td><a href="{-url:member_favorite/list_favorite?member_id={$mf['member_id']}-}">{-:$mf['member_id']-}</a></td>
				<td><a href="{-url:member_favorite/delete_favorite_do?member_favorite_id={$mf['member_favorite_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onClick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:member_favorite/delete_favorite_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>