<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@GUESTBOOK-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/g.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div id="main" class="m w_960">
	<div class="w_190 f_l">
		<ul class="aul_1">
		<uwa:sp_list row="10">
			<li class="a"><a href="{-:$item['sp_url']-}">{-:$item['sp_title']-}</a></li>
		</uwa:sp_list>
		</ul>
		<div class="hr_l"></div>
	</div>
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l bg_wht">
		<dl class="atab">
		<dt><strong>{-:@GUESTBOOK_LIST-}</strong><strong>{-:@ADD_GUESTBOOK-}</strong></dt>
		<dd>
			<div class="tabCntnt p_20">
				<ul class="guestbook_list">
				{-foreach:$_L,$item-}
					<li>
						<div class="guestbook_main">
							<p class="guestbook_info">
								<span class="fw_b">{-:$item['g_author']-}</span>
								<span class="fc_gry">{-:$item['g_add_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
							</p>
							<p class="guestbook_content">
								{-:$item['g_content']-}
							</p>
						</div>
						{-if:$item['g_reply']-}<div class="guestbook_reply">
							<p>
								<strong>{-:@REPLY-}:</strong> {-:$item['g_reply']-}
							</p>
						</div>{-:/if-}
					</li>
				{-:/foreach-}
				</ul>
				{-include:clip/paging-}
			</div>
			<div class="tabCntnt p_20">
			<form id="guestbook_add" action="{-url:home@guestbook/add_guestbook_do-}" method="post"><ul class="aul_form">
				<li>
					<strong>{-:@NAME-}</strong>
					<label for="g_author"><input type="text" name="g_author" class="i required" value="{-:+m_username-}" size="20" maxlength="64"></label>
				</li>
				<li>
					<strong>{-:@CONTENT-}</strong>
					<label><textarea class="i required" style="width:360px;height:90px;" name="g_content"></textarea></label>
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
			</div><!--/.tabCntnt-->
		</dd>
		</dl>
	</div>
	<div class="c"></div>
</div><!--/#main-->
{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>