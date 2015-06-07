<?php /* PFA Template Cache File. Create Time:2015-06-06 10:25:21 */ ?>
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
	<label><select name="al_status">
		<option value=""<?php if('' == ARequest::get('al_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("STATUS")); ?></option>
		<option value="f"<?php if('f' == ARequest::get('al_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("FAILED")); ?></option>
		<option value="s"<?php if('s' == ARequest::get('al_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("SUCCESS")); ?></option>
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
	<label><span class="btn_l submit" action="<?php echo(Url::U("admin_log/list_log")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
</div><!--/.mainTips-->
</form>
<dl class="abox">
	<dt><strong><?php echo(L("ADMIN_LOG_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="50"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("ADMIN")); ?></th>
				<th scope="col"><?php echo(L("OPERATION")); ?></th>
				<th scope="col" width="40"><?php echo(L("STATUS")); ?></th>
				<th scope="col"><?php echo(L("TIME")); ?></th>
				<th scope="col"><?php echo(L("IP")); ?></th>
			</tr>
			<?php if(isset($_ALL) and is_array($_ALL)) : foreach($_ALL as $al) : ?>
			<tr>
				<td><?php echo($al['admin_log_id']); ?></td>
				<td><?php echo($al['m_userid']); ?></td>
				<td><?php echo($al['al_operation']); ?></td>
				<td>
				<?php if(1 == $al['al_status']) :  ?>
					<span class="bg_wht br_g br_3 p_0_2 fc_g fw_b fs_11"><?php echo(L("SUCCESS")); ?></span>
				<?php else : ?>
					<span class="bg_wht br_r br_3 p_0_2 fc_r fw_b fs_11"><?php echo(L("FAILED")); ?></span>
				<?php endif; ?>
				</td>
				<td><?php echo(date(C('APP.TIME_FORMAT'), $al['al_time'])); ?></td>
				<td><?php echo($al['al_ip']); ?></td>
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
	<span class="btn_l submit" action="<?php echo(Url::U("admin_log/download_log?timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" to="#formSearch"><?php echo(L("DOWNLOAD_ADMIN_LOG")); ?></span>
	<a class="btn_l" href="<?php echo(Url::U("admin_log/delete_old_log?timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();"><?php echo(L("DELETE_OLD_LOG")); ?></a> <span class="fc_gry"><?php echo(L("DELETE_OLD_LOG_TIP")); ?></span>
</div><!--/#operation-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>