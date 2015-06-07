<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['ac_name']-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_V['ac_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['ac_description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/swiper.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/i.css" />
</head>

<body>
{-include:header-}

{-foreach:$_V['ac_sibling'],$k,$item-}
	{-if:0==$k-}
<ul id="channelNav" class="subnav subnav-pill subnav-justified margin-top-sm margin-bottom-sm">
	{-elseif:0==$k%4-}
</ul>
<ul id="channelNav" class="subnav subnav-pill subnav-justified margin-top-sm margin-bottom-sm">
	{-:/if-}
	<li class="a{-if:$AC_ID == $item['archive_channel_id']-} active{-:/if-}"><a href="{-:$item['ac_url_o']-}"><h6>{-:$item['ac_name']-}</h6></a></li>
{-:/foreach-}
</ul>

<div class="swiper-container">
	<div class="swiper-wrapper">
	<uwa:a_list row="5" flag="s">
		<div class="swiper-slide">
			<a href="{-:$item['a_url_o']-}"><img src="{-:$item['a_thumb']-}" ></a>
			<div class="title">{-:$item['a_title']-}</div>
		</div>
	</uwa:a_list>
	</div>
	<div class="pagination"></div>
</div>

<div class="grid">
	<div class="row">
		<div class="col-md-6">
			<div class="big_news text-center">
			<uwa:a_list row="3" flag="h">
			{-if:0==$k-}
				<h4><a href="{-:$item['a_url_o']-}"><strong>{-:$item['a_title']-}</strong></a></h4>
			{-else:-}
				<h6><a href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></h6>
			{-:/if-}
			</uwa:a_list>
			<uwa:a_list row="3" flag="a">
			{-if:0==$k-}
				<h5><a href="{-:$item['a_url_o']-}"><strong>{-:$item['a_title']-}</strong></a></h5>
			{-else:-}
				<p><a href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></p>
			{-:/if-}
			</uwa:a_list>
			</div>
		</div>
		<div class="col-md-6">
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
	</div>
</div>

<uwa:ad id="5">

<div class="grid">
	<div class="row">
		<uwa:ac_list>
		<div class="col-md-6">
			<dl class="adl">
				<dt><h5><i class="icon icon-bookmark"></i> {-:$channel['ac_name']-}</h5><span class="float-right"><a href="{-:$channel['ac_url_o']-}">{-:@MORE-}</a></span></dt>
				<dd>
				<ul class="aul list-unstyled list-line">
					<uwa:a_list issub='yes' row="10">
					<li><a href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></li>
					</uwa:a_list>
				</ul>
				<a class="btn btn-block" href="{-:$channel['ac_url_o']-}">{-:@ENTER_CHANNEL-} <i class="icon icon-angle-double-right"></i></a>
				</dd>
			</dl>
		</div>
		{-if:1==$key%2-}
	</div>
	<div class="row">
		{-:/if-}
		</uwa:ac_list>
	</div>
</div>

<div class="grid">
	<div class="row">
		<dl class="adl col-md-12">
			<dt><h5><i class="icon icon-image"></i> {-:@PICTURE_NEWS-}</h5></dt>
			<dd>
				<div class="row">
				<uwa:a_list flag='p' row="4">
					<div class="col-sm-6 col-md-3">
						<a class="thumb thumb-expand" href="{-:$item['a_url_o']-}">
						<img class="a" src="{-:$item['a_thumb']-}" />
						<div class="thumb-caption">{-:$item['a_title']|AString::utf8_substr~@me,36-}</div></a>
					</div>
				</uwa:a_list>
				</div>
			</dd>
		</dl>
	</div>
</div>

{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script src="{-:*__THEME__-}home/js/swiper.js"></script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
<script src="{-:*__THEME__-}home/js/i.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
{-:$_SITE['stat_code']-}
</body>
</html>
