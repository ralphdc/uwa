<?php /* PFA Template Cache File. Create Time:2015-06-06 10:45:57 */ ?>
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
	<label><select name="flink_category_id">
		<option value="0"><?php echo(L("CATEGORY")); ?></option>
	<?php if(isset($_FCL) and is_array($_FCL)) : foreach($_FCL as $fc) : ?>
		<option value="<?php echo($fc['flink_category_id']); ?>"<?php if($fc['flink_category_id']==ARequest::get('flink_category_id')) :  ?> selected="selected"<?php endif; ?>><?php echo($fc['fc_name']); ?></option>
	<?php endforeach; endif; ?>
	</select></label>
	<label><select name="f_show_type">
		<option value=""<?php if('' == ARequest::get('f_show_type')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("SHOW_TYPE")); ?></option>
		<option value="t"<?php if('t' == ARequest::get('f_show_type')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("TEXT_LINK")); ?></option>
		<option value="l"<?php if('l' == ARequest::get('f_show_type')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("LOGO_LINK")); ?></option>
	</select></label>
	<label><select name="f_status">
		<option value=""<?php if('' == ARequest::get('f_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("STATUS")); ?></option>
		<option value="n"<?php if('n' == ARequest::get('f_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("NOT_PASSED")); ?></option>
		<option value="p"<?php if('p' == ARequest::get('f_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("PASSED")); ?></option>
	</select></label>
	<label><select name="order_by">
		<option value=""><?php echo(L("DISPLAY_ORDER")); ?></option>
		<option value="flink_id"<?php if('flink_id'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ID")); ?></option>
		<option value="f_display_order"<?php if('f_display_order'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("DISPLAY_ORDER")); ?></option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"<?php if('desc'==ARequest::get('order_turn')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("DESC")); ?></option>
		<option value="asc"<?php if('asc'==ARequest::get('order_turn')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ASC")); ?></option>
	</select></label>
	<label><select name="page_size">
		<option value=""<?php if(''==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("PAGE_SIZE")); ?></option>
		<option value="10"<?php if('10'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>10 <?php echo(L("ITEMS")); ?></option>
		<option value="20"<?php if('20'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>20 <?php echo(L("ITEMS")); ?></option>
		<option value="50"<?php if('50'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>50 <?php echo(L("ITEMS")); ?></option>
		<option value="100"<?php if('100'==ARequest::get('page_size')) :  ?> selected="selected"<?php endif; ?>>100 <?php echo(L("ITEMS")); ?></option>
	</select></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("flink/list_flink")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("FLINK_LIST")); ?></strong><span><a href="<?php echo(Url::U("flink/edit_option")); ?>"><?php echo(L("FLINK_OPTION")); ?></a></span></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="flink_id"></th>
				<th scope="col" width="70"><?php echo(L("DISPLAY_ORDER")); ?></th>
				<th scope="col"><?php echo(L("CATEGORY")); ?></th>
				<th scope="col"><?php echo(L("SITE_NAME")); ?></th>
				<th scope="col"><?php echo(L("SITE_LOGO")); ?></th>
				<th scope="col"><?php echo(L("SHOW_TYPE")); ?></th>
				<th scope="col" width="90"><?php echo(L("STATUS")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_FL) and is_array($_FL)) : foreach($_FL as $f) : ?>
			<tr>
				<td><input name="flink_id[<?php echo($f['flink_id']); ?>]" type="checkbox" value="<?php echo($f['flink_id']); ?>"></td>
				<td><input type="text" class="required i" size="6" maxlength="10" name="f_display_order[<?php echo($f['flink_id']); ?>]" value="<?php echo($f['f_display_order']); ?>"></td>
				<td><?php echo($f['fc_name']); ?></td>
				<td>
					<?php echo($f['f_site_name']); ?><br />
					<a class="fc_gry" href="<?php echo($f['f_site_url']); ?>" target="_blank"><?php echo($f['f_site_url']); ?></a>
				</td>
				<td>
				<?php if(!empty($f['f_site_logo'])) :  ?><img src="<?php echo($f['f_site_logo']); ?>" /><?php endif; ?></td>
				<td><?php if(0 == $f['f_show_type']) :  ?><?php echo(L("TEXT_LINK")); ?><?php elseif(1 == $f['f_show_type']) :  ?><?php echo(L("LOGO_LINK")); ?><?php endif; ?></td>
				<td>
				<?php if(1 == $f['f_status']) :  ?>
					<span class="status"><b class="on"><?php echo(L("ON")); ?></b><a href="<?php echo(Url::U("flink/toggle_flink_status_do?flink_id={$f['flink_id']}&f_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php else : ?>
					<span class="status"><b class="off"><?php echo(L("OFF")); ?></b><a href="<?php echo(Url::U("flink/toggle_flink_status_do?flink_id={$f['flink_id']}&f_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php endif; ?>
				</td>
				<td><a href="<?php echo(Url::U("flink/edit_flink?flink_id={$f['flink_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("flink/delete_flink_do?flink_id={$f['flink_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
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
	<a class="btn_l" href="<?php echo(Url::U("flink/add_flink")); ?>"><?php echo(L("ADD_FLINK")); ?></a>
	<span class="btn_l submit" action="<?php echo(Url::U("flink/update_flink_do")); ?>" to="#formList"><?php echo(L("UPDATE_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("flink/delete_flink_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("flink_category/list_category")); ?>"><?php echo(L("FLINK_CATEGORY_LIST")); ?></a>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>