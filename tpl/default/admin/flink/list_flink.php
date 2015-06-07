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
	<label><select name="flink_category_id">
		<option value="0">{-:@CATEGORY-}</option>
	{-foreach:$_FCL,$fc-}
		<option value="{-:$fc['flink_category_id']-}"{-if:$fc['flink_category_id']==ARequest::get('flink_category_id')-} selected="selected"{-:/if-}>{-:$fc['fc_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><select name="f_show_type">
		<option value=""{-if:'' == ARequest::get('f_show_type')-} selected="selected"{-:/if-}>{-:@SHOW_TYPE-}</option>
		<option value="t"{-if:'t' == ARequest::get('f_show_type')-} selected="selected"{-:/if-}>{-:@TEXT_LINK-}</option>
		<option value="l"{-if:'l' == ARequest::get('f_show_type')-} selected="selected"{-:/if-}>{-:@LOGO_LINK-}</option>
	</select></label>
	<label><select name="f_status">
		<option value=""{-if:'' == ARequest::get('f_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('f_status')-} selected="selected"{-:/if-}>{-:@NOT_PASSED-}</option>
		<option value="p"{-if:'p' == ARequest::get('f_status')-} selected="selected"{-:/if-}>{-:@PASSED-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="flink_id"{-if:'flink_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="f_display_order"{-if:'f_display_order'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@DISPLAY_ORDER-}</option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"{-if:'desc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
		<option value="asc"{-if:'asc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==ARequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==ARequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==ARequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==ARequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==ARequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<label><span class="btn_l submit" action="{-url:flink/list_flink-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@FLINK_LIST-}</strong><span><a href="{-url:flink/edit_option-}">{-:@FLINK_OPTION-}</a></span></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="flink_id"></th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@CATEGORY-}</th>
				<th scope="col">{-:@SITE_NAME-}</th>
				<th scope="col">{-:@SITE_LOGO-}</th>
				<th scope="col">{-:@SHOW_TYPE-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_FL,$f-}
			<tr>
				<td><input name="flink_id[{-:$f['flink_id']-}]" type="checkbox" value="{-:$f['flink_id']-}"></td>
				<td><input type="text" class="required i" size="6" maxlength="10" name="f_display_order[{-:$f['flink_id']-}]" value="{-:$f['f_display_order']-}"></td>
				<td>{-:$f['fc_name']-}</td>
				<td>
					{-:$f['f_site_name']-}<br />
					<a class="fc_gry" href="{-:$f['f_site_url']-}" target="_blank">{-:$f['f_site_url']-}</a>
				</td>
				<td>
				{-if:!empty($f['f_site_logo'])-}<img src="{-:$f['f_site_logo']-}" />{-:/if-}</td>
				<td>{-if:0 == $f['f_show_type']-}{-:@TEXT_LINK-}{-elseif:1 == $f['f_show_type']-}{-:@LOGO_LINK-}{-:/if-}</td>
				<td>
				{-if:1 == $f['f_status']-}
					<span class="status"><b class="on">{-:@ON-}</b><a href="{-url:flink/toggle_flink_status_do?flink_id={$f['flink_id']}&f_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@OFF-}</b><a href="{-url:flink/toggle_flink_status_do?flink_id={$f['flink_id']}&f_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td><a href="{-url:flink/edit_flink?flink_id={$f['flink_id']}-}">{-:@EDIT-}</a> | <a href="{-url:flink/delete_flink_do?flink_id={$f['flink_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:flink/add_flink-}">{-:@ADD_FLINK-}</a>
	<span class="btn_l submit" action="{-url:flink/update_flink_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:flink/delete_flink_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:flink_category/list_category-}">{-:@FLINK_CATEGORY_LIST-}</a>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>