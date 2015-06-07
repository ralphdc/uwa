<?php /* PFA Template Cache File. Create Time:2015-06-06 01:29:07 */ ?>
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
	<label><select name="l_alias">
		<option value=""<?php if('' == ARequest::get('l_alias')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("SELECT_LINKAGE")); ?></option>
		<?php if(isset($_LL) and is_array($_LL)) : foreach($_LL as $l) : ?>
		<option value="<?php echo($l['l_alias']); ?>"<?php if($l['l_alias'] == ARequest::get('l_alias')) :  ?> selected="selected"<?php endif; ?>><?php echo($l['l_name']); ?> | <?php echo($l['l_alias']); ?></option>
		<?php endforeach; endif; ?>
	</select></label>
	<label><select name="page_size">
		<option value=""<?php if(''==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("PAGE_SIZE")); ?></option>
		<option value="10"<?php if('10'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>10 <?php echo(L("ITEMS")); ?></option>
		<option value="20"<?php if('20'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>20 <?php echo(L("ITEMS")); ?></option>
		<option value="50"<?php if('50'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>50 <?php echo(L("ITEMS")); ?></option>
		<option value="100"<?php if('100'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>100 <?php echo(L("ITEMS")); ?></option>
	</select></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("linkage_item/list_item")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("LINKAGE_ITEM_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<?php if(isset($_V['l_name'])) :  ?><tr>
				<td colspan="7"><span class="bg_gry_d br_3 p_2_5 fc_wht fs_11"><?php echo($_V['l_name']); ?> | <?php echo($_V['l_alias']); ?></span> <span class="fw_b"><?php echo(L("CURRENT_POSITION")); ?>: <span class="fc_gry"><?php echo($_V['position']); ?></span></span></td>
			</tr><?php endif; ?>
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="linkage_item_id"></th>
				<th scope="col" width="50"><?php echo(L("ID")); ?></th>
				<th scope="col" width="70"><?php echo(L("DISPLAY_ORDER")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("LINKAGE")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_LIL) and is_array($_LIL)) : foreach($_LIL as $li) : ?>
			<tr>
				<td><input name="linkage_item_id[<?php echo($li['linkage_item_id']); ?>]" type="checkbox" value="<?php echo($li['linkage_item_id']); ?>"></td>
				<td><?php echo($li['linkage_item_id']); ?></td>
				<td><input name="li_display_order[<?php echo($li['linkage_item_id']); ?>]" value="<?php echo($li['li_display_order']); ?>" class="i" maxlength="10" size="6" /></td>
				<td><input name="li_name[<?php echo($li['linkage_item_id']); ?>]" value="<?php echo($li['li_name']); ?>" class="i" size="20" /></td>
				<td><?php echo($li['l_name']); ?> | <?php echo($li['l_alias']); ?></td>
				<td><a href="<?php echo(Url::U("linkage_item/list_item?l_alias={$li['l_alias']}&li_parent_id={$li['linkage_item_id']}")); ?>"><?php echo(L("VIEW_SUB_ITEM")); ?></a> | <a href="<?php echo(Url::U("linkage_item/add_item?l_alias={$li['l_alias']}&li_parent_id={$li['linkage_item_id']}")); ?>"><?php echo(L("ADD_SUB_ITEM")); ?></a> | <a href="<?php echo(Url::U("linkage_item/edit_item?linkage_item_id={$li['linkage_item_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("linkage_item/delete_item_do?linkage_item_id={$li['linkage_item_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();"><?php echo(L("DELETE")); ?></a></td>
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
	<input name="li_parent_id" type="hidden" value="<?php echo($_V['li_parent_id']); ?>">
	<input name="l_alias" type="hidden" value="<?php echo($_V['l_alias']); ?>">
	<?php if(!empty($_V['l_alias'])) :  ?><span class="btn_l submit" action="<?php echo(Url::U("linkage_item/add_item")); ?>" to="#formList"><?php echo(L("ADD_LINKAGE_ITEM")); ?></span><?php endif; ?>
	<span class="btn_l submit" action="<?php echo(Url::U("linkage_item/update_item_do")); ?>" to="#formList"><?php echo(L("UPDATE_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("linkage_item/delete_item_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("linkage/list_linkage")); ?>"><?php echo(L("LINKAGE_LIST")); ?></a>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>