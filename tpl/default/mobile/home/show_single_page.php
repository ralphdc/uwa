<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['sp_title']-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_V['sp_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['sp_description']-}" />
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
	<li class="{-if:$_V['single_page_id'] == $item['single_page_id']-} active{-:/if-}"><a href="{-:$item['sp_url_o']-}"><h6>{-:$item['sp_title']-}</h6></a></li>
</uwa:sp_list>
</ul>

<div class="grid">
<div class="article">
	<h3>{-:$_V['sp_title']-}</h3>
	<ul class="article-meta list-inline">
		<li><i class="icon icon-clock-o"></i> {-:$_V['sp_edit_time']|date~'Y-m-d',@me-}</li>
	</ul>
	{-if:$_V['sp_keywords']-}<p class="article-meta"><i class="icon icon-tags"></i> {-:$_V['sp_keywords']-}</p>{-:/if-}
	{-if:$_V['sp_description']-}<p class="article-lead"><i class="icon icon-quote-left"></i> {-:$_V['sp_description']-} <i class="icon icon-quote-right"></i></p>{-:/if-}
	<hr class="article-divider">
	<div id="spContent" class="clearfix">
		<div style="float:right;margin:0 0 10px 10px;">
			<uwa:ad id="3">
		</div>
		{-:$_V['sp_content']|garble_string~@me-}
	</div><!--/.clearfix-->

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
