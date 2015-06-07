
{-foreach:$_AL,$a-}
<tr>
	<td>
		<strong>{-:@TITLE-}</strong>: {-:$a['a_title']|AString::utf8_substr~@me,36,1-}<br />
		<strong>{-:@STATUS-}</strong>: 
		{-if:0 == $a['a_status']-}<span class="text-muted">{-:@NOT_PASSED-}</span>
		{-elseif:1 == $a['a_status']-}<span class="text-success">{-:@PASSED-}</span>
		{-elseif:2 == $a['a_status']-}<span class="text-danger">{-:@REFUNDED-}</span>{-:/if-}<br />
		<span class="text-muted">
			<i class="icon icon-bookmark"></i> <a target="_blank" href="{-:$a['ac_url']-}">{-:$a['ac_name']-}</a><br />
			<i class="icon icon-clock-o"></i> {-:$a['a_edit_time']|date~'Y-m-d',@me-}<br />
			<i class="icon icon-eye"></i> {-:$a['a_view_count']-}
		</span>
	</td>
	<td>
		<div class="btn-group-vertical">
			<a class="btn btn-primary" target="_blank" href="{-url:home@archive/show_archive?archive_id={$a['archive_id']}-}"><i class="icon icon-search-plus"></i> {-:@PREVIEW-}</a>
			<a class="btn btn-primary" href="{-url:archive/edit_archive?archive_id={$a['archive_id']}-}"><i class="icon icon-edit"></i> {-:@EDIT-}</a>
		</div>
	</td>
</tr>
{-:/foreach-}

<!--next page-->
<script>
{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>

