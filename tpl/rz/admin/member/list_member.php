<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="member_model_id">
		<option value="0">{-:@MODEL-}</option>
	{-foreach:$_MML,$m-}
		<option value="{-:$m['member_model_id']-}"{-if:$m['member_model_id']==ARequest::get('member_model_id')-} selected="selected"{-:/if-}>{-:$m['mm_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><select name="member_level_id">
		<option value="0">{-:@LEVEL-}</option>
	{-foreach:$_MLL,$l-}
		<option value="{-:$l['member_level_id']-}"{-if:$l['member_level_id']==ARequest::get('member_level_id')-} selected="selected"{-:/if-}>{-:$l['ml_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><select name="m_status">
		<option value=""{-if:'' == ARequest::get('m_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('m_status')-} selected="selected"{-:/if-}>{-:@NOT_PASSED-}</option>
		<option value="p"{-if:'p' == ARequest::get('m_status')-} selected="selected"{-:/if-}>{-:@PASSED-}</option>
		<option value="d"{-if:'d' == ARequest::get('m_status')-} selected="selected"{-:/if-}>{-:@FORBIDDEN-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="member_id"{-if:'member_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="m_reg_time"{-if:'m_reg_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@REG_TIME-}</option>
		<option value="m_login_time"{-if:'m_login_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@LOGIN_TIME-}</option>
		<option value="m_experience"{-if:'m_experience'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@EXPERIENCE-}</option>
		<option value="m_points"{-if:'m_points'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@POINTS-}</option>
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
	<label>{-:@USERNAME-} <input class="i" type="text" size="10" maxlength="64" name="m_username" value="{-php:echo ARequest::get('m_username');-}"></label>
	<label><span class="btn_l submit" action="{-url:member/list_member-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@MEMBER_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@USERID-}</th>
				<th scope="col">{-:@USERNAME-}</th>
				<th scope="col">{-:@LEVEL-}</th>
				<th scope="col">{-:@MODEL-}</th>
				<th scope="col">{-:@LAST_LOGIN-}</th>
				<th scope="col">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_ML,$m-}
			<tr>
				<td>
					<input name="member_id[]" type="checkbox" value="{-:$m['member_id']-}">
				</td>
				<td>{-:$m['member_id']-}</td>
				<td>
					<a href="{-url:member/edit_member?member_id={$m['member_id']}-}">{-:$m['m_userid']-}</a>
				</td>
				<td>
					{-:$m['m_username']-}<br />
					<span class="fc_gry fs_11">{-:$m['m_email']-}</span>
				</td>
				<td>
					{-:$m['ml_name']-}
				</td>
				<td>
					{-:$m['mm_name']-}
				</td>
				<td>
					{-:$m['m_login_time']|date~'Y-m-d',@me-}<br />
					<span class="fc_gry fs_11">{-:$m['m_login_ip']-}</span>
				</td>
				<td>
					{-if:0 == $m['m_status']-}<span class="fc_gry">{-:@NOT_PASSED-}</span><br /><a class="btn_l" href="{-url:member/send_verify_email?member_id={$m['member_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@SEND_VERIFY_EMAIL-}</a>{-elseif:1 == $m['m_status']-}<span class="fc_g">{-:@PASSED-}</span>{-elseif:2 == $m['m_status']-}<span class="fc_r">{-:@FORBIDDEN-}</span>{-:/if-}
				</td>
				<td><a href="{-url:member/edit_member?member_id={$m['member_id']}-}">{-:@EDIT-}</a> | <a href="{-url:member/delete_member_do?member_id={$m['member_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a> | <a href="{-url:archive/list_archive?member_id={$m['member_id']}-}">{-:@ARCHIVE-}</a> | <a href="{-url:admin/assign_admin?member_id={$m['member_id']}-}">{-:@ASSIGN_ADMIN-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	{-foreach:$_MML,$m-}
	<a class="btn_l" href="{-url:member/add_member?member_model_id={$m['member_model_id']}-}">{-:@ADD-} {-:$m['mm_name']-} {-:@MEMBER-}</a>
	{-:/foreach-}
	<span class="btn_l submit" action="{-url:member/pass_member_do-}" to="#formList">{-:@PASS_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:member/forbidden_member_do-}" to="#formList">{-:@FORBIDDEN_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:member/delete_member_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<span class="btn_l ad" to="#formAddNotify" ad_id="add_notify">{-:@ADD_NOTIFY-}</span>
</div><!--/#operation-->
</form>
<div id="manage_notify" style="display:none">
	<div id="add_notify">
		<form id="formAddNotify" action="{-url:member_notify/add_notify_do-}" method="post">
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
					<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
					<input name="token" type="hidden" value="{-:$_TK['token']-}">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MN_CONTENT_TIP-}
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#add_notify-->
</div><!--/#manage_notify-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var l_ok = '{-:@OK-}',
	l_cancel = '{-:@CANCEL-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/l_m.js"></script>
</body>
</html>