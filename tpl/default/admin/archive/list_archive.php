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
	<label><select name="archive_model_id">
		<option value="0">{-:@MODEL-}</option>
	{-foreach:$_AML,$m-}
		<option value="{-:$m['archive_model_id']-}"{-if:$m['archive_model_id']==ARequest::get('archive_model_id')-} selected="selected"{-:/if-}>{-:$m['am_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><select name="archive_channel_id">
		<option value="0">{-:@CHANNEL-}</option>
		{-:$_ACLStr-}
	</select></label>
	<label><select name="af_alias">
		<option value="">{-:@FLAG-}</option>
	{-foreach:$_AFL,$af-}
		<option value="{-:$af['af_alias']-}"{-if:$af['af_alias']==ARequest::get('af_alias')-} selected="selected"{-:/if-}>{-:$af['af_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><select name="a_status">
		<option value=""{-if:'' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@NOT_PASSED-}</option>
		<option value="p"{-if:'p' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@PASSED-}</option>
		<option value="r"{-if:'r' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@REFUNDED-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="archive_id"{-if:'archive_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="a_edit_time"{-if:'a_edit_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@EDIT_TIME-}</option>
		<option value="a_rank"{-if:'a_rank'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@RANK-}</option>
		<option value="a_view_count"{-if:'a_view_count'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@VIEW_COUNT-}</option>
		<option value="a_support_count"{-if:'a_support_count'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@SUPPORT_COUNT-}</option>
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
	<label>{-:@TITLE-} <input class="i" type="text" size="10" maxlength="64" name="a_title" value="{-php:echo ARequest::get('a_title');-}"></label>
	<label><span class="btn_l submit" action="{-url:archive/list_archive-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:$_AMI['am_name']-} {-:@LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="archive_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@TITLE-}</th>
				<th scope="col">{-:@CHANNEL-}</th>
				<th scope="col">{-:@EDIT_TIME-}</th>
				<th scope="col">{-:@VIEW_COUNT-}</th>
				<th scope="col">{-:@PUBLISHER-}</th>
				<th scope="col">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_AL,$a-}
			<tr>
				<td>
					<input name="archive_id[]" type="checkbox" value="{-:$a['archive_id']-}">
				</td>
				<td>{-:$a['archive_id']-}</td>
				<td>
					<a href="{-url:archive/edit_archive?archive_id={$a['archive_id']}-}">{-:$a['a_title']-}</a> {-:$a['af_alias']|get_archiveFlag~@me,2-}
				</td>
				<td>
					<a href="{-url:archive/list_archive?archive_channel_id={$a['archive_channel_id']}-}">{-:$a['ac_name']-}</a>
				</td>
				<td>
					{-:$a['a_edit_time']|date~'Y-m-d',@me-}
				</td>
				<td>
					{-:$a['a_view_count']-}
				</td>
				<td>
					<a href="{-url:archive/list_archive?member_id={$a['member_id']}-}">{-:$a['m_username']-}</a>
				</td>
				<td>
					{-if:0 == $a['a_status']-}<span class="fc_gry">{-:@NOT_PASSED-}</span>{-elseif:1 == $a['a_status']-}<span class="fc_g">{-:@PASSED-}</span>{-elseif:2 == $a['a_status']-}<span class="fc_r">{-:@REFUNDED-}</span>{-:/if-}
				</td>
				<td><a target="_blank" href="{-url:home@archive/show_archive?archive_id={$a['archive_id']}-}">{-:@PREVIEW-}</a> | <a href="{-url:archive/edit_archive?archive_id={$a['archive_id']}-}">{-:@EDIT-}</a> | <a href="{-url:archive/delete_archive_do?archive_id={$a['archive_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	{-if:!empty($_AMI)-}<a class="btn_l" href="{-url:archive/add_archive?archive_model_id={$_AMI['archive_model_id']}-}">{-:@ADD-} {-:$_AMI['am_name']-}</a>{-:/if-}
	<span class="btn_l submit" action="{-url:archive/pass_archive_do-}" to="#formList">{-:@PASS_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:archive/refund_archive_do-}" to="#formList">{-:@REFUND_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:archive/delete_archive_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	{-if:!empty($_AMI)-}<span class="btn_l ad" to="#formChangeChannel" ad_id="change_channel">{-:@CHANGE_CHANNEL-}</span>{-:/if-}
	<span class="btn_l ad" to="#formAddFlag" ad_id="add_flag">{-:@ADD_FLAG-}</span>
	<span class="btn_l ad" to="#formDeleteFlag" ad_id="delete_flag">{-:@DELETE_FLAG-}</span>
	<span class="btn_l ad" to="#formBuildArchive" ad_id="build_archive">{-:@BUILD_SELECTED-}</span>
	<label><input type="checkbox" name="send_notify" checked="checked" value="y"> {-:@SEND_NOTIFY-}</label>
</div><!--/#operation-->
</form>
<div style="display:none">
	<div id="change_channel">
		<form id="formChangeChannel" action="{-url:archive/change_channel_do-}" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
				<strong>{-:@ARCHIVE_ID-}</strong>
				<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
				<strong>{-:@CHANNEL-}</strong>
				<select name="archive_channel_id">
					<option value="0">{-:@CHANNEL-}</option>
					{-:$_ACLStr-}
				</select>
				<label><input type="checkbox" name="send_notify" checked="checked" value="y"> {-:@SEND_NOTIFY-}</label>
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#change_channel-->
	<div id="add_flag">
		<form id="formAddFlag" action="{-url:archive/add_flag_do-}" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
					<strong>{-:@ARCHIVE_ID-}</strong>
					<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<strong>{-:@FLAG-}</strong>
					{-foreach:$_AFL,$af-}<label><input type="radio" value="{-:$af['af_alias']-}" name="af_alias"> {-:$af['af_name']-}[{-:$af['af_alias']-}]</label>{-:/foreach-}
					<label><input type="checkbox" name="send_notify" checked="checked" value="y"> {-:@SEND_NOTIFY-}</label>
					<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
					<input name="token" type="hidden" value="{-:$_TK['token']-}">
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#add_flag-->
	<div id="delete_flag">
		<form id="formDeleteFlag" action="{-url:archive/delete_flag_do-}" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
					<strong>{-:@ARCHIVE_ID-}</strong>
					<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<strong>{-:@FLAG-}</strong>
					{-foreach:$_AFL,$af-}<label><input type="radio" value="{-:$af['af_alias']-}" name="af_alias"> {-:$af['af_name']-}[{-:$af['af_alias']-}]</label>{-:/foreach-}
					<label><input type="checkbox" name="send_notify" checked="checked" value="y"> {-:@SEND_NOTIFY-}</label>
					<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
					<input name="token" type="hidden" value="{-:$_TK['token']-}">
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#delete_flag-->
	<div id="build_archive">
		<form id="formBuildArchive" action="{-url:build/build_archive_do-}" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
					<strong>{-:@ARCHIVE_ID-}</strong>
					<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<strong>{-:@ACTION-}</strong>
					<label><input type="radio" value="build_url" name="action" checked="checked"> {-:@BUILD_SELECTED_URL-}</label>
					<label><input type="radio" value="build_html" name="action"> {-:@BUILD_SELECTED_HTML-}</label>
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#build_archive-->
</div><!--/hidden-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var l_ok = '{-:@OK-}',
	l_cancel = '{-:@CANCEL-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/l_a.js"></script>
</body>
</html>