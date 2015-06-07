<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['v_name']-} - {-:@VOTE_RESULT-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['v_name']-}" />
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
	<h3>{-:$_V['v_name']-} - {-:@VOTE_RESULT-}</h3>
	<ul class="article-meta list-inline">
		<li><i class="icon icon-calendar"></i>
			{-if:0 == $_V['v_time_limit']-}
				{-:@NOT_LIMIT-}
			{-elseif:1 == $_V['v_time_limit']-}
				{-:$_V['v_start_time']|date~'Y-m-d',@me-} ~ {-:$_V['v_end_time']|date~'Y-m-d',@me-}
			{-:/if-}
		</li>
		<li><i class="icon icon-trophy"></i> {-:$_V['v_votes']-}</li>
	</ul>
	{-if:$_V['v_description']-}<div class="article-lead">{-:$_V['v_description']-}</div>{-:/if-}
	<hr class="article-divider">
	{-php:$_status = array('default', 'primary', 'success', 'warning', 'danger');-}
	<div class="aul_vote">
	{-foreach:$_V['v_option_set'],$k,$vo-}
		<h6>{-:$vo['description']-} ({-:$vo['votes']-} {-:@VOTES-} | {-:$vo['percentage']-}%)</h6>
		<div class="progress progress-striped">
			<div class="progress-bar progress-bar-{-:$_status[$k%5]-}" style="width:{-:$vo['percentage']-}%;"></div>
		</div>
	{-:/foreach-}
	</div>
	<!--main interaction-->
	<div class="grid text-center">
		<div class="btn-group">
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
{-:$_SITE['stat_code']-}
</body>
</html>
