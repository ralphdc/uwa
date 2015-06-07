{-foreach:$_L,$item-}
	<li>
		<div class="article">
			<p class="article-meta">
				<span><i class="icon icon-user"></i> {-:$item['g_author']-}</span>
				<span><i class="icon icon-clock-o"></i> {-:$item['g_add_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
			</p>
			<p>{-:$item['g_content']-}</p>
		</div><!--/.guestbook_main-->
		{-if:$item['g_reply']-}<div class="alert">
			<p><strong>{-:@REPLY-}:</strong> {-:$item['g_reply']-}</p>
		</div><!--/.guestbook_reply-->{-:/if-}
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