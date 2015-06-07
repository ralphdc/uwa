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
	<label><select name="al_status">
		<option value=""{-if:'' == ARequest::get('al_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="f"{-if:'f' == ARequest::get('al_status')-} selected="selected"{-:/if-}>{-:@FAILED-}</option>
		<option value="s"{-if:'s' == ARequest::get('al_status')-} selected="selected"{-:/if-}>{-:@SUCCESS-}</option>
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
	<label><span class="btn_l submit" action="{-url:admin_log/list_log-}" to="#formSearch">{-:@SEARCH-}</span></label>
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
</div><!--/.mainTips-->
</form>
<dl class="abox">
	<dt><strong>{-:@ADMIN_LOG_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="50">{-:@ID-}</th>
				<th scope="col">{-:@ADMIN-}</th>
				<th scope="col">{-:@OPERATION-}</th>
				<th scope="col" width="40">{-:@STATUS-}</th>
				<th scope="col">{-:@TIME-}</th>
				<th scope="col">{-:@IP-}</th>
			</tr>
			{-foreach:$_ALL,$al-}
			<tr>
				<td>{-:$al['admin_log_id']-}</td>
				<td>{-:$al['m_userid']-}</td>
				<td>{-:$al['al_operation']-}</td>
				<td>
				{-if:1 == $al['al_status']-}
					<span class="bg_wht br_g br_3 p_0_2 fc_g fw_b fs_11">{-:@SUCCESS-}</span>
				{-else:-}
					<span class="bg_wht br_r br_3 p_0_2 fc_r fw_b fs_11">{-:@FAILED-}</span>
				{-:/if-}
				</td>
				<td>{-:$al['al_time']|date~C('APP.TIME_FORMAT'),@me-}</td>
				<td>{-:$al['al_ip']-}</td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<span class="btn_l submit" action="{-url:admin_log/download_log?timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" to="#formSearch">{-:@DOWNLOAD_ADMIN_LOG-}</span>
	<a class="btn_l" href="{-url:admin_log/delete_old_log?timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE_OLD_LOG-}</a> <span class="fc_gry">{-:@DELETE_OLD_LOG_TIP-}</span>
</div><!--/#operation-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>