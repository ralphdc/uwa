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
	<label><select name="r_item_type">
		<option value=""{-if:'' == ARequest::get('r_item_type')-} selected="selected"{-:/if-}>{-:@ITEM_TYPE-}</option>
		<option value="a"{-if:'a' == ARequest::get('r_item_type')-} selected="selected"{-:/if-}>{-:@REPORT-}</option>
		<option value="r"{-if:'r' == ARequest::get('r_item_type')-} selected="selected"{-:/if-}>{-:@REVIEW-}</option>
	</select></label>
	<label><select name="r_status">
		<option value=""{-if:'' == ARequest::get('r_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('r_status')-} selected="selected"{-:/if-}>{-:@NOT_DEAL-}</option>
		<option value="d"{-if:'d' == ARequest::get('r_status')-} selected="selected"{-:/if-}>{-:@DEALT-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="report_id"{-if:'report_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="r_add_time"{-if:'r_add_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ADD_TIME-}</option>
		<option value="r_add_ip"{-if:'r_add_ip'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@IP-}</option>
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
	<label>{-:@KEYWORDS-} <input class="i" type="text" size="10" maxlength="64" name="r_info" value="{-php:echo ARequest::get('r_info');-}"></label>
	<label><span class="btn_l submit" action="{-url:report/list_report-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@REPORT_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="report_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@ITEM_TYPE-}</th>
				<th scope="col">{-:@INFO-}</th>
				<th scope="col">{-:@ADD_TIME-}</th>
				<th scope="col">{-:@IP-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_RL,$r-}
			<tr>
				<td>
					<input name="report_id[]" type="checkbox" value="{-:$r['report_id']-}">
				</td>
				<td>{-:$r['report_id']-}</td>
				<td>
					{-:$r['r_item_type']-} [{-:$r['r_item_id']-}]
				</td>
				<td>
					{-:$r['r_info']-}
				</td>
				<td>
					{-:$r['r_add_time']|date~C('APP.TIME_FORMAT'),@me-}
				</td>
				<td>
					{-:$r['r_add_ip']-}
				</td>
				<td>
				{-if:1 == $r['r_status']-}
					<span class="status"><b class="on">{-:@DEALT-}</b><a href="{-url:report/toggle_report_status_do?report_id={$r['report_id']}&r_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@NOT_DEAL-}</b><a href="{-url:report/toggle_report_status_do?report_id={$r['report_id']}&r_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td><a target="_blank" href="{-url:{$r['r_item_type']}/{$r['editor']}?{$r['r_item_type']}_id={$r['r_item_id']}-}">{-:@VIEW-}</a> | <a href="{-url:report/delete_report_do?report_id={$r['report_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:report/deal_report_do-}" to="#formList">{-:@DEAL_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:report/delete_report_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>