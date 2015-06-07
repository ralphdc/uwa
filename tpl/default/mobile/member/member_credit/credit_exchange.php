<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@CREDIT_EXCHANGE-} - {-:$_SITE['name']-}</title>
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
	<table class="table table-bordered">
		<tr>
			<th scope="col">{-:@CREDIT_TYPE-}</th>
			<th scope="col">{-:@CURRENT-}</th>
			<th scope="col">{-:@RATIO-}</th>
		</tr>
		{-foreach:$_MCTL,$ct-}
		<tr>
			<td><i class="icon icon-dot-circle-o"></i> {-:$ct['mct_name']-}</td>
			<td><strong class="text-success">{-:$_MI[$ct['mct_alias']]-}</strong> {-:$ct['mct_unit']-}</td>
			<td>
				{-if:$ct['mct_exchange']-}
				<span>{-:@POINTS-} : {-:$ct['mct_name']-} = {-:$ct['mct_ratio']-} : 1</span>
				{-else:-}
				<span class="text-danger">{-:@EXCHANGE_IS_OFF-}</span>
				{-:/if-}
			</td>
		</tr>
		{-:/foreach-}
	</table>
	<div class="alert">
		{-:@POINTS-}: <strong class="text-success">{-:$_MI['m_points']-}</strong>
	</div>
	<div id="creditExchange" class="margin-top-sm">
		<form id="credit_exchange" action="{-url:member_credit/credit_exchange_do-}" method="post" class="form">
			<div class="form-group">
				<label class="control-label">{-:@EXCHANGE_AMOUNT-}</label>
				<input id="amount" required="required" class="control-input required" type="text" size="10" name="amount" />
			</div>
			<div class="form-group">
				<label class="control-label">{-:@CREDIT_TYPE-}</label>
				<select id="mct_alias" name="mct_alias" class="control-input">
				{-foreach:$_MCTL,$ct-}
					{-if:$ct['mct_exchange']-}<option value="{-:$ct['mct_alias']-}">{-:$ct['mct_name']-}</option>{-:/if-}
				{-:/foreach-}
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@EXCHANGE_TYPE-}</label>
				<select id="type" name="type" class="control-input">
					<option value="ctp">{-:@CREDIT_TO_POINTS-}</option>
					<option value="ptc">{-:@POINTS_TO_CREDIT-}</option>
				</select>
			</div>
			{-if:$_G['interaction']['captcha']-}<div class="grid">
				<div class="row">
					<div class="col-sm-4"><input required="required" type="text" placeholder="{-:@CAPTCHA-}" name="vcode" autocomplete="off" value="" class="required control-input" size="5" maxlength="5"></div>
					<div class="col-sm-8 text-muted"><img src="{-url:home@common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> {-:@CAPTCHA_TIP-}</div>
				</div>
			</div>{-:/if-}
			<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
			<input name="token" type="hidden" value="{-:$_TK['token']-}">
			<input type="submit" class="btn btn-block" value="{-:@SUBMIT-}" />
		</form>
	</div>
</div>

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
$(document).ready(function() {
	/*s: form check */
	$('#credit_exchange').submit(function() {
		if('' == $('#amount').val()) {
			$('#amount').focus();
			alert("{-:@EXCHANGE_AMOUNT_NOT_NULL-}");
			return false;
		}
	})
});

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
