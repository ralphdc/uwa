{-if:!empty($_V['msg_err'])-}
	{-:$_V['msg_err']-}
{-else:-}
	{-:$_V['a_a_content']|garble_string~@me-}
{-:/if-}

<!--next page-->
<script>
{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>