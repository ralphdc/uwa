<?php /* PFA Template Cache File. Create Time:2015-06-06 10:25:17 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="order_by">
		<option value=""><?php echo(L("DISPLAY_ORDER")); ?></option>
		<option value="admin_permission_id"<?php if('admin_permission_id'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ID")); ?></option>
		<option value="ap_group"<?php if('ap_group'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("GROUP")); ?></option>
		<option value="ap_name"<?php if('ap_name'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("NAME")); ?></option>
	</select></label>
	<label><select name="order_turn">
		<option value="asc"<?php if('asc'==ARequest::get('order_turn')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ASC")); ?></option>
		<option value="desc"<?php if('desc'==ARequest::get('order_turn')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("DESC")); ?></option>
	</select></label>
	<label><select name="page_size">
		<option value=""<?php if(''==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("PAGE_SIZE")); ?></option>
		<option value="10"<?php if('10'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>10 <?php echo(L("ITEMS")); ?></option>
		<option value="20"<?php if('20'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>20 <?php echo(L("ITEMS")); ?></option>
		<option value="50"<?php if('50'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>50 <?php echo(L("ITEMS")); ?></option>
		<option value="100"<?php if('100'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>100 <?php echo(L("ITEMS")); ?></option>
	</select></label>
	<label><?php echo(L("NAME")); ?> <input class="i" type="text" size="10" maxlength="64" name="ap_name" value="<?php echo ARequest::get('ap_name'); ?>"></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("admin_permission/list_permission")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("ADMIN_PERMISSION_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="admin_permission_id"></th>
				<th scope="col"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("GROUP")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_APL) and is_array($_APL)) : foreach($_APL as $ap) : ?>
			<tr>
				<td>
					<input name="admin_permission_id[]" type="checkbox" value="<?php echo($ap['admin_permission_id']); ?>">
				</td>
				<td>
					<?php echo($ap['admin_permission_id']); ?>
				</td>
				<td>
					<a href="<?php echo(Url::U("admin_permission/list_permission?ap_group={$ap['ap_group']}")); ?>"><?php echo($ap['ap_group']); ?></a>
				</td>
				<td>
					<?php echo($ap['ap_name']); ?>
				</td>
				<td><a href="<?php echo(Url::U("admin_permission/edit_permission?admin_permission_id={$ap['admin_permission_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("admin_permission/delete_permission_do?admin_permission_id={$ap['admin_permission_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
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
	<a class="btn_l" href="<?php echo(Url::U("admin_permission/add_permission")); ?>"><?php echo(L("ADD_PERMISSION")); ?></a>
	<span class="btn_l submit" action="<?php echo(Url::U("admin_permission/delete_permission_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>