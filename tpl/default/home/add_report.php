<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['item_title']-} {-:@REPORT-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div class="m w_960">
	<dl class="adl">
		<dt><strong>{-:@ADD_REPORT-}</strong></dt>
		<dd class="p_20">
		<form id="add_report" action="{-url:home@report/add_report_do-}" method="post">
		<ul class="aul_form">
			<li><strong></strong> <label><a href="{-:$_V['item_url']-}">{-:$_V['item_title']-}</a></label></li>
			<li><strong>{-:@DETAIL-}</strong> <label><textarea class="required i" style="width:360px;height:90px;" placeholder="{-:@REPORT_DETAIL_TIP-}" name="r_info"></textarea> <span class="fc_r">*</span></label></li>
			{-if:$_G['interaction']['captcha']-}<li>
				<strong>{-:@CAPTCHA-}</strong> <label>
				<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
				<img src="{-url:home@common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" />
				<span class="fc_gry">{-:@CAPTCHA_TIP-}</span>
			</label></li>{-:/if-}
			<li><strong></strong> <label>
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<input name="r_item_type" type="hidden" value="{-:$_V['r_item_type']-}" />
				<input name="r_item_id" type="hidden" value="{-:$_V['r_item_id']-}" />
				<input type="submit" class="btn_b" value="{-:@SUBMIT-}" />
			</label></li>
		</ul><!--/.aul_form-->
		</form>
		</dd>
	</dl>
</div>
{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/placeholder.js"></script>
<script>
$(document).ready(function() {
	$('[placeholder]').placeholder({useNative: false, hideOnFocus: true});
});

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>