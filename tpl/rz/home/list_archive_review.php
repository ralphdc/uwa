<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['a_title']-} {-:@REVIEW_LIST-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/r.css" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div id="uwa_review" class="m w_960">
	<dl class="adl">
		<dt><strong>{-:@REVIEW_LIST-}</strong><span><a href="{-:$_V['a_url']-}">{-:@BACKTO-} {-:$_V['a_title']-}</a></span></dt>
		<dd>
		<ul class="review_list">
		{-foreach:$_L,$item-}
			<li>
				<div class="review_main">
					<p class="review_info">
						<span class="fw_b">{-:$item['ar_author']-}</span>
						<span class="fc_gry">{-:$item['ar_add_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
						<span class="review_support a" archive_review_id="{-:$item['archive_review_id']-}"><i>{-:@SUPPORT-}</i>[<b class="fc_g">{-:$item['ar_support_count']-}</b>]</span>
						<span class="review_oppose a" archive_review_id="{-:$item['archive_review_id']-}"><i>{-:@OPPOSE-}</i>[<b class="fc_r">{-:$item['ar_oppose_count']-}</b>]</span>
					</p>
					<p class="review_content">
						{-:$item['ar_content']-}
					</p>
				</div><!--/.review_main-->
				{-if:$item['ar_reply']-}<div class="review_reply">
					<p>
						<strong>{-:@REPLY-}:</strong> {-:$item['ar_reply']-}
					</p>
				</div><!--/.review_reply-->{-:/if-}
			</li>
		{-:/foreach-}
		</ul><!--/.review_list-->
		{-include:clip/paging-}
		</dd>
	</dl>
	<div class="h_10 o_h"></div>
	<dl class="adl">
		<dt><strong>{-:@ADD_REVIEW-}</strong></dt>
		<dd>
		{-if:!empty($_V['msg_err'])-}
			<div class="msg_err">
				{-:$_V['msg_err']-}
			</div>
		{-else:-}
		<form id="review_add" action="{-url:home@archive_review/add_review_do-}" method="post"><ul class="aul_form">
			<li>
				<strong>{-:@CONTENT-}</strong>
				<label><textarea class="i required" style="width:400px;height:150px;" name="ar_content" placeholder="{-:@REVIEW_CONTENT_TIP-}"></textarea></label>
			</li>
			{-if:$_G['interaction']['captcha']-}<li>
				<strong>{-:@CAPTCHA-}</strong>
				<label>
					<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
					<img src="{-url:home@common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" />
					<span class="fc_gry">{-:@CAPTCHA_TIP-}</span>
				</label></li>{-:/if-}
			<li>
				<strong></strong>
				<label>
					<input name="archive_id" type="hidden" value="{-:$_V['archive_id']-}">
					<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
					<input name="token" type="hidden" value="{-:$_TK['token']-}">
					<input type="submit" class="btn_b" value="{-:@SUBMIT-}" />
				</label>
			</li>
		</ul></form>
		{-:/if-}
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
/*s: support and oppose*/
$('.review_support').click(function() {
	var archive_review_id = $(this).attr('archive_review_id'),
		url_support = '{-url:home@archive_review/get_count?type=do_support-}';
	$.getJSON(url_support, {archive_review_id:archive_review_id}, function(data) {
		if(data.data == 1) {
			$('.review_support[archive_review_id='+archive_review_id+'] b').text(parseInt($('.review_support[archive_review_id='+archive_review_id+'] b').text()) + 1);
		}
		$('.review_support[archive_review_id='+archive_review_id+'], .review_oppose[archive_review_id='+archive_review_id+']').removeClass('a').unbind();
		$('.review_support[archive_review_id='+archive_review_id+'] i').text(data.info);
	});
});
$('.review_oppose').click(function() {
	var archive_review_id = $(this).attr('archive_review_id'),
		url_support = '{-url:home@archive_review/get_count?type=do_oppose-}';
	$.getJSON(url_support, {archive_review_id:archive_review_id}, function(data) {
		if(data.data == 1) {
			$('.review_oppose[archive_review_id='+archive_review_id+'] b').text(parseInt($('.review_oppose[archive_review_id='+archive_review_id+'] b').text()) + 1);
		}
		$('.review_support[archive_review_id='+archive_review_id+'], .review_oppose[archive_review_id='+archive_review_id+']').removeClass('a').unbind();
		$('.review_oppose[archive_review_id='+archive_review_id+'] i').text(data.info);
	});
});
/*e: support and oppose*/

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>