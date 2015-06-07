
{-foreach:$_MFL,$mf-}
<tr>
	<td>
		<a href="{-:$mf['mf_url']-}" target="_blank">{-:$mf['mf_title']-}</a><br />
		<span class="text-muted"><i class="icon icon-clock-o"></i> {-:$mf['mf_add_time']|date~'Y-m-d',@me-}</span>
	</td>
	<td><a class="btn btn-primary" href="{-url:member_favorite/delete_favorite_do?member_favorite_id={$mf['member_favorite_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();"><i class="icon icon-times"></i> {-:@DELETE-}</a></td>
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

