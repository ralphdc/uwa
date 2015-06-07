<?php /* PFA Template Cache File. Create Time:2015-06-06 01:16:30 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo(L("MANAGE")); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/i.css" />
</head>
<body>
<div id="screenLock" <?php if('on' == ASession::get('LOCK_SCREEN_SWITCH')) :  ?><?php else : ?>style="display:none;"<?php endif; ?>>
	<dl>
		<dt><i class="mi mi_32 mi_32_info"></i> <span id="lockTips" class="fw_b"><?php echo(L("SCREEN_LOCK_TIP")); ?></span></dt>
		<dd>
			<ul>
				<li><label><input type="password" placeholder="<?php echo(L("PASSWORD")); ?>" id="lockPassword" class="i" size="36"></label></li>
				<li><label><span class="btn_l" value="" onclick="check_screenlock();return false;"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/unlock.png" /> <?php echo(L("UNLOCK")); ?></span></label></li>
			</ul>
		</dd>
	</dl>
</div><!--/#screenLock-->
<div id="header">
	<div id="mainNav">
		<div id="logo">
			<a href="<?php echo(Url::U("index/index")); ?>"><h1><?php echo(L("MANAGE")); ?></h1></a>
		</div>
		<ul id="mainMenu">
			<?php if(isset($_M) and is_array($_M)) : foreach($_M as $m) : ?><li for="<?php echo($m['m_sub_key']); ?>" class="a"><i class="mi mi_24 mi_24_<?php echo($m['m_alias']); ?>"></i> <?php echo($m['m_name']); ?></li><?php endforeach; endif; ?>
		</ul><!--/#mainMenu-->
	</div><!--/#mainNav-->
	<div id="statusInfo">
		<ul>
			<li class="top"><strong><?php echo(ASession::get("m_username")); ?></strong> [<?php echo(ASession::get("ar_name")); ?>]</li>
			<li id="_M0" class="top a" url="<?php echo(Url::U("index/show_system_info")); ?>"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/information.png" /> <?php echo(L("SYSTEM_INFO")); ?></li>
			<li class="top"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/globe.png" /> <a href="<?php echo(Url::U("home@index/index")); ?>" target="_blank"><?php echo(L("VIEW_SITE")); ?></a></li>
			<li class="top"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/logout.png" /> <a href="<?php echo(Url::U("login/logout_do")); ?>"><?php echo(L("LOGOUT")); ?></a></li>
			<li class="top"><span id="screenLockSwitch" class="a fw_b fc_g"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/screen_lock.png" /> <?php echo(L("LOCK_SCREEN")); ?></span></li>
			<li id="shortcutSwitch" class="top a">
				<div><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/shortcut.png" /> <?php echo(L("SHORTCUT")); ?></div>
				<ul id="shortcutItems">
					<?php if(isset($_SL) and is_array($_SL)) : foreach($_SL as $s) : ?><li url="<?php echo($s['shortcut_url']); ?>" class="a">
						<img class="mi mi_16" src="/tpl/default/admin/img/mi_16/<?php echo($s['shortcut_icon']); ?>.png" /> <?php echo($s['shortcut_title']); ?>
					</li><?php endforeach; endif; ?>
				</ul>
			</li>
			<div class="c"></div>
		</ul>
	</div><!--/#statusInfo-->
	<div id="positionBar">
		<div id="menuControl">
			<span class="a" id="topbarSwitch"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/toggle_topbar.png" /> <?php echo(L("TOGGLE_TOPBAR")); ?></span>
			<span class="a" id="sidebarSwitch"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/toggle_sidebar.png" /> <?php echo(L("TOGGLE_SIDEBAR")); ?></span>
			<span class="a" id="operationMapSwitch"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/operation_map.png" /> <?php echo(L("OPERATION_MAP")); ?></span>
		</div>
		<div id="position"></div><!--/#position-->
		<div id="official_link"><a href="<?php echo(SOFT_OFFICIAL_FORUM_URL); ?>" target="_blank"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/balloon.png" /> <?php echo(L("OFFICIAL_FORUM")); ?></a> <a href="<?php echo(SOFT_ONLINE_MANUAL_URL); ?>" target="_blank"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/lifebuoy.png" /> <?php echo(L("HELP_MANUAL")); ?></a></div>
	</div><!--/#positionBar-->
</div><!--/#header-->
<div id="sidebar">
	<?php if(isset($_M) and is_array($_M)) : foreach($_M as $m) : ?>
	<dl id="<?php echo($m['m_sub_key']); ?>" class="t subMenu">
		<?php if(isset($m['m_sub']) and is_array($m['m_sub'])) : foreach($m['m_sub'] as $ms) : ?>
		<dt class="a"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/<?php echo($ms['m_alias']); ?>.png" /> <?php echo($ms['m_group_name']); ?></dt>
		<dd>
			<ul>
				<?php if(isset($ms['m_menus']) and is_array($ms['m_menus'])) : foreach($ms['m_menus'] as $menu) : ?>
				<li class="a" url="<?php echo($menu['m_url']); ?>"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/<?php echo($menu['m_alias']); ?>.png" /> <?php echo($menu['m_name']); ?></li>
				<?php endforeach; endif; ?>
			</ul>
		</dd>
		<?php endforeach; endif; ?>
	</dl>
	<?php endforeach; endif; ?>
</div><!--/#sidebar-->
<div id="main">
</div><!--/#main-->
<div id="footer">
	<div id="iframeTabs"><ul></ul></div>
	<div id="copyright">&copy;<?php echo date('Y'); ?> <a href="<?php echo(SOFT_AUTHOR_URL); ?>" class="fw_b" target="_blank"><?php echo(SOFT_AUTHOR); ?></a>, Powered by <span class="fc_b fw_b"><?php echo(SOFT_NAME); ?><?php echo(SOFT_CODENAME); ?>(<?php echo(SOFT_VERSION); ?>) <?php echo(SOFT_CHARSET); ?></span><?php if(!is_null($LICENCE)) :  ?> <span class="fc_g fw_b"><?php echo(L("AUTHORIZED")); ?></span><?php else : ?> <span class="fc_gry fw_n"><?php echo(L("UNAUTHORIZED")); ?></span><?php endif; ?></div>
</div><!--/#footer-->
<div id="operationMap" style="display:none">
<?php if(isset($_M) and is_array($_M)) : foreach($_M as $m) : ?>
<dl class="mapTop">
	<dt class="bigItem"><i class="mi mi_24 mi_24_<?php echo($m['m_alias']); ?>"></i> <?php echo($m['m_name']); ?></dt>
	<dd>
		<?php if(isset($m['m_sub']) and is_array($m['m_sub'])) : foreach($m['m_sub'] as $ms) : ?>
		<dl class="mapItem">
			<dt><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/<?php echo($ms['m_alias']); ?>.png" /> <?php echo($ms['m_group_name']); ?></dt>
			<dd>
			<ul class="item">
				<?php if(isset($ms['m_menus']) and is_array($ms['m_menus'])) : foreach($ms['m_menus'] as $menu) : ?>
				<li class="a" url="<?php echo($menu['m_url']); ?>" target="mainiFrame"><img class="mi mi_16" src="/tpl/default/admin/img/mi_16/<?php echo($menu['m_alias']); ?>.png" /> <?php echo($menu['m_name']); ?></li>
				<?php endforeach; endif; ?>
			</ul>
			</dd>
		</dl>
		<?php endforeach; endif; ?>
	</dd>
</dl>
<?php endforeach; endif; ?>
<div class="c"></div>
</div>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
var l_manage = '<?php echo(L("MANAGE")); ?>',
	l_operation_map_title = '<?php echo(L("OPERATION_MAP")); ?>',
	l_screen_lock_tip = '<?php echo(L("SCREEN_LOCK_TIP")); ?>',
	l_input_empty_tip = '<?php echo(L("INPUT_NO_EMPTY")); ?>',
	url_lock_screen = '<?php echo(Url::U("login/lock_screen")); ?>',
	url_check_screen_lock = '<?php echo(Url::U("login/check_screen_lock")); ?>';

$(document).ready(function() {
	$.getJSON('<?php echo(Url::U("index/check_new_version?type=system")); ?>'+'&'+Math.random(), function(result) {
		if(1 == result.data) {
			var newVersion = result.info;
			$('#check_result').html('');
			dialog({
				quickClose: true,
				title:'<?php echo(L("NEW_VERSION")); ?>',
				content:'<a href="<?php echo(SOFT_AUTHOR_URL); ?>" target="_blank"><?php echo(L("NEW_VERSION")); ?>: ' + newVersion + '</a>',
				padding:'10px 5px',
				id:'OM'
			}).showModal();
		}
	});
});
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/i.js"></script>
</body>
</html>