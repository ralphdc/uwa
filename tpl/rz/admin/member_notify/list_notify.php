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
	<label><select name="mn_status">
		<option value=""{-if:'' == ARequest::get('mn_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="u"{-if:'u' == ARequest::get('mn_status')-} selected="selected"{-:/if-}>{-:@UNREAD-}</option>
		<option value="r"{-if:'r' == ARequest::get('mn_status')-} selected="selected"{-:/if-}>{-:@HAVE_READ-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="member_notify_id"{-if:'member_notify_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="mn_send_time"{-if:'mn_send_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@SEND_TIME-}</option>
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
	<label>{-:@TITLE-} <input class="i" type="text" size="10" maxlength="64" name="mn_title" value="{-php:echo ARequest::get('mn_title');-}"></label>
	<label>{-:@CONTENT-} <input class="i" type="text" size="10" maxlength="64" name="mn_content" value="{-php:echo ARequest::get('mn_content');-}"></label>
	<label><span class="btn_l submit" action="{-url:member_notify/list_notify-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<dl class="atab">
	<dt><strong>{-:@MEMBER_NOTIFY_LIST-}</strong><strong>{-:@ADD_NOTIFY-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<form id="formList" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_notify_id"></th>
					<th scope="col">{-:@ID-}</th>
					<th scope="col">{-:@TITLE-}</th>
					<th scope="col">{-:@CONTENT-}</th>
					<th scope="col">{-:@TIME-}</th>
					<th scope="col">{-:@ADMIN-}</th>
					<th scope="col">{-:@MEMBER_ID-}</th>
					<th scope="col">{-:@STATUS-}</th>
					<th scope="col">{-:@MANAGE-}</th>
				</tr>
				{-foreach:$_MNL,$mn-}
				<tr>
					<td><input name="member_notify_id[{-:$mn['member_notify_id']-}]" type="checkbox" value="{-:$mn['member_notify_id']-}"></td>
					<td>{-:$mn['member_notify_id']-}</td>
					<td>{-:$mn['mn_title']-}</td>
					<td>{-:$mn['mn_content']|AFilter::text~@me,32-}</td>
					<td>{-:$mn['mn_send_time']|date~C('APP.TIME_FORMAT'),@me-}</td>
					<td>{-:$mn['mn_admin_userid']-}</td>
					<td>{-if:-1==$mn['mn_m_id']-}{-:@ALL-}{-else:-}{-:$mn['mn_m_id']-}{-:/if-}</td>
					<td>
						{-if:0==$mn['mn_status']-}
						<span class="fc_gry">{-:@UNREAD-}</span>
						{-elseif:1==$mn['mn_status']-}
						<span class="fc_g">{-:@HAVE_READ-}</span>
						{-:/if-}
					</td>
					<td><a href="{-url:member_notify/delete_notify_do?member_notify_id={$mn['member_notify_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
				</tr>
				{-:/foreach-}
			</table>
			{-include:../paging-}
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_l submit" action="{-url:member_notify/delete_notify_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
			</div><!--/#operation-->
			</form>
		</div><!--/.tabCntnt-->
		<div class="tabCntnt">
			<form id="formAdd" action="" method="post">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@MEMBER_ID-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="{-if:0==ARequest::get('mn_m_id')-}-1{-else:-}{-:%mn_m_id-}{-:/if-}" name="mn_m_id" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MN_M_ID_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@TITLE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="mn_title" maxlength="96" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MN_TITLE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CONTENT-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="required i" style="width:360px;height:120px;" name="mn_content"></textarea>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MN_CONTENT_TIP-}
					</td>
				</tr>
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_b submit" action="{-url:member_notify/add_notify_do-}" to="#formAdd">{-:@SUBMIT-}</span>
				<input class="btn_l" type="reset" value="{-:@RESET-}" />
			</div>
			</form>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>