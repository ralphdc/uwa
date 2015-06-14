<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@CCATEGORY_PAGE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="ccategory_id"></th>
				<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@GROUP-}</th>
				<th scope="col">{-:@TITLE-}</th>
				<th scope="col">{-:@EDIT_TIME-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_SPL,$sp-}
			<tr>
				<td><input name="ccategory_id[{-:$sp['ccategory_id']-}]" type="checkbox" value="{-:$sp['ccategory_id']-}"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="sp_display_order[{-:$sp['ccategory_id']-}]" value="{-:$sp['ccategory_id']-}"></td>
				<td>{-:$sp['ccategory_id']-}</td>
				<td>{-:$sp['ccategory_group']-}</td>
				<td>{-:$sp['ccategory_title']-}</td>
				<td>
					{-:$sp['ccategory_edit_time']-}
				</td>
				<td><a href="{-url:ccategory/edit_ccategory?ccategory_id={$sp['ccategory_id']}-}">{-:@EDIT-}</a> | <a href="{-url:ccategory/delete_ccategory_do?ccategory_id={$sp['ccategory_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a>
					</td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:ccategory/add_ccategory-}">{-:@ADD_CCATEGORY-}</a>
	<!--  <span class="btn_l submit" action="{-url:pcateogry/update_ccategory_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>  -->
	<span class="btn_l submit" action="{-url:ccategory/delete_ccategory_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<!-- <span class="btn_l submit" action="{-url:ccategory/build_url_do-}" to="#formList">{-:@BUILD_URL-}</span>
	<span class="btn_l submit" action="{-url:ccategory/build_html_do-}" to="#formList">{-:@BUILD_HTML-}</span> -->
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>