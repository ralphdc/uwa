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
{-include:header-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-comments"></i> {-:@REVIEW_LIST-}</h5><span class="align-right"><a href="{-:$_V['a_url_o']-}"><i class="icon icon-reply"></i> {-:@BACKTO-}</a></span></dt>
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

<!--prev and next page-->
<div class="grid">
	<ul class="pagination-pager">
	{-if:!empty($PAGING['prevPage']['url'])-}
		<li class="previous">
			<a href="{-:$PAGING['prevPage']['url']-}">{-:@_PREV_PAGE_-}</a>
		</li>
	{-else:-}
		<li class="previous disabled">
			<a href="#">{-:@NONE-}</a>
		</li>
	{-:/if-}
	{-if:!empty($PAGING['nextPage']['url'])-}
		<li class="next">
			<a href="{-:$PAGING['nextPage']['url']-}">{-:@_NEXT_PAGE_-}</a>
		</li>
	{-else:-}
		<li class="next disabled">
			<a href="#">{-:@NONE-}</a>
		</li>
	{-:/if-}
	</ul>
</div>

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
					<textarea required="required" class="control-input required" style="height:150px;" name="ar_content" placeholder="{-:@REVIEW_CONTENT_TIP-}"></textarea>
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

<uwa:ad id="5">

<div class="grid">
	<ul class="subnav subnav-tab subnav-justified atab" data-switcher="{'connect':'#archive_clh'}">
		<li><a href="#"><h5 class="text-primary"><i class="icon icon-star"></i> {-:@COMMEND-}</h5></a></li>
		<li><a href="#"><h5 class="text-success"><i class="icon icon-leaf"></i> {-:@LATEST-}</h5></a></li>
		<li><a href="#"><h5 class="text-danger"><i class="icon icon-fire"></i> {-:@HOT-}</h5></a></li>
	</ul>
	<div id="archive_clh" class="switcher">
		<ul class="aul list-unstyled list-line">
		<uwa:a_list flag="c" titlelen="30" row="4">
			<li>[<a href="{-:$item['ac_url_o']-}">{-:$item['ac_name']-}</a>] <a href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></li>
		</uwa:a_list>
		</ul>
		<ul class="aul list-unstyled list-line">
		<uwa:a_list orderby="a_edit_time" order="desc" titlelen="30" row="4">
			<li>[<a href="{-:$item['ac_url_o']-}">{-:$item['ac_name']-}</a>] <a href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></li>
		</uwa:a_list>
		</ul>
		<ul class="aul list-unstyled list-line">
		<uwa:a_list orderby="a_view_count" order="desc" titlelen="30" row="4">
			<li>[<a href="{-:$item['ac_url_o']-}">{-:$item['ac_name']-}</a>] <a href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></li>
		</uwa:a_list>
		</ul>
	</div>
</div>

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
