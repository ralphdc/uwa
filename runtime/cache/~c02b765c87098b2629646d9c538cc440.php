<?php /* PFA Template Cache File. Create Time:2015-06-06 11:59:15 */ ?>
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
	<label><select name="archive_model_id">
		<option value="0"><?php echo(L("MODEL")); ?></option>
	<?php if(isset($_AML) and is_array($_AML)) : foreach($_AML as $m) : ?>
		<option value="<?php echo($m['archive_model_id']); ?>"<?php if($m['archive_model_id']==ARequest::get('archive_model_id')) :  ?> selected="selected"<?php endif; ?>><?php echo($m['am_name']); ?></option>
	<?php endforeach; endif; ?>
	</select></label>
	<label><select name="archive_channel_id">
		<option value="0"><?php echo(L("CHANNEL")); ?></option>
		<?php echo($_ACLStr); ?>
	</select></label>
	<label><select name="af_alias">
		<option value=""><?php echo(L("FLAG")); ?></option>
	<?php if(isset($_AFL) and is_array($_AFL)) : foreach($_AFL as $af) : ?>
		<option value="<?php echo($af['af_alias']); ?>"<?php if($af['af_alias']==ARequest::get('af_alias')) :  ?> selected="selected"<?php endif; ?>><?php echo($af['af_name']); ?></option>
	<?php endforeach; endif; ?>
	</select></label>
	<label><select name="a_status">
		<option value=""<?php if('' == ARequest::get('a_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("STATUS")); ?></option>
		<option value="n"<?php if('n' == ARequest::get('a_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("NOT_PASSED")); ?></option>
		<option value="p"<?php if('p' == ARequest::get('a_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("PASSED")); ?></option>
		<option value="r"<?php if('r' == ARequest::get('a_status')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("REFUNDED")); ?></option>
	</select></label>
	<label><select name="order_by">
		<option value=""><?php echo(L("DISPLAY_ORDER")); ?></option>
		<option value="archive_id"<?php if('archive_id'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("ID")); ?></option>
		<option value="a_edit_time"<?php if('a_edit_time'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("EDIT_TIME")); ?></option>
		<option value="a_rank"<?php if('a_rank'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("RANK")); ?></option>
		<option value="a_view_count"<?php if('a_view_count'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("VIEW_COUNT")); ?></option>
		<option value="a_support_count"<?php if('a_support_count'==ARequest::get('order_by')) :  ?> selected="selected"<?php endif; ?>><?php echo(L("SUPPORT_COUNT")); ?></option>
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
	<label><?php echo(L("TITLE")); ?> <input class="i" type="text" size="10" maxlength="64" name="a_title" value="<?php echo ARequest::get('a_title'); ?>"></label>
	<label><span class="btn_l submit" action="<?php echo(Url::U("archive/list_archive")); ?>" to="#formSearch"><?php echo(L("SEARCH")); ?></span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo($_AMI['am_name']); ?> <?php echo(L("LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="archive_id"></th>
				<th scope="col"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("TITLE")); ?></th>
				<th scope="col"><?php echo(L("CHANNEL")); ?></th>
				<th scope="col"><?php echo(L("EDIT_TIME")); ?></th>
				<th scope="col"><?php echo(L("VIEW_COUNT")); ?></th>
				<th scope="col"><?php echo(L("PUBLISHER")); ?></th>
				<th scope="col"><?php echo(L("STATUS")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_AL) and is_array($_AL)) : foreach($_AL as $a) : ?>
			<tr>
				<td>
					<input name="archive_id[]" type="checkbox" value="<?php echo($a['archive_id']); ?>">
				</td>
				<td><?php echo($a['archive_id']); ?></td>
				<td>
					<a href="<?php echo(Url::U("archive/edit_archive?archive_id={$a['archive_id']}")); ?>"><?php echo($a['a_title']); ?></a> <?php echo(get_archiveFlag($a['af_alias'], 2)); ?>
				</td>
				<td>
					<a href="<?php echo(Url::U("archive/list_archive?archive_channel_id={$a['archive_channel_id']}")); ?>"><?php echo($a['ac_name']); ?></a>
				</td>
				<td>
					<?php echo(date('Y-m-d', $a['a_edit_time'])); ?>
				</td>
				<td>
					<?php echo($a['a_view_count']); ?>
				</td>
				<td>
					<a href="<?php echo(Url::U("archive/list_archive?member_id={$a['member_id']}")); ?>"><?php echo($a['m_username']); ?></a>
				</td>
				<td>
					<?php if(0 == $a['a_status']) :  ?><span class="fc_gry"><?php echo(L("NOT_PASSED")); ?></span><?php elseif(1 == $a['a_status']) :  ?><span class="fc_g"><?php echo(L("PASSED")); ?></span><?php elseif(2 == $a['a_status']) :  ?><span class="fc_r"><?php echo(L("REFUNDED")); ?></span><?php endif; ?>
				</td>
				<td><a target="_blank" href="<?php echo(Url::U("home@archive/show_archive?archive_id={$a['archive_id']}")); ?>"><?php echo(L("PREVIEW")); ?></a> | <a href="<?php echo(Url::U("archive/edit_archive?archive_id={$a['archive_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("archive/delete_archive_do?archive_id={$a['archive_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
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
	<?php if(!empty($_AMI)) :  ?><a class="btn_l" href="<?php echo(Url::U("archive/add_archive?archive_model_id={$_AMI['archive_model_id']}")); ?>"><?php echo(L("ADD")); ?> <?php echo($_AMI['am_name']); ?></a><?php endif; ?>
	<span class="btn_l submit" action="<?php echo(Url::U("archive/pass_archive_do")); ?>" to="#formList"><?php echo(L("PASS_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("archive/refund_archive_do")); ?>" to="#formList"><?php echo(L("REFUND_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("archive/delete_archive_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<?php if(!empty($_AMI)) :  ?><span class="btn_l ad" to="#formChangeChannel" ad_id="change_channel"><?php echo(L("CHANGE_CHANNEL")); ?></span><?php endif; ?>
	<span class="btn_l ad" to="#formAddFlag" ad_id="add_flag"><?php echo(L("ADD_FLAG")); ?></span>
	<span class="btn_l ad" to="#formDeleteFlag" ad_id="delete_flag"><?php echo(L("DELETE_FLAG")); ?></span>
	<span class="btn_l ad" to="#formBuildArchive" ad_id="build_archive"><?php echo(L("BUILD_SELECTED")); ?></span>
	<label><input type="checkbox" name="send_notify" checked="checked" value="y"> <?php echo(L("SEND_NOTIFY")); ?></label>
</div><!--/#operation-->
</form>
<div style="display:none">
	<div id="change_channel">
		<form id="formChangeChannel" action="<?php echo(Url::U("archive/change_channel_do")); ?>" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
				<strong><?php echo(L("ARCHIVE_ID")); ?></strong>
				<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
				<strong><?php echo(L("CHANNEL")); ?></strong>
				<select name="archive_channel_id">
					<option value="0"><?php echo(L("CHANNEL")); ?></option>
					<?php echo($_ACLStr); ?>
				</select>
				<label><input type="checkbox" name="send_notify" checked="checked" value="y"> <?php echo(L("SEND_NOTIFY")); ?></label>
				<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
				<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#change_channel-->
	<div id="add_flag">
		<form id="formAddFlag" action="<?php echo(Url::U("archive/add_flag_do")); ?>" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
					<strong><?php echo(L("ARCHIVE_ID")); ?></strong>
					<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<strong><?php echo(L("FLAG")); ?></strong>
					<?php if(isset($_AFL) and is_array($_AFL)) : foreach($_AFL as $af) : ?><label><input type="radio" value="<?php echo($af['af_alias']); ?>" name="af_alias"> <?php echo($af['af_name']); ?>[<?php echo($af['af_alias']); ?>]</label><?php endforeach; endif; ?>
					<label><input type="checkbox" name="send_notify" checked="checked" value="y"> <?php echo(L("SEND_NOTIFY")); ?></label>
					<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
					<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#add_flag-->
	<div id="delete_flag">
		<form id="formDeleteFlag" action="<?php echo(Url::U("archive/delete_flag_do")); ?>" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
					<strong><?php echo(L("ARCHIVE_ID")); ?></strong>
					<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<strong><?php echo(L("FLAG")); ?></strong>
					<?php if(isset($_AFL) and is_array($_AFL)) : foreach($_AFL as $af) : ?><label><input type="radio" value="<?php echo($af['af_alias']); ?>" name="af_alias"> <?php echo($af['af_name']); ?>[<?php echo($af['af_alias']); ?>]</label><?php endforeach; endif; ?>
					<label><input type="checkbox" name="send_notify" checked="checked" value="y"> <?php echo(L("SEND_NOTIFY")); ?></label>
					<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
					<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#delete_flag-->
	<div id="build_archive">
		<form id="formBuildArchive" action="<?php echo(Url::U("build/build_archive_do")); ?>" method="post">
		<table class="listTable">
			<tr>
				<td class="inputArea">
					<strong><?php echo(L("ARCHIVE_ID")); ?></strong>
					<input class="required i" type="text" value="" name="archive_id" maxlength="255" size="50">
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<strong><?php echo(L("ACTION")); ?></strong>
					<label><input type="radio" value="build_url" name="action" checked="checked"> <?php echo(L("BUILD_SELECTED_URL")); ?></label>
					<label><input type="radio" value="build_html" name="action"> <?php echo(L("BUILD_SELECTED_HTML")); ?></label>
				</td>
			</tr>
		</table>
		</form>
	</div><!--/#build_archive-->
</div><!--/hidden-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
var l_ok = '<?php echo(L("OK")); ?>',
	l_cancel = '<?php echo(L("CANCEL")); ?>';
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
<script src="/tpl/rz/admin/js/l_a.js"></script>
</body>
</html>