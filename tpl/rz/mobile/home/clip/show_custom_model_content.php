{-if:!empty($_V['msg_err'])-}
	{-:$_V['msg_err']-}
{-else:-}
	{-foreach:$_V['cm_field'],$field,$params-}
		{-if:isset($params['f_is_paging']) and (1 == $params['f_is_paging'])-}
			{-:$_V[$field]-}
		{-:/if-}
	{-:/foreach-}
{-:/if-}

<!--next page-->
<script>
{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>