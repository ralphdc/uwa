document.write('');
{-if:1 == $_VI['v_status']-}
document.write('<form method="post" action="{-url:home@vote/post_vote_do-}" target="_blank"><dl class="adl_panel">');
document.write('	<input type="hidden" name="vote_id" value="{-:$_VI['vote_id']-}" />');
document.write('	<dt><strong>{-:$_VI['v_name']-}</strong></dt>');
document.write('	<dd class="header">{-:$_VI['v_description']-}</dd>');
document.write('	<dd class="main">');
document.write('		<ul>');
	{-foreach:$_VI['v_option_set'],$k,$vo-}
document.write('			<li>');
		{-if:1 == $_VI['v_is_multi']-}
document.write('				<label><input type="checkbox" name="vote_item[]" value="{-:$k-}" /> <a href="{-:$vo['link']-}" target="_blank">{-:$vo['description']-}</a></label>');
		{-else:-}
document.write('				<label><input type="radio" name="vote_item" value="{-:$k-}" /> <a href="{-:$vo['link']-}" target="_blank">{-:$vo['description']-}</a></label>');
		{-:/if-}
document.write('			</li>');
	{-:/foreach-}
document.write('		</ul>');
document.write('	</dd>');
document.write('	<dd class="footer">');
document.write('		<input type="submit" class="btn_l"  value="{-:@VOTE-}" />');
	{-if:1 == $_VI['v_allow_view']-}
document.write('		<a class="btn_l" href="{-url:home@vote/show_vote_result?vote_id={$_VI['vote_id']}-}" target="_blank">{-:@VIEW_RESULT-}</a>');
	{-:/if-}
document.write('	</dd>');
document.write('</dl></form>');
{-else:-}
document.write('{-:@VOTE_IS_NOT_ACTIVE-}');
{-:/if-}
