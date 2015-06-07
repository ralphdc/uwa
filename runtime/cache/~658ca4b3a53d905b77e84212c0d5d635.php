<?php /* PFA Template Cache File. Create Time:2015-06-06 22:59:39 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="order_by">
		<option value=""><?php echo(L("DISPLAY_ORDER")); ?></option>
		<option value="upload_id"<?php if('upload_id'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ID")); ?></option>
		<option value="u_filename"<?php if('u_filename'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("FILENAME")); ?></option>
		<option value="u_type"<?php if('u_type'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("TYPE")); ?></option>
		<option value="u_size"<?php if('u_size'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("SIZE")); ?></option>
		<option value="u_add_time"<?php if('u_add_time'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ADD_TIME")); ?></option>
		<option value="u_item_type"<?php if('u_item_type'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ITEM_TYPE")); ?></option>
		<option value="u_item_id"<?php if('u_item_id'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ITEM_ID")); ?></option>
		<option value="member_id"<?php if('member_id'==arequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("MEMBER_ID")); ?></option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"<?php if('desc'==arequest::get('order_turn')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("DESC")); ?></option>
		<option value="asc"<?php if('asc'==arequest::get('order_turn')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ASC")); ?></option>
	</select></label>
	<label><select name="page_size">
		<option value=""<?php if(''==arequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("PAGE_SIZE")); ?></option>
		<option value="10"<?php if('10'==arequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>10 <?php echo(L("ITEMS")); ?></option>
		<option value="20"<?php if('20'==arequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>20 <?php echo(L("ITEMS")); ?></option>
		<option value="50"<?php if('50'==arequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>50 <?php echo(L("ITEMS")); ?></option>
		<option value="100"<?php if('100'==arequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>100 <?php echo(L("ITEMS")); ?></option>
	</select></label>
	<label><?php echo(L("KEYWORDS")); ?> <input class="i" type="text" size="10" maxlength="64" name="u_filename" value="<?php echo ARequest::get('u_filename'); ?>"></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("upload/list_upload")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
	<a class="btn_l" href="<?php echo(Url::U("upload/list_upload?u_item_id=not_used")); ?>"><?php echo(L("NOT_USED_FILE")); ?></a>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("UPLOAD_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="upload_id"></th>
				<th scope="col"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("FILENAME")); ?></th>
				<th scope="col"><?php echo(L("FILETYPE")); ?></th>
				<th scope="col"><?php echo(L("FILESIZE")); ?></th>
				<th scope="col"><?php echo(L("ADD_TIME")); ?></th>
				<th scope="col"><?php echo(L("ITEM")); ?></th>
				<th scope="col"><?php echo(L("MEMBER_ID")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_UL) and is_array($_UL)) : foreach($_UL as $u) : ?>
			<tr>
				<td><input name="upload_id[]" type="checkbox" value="<?php echo($u['upload_id']); ?>"></td>
				<td><?php echo($u['upload_id']); ?></td>
				<td><i class="ai ai_16 ai_16_file_type_<?php echo($u['u_type']); ?>"></i> <?php echo($u['u_filename']); ?></td>
				<td><a href="<?php echo(Url::U("upload/list_upload?u_type={$u['u_type']}")); ?>"><?php echo($u['u_type']); ?></a></td>
				<td><?php echo(byte_format($u['u_size'])); ?></td>
				<td><?php echo(date('Y-m-d', $u['u_add_time'])); ?></td>
				<td>
					<a href="<?php echo(Url::U("upload/list_upload?u_item_type={$u['u_item_type']}")); ?>"><?php echo($u['u_item_type']); ?></a>
					[<a href="<?php echo(Url::U("upload/list_upload?u_item_id={$u['u_item_id']}")); ?>"><?php echo($u['u_item_id']); ?></a>]</td>
				<td><a href="<?php echo(Url::U("upload/list_upload?member_id={$u['member_id']}")); ?>"><?php echo($u['member_id']); ?></a></td>
				<td><span class="preview btn_l" src="<?php echo($u['u_src']); ?>" title="<?php echo($u['u_filename']); ?>"><?php echo(L("VIEW")); ?></span> | <a href="<?php echo(Url::U("upload/edit_upload?upload_id={$u['upload_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("upload/delete_upload_do?upload_id={$u['upload_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onClick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
		<?php if(!empty($PAGING)) :  ?>
<div id="page_list">
<!--first page-->
<?php if(!empty($PAGING['firstPage']['url'])) :  ?>
	<a href="<?php echo($PAGING['firstPage']['url']); ?>" class="firstPage"><?php echo(L("_FIRST_PAGE_")); ?></a>
<?php else : ?>
	<span class="firstPage"><?php echo(L("_FIRST_PAGE_")); ?></span>
<?php endif; ?>

<!--prev page-->
<?php if(!empty($PAGING['prevPage']['url'])) :  ?>
	<a href="<?php echo($PAGING['prevPage']['url']); ?>" class="prevPage"><?php echo(L("_PREV_PAGE_")); ?></a>
<?php else : ?>
	<span class="prevPage"><?php echo(L("_PREV_PAGE_")); ?></span>
<?php endif; ?>

<!--near prev page-->
<?php if(!empty($PAGING['nearPrevPage'])) :  ?>
	<?php if(isset($PAGING['nearPrevPage']) and is_array($PAGING['nearPrevPage'])) : foreach($PAGING['nearPrevPage'] as $npp) : ?>
		<a href="<?php echo($npp['url']); ?>" class="nearPage"><?php echo($npp['page']); ?></a>
	<?php endforeach; endif; ?>
<?php endif; ?>

<!--current page-->
<?php if(!empty($PAGING['currentPage'])) :  ?>
	<span class="currentPage"><?php echo($PAGING['currentPage']['page']); ?></span>
<?php endif; ?>

<!--near next page-->
<?php if(!empty($PAGING['nearNextPage'])) :  ?>
	<?php if(isset($PAGING['nearNextPage']) and is_array($PAGING['nearNextPage'])) : foreach($PAGING['nearNextPage'] as $nnp) : ?>
		<a href="<?php echo($nnp['url']); ?>" class="nearPage"><?php echo($nnp['page']); ?></a>
	<?php endforeach; endif; ?>
<?php endif; ?>

<!--next page-->
<?php if(!empty($PAGING['nextPage']['url'])) :  ?>
	<a href="<?php echo($PAGING['nextPage']['url']); ?>" class="nextPage"><?php echo(L("_NEXT_PAGE_")); ?></a>
<?php else : ?>
	<span class="nextPage"><?php echo(L("_NEXT_PAGE_")); ?></span>
<?php endif; ?>

<!--last page-->
<?php if(!empty($PAGING['lastPage']['url'])) :  ?>
	<a href="<?php echo($PAGING['lastPage']['url']); ?>" class="lastPage"><?php echo(L("_LAST_PAGE_")); ?></a>
<?php else : ?>
	<span class="lastPage"><?php echo(L("_LAST_PAGE_")); ?></span>
<?php endif; ?>

<!--total info-->
<span class="total"><?php echo(L("_TOTAL_PAGES_")); ?>:<?php echo($PAGING['totalPages']); ?> | <?php echo(L("_TOTAL_ROWS_")); ?>:<?php echo($PAGING['totalRows']); ?></span>
</div>
<?php endif; ?>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_l submit" action="<?php echo(Url::U("upload/delete_upload_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
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