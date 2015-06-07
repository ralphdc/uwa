<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['a_title']-} {-:@REVIEW_LIST-} - {-:$_SITE['name']-}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
</head>

<body>
<div id="uwa_review">

<dl class="adl margin-top-sm">
	<dt>
		<h5><i class="icon icon-comments"></i> {-:@REVIEW_LIST-}</h5>
		<span class="float-right"><a href="{-url:home@archive_review/list_review?archive_id={$_V['archive_id']}-}" target="_parent">{-:@ALL_REVIEW-} <i class="icon icon-share-square"></i></a></span>
	</dt>
	<dd>
		<ul class="list-unstyled list-line margin-remove-bottom">
		{-foreach:$_L,$item-}
			<li>
				<div class="article">
					<p class="article-meta">
						<span><i class="icon icon-user"></i> {-:$item['ar_author']-}</span>
						<span><i class="icon icon-clock-o"></i> {-:$item['ar_add_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
						<span class="review_support btn btn-sm" archive_review_id="{-:$item['archive_review_id']-}"><i class="icon icon-thumbs-o-up"></i> <span class="badge">{-:$item['ar_support_count']-}</span></span>
						<span class="review_oppose btn btn-sm" archive_review_id="{-:$item['archive_review_id']-}"><span class="badge">{-:$item['ar_oppose_count']-}</span> <i class="icon icon-thumbs-o-down icon-flip-horizontal"></i></span>
					</p>
					<p>{-:$item['ar_content']-}</p>
				</div><!--/.review_main-->
				{-if:$item['ar_reply']-}<div class="alert">
					<p><strong>{-:@REPLY-}:</strong> {-:$item['ar_reply']-}</p>
				</div><!--/.review_reply-->{-:/if-}
			</li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-edit"></i> {-:@ADD_REVIEW-}</h5></dt>
	<dd>
	{-if:!empty($_V['msg_err'])-}
		<div class="alert alert-warning">
			{-:$_V['msg_err']-}
		</div>
	{-else:-}
		<form class="form" action="{-url:home@archive_review/add_review_do-}" method="post">
			<fieldset>
				<div class="form-group">
					<label class="control-label">{-:@CONTENT-}</label>
					<textarea required class="control-input required" style="height:150px;" name="ar_content" placeholder="{-:@REVIEW_CONTENT_TIP-}"></textarea>
				</div>
			</fieldset>
			{-if:$_G['interaction']['captcha']-}<div class="grid">
				<div class="row">
					<div class="col-sm-4"><input required="required" type="text" placeholder="{-:@CAPTCHA-}" name="vcode" autocomplete="off" value="" class="required control-input" size="5" maxlength="5"></div>
					<div class="col-sm-8 text-muted"><img src="{-url:home@common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> {-:@CAPTCHA_TIP-}</div>
				</div>
			</div>{-:/if-}
			<input name="archive_id" type="hidden" value="{-:$_V['archive_id']-}">
			<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
			<input name="token" type="hidden" value="{-:$_TK['token']-}">
			<input type="submit" class="btn btn-block" value="{-:@SUBMIT-}" />
		</form>
	{-:/if-}
	</dd>
</dl>

</div>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
/*s: review iframe height */
$(document).ready(function() {
	H();
});
function H() {
	$(window.parent.document).find('#uwa_review').height($("#uwa_review").height());
}
/*e: review iframe height */

/*s: support and oppose*/
$('.review_support').click(function() {
	var archive_review_id = $(this).attr('archive_review_id'),
		url_support = '{-url:home@archive_review/get_count?type=do_support-}';
	$.getJSON(url_support, {archive_review_id:archive_review_id}, function(data) {
		if(data.data == 1) {
			$('.review_support[archive_review_id='+archive_review_id+'] span').text(parseInt($('.review_support[archive_review_id='+archive_review_id+'] span').text()) + 1);
		}
		$('.review_support[archive_review_id='+archive_review_id+']').addClass('active').unbind();
		$('.review_oppose[archive_review_id='+archive_review_id+']').addClass('disabled').unbind();
	});
});
$('.review_oppose').click(function() {
	var archive_review_id = $(this).attr('archive_review_id'),
		url_support = '{-url:home@archive_review/get_count?type=do_oppose-}';
	$.getJSON(url_support, {archive_review_id:archive_review_id}, function(data) {
		if(data.data == 1) {
			$('.review_oppose[archive_review_id='+archive_review_id+'] span').text(parseInt($('.review_oppose[archive_review_id='+archive_review_id+'] span').text()) + 1);
		}
		$('.review_oppose[archive_review_id='+archive_review_id+']').addClass('active').unbind();
		$('.review_support[archive_review_id='+archive_review_id+']').addClass('disabled').unbind();
	});
});
/*e: support and oppose*/
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>