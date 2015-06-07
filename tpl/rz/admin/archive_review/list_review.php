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
	<label><select name="archive_channel_id">
		<option value="0">{-:@CHANNEL-}</option>
		{-:$_ACLStr-}
	</select></label>
	<label><select name="ar_status">
		<option value=""{-if:'' == ARequest::get('ar_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('ar_status')-} selected="selected"{-:/if-}>{-:@NOT_PASSED-}</option>
		<option value="p"{-if:'p' == ARequest::get('ar_status')-} selected="selected"{-:/if-}>{-:@PASSED-}</option>
		<option value="f"{-if:'f' == ARequest::get('ar_status')-} selected="selected"{-:/if-}>{-:@FILTER-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="archive_review_id"{-if:'archive_review_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="ar_add_time"{-if:'ar_add_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ADD_TIME-}</option>
		<option value="ar_support_count"{-if:'ar_support_count'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@SUPPORT_COUNT-}</option>
		<option value="ar_oppose_count"{-if:'ar_oppose_count'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@OPPOSE_COUNT-}</option>
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
	<label>{-:@KEYWORDS-} <input class="i" type="text" size="10" maxlength="64" name="ar_content" value="{-php:echo ARequest::get('ar_content');-}"></label>
	<label><span class="btn_l submit" action="{-url:archive_review/list_review-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ARCHIVE_REVIEW_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			{-foreach:$_ARL,$ar-}
			<tr>
				<th scope="col"><input name="archive_review_id[]" type="checkbox" value="{-:$ar['archive_review_id']-}"> {-:@ID-}:{-:$ar['archive_review_id']-}</th>
				<th scope="col">{-:@ARCHIVE-}: <a href="{-url:archive_review/list_review?archive_id={$ar['archive_id']}-}">{-:$ar['a_title']-}</a></th>
				<th scope="col">{-:@SUPPORT-}: {-:$ar['ar_support_count']-}</th>
				<th scope="col">{-:@OPPOSE-}: {-:$ar['ar_oppose_count']-}</th>
				<th scope="col">{-:@STATUS-}:
				{-if:0 == $ar['ar_status']-}
					<span class="status"><b class="off">{-:@NOT_PASSED-}</b><a href="{-url:archive_review/toggle_review_status_do?archive_review_id={$ar['archive_review_id']}&ar_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-elseif:1 == $ar['ar_status']-}
					<span class="status"><b class="on">{-:@PASSED-}</b><a href="{-url:archive_review/toggle_review_status_do?archive_review_id={$ar['archive_review_id']}&ar_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-elseif:2 == $ar['ar_status']-}
					<span class="status"><b class="off">{-:@FILTER-}</b><a href="{-url:archive_review/toggle_review_status_do?archive_review_id={$ar['archive_review_id']}&ar_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</th>
			</tr>
			<tr>
				<td colspan="4">
					<table class="listTable" style="width:95%;">
						<tr>
							<td>
							<span class="fc_gry"><strong>{-:@ADD_TIME-}:</strong> {-:$ar['ar_add_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
							<span class="fc_gry"><strong>{-:@IP-}:</strong> {-:$ar['ar_add_ip']-}</span>
							</td>
						</tr>
						<tr>
							<td>
							<strong class="fc_b">
							{-if:empty($ar['ar_author'])-}
								{-:@GUEST-}
							{-else:-}
								<a href="{-url:archive_review/list_review?member_id={$ar['member_id']}-}">{-:$ar['ar_author']-}</a>
							{-:/if-}:</strong> {-:$ar['ar_content']|AString::msubstr~@me,0,32-}
							</td>
						</tr>
						{-if:!empty($ar['ar_reply'])-}
						<tr>
							<td>
							<strong class="fc_g">{-:@REPLY-}:</strong> {-:$ar['ar_reply']-}
							</td>
						</tr>
						{-:/if-}
					</table>
				</td>
				<td><a href="{-url:archive_review/edit_review?archive_review_id={$ar['archive_review_id']}-}">{-:@EDIT-}</a> | <a href="{-url:archive_review/delete_review_do?archive_review_id={$ar['archive_review_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:archive_review/pass_review_do-}" to="#formList">{-:@PASS_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:archive_review/delete_same_ip_do-}" to="#formList">{-:@DELETE_SAME_IP-}</span>
	<span class="btn_l submit" action="{-url:archive_review/delete_review_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>