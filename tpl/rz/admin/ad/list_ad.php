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
	<label><select name="ad_space_id">
		<option value="0">{-:@AD_SPACE-}</option>
	{-foreach:$_ASL,$as-}
		<option value="{-:$as['ad_space_id']-}"{-if:$as['ad_space_id']==ARequest::get('ad_space_id')-} selected="selected"{-:/if-}>{-:$as['as_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><span class="btn_l submit" action="{-url:ad/list_ad-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@AD_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="ad_id"></th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@AD_SPACE-}</th>
				<th scope="col">{-:@TIME_LIMIT-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_AL,$a-}
			<tr>
				<td><input name="ad_id[{-:$a['ad_id']-}]" type="checkbox" value="{-:$a['ad_id']-}"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="a_display_order[{-:$a['ad_id']-}]" value="{-:$a['a_display_order']-}"></td>
				<td>{-:$a['a_name']-}</td>
				<td>{-:$a['as_name']-}</td>
				<td>
				{-if:0 == $a['a_time_limit']-}
					{-:@NOT_LIMIT-}
				{-elseif:1 == $a['a_time_limit']-}
					{-:$a['a_start_time']|date~'Y-m-d',@me-} ~ {-:$a['a_end_time']|date~'Y-m-d',@me-}
				{-:/if-}
				</td>
				<td><a href="{-url:ad/edit_ad?ad_id={$a['ad_id']}-}">{-:@EDIT-}</a> | <a href="{-url:ad/delete_ad_do?ad_id={$a['ad_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:ad/update_ad_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:ad/delete_ad_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:ad_space/list_space-}">{-:@AD_SPACE_LIST-}</a>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>