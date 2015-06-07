<?php /* PFA Template Cache File. Create Time:2015-06-06 01:29:02 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("LINKAGE_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="linkage_id"></th>
				<th scope="col" width="50"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("ALIAS")); ?></th>
				<th scope="col"><?php echo(L("DESCRIPTION")); ?></th>
				<th scope="col"><?php echo(L("TYPE")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_LL) and is_array($_LL)) : foreach($_LL as $l) : ?>
			<tr>
				<td>
					<input name="linkage_id[<?php echo($l['linkage_id']); ?>]" type="checkbox" value="<?php echo($l['linkage_id']); ?>">
				</td>
				<td><?php echo($l['linkage_id']); ?></td>
				<td><?php echo($l['l_name']); ?></td>
				<td>
					<input name="l_alias[<?php echo($l['linkage_id']); ?>]" type="hidden" value="<?php echo($l['l_alias']); ?>">
					<?php echo($l['l_alias']); ?>
				</td>
				<td><?php echo($l['l_description']); ?></td>
				<td>
				<?php if(0 == $l['l_type']) :  ?>
					<span><?php echo(L("SYSTEM")); ?></span>
				<?php elseif(1 == $l['l_type']) :  ?>
					<span><?php echo(L("CUSTOM")); ?></span>
				<?php endif; ?>
				</td>
				<td><a href="<?php echo(Url::U("linkage_item/list_item?l_alias={$l['l_alias']}")); ?>"><?php echo(L("VIEW_ITEM")); ?></a> | <a href="<?php echo(Url::U("linkage/edit_linkage?linkage_id={$l['linkage_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("linkage/delete_linkage_do?linkage_id={$l['linkage_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a> | <a class="btn_l" href="<?php echo(Url::U("linkage/update_cache_do?l_alias={$l['l_alias']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("UPDATE_LINKAGE_CACHE")); ?></a></td>
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
	<a class="btn_l" href="<?php echo(Url::U("linkage/add_linkage")); ?>"><?php echo(L("ADD_LINKAGE")); ?></a>
	<span class="btn_l submit" action="<?php echo(Url::U("linkage/delete_linkage_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("linkage/update_cache_do")); ?>" to="#formList"><?php echo(L("UPDATE_LINKAGE_CACHE")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>