<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@CREDIT_ORDER-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
{-include:../header-}

<div class="grid">
	<ul class="subnav subnav-tab">
		<li{-if:!ARequest::get('mco_status')-} class="active"{-:/if-}><a href="{-url:member_credit_order/list_credit_order-}">{-:@CREDIT_ORDER-}</a></li>
		<li{-if:'u'==ARequest::get('mco_status')-} class="active"{-:/if-}><a href="{-url:member_credit_order/list_credit_order?mco_status=u-}">{-:@NOT_PAIED-}</a></li>
		<li{-if:'p'==ARequest::get('mco_status')-} class="active"{-:/if-}><a href="{-url:member_credit_order/list_credit_order?mco_status=p-}">{-:@PAIED-}</a></li>
	</ul>
</div>

<table id="creditOrderList" class="table">
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
</table>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#creditOrderList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
</div>
{-:/if-}

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
function get_notify(notify_id) {
	if($('#notify_status_' + notify_id + ' span').hasClass("text-success")) {
		$.get('{-url:member_notify/read_notify-}', {member_notify_id : notify_id}, function(data) {
			$('#notify_status_' + notify_id).html('<span class="text-muted">{-:@HAVE_READ-}</span>');
		});
	}
	$('#notify_' + notify_id).toggle();
}

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
