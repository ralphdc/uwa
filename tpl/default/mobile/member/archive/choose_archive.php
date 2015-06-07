<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
<table id="archiveList" class="table">
	{-foreach:$_AL,$a-}
	<tr>
		<td>
			<input name="archive_id[]" type="checkbox" value="{-:$a['archive_id']-}">
		</td>
		<td>
			<a id="title_{-:$a['archive_id']-}" href="{-:$a['a_url']-}" target="_blank">{-:$a['a_title']|AString::utf8_substr~@me,36,1-}</a><br />
			{-if:0 == $a['a_status']-}<span class="text-muted">{-:@NOT_PASSED-}</span>
			{-elseif:1 == $a['a_status']-}<span class="text-success">{-:@PASSED-}</span>
			{-elseif:2 == $a['a_status']-}<span class="text-danger">{-:@REFUNDED-}</span>{-:/if-}
			<span class="text-muted">
				<i class="icon icon-bookmark"></i> <a target="_blank" href="{-:$a['ac_url']-}">{-:$a['ac_name']-}</a><br />
				<i class="icon icon-clock-o"></i> {-:$a['a_edit_time']|date~'Y-m-d',@me-}
			</span>
		</td>
	</tr>
	{-:/foreach-}
</table>

<!--prev and next page-->
<div class="grid">
	<ul class="pagination-pager">
	{-if:!empty($PAGING['prevPage']['url'])-}
		<li class="previous">
			<a href="{-:$PAGING['prevPage']['url']-}">{-:@_PREV_PAGE_-}</a>
		</li>
	{-else:-}
		<li class="previous disabled">
			<a href="#">{-:@NONE-}</a>
		</li>
	{-:/if-}
	{-if:!empty($PAGING['nextPage']['url'])-}
		<li class="next">
			<a href="{-:$PAGING['nextPage']['url']-}">{-:@_NEXT_PAGE_-}</a>
		</li>
	{-else:-}
		<li class="next disabled">
			<a href="#">{-:@NONE-}</a>
		</li>
	{-:/if-}
	</ul>
</div>

<div class="btn-group">
	<span class="btn btn-primary insert_selected">{-:@INSERT_SELECTED-}</span>
	<input class="btn btn-primary" type="reset" value="{-:@RESET-}" />
</div><!--/#operation-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
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
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
