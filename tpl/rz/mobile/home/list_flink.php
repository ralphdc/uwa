<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@FLINK-} - {-:$_SITE['name']-}</title>
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
	<dt><h5><i class="icon icon-link"></i> {-:@FLINK-}</h5><span class="float-right"><a href="{-url:home@flink/apply_flink-}">{-:@APPLY_FLINK-} <i class="icon icon-plus"></i></a></span></dt>
	<dd>
		<ul id="flinkList" class="list-unstyled list-line">
		{-foreach:$_L,$f-}
			<li>
				<dl class="dl-horizontal">
					<dt>
					{-if:1==$f['f_show_type']-}
						<a class="fc_b fs_13" href="{-:$f['f_site_url']-}"><img src="{-:$f['f_site_logo']-}" /></a>
					{-else:-}
						<a class="fc_b fs_13" href="{-:$f['f_site_url']-}">{-:$f['f_site_name']-}</a>
					{-:/if-}
					</dt>
					<dd class="text-muted">
						<i class="icon icon-bookmark"></i> <span class="badge">{-:$f['fc_name']-}</span><br>
						<i class="icon icon-globe"></i> <code>{-:$f['f_site_url']-}</code><br>
						{-if:!empty($f['f_site_description'])-}<i class="icon icon-quote-left"></i> <span>{-:$f['f_site_description']|AString::utf8_substr~@me,36-}</span>{-:/if-}
					</dd>
				</dl>
			</li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#flinkList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
</div>
{-:/if-}

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
