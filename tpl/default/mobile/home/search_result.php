<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@SEARCH-} {-:$keyword-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$keyword-},{-:$_SITE['keywords']-}" />
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
	<dt><h5><i class="icon icon-search"></i> {-:@SEARCH-} {-:$keyword-}</h5></dt>
	<dd>
		<ul id="searchResultList" class="list-unstyled list-line">
		{-foreach:$_L,$k,$item-}
			<li>
				<h5><a class="text-primary" href="{-:$item['a_url_o']-}">{-:$item['a_title']-}</a></h5>
				<p class="margin-remove">{-:$item['a_description']-}</p>
				<p class="margin-remove text-muted"><i class="icon icon-globe"></i> <small><a class="text-success" target="_blank" href="{-:$item['a_url_o']-}">{-:$item['a_url_o']|substr~@me,0,16-} ... {-:$item['a_url_o']|substr~@me,-24-}</a></small></p>
				<p class="margin-remove text-muted"><span><i class="icon icon-bookmark"></i> <a class="text-primary" target="_blank" href="{-:$item['ac_url_o']-}">{-:$item['ac_name']-}</a></span> <span><i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'Y-m-d',@me-}</span></p>
			</li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#searchResultList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
</div>
{-:/if-}

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
var result_id = 'searchResultList', keyword = '{-:$keyword-}';

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/s.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
