<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@CREDIT_ORDER-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar_credit-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<dl class="atab_1 adiv">
			<dt><strong {-if:!ARequest::get('mco_status')-}class="on"{-:/if-}><a href="{-url:member_credit_order/list_credit_order-}">{-:@CREDIT_ORDER-}</a></strong><strong {-if:'u'==ARequest::get('mco_status')-}class="on"{-:/if-}><a href="{-url:member_credit_order/list_credit_order?mco_status=u-}">{-:@NOT_PAIED-}</a></strong><strong {-if:'p'==ARequest::get('mco_status')-}class="on"{-:/if-}><a href="{-url:member_credit_order/list_credit_order?mco_status=p-}">{-:@PAIED-}</a></strong></dt>
			<dd class="p_10">
				<table class="listTable">
					<tr>
						<th scope="col">{-:@PRODUCT_NAME-}</th>
						<th scope="col">{-:@TIME-}</th>
						<th scope="col">{-:@POINTS-}</th>
						<th scope="col">{-:@STATUS-}</th>
						<th scope="col">{-:@MANAGE-}</th>
					</tr>
					{-foreach:$_MCOL,$mco-}
					<tr>
						<td><span>{-:$mco['mco_product_name']-}</span></td>
						<td>{-:$mco['mco_add_time']|date~C('APP.TIME_FORMAT'),@me-}</td>
						<td>{-:$mco['mco_points']-}</td>
						<td>
							{-if:0==$mco['mco_status']-}
							<span class="fc_gry">{-:@NOT_PAIED-}</span>
							{-elseif:1==$mco['mco_status']-}
							<span class="fc_g">{-:@PAIED-}</span>
							{-:/if-}
						</td>
						<td>
						{-if:!$mco['mco_status']-}
							<a href="{-url:member_credit_order/pay_credit_order_do?member_credit_order_id={$mco['member_credit_order_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" >{-:@PAY-}</a>
						{-:/if-}
						</td>
					</tr>
					{-:/foreach-}
				</table>
				{-include:../clip/paging-}
			</dd>
		</dl>
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>