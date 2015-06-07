<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="archive_model_id">
		<option value="0">{-:@MODEL-}</option>
	{-foreach:$_AML,$m-}
		<option value="{-:$m['archive_model_id']-}"{-if:$m['archive_model_id']==ARequest::get('archive_model_id')-} selected="selected"{-:/if-}>{-:$m['am_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><select name="archive_channel_id">
		<option value="0">{-:@CHANNEL-}</option>
		{-:$_ACLStr-}
	</select></label>
	<label><select name="af_alias">
		<option value="">{-:@FLAG-}</option>
	{-foreach:$_AFL,$af-}
		<option value="{-:$af['af_alias']-}"{-if:$af['af_alias']==ARequest::get('af_alias')-} selected="selected"{-:/if-}>{-:$af['af_name']-}</option>
	{-:/foreach-}
	</select></label>
	<label><select name="a_status">
		<option value=""{-if:'' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@NOT_PASSED-}</option>
		<option value="p"{-if:'p' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@PASSED-}</option>
		<option value="r"{-if:'r' == ARequest::get('a_status')-} selected="selected"{-:/if-}>{-:@REFUNDED-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="archive_id"{-if:'archive_id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="a_edit_time"{-if:'a_edit_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@EDIT_TIME-}</option>
		<option value="a_rank"{-if:'a_rank'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@RANK-}</option>
		<option value="a_view_count"{-if:'a_view_count'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@VIEW_COUNT-}</option>
		<option value="a_support_count"{-if:'a_support_count'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@SUPPORT_COUNT-}</option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"{-if:'desc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
		<option value="asc"{-if:'asc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==ARequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==ARequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==ARequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==ARequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==ARequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<label>{-:@TITLE-} <input class="i" type="text" size="10" maxlength="64" name="a_title" value="{-php:echo ARequest::get('a_title');-}"></label>
	<label><span class="btn_l submit" action="{-url:archive/choose_archive-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<table class="listTable">
	<tr>
		<th scope="col" width="18"><input type="checkbox" class="select_all" to="archive_id"></th>
		<th scope="col">{-:@ID-}</th>
		<th scope="col">{-:@TITLE-}</th>
		<th scope="col">{-:@CHANNEL-}</th>
		<th scope="col">{-:@EDIT_TIME-}</th>
		<th scope="col">{-:@STATUS-}</th>
	</tr>
	{-foreach:$_AL,$a-}
	<tr>
		<td>
			<input name="archive_id[]" type="checkbox" value="{-:$a['archive_id']-}">
		</td>
		<td>{-:$a['archive_id']-}</td>
		<td>
			<a id="title_{-:$a['archive_id']-}" href="{-:$a['a_url']-}" target="_blank">{-:$a['a_title']-}</a> {-:$a['af_alias']|get_archiveFlag~@me,2-}
		</td>
		<td>
			{-:$a['ac_name']-}
		</td>
		<td>
			{-:$a['a_edit_time']|date~'Y-m-d',@me-}
		</td>
		<td>
			{-if:0 == $a['a_status']-}<span class="fc_gry">{-:@NOT_PASSED-}</span>{-elseif:1 == $a['a_status']-}<span class="fc_g">{-:@PASSED-}</span>{-elseif:2 == $a['a_status']-}<span class="fc_r">{-:@REFUNDED-}</span>{-:/if-}
		</td>
	</tr>
	{-:/foreach-}
</table>
{-include:../paging-}
<div id="operation">
	<span class="btn_l insert_selected">{-:@INSERT_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div><!--/#operation-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
/* define in_array */
Array.prototype.S = String.fromCharCode(2);
Array.prototype.in_array = function(e) {
	var r = new RegExp(this.S + e + this.S);
	return (r.test(this.S + this.join(this.S) + this.S));
};

/* check selected id */
var selectId = Array();

var dialog = parent.dialog.get(window);
if('' != dialog.data.archive) {
	selectId = dialog.data.archive.split(',');
}
var items = $(":checkbox[name='archive_id[]']");
for(i = 0; i < items.length; i++) {
	var id = items[i].value;
	if(selectId.in_array(id)) {
		$(':checkbox[value="' + id + '"]').prop('checked', true);
	}
}

/* insert archive  */
$('.insert_selected').bind('click',function() {
	var items = getCheckboxItem('select'),
		exceptItems = getCheckboxItem('except'),
		itemTitles = getCheckboxItem('selectTitle');
	var data = {'archive': items, 'exceptArchive': exceptItems, 'archiveTitle': itemTitles};
	dialog.close(data);
	dialog.remove();
});

/* get selected archive */
function getCheckboxItem(type) {
	var allSel = '', selTitle = [],
		items = $(":checkbox[name='archive_id[]']");
	for(i = 0; i < items.length; i++) {
		if((items[i].checked && 'select' == type) || (!items[i].checked && 'except' == type)) {
			if('' == allSel) {
				allSel = items[i].value;
			}
			else {
				allSel = allSel + ',' +items[i].value;
			}
		}
		if(items[i].checked && 'selectTitle' == type) {
			selTitle.push($('#title_' + items[i].value).text());
		}
	}
	if('selectTitle' == type) {
		return selTitle;
	}
	return allSel;
}
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>