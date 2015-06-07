{-if:1 == $_VI['v_status']-}
<form method="post" action="{-url:home@vote/post_vote_do-}" target="_blank"><dl class="adl">
	<input type="hidden" name="vote_id" value="{-:$_VI['vote_id']-}" />
	<dt>
		<h5><i class="icon icon-bar-chart-o"></i> {-:$_VI['v_name']-}</h5>
	{-if:1 == $_VI['v_allow_view']-}
		<span class="float-right"><a href="{-url:home@vote/show_vote_result?vote_id={$_VI['vote_id']}-}" target="_blank">{-:@VIEW_RESULT-}</a></span>
	{-:/if-}
	</dt>
	<dd>
		{-:$_VI['v_description']-}
		<ul class="aul list-unstyled list-line">
	{-foreach:$_VI['v_option_set'],$k,$vo-}
			<li>
		{-if:1 == $_VI['v_is_multi']-}
				<label><input type="checkbox" name="vote_item[]" value="{-:$k-}" /> {-:$vo['description']-}</label> <a class="float-right" href="{-:$vo['link']-}" target="_blank">{-:@VIEW_DETAIL-} <i class="icon icon-external-link"></i></a>
		{-else:-}
				<label><input type="radio" name="vote_item" value="{-:$k-}" /> {-:$vo['description']-}</label><a class="float-right" href="{-:$vo['link']-}" target="_blank">{-:@VIEW_DETAIL-} <i class="icon icon-external-link"></i></a>
		{-:/if-}
			</li>
	{-:/foreach-}
		</ul>
		<input type="submit" class="btn"  value="{-:@VOTE-}" />
	</dd>
</dl></form>
{-else:-}
	{-:@VOTE_IS_NOT_ACTIVE-}
{-:/if-}
