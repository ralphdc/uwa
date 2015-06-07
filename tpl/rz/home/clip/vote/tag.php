{-if:1 == $_VI['v_status']-}
<form method="post" action="{-url:home@vote/post_vote_do-}" target="_blank"><dl class="adl_panel">
	<input type="hidden" name="vote_id" value="{-:$_VI['vote_id']-}" />
	<dt><strong>{-:$_VI['v_name']-}</strong></dt>
	<dd class="header">{-:$_VI['v_description']-}</dd>
	<dd class="main">
		<ul>
	{-foreach:$_VI['v_option_set'],$k,$vo-}
			<li>
		{-if:1 == $_VI['v_is_multi']-}
				<label><input type="checkbox" name="vote_item[]" value="{-:$k-}" /> <a href="{-:$vo['link']-}" target="_blank">{-:$vo['description']-}</a></label>
		{-else:-}
				<label><input type="radio" name="vote_item" value="{-:$k-}" /> <a href="{-:$vo['link']-}" target="_blank">{-:$vo['description']-}</a></label>
		{-:/if-}
			</li>
	{-:/foreach-}
		</ul>
	</dd>
	<dd class="footer">
		<input type="submit" class="btn_l"  value="{-:@VOTE-}" />
	{-if:1 == $_VI['v_allow_view']-}
		<a class="btn_l" href="{-url:home@vote/show_vote_result?vote_id={$_VI['vote_id']}-}" target="_blank">{-:@VIEW_RESULT-}</a>
	{-:/if-}
	</dd>
</dl></form>
{-else:-}
	{-:@VOTE_IS_NOT_ACTIVE-}
{-:/if-}
