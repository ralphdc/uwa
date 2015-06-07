<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@MEMBER_CENTER-} - {-:$_SITE['name']-}</title>
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

<div class="grid margin-top">
	<h4>{-:$_MI['m_username']-}<small>[{-:$_MI['m_userid']-}]</small></h4>
	<div class="alert" data-alert>
		<a href="#" class="alert-close close"></a>
		<dl class="dl-horizontal">
			<dt>{-:@STATUS-}</dt><dd>
			{-if:2==$_MI['m_status']-}
				<span class="text-danger">{-:@FORBIDDEN-}</span>
			{-elseif:1==$_MI['m_status']-}
				<span class="text-success">{-:@PASSED-}</span>
			{-elseif:0==$_MI['m_status']-}
				<span class="text-muted">{-:@NOT_PASSED-}</span>
			{-:/if-}</span>
			</dd>
			<dt>{-:@MEMBER_TYPE-}</dt><dd>{-:$_MI['mm_name']-}</dd>
			<dt>{-:@MEMBER_LEVEL-}</dt><dd>{-:$_MI['ml_name']-}</dd>
			<dt>{-:@EXPERIENCE-}</dt><dd>{-:$_MI['m_experience']-}</dd>
			<dt>{-:@POINTS-}</dt><dd>{-:$_MI['m_points']-}</dd>
		</dl>
	</div>
	<table class="table table-bordered">
		<caption>{-:@CREDIT-}</caption>
		<thead>
			<tr>
			{-foreach:$_MCTL,$ct-}
				<th>{-:$ct['mct_name']-}</th>
			{-:/foreach-}
			</tr>
		</thead>
		<tbody>
			<tr>
			{-foreach:$_MCTL,$ct-}
				<td><strong class="text-success">{-:$_MI[$ct['mct_alias']]-}</strong> {-:$ct['mct_unit']-}</td>
			{-:/foreach-}
			</tr>
		</tbody>
	</table>
</div>

<dl class="adl">
	<dt><h5><i class="icon icon-bookmark"></i> {-:@MY_ARCHIVE-}</h5></dt>
	<dd>
		<ul id="archiveList" class="aul list-unstyled list-line">
		{-foreach:$_AL,$k,$item-}
			<li>
				<a href="{-:$item['a_url_o']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
				<small class="text-muted"><i class="icon icon-clock-o"></i> {-:$item['a_edit_time']|date~'m-d',@me-}</small>
			</li>
		{-:/foreach-}
		</ul>
	</dd>
</dl>
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
