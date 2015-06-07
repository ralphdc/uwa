<?php /* PFA Template Cache File. Create Time:2015-06-06 10:45:54 */ ?>
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
	<label><select name="g_status">
		<option value=""<?php if('' == ARequest::get('g_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("STATUS")); ?></option>
		<option value="n"<?php if('n' == ARequest::get('g_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("NOT_PASSED")); ?></option>
		<option value="p"<?php if('p' == ARequest::get('g_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("PASSED")); ?></option>
		<option value="f"<?php if('f' == ARequest::get('g_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("FILTER")); ?></option>
	</select></label>
	<label><select name="order_by">
		<option value=""><?php echo(L("DISPLAY_ORDER")); ?></option>
		<option value="guestbook_id"<?php if('guestbook_id'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ID")); ?></option>
		<option value="g_add_time"<?php if('g_add_time'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ADD_TIME")); ?></option>
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
	<label><?php echo(L("KEYWORDS")); ?> <input class="i" type="text" size="10" maxlength="64" name="g_content" value="<?php echo ARequest::get('g_content'); ?>"></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("guestbook/list_guestbook")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("GUESTBOOK_LIST")); ?></strong><span><a href="<?php echo(Url::U("guestbook/edit_option")); ?>"><?php echo(L("GUESTBOOK_OPTION")); ?></a></span></dt>
	<dd>
		<table class="listTable">
			<?php if(isset($_GL) and is_array($_GL)) : foreach($_GL as $g) : ?>
			<tr>
				<th scope="col"><input name="guestbook_id[]" type="checkbox" value="<?php echo($g['guestbook_id']); ?>"> <?php echo(L("ID")); ?>:<?php echo($g['guestbook_id']); ?></th>
				<th scope="col">
					<span class="fc_gry"><strong><?php echo(L("ADD_TIME")); ?>:</strong> <?php echo(date(C('APP.TIME_FORMAT'), $g['g_add_time'])); ?></span>
					<span class="fc_gry"><strong><?php echo(L("IP")); ?>:</strong> <?php echo($g['g_add_ip']); ?></span>
				</th>
				<th scope="col"><?php echo(L("STATUS")); ?>:
				<?php if(0 == $g['g_status']) :  ?>
					<span class="status"><b class="off"><?php echo(L("NOT_PASSED")); ?></b><a href="<?php echo(Url::U("guestbook/toggle_guestbook_status_do?guestbook_id={$g['guestbook_id']}&g_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php elseif(1 == $g['g_status']) :  ?>
					<span class="status"><b class="on"><?php echo(L("PASSED")); ?></b><a href="<?php echo(Url::U("guestbook/toggle_guestbook_status_do?guestbook_id={$g['guestbook_id']}&g_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php elseif(2 == $g['g_status']) :  ?>
					<span class="status"><b class="off"><?php echo(L("FILTER")); ?></b><a href="<?php echo(Url::U("guestbook/toggle_guestbook_status_do?guestbook_id={$g['guestbook_id']}&g_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php endif; ?>
				</th>
			</tr>
			<tr>
				<td colspan="2">
					<table class="listTable" style="width:95%;">
						<tr>
							<td>
							<strong class="fc_b">
							<?php if(empty($g['g_author'])) :  ?>
								<?php echo(L("GUEST")); ?>
							<?php else : ?>
								<a href="<?php echo(Url::U("guestbook/list_guestbook?member_id={$g['member_id']}")); ?>"><?php echo($g['g_author']); ?></a>
							<?php endif; ?>:</strong> <?php echo(AString::msubstr($g['g_content'], 0, 32)); ?>
							</td>
						</tr>
						<?php if(!empty($g['g_reply'])) :  ?>
						<tr>
							<td>
							<strong class="fc_g"><?php echo(L("REPLY")); ?>:</strong> <?php echo($g['g_reply']); ?>
							</td>
						</tr>
						<?php endif; ?>
					</table>
				</td>
				<td><a href="<?php echo(Url::U("guestbook/edit_guestbook?guestbook_id={$g['guestbook_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("guestbook/delete_guestbook_do?guestbook_id={$g['guestbook_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
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
	<span class="btn_l submit" action="<?php echo(Url::U("guestbook/pass_guestbook_do")); ?>" to="#formList"><?php echo(L("PASS_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("guestbook/delete_same_ip_do")); ?>" to="#formList"><?php echo(L("DELETE_SAME_IP")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("guestbook/delete_guestbook_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>