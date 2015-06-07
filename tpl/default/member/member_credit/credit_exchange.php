<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@CREDIT_EXCHANGE-} - {-:$_SITE['name']-}</title>
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
		<div class="w_500 f_l">
			<table class="listTable">
				<tr>
					<th scope="col">{-:@CREDIT_TYPE-}</th>
					<th scope="col">{-:@CURRENT-}</th>
					<th scope="col">{-:@RATIO-}</th>
				</tr>
				{-foreach:$_MCTL,$ct-}
				<tr>
					<td><i class="ai ai_16 ai_16_credit"></i> {-:$ct['mct_name']-}</td>
					<td><span class="fw_b fc_g">{-:$_MI[$ct['mct_alias']]-}</span> {-:$ct['mct_unit']-}</td>
					<td>
						{-if:$ct['mct_exchange']-}
						<span>{-:@POINTS-} : {-:$ct['mct_name']-} = {-:$ct['mct_ratio']-} : 1</span>
						{-else:-}
						<span class="fc_r">{-:@EXCHANGE_IS_OFF-}</span>
						{-:/if-}
					</td>
				</tr>
				{-:/foreach-}
			</table>
		</div><!--/.w_500-->
		<div class="w_10 h_10 o_h f_l">&nbsp;</div>
		<div class="w_250 f_l">
			<div class="member_info">
				{-:@POINTS-}: <span class="fw_b fc_g">{-:$_MI['m_points']-}</span>
			</div><!--/.member_info-->
		</div><!--/.w_250-->
		<div class="h_10 o_h c"></div>
		<div class="adiv p_10">
			<form id="credit_exchange" action="{-url:member_credit/credit_exchange_do-}" method="post"><table class="formTable">
				<tr>
					<td class="inputTitle">{-:@EXCHANGE_AMOUNT-}</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<input id="amount" class="required i" type="text" size="10" name="amount" />
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@CREDIT_TYPE-}</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><select id="mct_alias" name="mct_alias">
						{-foreach:$_MCTL,$ct-}
							{-if:$ct['mct_exchange']-}<option value="{-:$ct['mct_alias']-}">{-:$ct['mct_name']-}</option>{-:/if-}
						{-:/foreach-}
						</select></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@EXCHANGE_TYPE-}</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><select id="type" name="type">
							<option value="ctp">{-:@CREDIT_TO_POINTS-}</option>
							<option value="ptc">{-:@POINTS_TO_CREDIT-}</option>
						</select></label>
					</td>
				</tr>
				{-if:$_G['interaction']['captcha']-}
				<tr>
					<td class="inputTitle">{-:@CAPTCHA-}</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
					<label>
						<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
						<img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" />
						<span class="fc_gry">{-:@CAPTCHA_TIP-}</span>
					</label>
					</td>
				</tr>{-:/if-}
				<tr>
					<td colspan="2" class="operation">
					<label>
						<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
						<input name="token" type="hidden" value="{-:$_TK['token']-}">
						<input type="submit" class="btn_b" value="{-:@SUBMIT-}" />
						<input class="btn_l" type="reset" value="{-:@RESET-}" />
					</label>
					</td>
				</tr>
			</table></form>
		</div>
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
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
	/*e: form check */
});

document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>