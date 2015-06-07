<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@NOTIFY-} - {-:$_SITE['name']-}</title>
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
	<ul class="subnav subnav-tab">
		<li{-if:!ARequest::get('mn_status')-} class="active"{-:/if-}><a href="{-url:member_notify/list_notify-}">{-:@NOTIFY-}</a></li>
		<li{-if:'u'==ARequest::get('mn_status')-} class="active"{-:/if-}><a href="{-url:member_notify/list_notify?mn_status=u-}">{-:@UNREAD-}</a></li>
		<li{-if:'r'==ARequest::get('mn_status')-} class="active"{-:/if-}><a href="{-url:member_notify/list_notify?mn_status=r-}">{-:@HAVE_READ-}</a></li>
	</ul>
</div>

<table id="notifyList" class="table">
	{-foreach:$_MNL,$mn-}
	<tr>
		<td>
			<span id="notify_status_{-:$mn['member_notify_id']-}">
			{-if:-1!=$mn['mn_m_id']-}
				{-if:0==$mn['mn_status']-}
				<span class="text-success">{-:@UNREAD-}</span>
				{-elseif:1==$mn['mn_status']-}
				<span class="text-muted">{-:@HAVE_READ-}</span>
				{-:/if-}
			{-:/if-}
			</span>
			<span class="td_u a">{-:$mn['mn_title']-}</span><br />
			<span class="text-muted"><i class="icon icon-clock-o"></i> {-:$mn['mn_send_time']|date~C('APP.TIME_FORMAT'),@me-}</span>
			<div class="alert" style="display:none" id="notify_{-:$mn['member_notify_id']-}">
				{-:$mn['mn_content']-}
			</div>
		</td>
		<td>
			<div class="btn-group-vertical">
				<span class="btn btn-primary" onclick="get_notify('{-:$mn['member_notify_id']-}')"><i class="icon icon-search-plus"></i> {-:@VIEW-}</span>
			{-if:-1!=$mn['mn_m_id']-}
				<a class="btn btn-primary" href="{-url:member_notify/delete_notify_do?member_notify_id={$mn['member_notify_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();"><i class="icon icon-times"></i> {-:@DELETE-}</a>
			{-:/if-}
			</div>
		</td>
	</tr>
	{-:/foreach-}
</table>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#notifyList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
</div>
{-:/if-}

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
function get_notify(notify_id) {
	if($('#notify_status_' + notify_id + ' span').hasClass("text-success")) {
		$.get('{-url:member_notify/read_notify-}', {member_notify_id : notify_id}, function(data) {
			$('#notify_status_' + notify_id).html('<span class="text-muted">{-:@HAVE_READ-}</span>');
		});
	}
	$('#notify_' + notify_id).toggle();
}

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
