<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['cm_name']-} - {-:$_SITE['name']-}</title>
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

{-if:!empty($_V['msg_err'])-}
	<div class="grid">
		<div class="alert">
			{-:$_V['msg_err']-}
		</div>
	</div>
{-else:-}
	<div class="grid">
		<div class="panel margin-remove">
			<div class="panel-body">
				{-:$_V['cm_content']-}
			</div>
		</div>
	</div>
	{-if:!empty($_FF)-}
	<div id="fieldFilter" class="grid">
	{-foreach:$_FF,$f,$fp-}
		<dl class="dl-horizontal">
			<dt>{-:$fp['name']-}</dt>
			<dd>
				<div class="btn-group">
		{-foreach:$fp['params'],$f-}
				<a class="btn {-if:$f['value'] == ARequest::get($f['field'])-} active{-:/if-}" href="{-:$f['url']-}">{-:$f['name']-}</a>
		{-:/foreach-}
				</div>
			</dd>
		</dl>
	{-:/foreach-}
	</div>
	{-:/if-}

	<dl class="adl">
		<dt><h5><i class="icon icon-bookmark"></i> {-:$_V['cm_name']-}</h5></dt>
		<dd>
			<ul id="contentList" class="list-unstyled list-line">
			{-foreach:$_L,$k,$item-}
				<li>
					{-if:!empty($_V['cm_field'])-}<table class="table table-bordered table-condensed">
						<caption><strong>ID: {-:$item['id']-}</strong> <a class="float-right" href="{-url:custom_model/show_content?custom_model_id={$_V['custom_model_id']}&id={$item['id']}-}"><i class="icon icon-eye"></i> {-:@VIEW_DETAIL-}</a></caption>
					{-foreach:$_V['cm_field'],$field,$params-}
						{-if:1==$params['f_is_list'] and !empty($item[$field])-}
						<tr>
							<td align="right">{-:$params['f_item_name']-}</td>
							<td>
							{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload']-}
								<a href="{-:$item[$field]-}" target="_blank"><i class="icon icon-image"></i> {-:@IMAGE_ATTACHMENT-}</a>
							{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload']-}
								<a href="{-:$item[$field]-}" target="_blank"><i class="icon icon-paperclip"></i> {-:@FILE_ATTACHMENT-}</a>
							{-else:-}
								{-:$item[$field]-}
							{-:/if-}
							</td>
						</tr>
						{-:/if-}
					{-:/foreach-}
					</table>{-:/if-}
				</li>
			{-:/foreach-}
			</ul>
		</dd>
	</dl>

	<!--next page-->
	{-if:!empty($PAGING['nextPage']['url'])-}
	<div class="grid">
		<span id="viewMore" to="#contentList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
	</div>
	{-:/if-}

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
