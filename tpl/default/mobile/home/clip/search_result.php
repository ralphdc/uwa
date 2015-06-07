{-foreach:$_L,$k,$item-}
	<li id="searchResultList-{-:$PAGING['currentPage']['page']-}">
		<h5><a class="text-primary" href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></h5>
		<p class="margin-remove">{-:$item['a_description']-}</p>
		<p class="margin-remove text-muted"><i class="icon icon-globe"></i> <small><a class="text-success" target="_blank" href="{-:$item['a_url_o']-}">{-:$item['a_url_o']|substr~@me,0,16-} ... {-:$item['a_url_o']|substr~@me,-24-}</a></small></p>
		<p class="margin-remove text-muted"><span><i class="icon icon-bookmark"></i> <a class="text-primary" target="_blank" href="{-:$item['ac_url_o']-}">{-:$item['ac_name']-}</a></span> <span><i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'Y-m-d',@me-}</span></p>
	</li>
{-:/foreach-}

<!--next page-->
<script>
var obj = document.getElementById('searchResultList-{-:$PAGING['currentPage']['page']-}');
highlight_keywords(obj, keyword, "red");

{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>