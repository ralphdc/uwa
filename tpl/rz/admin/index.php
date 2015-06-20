<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@MANAGE-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/i.css" />
</head>
<body>
<div id="screenLock" {-if:'on' == ASession::get('LOCK_SCREEN_SWITCH')-}{-else:-}style="display:none;"{-:/if-}>
	<dl>
		<dt><i class="mi mi_32 mi_32_info"></i> <span id="lockTips" class="fw_b">{-:@SCREEN_LOCK_TIP-}</span></dt>
		<dd>
			<ul>
				<li><label><input type="password" placeholder="{-:@PASSWORD-}" id="lockPassword" class="i" size="36"></label></li>
				<li><label><span class="btn_l" value="" onclick="check_screenlock();return false;"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/unlock.png" /> {-:@UNLOCK-}</span></label></li>
			</ul>
		</dd>
	</dl>
</div><!--/#screenLock-->
<div id="header">
	<div id="mainNav">
		<div id="logo">
			<a href="{-url:index/index-}"><h1>{-:@MANAGE-}</h1></a>
		</div>
		<ul id="mainMenu">
			{-foreach:$_M,$m-}<li for="{-:$m['m_sub_key']-}" class="a"><i class="mi mi_24 mi_24_{-:$m['m_alias']-}"></i> {-:$m['m_name']-}</li>{-:/foreach-}
		</ul><!--/#mainMenu-->
	</div><!--/#mainNav-->
	<div id="statusInfo">
		<ul>
			<li class="top"><strong>{-:-m_username-}</strong> [{-:-ar_name-}]</li>
			<li id="_M0" class="top a" url="{-url:index/show_system_info-}"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/information.png" /> {-:@SYSTEM_INFO-}</li>
			<li class="top"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/globe.png" /> <a href="{-url:home@index/index-}" target="_blank">{-:@VIEW_SITE-}</a></li>
			<li class="top"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/logout.png" /> <a href="{-url:login/logout_do-}">{-:@LOGOUT-}</a></li>
			<li class="top"><span id="screenLockSwitch" class="a fw_b fc_g"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/screen_lock.png" /> {-:@LOCK_SCREEN-}</span></li>
			<li id="shortcutSwitch" class="top a">
				<div><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/shortcut.png" /> {-:@SHORTCUT-}</div>
				<ul id="shortcutItems">
					{-foreach:$_SL,$s-}<li url="{-:$s['shortcut_url']-}" class="a">
						<img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/{-:$s['shortcut_icon']-}.png" /> {-:$s['shortcut_title']-}
					</li>{-:/foreach-}
				</ul>
			</li>
			<div class="c"></div>
		</ul>
	</div><!--/#statusInfo-->
	<div id="positionBar">
		<div id="menuControl">
			<span class="a" id="topbarSwitch"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/toggle_topbar.png" /> {-:@TOGGLE_TOPBAR-}</span>
			<span class="a" id="sidebarSwitch"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/toggle_sidebar.png" /> {-:@TOGGLE_SIDEBAR-}</span>
			<span class="a" id="operationMapSwitch"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/operation_map.png" /> {-:@OPERATION_MAP-}</span>
		</div>
		<div id="position"></div><!--/#position-->
	</div><!--/#positionBar-->
</div><!--/#header-->
<div id="sidebar">
	{-foreach:$_M,$m-}
	<dl id="{-:$m['m_sub_key']-}" class="t subMenu">
		{-foreach:$m['m_sub'],$ms-}
		<dt class="a"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/{-:$ms['m_alias']-}.png" /> {-:$ms['m_group_name']-}</dt>
		<dd>
			<ul>
				{-foreach:$ms['m_menus'],$menu-}
				<li class="a" url="{-:$menu['m_url']-}"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/{-:$menu['m_alias']-}.png" /> {-:$menu['m_name']-}</li>
				{-:/foreach-}
			</ul>
		</dd>
		{-:/foreach-}
	</dl>
	{-:/foreach-}
</div><!--/#sidebar-->
<div id="main">
</div><!--/#main-->
<div id="footer">
	<div id="iframeTabs"><ul></ul></div>
	<div id="copyright">&copy;{-php:echo date('Y');-} <a href="javascript:void(0)" class="fw_b" target="_blank">锐志包装</a>, Powered by <span class="fc_b fw_b">锐志包装公司</span></div>
</div><!--/#footer-->
<div id="operationMap" style="display:none">
{-foreach:$_M,$m-}
<dl class="mapTop">
	<dt class="bigItem"><i class="mi mi_24 mi_24_{-:$m['m_alias']-}"></i> {-:$m['m_name']-}</dt>
	<dd>
		{-foreach:$m['m_sub'],$ms-}
		<dl class="mapItem">
			<dt><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/{-:$ms['m_alias']-}.png" /> {-:$ms['m_group_name']-}</dt>
			<dd>
			<ul class="item">
				{-foreach:$ms['m_menus'],$menu-}
				<li class="a" url="{-:$menu['m_url']-}" target="mainiFrame"><img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/{-:$menu['m_alias']-}.png" /> {-:$menu['m_name']-}</li>
				{-:/foreach-}
			</ul>
			</dd>
		</dl>
		{-:/foreach-}
	</dd>
</dl>
{-:/foreach-}
<div class="c"></div>
</div>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var l_manage = '{-:@MANAGE-}',
	l_operation_map_title = '{-:@OPERATION_MAP-}',
	l_screen_lock_tip = '{-:@SCREEN_LOCK_TIP-}',
	l_input_empty_tip = '{-:@INPUT_NO_EMPTY-}',
	url_lock_screen = '{-url:login/lock_screen-}',
	url_check_screen_lock = '{-url:login/check_screen_lock-}';

$(document).ready(function() {
	$.getJSON('{-url:index/check_new_version?type=system-}'+'&'+Math.random(), function(result) {
		if(1 == result.data) {
			var newVersion = result.info;
			$('#check_result').html('');
			dialog({
				quickClose: true,
				title:'{-:@NEW_VERSION-}',
				content:'<a href="{-:*SOFT_AUTHOR_URL-}" target="_blank">{-:@NEW_VERSION-}: ' + newVersion + '</a>',
				padding:'10px 5px',
				id:'OM'
			}).showModal();
		}
	});
});
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/i.js"></script>
</body>
</html>