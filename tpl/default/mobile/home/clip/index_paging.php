{-foreach:$_L,$k,$item-}
<li>
	<a href="{-:$item['a_url_o']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
	<small class="text-muted"><i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'m-d',@me-}</small>
</li>
{-:/foreach-}

<!--next page-->
<script>
{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>