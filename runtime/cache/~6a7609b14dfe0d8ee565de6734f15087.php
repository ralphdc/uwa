<?php /* PFA Template Cache File. Create Time:2015-06-11 01:02:08 */ ?>
<!DOCTYPE html> <html> <head> <meta charset="utf-8" /> <title><?php echo($_V['sp_title']); ?> - <?php echo($_SITE['name']); ?></title> <link rel="stylesheet" type="text/css" href="/tpl/rz/home/css/rz.css" /> <meta name="keywords" content="<?php echo($_V['sp_keywords']); ?>,<?php echo($_SITE['keywords']); ?>" /> <meta name="description" content="<?php echo($_V['sp_description']); ?>" /> </head> <body> <div class="header"> <div class="main"> <img class="f_left" src="<?php echo($_SITE['logo']); ?>"
			alt="<?php echo($_SITE['name']); ?>" /> <div class="f_right help"> <p class="f_gray">全国统一服务热线: 0755-82797719</p> <p class="f_blue">诚信经营 · 细心服务 · 专业产品</p> </div> <div class="clear"></div> </div> </div> <div id="nav_main"> <div class="m w_960"> <dl class="menu w_760 f_l"> <?php
$_menu_main = M('Menu')->get_menuList('main');
if(is_array($_menu_main)) : foreach($_menu_main as $k => $m): 
?> <dt class="a<?php if(get_url($_GCAP) == $m['url']) :  ?> on<?php endif; ?>"><a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a></dt> <?php if(!empty($m['m_sub_menu'])) :  ?><dd class="fs_13 fw_n"><ul> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <li class="a"><a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a></li> <?php endforeach; endif; ?> </ul></dd><?php endif; ?> <?php endforeach; endif; ?> </dl><!--/.menu--> </div> </div><!--/#nav_main--> <div class="banner about"> <?php
$var_asi = '_asi_13';
$$var_asi = M('AdSpace')->get_spaceInfo('13');
$_ASI = $$var_asi;
if(!empty($_ASI) and 1 == $_ASI['as_status']) {
	$var_al = '_al_13';
	$$var_al = S('~list/~'.ltrim($var_al, '_'));
	if(empty($$var_al)) {
		$$var_al = M('Ad')->get_adList('13', true);
		S('~list/~'.ltrim($var_al, '_'), $$var_al);
	}
	if(!empty($$var_al)) {
		$_ASI['ad'] = $$var_al;
		$this->assign('_ASI', $_ASI);
		$ad = $this->fetch('home/clip/ad/tag/'.$_ASI['as_type']);
		echo $ad;
	}
	else {
		echo $_ASI['as_default'];
	}
}
?> </div> <div class="center"> <div class="main"> <div class="crumbs"><a href="#">首页</a> > 关于我们</div> <div class="list"> <div class="about_text"> <div> <?php echo($_V['sp_content']); ?> </div> </div> </div> </div> </div> <div id="footer"> <div class="nav_footer m w_960"> <?php
$_menu_footer = M('Menu')->get_menuList('footer');
if(is_array($_menu_footer)) : foreach($_menu_footer as $k => $m): 
?> <a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a> <?php endforeach; endif; ?> <?php endforeach; endif; ?> <?php if($_SITE{'mobile_version'}) :  ?><a href="<?php echo(Url::U("home@common/toggle_ua?ua=mobile")); ?>"><?php echo(L("MOBILE_VERSION")); ?></a><?php endif; ?> <a target="_blank" href="<?php echo(SOFT_AUTHOR_URL); ?>"><span class="logo_tiny"></span></a> </div><!--/.nav_footer--> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l ta_l copyright"> <?php echo($_SITE['copyright']); ?> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l ta_r prowered_by"> 			Powered by <strong><a href="<?php echo(SOFT_AUTHOR_URL); ?>" target="_blank"><?php echo(SOFT_NAME); ?></a></strong> <?php echo(SOFT_CODENAME); ?> </div><!--/.w_300--> <div class="c"></div> </div><!--/.copyright--> </div><!--/#footer--> <script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script> <script> document.write('<script src="<?php echo(Url::U("member@common/get_member_info")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="<?php echo(Url::U("home@common/task?task={$TASK}")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
</script> <script src="/tpl/rz/home/js/c.js"></script> <?php echo($_SITE['stat_code']); ?> </body> </html>