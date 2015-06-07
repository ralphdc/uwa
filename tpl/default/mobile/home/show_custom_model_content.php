<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['cm_name']-} - ID {-:$_V['id']-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_V['cm_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['cm_description']-}" />
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
	<h3>{-:$_V['cm_name']-} - ID {-:$_V['id']-}</h3>
{-if:!empty($_V['msg_err'])-}
	<div class="alert alert-warning">
		{-:$_V['msg_err']-}
	</div>
{-else:-}
	{-foreach:$_V['cm_field'],$field,$params-}
	<dl class="dl-horizontal">
		<dt><strong>{-:$params['f_item_name']-}</strong></dt>
		<dd {-if:isset($params['f_is_paging']) and (1 == $params['f_is_paging'])-} id="cmcPaging"{-:/if-}>
		{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload'] and !empty($_V[$field])-}
			<img src="{-:$_V[$field]-}" />
		{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload'] and !empty($_V[$field])-}
			<a href="{-:$_V[$field]-}" target="_blank"><i class="icon icon-paperclip"></i> {-:@FILE_ATTACHMENT-}</a>
		{-else:-}
			{-:$_V[$field]-}
		{-:/if-}
		</dd>
	</dl>
	{-:/foreach-}

	<!--next page-->
	{-if:!empty($PAGING['nextPage']['url'])-}
	<div class="grid">
		<span id="viewMore" to="#cmcPaging" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
	</div>
	{-:/if-}
{-:/if-}

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

<div class="grid">
	<ul class="pagination-pager">
	{-if:!empty($_V['prev'])-}
		<li class="previous">
			<a href="{-:$_V['prev']['url']-}">{-:@PREV_ARCHIVE-}</a>
		</li>
	{-else:-}
		<li class="previous disabled">
			<a href="#">{-:@NONE-}</a>
		</li>
	{-:/if-}
	{-if:!empty($_V['next'])-}
		<li class="next">
			<a href="{-:$_V['next']['url']-}">{-:@NEXT_ARCHIVE-}</a>
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
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
{-:$_SITE['stat_code']-}
</body>
</html>
