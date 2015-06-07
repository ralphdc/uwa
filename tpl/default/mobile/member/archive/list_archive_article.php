<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_AMI['am_name']-} {-:@LIST-} - {-:$_SITE['name']-}</title>
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

<div class="grid">
	<div class="text-right">
		<a class="btn btn-success" href="{-url:archive/add_archive?archive_model_id={$_AMI['archive_model_id']}-}"><i class="icon icon-plus"></i> {-:@PUBLISH-} {-:$_AMI['am_name']-}</a>
	</div>
	<ul class="subnav subnav-tab">
		<li{-if:!ARequest::get('a_status')-} class="active"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}-}">{-:@ALL-}</a></li>
		<li{-if:'n'==ARequest::get('a_status')-} class="active"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}&a_status=n-}">{-:@NOT_PASSED-}</a></li>
		<li{-if:'p'==ARequest::get('a_status')-} class="active"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}&a_status=p-}">{-:@PASSED-}</a></li>
		<li{-if:'r'==ARequest::get('a_status')-} class="active"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}&a_status=r-}">{-:@REFUNDED-}</a></li>
	</ul>
</div>

<table id="archiveList" class="table">
	{-foreach:$_AL,$a-}
	<tr>
		<td>
			<strong>{-:@TITLE-}</strong>: {-:$a['a_title']|AString::utf8_substr~@me,36,1-}<br />
			<strong>{-:@STATUS-}</strong>: 
			{-if:0 == $a['a_status']-}<span class="text-muted">{-:@NOT_PASSED-}</span>
			{-elseif:1 == $a['a_status']-}<span class="text-success">{-:@PASSED-}</span>
			{-elseif:2 == $a['a_status']-}<span class="text-danger">{-:@REFUNDED-}</span>{-:/if-}<br />
			<span class="text-muted">
				<i class="icon icon-bookmark"></i> <a target="_blank" href="{-:$a['ac_url']-}">{-:$a['ac_name']-}</a><br />
				{-if:!empty($a['a_a_author'])-}<i class="icon icon-user"></i> {-:$a['a_a_author']-}<br />{-:/if-}
				<i class="icon icon-clock-o"></i> {-:$a['a_edit_time']|date~'Y-m-d',@me-}<br />
				<i class="icon icon-eye"></i> {-:$a['a_view_count']-}
			</span>
		</td>
		<td>
			<div class="btn-group-vertical">
				<a class="btn btn-primary" target="_blank" href="{-url:home@archive/show_archive?archive_id={$a['archive_id']}-}"><i class="icon icon-search-plus"></i> {-:@PREVIEW-}</a>
				<a class="btn btn-primary" href="{-url:archive/edit_archive?archive_id={$a['archive_id']}-}"><i class="icon icon-edit"></i> {-:@EDIT-}</a>
			</div>
		</td>
	</tr>
	{-:/foreach-}
</table>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#archiveList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
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
