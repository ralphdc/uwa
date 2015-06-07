
{-foreach:$_UL,$u-}
<tr>
	<td>
		<strong>{-:@FILENAME-}</strong> <i class="ai ai_16 ai_16_file_type_{-:$u['u_type']-}"></i> {-:$u['u_filename']-}<br />
		<strong>{-:@SIZE-}</strong> {-:$u['u_size']|byte_format~@me-}<br />
		<strong>{-:@ADD_TIME-}</strong> {-:$u['u_add_time']|date~'Y-m-d',@me-}<br />
		<strong>{-:@ITEM_TYPE-}</strong> {-:$u['u_item_type']-} [{-:$u['u_item_id']-}]<br />
	<td><a target="_blank" href="{-:$u['u_src']-}" class="btn btn-primary"><i class="icon icon-search-plus"></i> {-:@VIEW-}</a></td>
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
