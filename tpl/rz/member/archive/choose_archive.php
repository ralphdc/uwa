<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
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
			<a id="title_{-:$a['archive_id']-}" href="{-:$a['a_url']-}" target="_blank">{-:$a['a_title']-}</a>
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
{-include:../clip/paging-}
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
<script src="{-:*__THEME__-}member/js/c.js"></script>
</body>
</html>