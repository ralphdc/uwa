{-foreach:$_MNL,$mn-}
<tr>
	<td>
		<span id="notify_status_{-:$mn['member_notify_id']-}">
		{-if:-1!=$mn['mn_m_id']-}
			{-if:0==$mn['mn_status']-}
			<span class="text-success">{-:@UNREAD-}</span>
			{-elseif:1==$mn['mn_status']-}
			<span class="text-muted">{-:@HAVE_READ-}</span>
			{-:/if-}
		{-:/if-}
		</span>
		<span class="td_u a">{-:$mn['mn_title']-}</span><br />
		<span class="text-muted"><i class="icon icon-clock-o"></i> {-:$mn['mn_send_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
		<div class="alert" style="display:none" id="notify_{-:$mn['member_notify_id']-}">
			{-:$mn['mn_content']-}
		</div>
	</td>
	<td>
		<div class="btn-group-vertical">
			<span class="btn btn-primary" onclick="get_notify('{-:$mn['member_notify_id']-}')"><i class="icon icon-search-plus"></i> {-:@VIEW-}</span>
		{-if:-1!=$mn['mn_m_id']-}
			<a class="btn btn-primary" href="{-url:member_notify/delete_notify_do?member_notify_id={$mn['member_notify_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();"><i class="icon icon-times"></i> {-:@DELETE-}</a>
		{-:/if-}
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

