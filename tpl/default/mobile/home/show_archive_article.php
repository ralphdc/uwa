<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['a_title']-} - {-:$_V['ac_name']-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_V['a_keywords']-},{-:$_V['ac_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['a_description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
</head>

<body>
{-include:header-}

<div class="grid">
<div class="article">
	<h3>{-:$_V['a_title']-}</h3>
	<ul class="article-meta list-inline">
		<li><i class="icon icon-bookmark"></i> <a href="{-:$_V['ac_url_o']-}">{-:$_V['ac_name']-}</a></li>
		{-if:$_V['a_a_source']-}<li><i class="icon icon-globe"></i> {-:$_V['a_a_source']-}</li>{-:/if-}
		{-if:$_V['a_a_author']-}<li><i class="icon icon-user"></i> {-:$_V['a_a_author']-}</li>{-:/if-}
		<li><i class="icon icon-clock-o"></i> {-:$_V['a_edit_time']|date~'Y-m-d',@me-}</li>
		<li><i class="icon icon-eye"></i> <script src="{-url:home@archive/get_count?type=view&archive_id={$_V['archive_id']}-}"></script></li>
	</ul>
	{-if:$_V['a_keywords']-}<p class="article-meta"><i class="icon icon-tags"></i> {-:$_V['a_keywords']|keywords_to_tag~@me-}</p>{-:/if-}
	{-if:$_V['a_description']-}<p class="article-lead"><i class="icon icon-quote-left"></i> {-:$_V['a_description']-} <i class="icon icon-quote-right"></i></p>{-:/if-}
	<hr class="article-divider">
{-if:!empty($_V['msg_err'])-}
	<div class="alert alert-warning">
		{-:$_V['msg_err']-}
	</div>
{-else:-}
	<div id="aAContent" class="clearfix">
		<div style="float:right;margin:0 0 10px 10px;">
			<uwa:ad id="3">
		</div>
		{-:$_V['a_a_content']|garble_string~@me-}
	</div><!--/.clearfix-->

	<!--next page-->
	{-if:!empty($PAGING['nextPage']['url'])-}
	<div class="grid">
		<span id="viewMore" to="#aAContent" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
	</div>
	{-:/if-}
{-:/if-}

	<!--main interaction-->
	<div class="grid text-center">
		<div class="btn-group">
			<span id="a_support" class="btn"><i class="icon icon-thumbs-up"></i> <span id="a_support_count" class="badge"><script src="{-url:home@archive/get_count?type=support&archive_id={$_V['archive_id']}-}"></script></span></span>
			<span id="a_oppose" class="btn"><span id="a_oppose_count" class="badge"><script src="{-url:home@archive/get_count?type=oppose&archive_id={$_V['archive_id']}-}"></script></span> <i class="icon icon-thumbs-down icon-flip-horizontal"></i></span>
			{-if:$_G['interaction']['report_switch']-}<a class="btn" href="{-url:home@report/add_report?r_item_type=archive&r_item_id={$_V['archive_id']}-}"><i class="icon icon-exclamation-triangle"></i></a>{-:/if-}
			<a class="btn" href="{-url:member@member_favorite/add_favorite_do?archive_id={$_V['archive_id']}-}"><i class="icon icon-star"></i></a>
			<span class="btn" data-modal="{target:'#snsShare'}"><i class="icon icon-share-alt"></i></span>
		</div>
	</div>
	<div id="snsShare" class="modal">
		<div class="modal-dialog">
			<a href="" class="modal-close close"></a>
			<h3>{-:@SHARE_TO-}</h3>
			<div>
				<a title="{-:@SHARE_TO_TQQ-}" ss_share="ss_tqq" class="snsshare btn btn-primary border-circle icon icon-tencent-weibo" href="javascript:void(0)"></a>
				<a title="{-:@SHARE_TO_QZONE-}" ss_share="ss_qzone" class="snsshare btn btn-primary border-circle icon icon-star" href="javascript:void(0)"></a>
				<a title="{-:@SHARE_TO_TSINA-}" ss_share="ss_tsina" class="snsshare btn btn-primary border-circle icon icon-weibo" href="javascript:void(0)"></a>
				<a title="{-:@SHARE_TO_DOUBAN-}" ss_share="ss_douban" class="snsshare btn btn-primary border-circle icon icon-share-alt" href="javascript:void(0)"></a>
				<a title="{-:@SHARE_TO_RENREN-}" ss_share="ss_renren" class="snsshare btn btn-primary border-circle icon icon-renren" href="javascript:void(0)"></a>
				<a title="{-:@SHARE_TO_KAIXIN-}" ss_share="ss_kaixin" class="snsshare btn btn-primary border-circle icon icon-share-alt" href="javascript:void(0)"></a>
			</div>
		</div>
	</div>

</div>
</div>

<div class="grid">
	<ul class="pagination-pager">
	{-if:!empty($_V['a_prev'])-}
		<li class="previous">
			<a href="{-:$_V['a_prev']['a_url']-}">{-:@PREV_ARCHIVE-}</a>
		</li>
	{-else:-}
		<li class="previous disabled">
			<a href="#">{-:@NONE-}</a>
		</li>
	{-:/if-}
	{-if:!empty($_V['a_next'])-}
		<li class="next">
			<a href="{-:$_V['a_next']['a_url']-}">{-:@NEXT_ARCHIVE-}</a>
		</li>
	{-else:-}
		<li class="next disabled">
			<a href="#">{-:@NONE-}</a>
		</li>
	{-:/if-}
	</ul>
</div>

<!--archive review-->
<iframe id="uwa_review" src="{-url:home@archive_review/list_review?type=clip&archive_id={$_V['archive_id']}-}" width="100%" height="auto" scrolling="no" frameborder="0"></iframe>

{-if:!empty($_V['a_related'])-}<dl class="adl">
	<dt><h5><i class="icon icon-flash"></i> {-:@RELATED_CONTENT-}</h5></dt>
	<dd>
		<ul id="archiveList" class="aul list-unstyled list-line">
		<uwa:a_list aid="$_V.a_related" row="5">
			<li>
				<a href="{-:$item['a_url_o']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
				<small class="text-muted"><i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'m-d',@me-}</small>
			</li>
		</uwa:a_list>
		</ul>
	</dd>
</dl>{-:/if-}

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
/*s: support */
var url_support = '{-url:home@archive/get_count?type=do_support&archive_id={$_V['archive_id']}-}';
$('#a_support').click(function() {
	$.getJSON(url_support, function(data) {
		if(data.data == 1) {
			$('#a_support_count').text(parseInt($('#a_support_count').text()) + 1);
		}
		$('#a_support').addClass('active').unbind();
		$('#a_oppose').addClass('disabled').unbind();
	});
});
/*e: support */
/*s: oppose */
var url_oppose = '{-url:home@archive/get_count?type=do_oppose&archive_id={$_V['archive_id']}-}';
$('#a_oppose').click(function() {
	$.getJSON(url_oppose, function(data) {
		if(data.data == 1) {
			$('#a_oppose_count').text(parseInt($('#a_oppose_count').text()) + 1);
		}
		$('#a_oppose').addClass('active').unbind();
		$('#a_support').addClass('disabled').unbind();
	});
});
/*e: oppose */

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/snsshare.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
