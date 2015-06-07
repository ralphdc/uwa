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
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="upload_id"{-if:'upload_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="u_filename"{-if:'u_filename'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@FILENAME-}</option>
		<option value="u_type"{-if:'u_type'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@TYPE-}</option>
		<option value="u_size"{-if:'u_size'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@SIZE-}</option>
		<option value="u_add_time"{-if:'u_add_time'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ADD_TIME-}</option>
		<option value="u_item_type"{-if:'u_item_type'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ITEM_TYPE-}</option>
		<option value="u_item_id"{-if:'u_item_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ITEM_ID-}</option>
		<option value="member_id"{-if:'member_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@MEMBER_ID-}</option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"{-if:'desc'==arequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
		<option value="asc"{-if:'asc'==arequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==arequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==arequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==arequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==arequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==arequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<label>{-:@KEYWORDS-} <input class="i" type="text" size="10" maxlength="64" name="u_filename" value="{-php:echo ARequest::get('u_filename');-}"></label>
	<label><span class="btn_l submit" action="{-url:upload/list_upload-}" to="#formSearch">{-:@SEARCH-}</span></label>
	<a class="btn_l" href="{-url:upload/list_upload?u_item_id=not_used-}">{-:@NOT_USED_FILE-}</a>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@UPLOAD_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="upload_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@FILENAME-}</th>
				<th scope="col">{-:@FILETYPE-}</th>
				<th scope="col">{-:@FILESIZE-}</th>
				<th scope="col">{-:@ADD_TIME-}</th>
				<th scope="col">{-:@ITEM-}</th>
				<th scope="col">{-:@MEMBER_ID-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_UL,$u-}
			<tr>
				<td><input name="upload_id[]" type="checkbox" value="{-:$u['upload_id']-}"></td>
				<td>{-:$u['upload_id']-}</td>
				<td><i class="ai ai_16 ai_16_file_type_{-:$u['u_type']-}"></i> {-:$u['u_filename']-}</td>
				<td><a href="{-url:upload/list_upload?u_type={$u['u_type']}-}">{-:$u['u_type']-}</a></td>
				<td>{-:$u['u_size']|byte_format~@me-}</td>
				<td>{-:$u['u_add_time']|date~'Y-m-d',@me-}</td>
				<td>
					<a href="{-url:upload/list_upload?u_item_type={$u['u_item_type']}-}">{-:$u['u_item_type']-}</a>
					[<a href="{-url:upload/list_upload?u_item_id={$u['u_item_id']}-}">{-:$u['u_item_id']-}</a>]</td>
				<td><a href="{-url:upload/list_upload?member_id={$u['member_id']}-}">{-:$u['member_id']-}</a></td>
				<td><span class="preview btn_l" src="{-:$u['u_src']-}" title="{-:$u['u_filename']-}">{-:@VIEW-}</span> | <a href="{-url:upload/edit_upload?upload_id={$u['upload_id']}-}">{-:@EDIT-}</a> | <a href="{-url:upload/delete_upload_do?upload_id={$u['upload_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onClick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:upload/delete_upload_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script>
$(document).on('click', '.preview', function() {
	var i_src = $(this).attr('src'),
		i_title = $(this).attr('title');
	dialog({
		padding: 0,
		title: i_title,
		content: '<img src="' + i_src + '" />'
	}).showModal();
});
</script>
</body>
</html>