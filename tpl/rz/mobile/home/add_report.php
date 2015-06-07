<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['item_title']-} {-:@REPORT-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
</head>

<body>
{-include:header-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-plus"></i> {-:@ADD_REPORT-}</h5><span class="align-right"><a href="{-:$_V['item_url']-}"><i class="icon icon-reply"></i> {-:@BACKTO-}</a></span></dt>
	<dd>
		<form class="form" action="{-url:home@report/add_report_do-}" method="post">
			<fieldset>
				<div class="form-group">
					<label class="control-label">{-:@DETAIL-}</label>
					<textarea required="required" class="control-input required" style="height:150px;" name="r_info" placeholder="{-:@REPORT_DETAIL_TIP-}"></textarea>
				</div>
			</fieldset>
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
	</dd>
</dl>

<uwa:ad id="5">

{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
<script>
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

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
{-:$_SITE['stat_code']-}
</body>
</html>
