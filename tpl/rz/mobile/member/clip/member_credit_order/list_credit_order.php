
{-foreach:$_MCOL,$mco-}
<tr>
	<td>
		<strong>{-:@PRODUCT_NAME-}</strong> {-:$mco['mco_product_name']-}<br />
		<strong>{-:@TIME-}</strong> {-:$mco['mco_add_time']|date~C('APP.TIME_FORMAT'),@me-}<br />
		<strong>{-:@POINTS-}</strong> {-:$mco['mco_points']-}<br />
		<strong>{-:@STATUS-}</strong> 
		{-if:0==$mco['mco_status']-}
		<span class="text-danger">{-:@NOT_PAIED-}</span>
		{-elseif:1==$mco['mco_status']-}
		<span class="text-success">{-:@PAIED-}</span>
		{-:/if-}
	</td>
	<td>
	{-if:!$mco['mco_status']-}
		<a class="btn btn-primary" href="{-url:member_credit_order/pay_credit_order_do?member_credit_order_id={$mco['member_credit_order_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" ><i class="icon icon-credit-card"></i> {-:@PAY-}</a>
	{-:/if-}
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

