<?php /* PFA Template Cache File. Create Time:2015-06-06 15:59:54 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="r_item_type">
		<option value=""<?php if('' == ARequest::get('r_item_type')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ITEM_TYPE")); ?></option>
		<option value="a"<?php if('a' == ARequest::get('r_item_type')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("REPORT")); ?></option>
		<option value="r"<?php if('r' == ARequest::get('r_item_type')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("REVIEW")); ?></option>
	</select></label>
	<label><select name="r_status">
		<option value=""<?php if('' == ARequest::get('r_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("STATUS")); ?></option>
		<option value="n"<?php if('n' == ARequest::get('r_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("NOT_DEAL")); ?></option>
		<option value="d"<?php if('d' == ARequest::get('r_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("DEALT")); ?></option>
	</select></label>
	<label><select name="order_by">
		<option value=""><?php echo(L("DISPLAY_ORDER")); ?></option>
		<option value="report_id"<?php if('report_id'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ID")); ?></option>
		<option value="r_add_time"<?php if('r_add_time'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ADD_TIME")); ?></option>
		<option value="r_add_ip"<?php if('r_add_ip'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("IP")); ?></option>
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
	<label><?php echo(L("KEYWORDS")); ?> <input class="i" type="text" size="10" maxlength="64" name="r_info" value="<?php echo ARequest::get('r_info'); ?>"></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("report/list_report")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("REPORT_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="report_id"></th>
				<th scope="col"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("ITEM_TYPE")); ?></th>
				<th scope="col"><?php echo(L("INFO")); ?></th>
				<th scope="col"><?php echo(L("ADD_TIME")); ?></th>
				<th scope="col"><?php echo(L("IP")); ?></th>
				<th scope="col" width="90"><?php echo(L("STATUS")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_RL) and is_array($_RL)) : foreach($_RL as $r) : ?>
			<tr>
				<td>
					<input name="report_id[]" type="checkbox" value="<?php echo($r['report_id']); ?>">
				</td>
				<td><?php echo($r['report_id']); ?></td>
				<td>
					<?php echo($r['r_item_type']); ?> [<?php echo($r['r_item_id']); ?>]
				</td>
				<td>
					<?php echo($r['r_info']); ?>
				</td>
				<td>
					<?php echo(date(C('APP.TIME_FORMAT'), $r['r_add_time'])); ?>
				</td>
				<td>
					<?php echo($r['r_add_ip']); ?>
				</td>
				<td>
				<?php if(1 == $r['r_status']) :  ?>
					<span class="status"><b class="on"><?php echo(L("DEALT")); ?></b><a href="<?php echo(Url::U("report/toggle_report_status_do?report_id={$r['report_id']}&r_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php else : ?>
					<span class="status"><b class="off"><?php echo(L("NOT_DEAL")); ?></b><a href="<?php echo(Url::U("report/toggle_report_status_do?report_id={$r['report_id']}&r_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php endif; ?>
				</td>
				<td><a target="_blank" href="<?php echo(Url::U("{$r['r_item_type']}/{$r['editor']}?{$r['r_item_type']}_id={$r['r_item_id']}")); ?>"><?php echo(L("VIEW")); ?></a> | <a href="<?php echo(Url::U("report/delete_report_do?report_id={$r['report_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
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
	<span class="btn_l submit" action="<?php echo(Url::U("report/deal_report_do")); ?>" to="#formList"><?php echo(L("DEAL_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("report/delete_report_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>