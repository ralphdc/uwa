<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@NOTIFY-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<dl class="atab_1 adiv">
			<dt><strong {-if:!ARequest::get('mn_status')-}class="on"{-:/if-}><a href="{-url:member_notify/list_notify-}">{-:@NOTIFY-}</a></strong><strong {-if:'u'==ARequest::get('mn_status')-}class="on"{-:/if-}><a href="{-url:member_notify/list_notify?mn_status=u-}">{-:@UNREAD-}</a></strong><strong {-if:'r'==ARequest::get('mn_status')-}class="on"{-:/if-}><a href="{-url:member_notify/list_notify?mn_status=r-}">{-:@HAVE_READ-}</a></strong></dt>
			<dd class="p_10">
				<table class="listTable">
					<tr>
						<th scope="col">{-:@TITLE-}</th>
						<th scope="col">{-:@TIME-}</th>
						<th scope="col">{-:@STATUS-}</th>
						<th scope="col">{-:@MANAGE-}</th>
					</tr>
					{-foreach:$_MNL,$mn-}
					<tr>
						<td><span class="td_u a" onclick="get_notify('{-:$mn['member_notify_id']-}')">{-:$mn['mn_title']-}</span></td>
						<td>{-:$mn['mn_send_time']|date~C('APP.TIME_FORMAT'),@me-}</td>
						<td id="notify_status_{-:$mn['member_notify_id']-}">
						{-if:-1!=$mn['mn_m_id']-}
							{-if:0==$mn['mn_status']-}
							<span class="fc_g">{-:@UNREAD-}</span>
							{-elseif:1==$mn['mn_status']-}
							<span class="fc_gry">{-:@HAVE_READ-}</span>
							{-:/if-}
						{-:/if-}
						</td>
						<td>
						{-if:-1!=$mn['mn_m_id']-}
							<a href="{-url:member_notify/delete_notify_do?member_notify_id={$mn['member_notify_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a>
						{-:/if-}
						</td>
					</tr>
					<tr id="notify_{-:$mn['member_notify_id']-}" style="display:none">
						<td colspan="4" class="bg_gry_l"><div>
						{-:$mn['mn_content']-}
						</div></td>
					</tr>
					{-:/foreach-}
				</table>
				{-include:../clip/paging-}
			</dd>
		</dl>
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
function get_notify(notify_id) {
	if($('#notify_status_' + notify_id + ' span').hasClass("fc_g")) {
		$.get('{-url:member_notify/read_notify-}', {member_notify_id : notify_id}, function(data) {
			$('#notify_status_' + notify_id).html('<span class="fc_gry">{-:@HAVE_READ-}</span>');
		});
	}
	$('#notify_' + notify_id).toggle();
}

document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>