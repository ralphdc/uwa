{-foreach:$_L,$f-}
<li>
	<dl class="dl-horizontal">
		<dt>
		{-if:1==$f['f_show_type']-}
			<a class="fc_b fs_13" href="{-:$f['f_site_url']-}"><img src="{-:$f['f_site_logo']-}" /></a>
		{-else:-}
			<a class="fc_b fs_13" href="{-:$f['f_site_url']-}">{-:$f['f_site_name']-}</a>
		{-:/if-}
		</dt>
		<dd class="text-muted">
			<i class="icon icon-bookmark"></i> <span class="badge">{-:$f['fc_name']-}</span><br>
			<i class="icon icon-globe"></i> <code>{-:$f['f_site_url']-}</code><br>
			<i class="icon icon-quote-left"></i> <span>{-:$f['f_site_description']|AString::utf8_substr~@me,36-}</span>
		</dd>
	</dl>
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