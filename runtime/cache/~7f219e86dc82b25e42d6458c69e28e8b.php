<?php /* PFA Template Cache File. Create Time:2015-06-10 02:37:11 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("CONTENT_PAGE_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="single_page_id"></th>
				<th scope="col" width="70"><?php echo(L("DISPLAY_ORDER")); ?></th>
				<th scope="col"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("GROUP")); ?></th>
				<th scope="col"><?php echo(L("TITLE")); ?></th>
				<th scope="col"><?php echo(L("EDIT_TIME")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_SPL) and is_array($_SPL)) : foreach($_SPL as $sp) : ?>
			<tr>
				<td><input name="single_page_id[<?php echo($sp['single_page_id']); ?>]" type="checkbox" value="<?php echo($sp['single_page_id']); ?>"></td>
				<td><input type="text" class="i required" size="6" maxlength="10" name="sp_display_order[<?php echo($sp['single_page_id']); ?>]" value="<?php echo($sp['sp_display_order']); ?>"></td>
				<td><?php echo($sp['content_id']); ?></td>
				<td><?php echo($sp['content_group']); ?></td>
				<td><?php echo($sp['content_title']); ?></td>
				<td>
					<?php echo(date('Y-m-d', $sp['content_edit_time'])); ?>
				</td>
				<td><a href="<?php echo(Url::U("content/edit_content?content_id={$sp['content_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("single_page/delete_single_page_do?single_page_id={$sp['single_page_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();"><?php echo(L("DELETE")); ?></a>
					</td>
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
	<a class="btn_l" href="<?php echo(Url::U("content/add_content")); ?>"><?php echo(L("ADD_CONTENT")); ?></a>
	<span class="btn_l submit" action="<?php echo(Url::U("single_page/update_single_page_do")); ?>" to="#formList"><?php echo(L("UPDATE_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("single_page/delete_single_page_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<span class="btn_l submit" action="<?php echo(Url::U("single_page/build_url_do")); ?>" to="#formList"><?php echo(L("BUILD_URL")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("single_page/build_html_do")); ?>" to="#formList"><?php echo(L("BUILD_HTML")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>