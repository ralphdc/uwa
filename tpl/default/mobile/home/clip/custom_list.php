<uwa:a_list cid="$_V.cl_config.cid" flag="$_V.cl_config.flag" days="$_V.cl_config.days" keywords="$_V.cl_config.keywords" orderby="$_V.cl_config.orderby" order="$_V.cl_config.order" row="$_V.cl_config.row" offset="$_V.cl_config.offset">
	<li>
		<a href="{-:$item['a_url_o']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
		<small class="text-muted"><i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'m-d',@me-}</small>
	</li>
</uwa:a_list>

<!--next page-->
<script>
{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>