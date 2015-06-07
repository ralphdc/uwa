/* list archive */
var a_ad;
$('.ad').bind('click',function() {
	var ad_id = $(this).attr('ad_id'),
		to = $(this).attr('to'),
		t = $(this).text(),
		items = getCheckboxItem();
		$("[name='archive_id']").val(items);
	dialog({
		content:document.getElementById(ad_id),
		id:'ab_d',
		title:t,
		button:[
			{
				value:l_ok,
				callback:function() {
					$(to).submit();
					return false;
				}
			},
			{
				value:l_cancel
			}
		]
	}).showModal();
});

/* get checked archive item */
function getCheckboxItem() {
	var allSel = '',
		items = $(":checkbox[name='archive_id[]']");
	for(i=0; i < items.length; i++) {
		if(items[i].checked) {
			if('' == allSel) {
				allSel = items[i].value;
			}
			else {
				allSel = allSel + ',' +items[i].value;
			}
		}
	}
	return allSel;
}
