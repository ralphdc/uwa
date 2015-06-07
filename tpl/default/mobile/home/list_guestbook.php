<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@GUESTBOOK-} - {-:$_SITE['name']-}</title>
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

<uwa:sp_list row="10">
	{-if:0==$k-}
<ul id="channelNav" class="subnav subnav-pill subnav-justified margin-top-sm">
	{-elseif:0==$k%5-}
</ul>
<ul id="channelNav" class="subnav subnav-pill subnav-justified">
	{-:/if-}
	<li><a href="{-:$item['sp_url_o']-}"><h6>{-:$item['sp_title']-}</h6></a></li>
</uwa:sp_list>
</ul>

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-book"></i> {-:@GUESTBOOK_LIST-}</h5></dt>
	<dd>
		<ul id="guestbookList" class="list-unstyled list-line margin-remove-bottom">
		{-foreach:$_L,$item-}
			<li>
				<div class="article">
					<p class="article-meta">
						<span><i class="icon icon-user"></i> {-:$item['g_author']-}</span>
						<span><i class="icon icon-clock-o"></i> {-:$item['g_add_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
					</p>
					<p>{-:$item['g_content']-}</p>
				</div><!--/.guestbook_main-->
				{-if:$item['g_reply']-}<div class="alert">
					<p><strong>{-:@REPLY-}:</strong> {-:$item['g_reply']-}</p>
				</div><!--/.guestbook_reply-->{-:/if-}
			</li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#guestbookList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
</div>
{-:/if-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-edit"></i> {-:@ADD_GUESTBOOK-}</h5></dt>
	<dd>
		<form class="form" action="{-url:home@guestbook/add_guestbook_do-}" method="post">
			<fieldset>
				<div class="form-group">
					<label class="control-label">{-:@NAME-}</label>
					<input required="required" type="text" value="{-:+m_username-}" name="g_author" class="control-input" maxlength="40">
				</div>
				<div class="form-group">
					<label class="control-label">{-:@CONTENT-}</label>
					<textarea required="required" class="control-input required" style="height:150px;" name="g_content"></textarea>
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
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
{-:$_SITE['stat_code']-}
</body>
</html>
