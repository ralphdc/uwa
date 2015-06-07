{-foreach:$_L,$k,$item-}
<li class="media">
	<a href="{-:$item['a_url_o']-}" class="pull-left">
		<img class="media-object" style="width:72px" src="{-:$item['a_thumb']-}">
	</a>
	<div class="media-body">
		<h6 class="media-heading text-truncate"><a href="{-:$item['a_url_o']-}">{-:$item['a_title']|AString::utf8_substr~@me,36-}</a></h6>
		<ul class="media-meta list-inline">
			<li><i class="icon icon-bookmark"></i> <a href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a></li>
			<li><i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'m-d',@me-}</li>
			<li><i class="icon icon-eye"></i> {-:$item['a_view_count']-}</li>
		</ul>
		<p class="media-content text-muted">{-:$item['a_description']|AString::utf8_substr~@me,96,1-}</p>
	</div>
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