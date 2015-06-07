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
	<label><select name="g_status">
		<option value=""{-if:'' == ARequest::get('g_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('g_status')-} selected="selected"{-:/if-}>{-:@NOT_PASSED-}</option>
		<option value="p"{-if:'p' == ARequest::get('g_status')-} selected="selected"{-:/if-}>{-:@PASSED-}</option>
		<option value="f"{-if:'f' == ARequest::get('g_status')-} selected="selected"{-:/if-}>{-:@FILTER-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="guestbook_id"{-if:'guestbook_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="g_add_time"{-if:'g_add_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ADD_TIME-}</option>
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
	<label>{-:@KEYWORDS-} <input class="i" type="text" size="10" maxlength="64" name="g_content" value="{-php:echo ARequest::get('g_content');-}"></label>
	<label><span class="btn_l submit" action="{-url:guestbook/list_guestbook-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@GUESTBOOK_LIST-}</strong><span><a href="{-url:guestbook/edit_option-}">{-:@GUESTBOOK_OPTION-}</a></span></dt>
	<dd>
		<table class="listTable">
			{-foreach:$_GL,$g-}
			<tr>
				<th scope="col"><input name="guestbook_id[]" type="checkbox" value="{-:$g['guestbook_id']-}"> {-:@ID-}:{-:$g['guestbook_id']-}</th>
				<th scope="col">
					<span class="fc_gry"><strong>{-:@ADD_TIME-}:</strong> {-:$g['g_add_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
					<span class="fc_gry"><strong>{-:@IP-}:</strong> {-:$g['g_add_ip']-}</span>
				</th>
				<th scope="col">{-:@STATUS-}:
				{-if:0 == $g['g_status']-}
					<span class="status"><b class="off">{-:@NOT_PASSED-}</b><a href="{-url:guestbook/toggle_guestbook_status_do?guestbook_id={$g['guestbook_id']}&g_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-elseif:1 == $g['g_status']-}
					<span class="status"><b class="on">{-:@PASSED-}</b><a href="{-url:guestbook/toggle_guestbook_status_do?guestbook_id={$g['guestbook_id']}&g_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-elseif:2 == $g['g_status']-}
					<span class="status"><b class="off">{-:@FILTER-}</b><a href="{-url:guestbook/toggle_guestbook_status_do?guestbook_id={$g['guestbook_id']}&g_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</th>
			</tr>
			<tr>
				<td colspan="2">
					<table class="listTable" style="width:95%;">
						<tr>
							<td>
							<strong class="fc_b">
							{-if:empty($g['g_author'])-}
								{-:@GUEST-}
							{-else:-}
								<a href="{-url:guestbook/list_guestbook?member_id={$g['member_id']}-}">{-:$g['g_author']-}</a>
							{-:/if-}:</strong> {-:$g['g_content']|AString::msubstr~@me,0,32-}
							</td>
						</tr>
						{-if:!empty($g['g_reply'])-}
						<tr>
							<td>
							<strong class="fc_g">{-:@REPLY-}:</strong> {-:$g['g_reply']-}
							</td>
						</tr>
						{-:/if-}
					</table>
				</td>
				<td><a href="{-url:guestbook/edit_guestbook?guestbook_id={$g['guestbook_id']}-}">{-:@EDIT-}</a> | <a href="{-url:guestbook/delete_guestbook_do?guestbook_id={$g['guestbook_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:guestbook/pass_guestbook_do-}" to="#formList">{-:@PASS_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:guestbook/delete_same_ip_do-}" to="#formList">{-:@DELETE_SAME_IP-}</span>
	<span class="btn_l submit" action="{-url:guestbook/delete_guestbook_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>