<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@APPLY_FLINK-} - {-:$_SITE['name']-}</title>
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
		<dt><strong>{-:@APPLY_FLINK-}</strong><span><a href="{-url:home@flink/list_flink-}">{-:@ALL_FLINK-}</a></span></dt>
		<dd class="p_20">
		<form id="apply_flink" action="{-url:home@flink/apply_flink_do-}" method="post"><ul class="aul_form">
			<li>
				<strong>{-:@SITE_NAME-}</strong>
				<label><input class="required i" type="text" size="20" placeholder="{-:@FLINK_SITE_NAME_TIP-}" name="f_site_name" /> <span class="fc_r">*</span></label>
			</li>
			<li>
				<strong>{-:@SITE_URL-}</strong>
				<label><input class="required i" type="text" size="50" placeholder="{-:@FLINK_SITE_URL_TIP-}" value="http://" name="f_site_url" /> <span class="fc_r">*</span></label>
			</li>
			<li>
				<strong>{-:@SITE_LOGO-}</strong>
				<label><input class="i" type="text" size="50" placeholder="{-:@FLINK_SITE_LOGO_TIP-}" name="f_site_logo" /></label>
			</li>
			<li>
				<strong>{-:@WEBMASTER_EMAIL-}</strong>
				<label><input class="required i" type="text" size="30" placeholder="{-:@FLINK_WEBMASTER_EMAIL_TIP-}" name="f_webmaster_email" /> <span class="fc_r">*</span></label>
			</li>
			<li>
				<strong>{-:@SITE_DESCRIPTION-}</strong>
				<label><textarea class="required i" style="width:360px;height:90px;" placeholder="{-:@FLINK_SITE_DESCRIPTION_TIP-}" name="f_site_description"></textarea> <span class="fc_r">*</span></label>
			</li>
			{-if:$_G['interaction']['captcha']-}<li>
				<strong>{-:@CAPTCHA-}</strong>
				<label>
					<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
					<img src="{-url:home@common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" />
					<span class="fc_gry">{-:@CAPTCHA_TIP-}</span>
				</label>
			</li>{-:/if-}
			<li>
				<strong></strong>
				<label>
					<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
					<input name="token" type="hidden" value="{-:$_TK['token']-}">
					<input type="submit" class="btn_b" value="{-:@SUBMIT-}" />
				</label>
			</li>
		</ul></form>
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