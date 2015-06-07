<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@TAG-} - {-:$_SITE['name']-}</title>
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
	<dt><h5><i class="icon icon-tags"></i> {-:@LATEST-} {-:@TAG-}</h5></dt>
	<dd>
		<ul class="list-inline">
		{-foreach:$_L['latest'],$k,$item-}
			<li><a href="{-:$item['t_url']-}" class=""><i class="icon icon-tag"></i> {-:$item['t_name']-}</a></li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-tags"></i> {-:@MOST_ARCHIVE-} {-:@TAG-}</h5></dt>
	<dd>
		<ul class="list-inline">
		{-foreach:$_L['most_archive'],$k,$item-}
			<li><a href="{-:$item['t_url']-}" class=""><i class="icon icon-tag"></i> {-:$item['t_name']-}</a></li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-tags"></i> {-:@MOST_VIEW_7D-} {-:@TAG-}</h5></dt>
	<dd>
		<ul class="list-inline">
		{-foreach:$_L['most_view_7d'],$k,$item-}
			<li><a href="{-:$item['t_url']-}" class=""><i class="icon icon-tag"></i> {-:$item['t_name']-}</a></li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-tags"></i> {-:@MOST_VIEW-} {-:@TAG-}</h5></dt>
	<dd>
		<ul class="list-inline">
		{-foreach:$_L['most_view'],$k,$item-}
			<li><a href="{-:$item['t_url']-}" class=""><i class="icon icon-tag"></i> {-:$item['t_name']-}</a></li>
		{-:/foreach-}
		</ul>
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
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
{-:$_SITE['stat_code']-}
</body>
</html>
