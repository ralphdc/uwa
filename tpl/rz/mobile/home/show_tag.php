<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['t_name']-} - {-:@TAG-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_V['ac_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['ac_description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
</head>

<body>
{-include:header-}

<dl class="adl">
	<dt><h5><i class="icon icon-tag"></i> {-:@TAG-} - {-:$_V['t_name']-}</h5></dt>
	<dd>
		<ul class="list-inline text-muted">
			<li><i class="icon icon-archive"></i> {-:$_V['t_archive_count']-}</li>
			<li><i class="icon icon-eye"></i> <script src="{-url:home@tag/get_count?type=view&tag_id={$_V['tag_id']}-}"></script></li>
			<li><i class="icon icon-clock-o"></i> {-:$_V['t_add_time']|date~'Y-m-d',@me-}</li>
			<li><i class="icon icon-refresh"></i> {-:$_V['t_update_time']|date~'Y-m-d',@me-}</li>
		</li><!--/.main_info-->
		<ul id="archiveList" class="aul list-unstyled list-line">
		{-foreach:$_L,$k,$item-}
			<li>
				<a href="{-:$item['a_url_o']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
				<small class="text-muted"><i class="icon icon-eye"></i> {-:$item['a_view_count']-} <i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'m-d',@me-}</small>
			</li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#archiveList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
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
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
{-:$_SITE['stat_code']-}
</body>
</html>
