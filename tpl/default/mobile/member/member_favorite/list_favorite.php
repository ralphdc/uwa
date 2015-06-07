<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@UPLOAD-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
{-include:../header-}

<form id="formSearch" class="form" action="" method="post">
<div class="grid">
	<div class="row">
		<div class="col-sm-8">
			<input placeholder="{-:@KEYWORDS-}" required="required" type="text" name="mf_title" value="{-php:echo ARequest::get('mf_title');-}" class="control-input" maxlength="64">
		</div>
		<div class="col-sm-4">
			<input type="submit" class="btn btn-block" value="{-:@SEARCH-}" />
		</div>
	</div>
</div>
</form>

<table id="favoriteList" class="table">
	{-foreach:$_MFL,$mf-}
	<tr>
		<td>
			<a href="{-:$mf['mf_url']-}" target="_blank">{-:$mf['mf_title']-}</a><br />
			<span class="text-muted"><i class="icon icon-clock-o"></i> {-:$mf['mf_add_time']|date~'Y-m-d',@me-}</span>
		</td>
		<td><a class="btn btn-primary" href="{-url:member_favorite/delete_favorite_do?member_favorite_id={$mf['member_favorite_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();"><i class="icon icon-times"></i> {-:@DELETE-}</a></td>
	</tr>
	{-:/foreach-}
</table>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#favoriteList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
</div>
{-:/if-}

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
