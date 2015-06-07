<?php /* PFA Template Cache File. Create Time:2015-06-06 01:18:47 */ ?>
<!DOCTYPE html> <html> <head> <meta charset="utf-8" /> <title><?php echo($_SITE['name']); ?></title> <link rel="stylesheet" type="text/css" href="/tpl/default/home/css/c.css" /> <meta name="keywords" content="<?php echo($_SITE['keywords']); ?>" /> <meta name="description" content="<?php echo($_SITE['description']); ?>" /> </head> <body> <div id="header"> <div id="topbar" class="m w_960"> <div id="uwa_member"></div><!--/#uwa_member--> <div id="nav_topbar"> <a href="<?php echo(Url::U("home@search/search")); ?>" target="_blank"><?php echo(L("ADVANCED_SEARCH")); ?></a> | <a href="<?php echo(Url::U("home@tag/index")); ?>" target="_blank"><?php echo(L("TAG")); ?></a> </div><!--/#nav_topbar--> </div> <div class="m w_960"> <h1><a href="<?php echo($_SITE['host']); ?>"><img src="<?php echo($_SITE['logo']); ?>" alt="<?php echo($_SITE['name']); ?>" /></a></h1> </div> </div><!--/#header--> <div id="nav_main"> <div class="m w_960"> <dl class="menu w_760 f_l"> <?php
$_menu_main = M('Menu')->get_menuList('main');
if(is_array($_menu_main)) : foreach($_menu_main as $k => $m): 
?> <dt class="a<?php if(get_url($_GCAP) == $m['url']) :  ?> on<?php endif; ?>"><a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a></dt> <?php if(!empty($m['m_sub_menu'])) :  ?><dd class="fs_13 fw_n"><ul> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <li class="a"><a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a></li> <?php endforeach; endif; ?> </ul></dd><?php endif; ?> <?php endforeach; endif; ?> </dl><!--/.menu--> <div class="search_box f_r"> <form method="post" action="<?php echo(Url::U("home@search/search_do")); ?>"> <input type="text" name="keyword" value="" class="required"><input type="submit" class="search_btn a" value="<?php echo(L("SEARCH")); ?>" /> </form> </div><!--/.search_box--> </div> </div><!--/#nav_main--> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l"> <div class="w_300 f_l"> <div id="slide"> <object type="application/x-shockwave-flash" data="<?php echo(__PUBLIC__); ?>flash/slide.swf?xml=
<data> <channel> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_s_days_keywords_orderby_0_5';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.af_alias'] = array('INSET', 's');
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,5', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <item> <link><?php echo(str_replace('&', '^', $item['a_url'])); ?></link> <image><?php echo($item['a_thumb']); ?></image> <title><?php echo($item['a_title']); ?></title> </item> <?php endforeach; endif; ?> </channel> <config> <autoPlayTime>5</autoPlayTime> <titleBgColor>0x000000</titleBgColor> <titleTextColor>0xffffff</titleTextColor> <titleBgAlpha>0.4</titleBgAlpha> <btnSetMargin>5 5 auto auto</btnSetMargin> <btnAlpha>.5</btnAlpha> <btnTextColor>0xffffff</btnTextColor> <btnDefaultColor>0x000000</btnDefaultColor> <btnHoverColor>0x0066ff</btnHoverColor> <btnFocusColor>0x0066ff</btnFocusColor> <changImageMode>hover</changImageMode> <transform>breatheBlur</transform> <isShowAbout>false</isShowAbout> </config> </data>"
width="300" height="180" id="archive_slide" wmode="transparent"> <param name="wmode" value="transparent"> <param name="movie" value="<?php echo(__PUBLIC__); ?>flash/slide.swf?xml=
<data> <channel> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_s_days_keywords_orderby_0_5';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.af_alias'] = array('INSET', 's');
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,5', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <item> <link><?php echo(str_replace('&', '^', $item['a_url'])); ?></link> <image><?php echo($item['a_thumb']); ?></image> <title><?php echo($item['a_title']); ?></title> </item> <?php endforeach; endif; ?> </channel> <config> <autoPlayTime>5</autoPlayTime> <titleBgColor>0x000000</titleBgColor> <titleTextColor>0xffffff</titleTextColor> <titleBgAlpha>0.4</titleBgAlpha> <btnSetMargin>5 5 auto auto</btnSetMargin> <btnAlpha>.5</btnAlpha> <btnTextColor>0xffffff</btnTextColor> <btnDefaultColor>0x000000</btnDefaultColor> <btnHoverColor>0x0066ff</btnHoverColor> <btnFocusColor>0x0066ff</btnFocusColor> <changImageMode>hover</changImageMode> <transform>breatheBlur</transform> <isShowAbout>false</isShowAbout> </config> </data>" /> </object> </div><!--/#slide--> <div class="h_10 o_h"></div> <dl class="adl"> <dt><strong><?php echo(L("SPECIAL_COMMEND")); ?></strong></dt> <dd> <ul class="aul"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_a_days_keywords_orderby_0_3';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.af_alias'] = array('INSET', 'a');
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,3', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li>[<a class="fc_gry_d" href="<?php echo($item['ac_url']); ?>"><?php echo($item['ac_name']); ?></a>] <a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul> </dd> </dl> </div><!--/.w_300--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_340 f_l"> <div class="adiv"> <div id="big_news"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_h_days_keywords_orderby_0_1';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.af_alias'] = array('INSET', 'h');
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,1', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
$item['a_title'] = AString::utf8_substr($item['a_title'], '36')
?> <h2 class="ta_c lh_40"><a class="fs_16 fw_b fc_r lh_40" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></h2> <p><a class="fs_12 fc_gry lh_20 td_n" href="<?php echo($item['a_url']); ?>"><?php echo(AString::utf8_substr($item['a_description'], 80, 1)); ?></a></p> <?php endforeach; endif; ?> </div><!--/#big_news--> <ul class="fs_14 aul p_10 bg_wht"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_flag_days_keywords_a_edit_time_desc_0_7';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$$var_a = M('Archive')->get_archiveList($where, '`a_edit_time` desc', '0,7', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li>[<a class="fc_gry_d" href="<?php echo($item['ac_url']); ?>"><?php echo($item['ac_name']); ?></a>] <a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul> </div> </div><!--/.w_340--> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l"> <dl class="adl"> <dt><strong><?php echo(L("COMMEND")); ?></strong></dt> <dd><ul class="aul"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_c_days_keywords_orderby_0_10';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.af_alias'] = array('INSET', 'c');
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,10', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li><a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul></dd> </dl> </div><!--/.w_300--> <div class="c"></div> </div> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l"> <dl class="adl"> <dt><strong><?php echo(L("PICTURE_NEWS")); ?></strong><span><b id="prev" class="a"></b><b id="next" class="a"></b></span></dt> <dd> <div id="marquee"><ul class="aul_marquee"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_p_days_keywords_orderby_0_8';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.af_alias'] = array('INSET', 'p');
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,8', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li> <a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"> <img class="a" src="<?php echo($item['a_thumb']); ?>" /> <span><?php echo(AString::utf8_substr($item['a_title'], 36)); ?></span></a> </li> <?php endforeach; endif; ?> </ul></div> </dd> </dl><!--/.hot_list--> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l"> <?php
$var_asi = '_asi_1';
$$var_asi = M('AdSpace')->get_spaceInfo('1');
$_ASI = $$var_asi;
if(!empty($_ASI) and 1 == $_ASI['as_status']) {
	$var_al = '_al_1';
	$$var_al = S('~list/~'.ltrim($var_al, '_'));
	if(empty($$var_al)) {
		$$var_al = M('Ad')->get_adList('1', true);
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
?> </div><!--/.w_300--> <div class="c"></div> </div> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l"> <?php
$var_ac = '_ac_list_'.(isset($AC_ID) ? $AC_ID : 0).'_no_100';
$$var_ac = S('~list/~'.ltrim($var_ac, '_'));
if(empty($$var_ac)) {
	$$var_ac = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'', 1, '100', 1);
	S('~list/~'.ltrim($var_ac, '_'), $$var_ac);
}
if($$var_ac) : foreach($$var_ac as $key => $channel): 
C('AC_ID', $channel['archive_channel_id']);
?> <div class="f_l w_320"> <dl class="adl"> <dt><strong><?php echo($channel['ac_name']); ?></strong><span><a href="<?php echo($channel['ac_url']); ?>"><?php echo(L("MORE")); ?></a></span></dt> <dd> <ul class="aul"> <?php
$var_a = '_a_list_aid_'.C('AC_ID').'_yes_flag_days_keywords_orderby_0_5';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.C('AC_ID').'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.C('AC_ID').'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.C('AC_ID').'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.C('AC_ID').'')));
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,5', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li><a href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul> </dd> </dl> </div> <?php if(0==$key%2) :  ?><div class="w_10 h_10 o_h f_l">&nbsp;</div><?php else : ?><div class="c"></div><div class="h_10 o_h"></div><?php endif; ?> <?php C('AC_ID', null); endforeach; endif; ?> <div> <?php
$var_asi = '_asi_2';
$$var_asi = M('AdSpace')->get_spaceInfo('2');
$_ASI = $$var_asi;
if(!empty($_ASI) and 1 == $_ASI['as_status']) {
	$var_al = '_al_2';
	$$var_al = S('~list/~'.ltrim($var_al, '_'));
	if(empty($$var_al)) {
		$$var_al = M('Ad')->get_adList('2', true);
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
?> </div> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l"> <dl class="atab"> <dt><strong><?php echo(L("HOT_1")); ?></strong><strong><?php echo(L("HOT_7")); ?></strong><strong><?php echo(L("HOT_30")); ?></strong></dt> <dd class="p_10 bg_wht"> <ul class="tabCntnt aul_hot"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_flag_1_keywords_a_view_count_desc_0_10';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.a_edit_time'] = array('GT', time() - 86400*('1'));
	$$var_a = M('Archive')->get_archiveList($where, '`a_view_count` desc', '0,10', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li><a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul> <ul class="tabCntnt aul_hot"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_flag_7_keywords_a_view_count_desc_0_10';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.a_edit_time'] = array('GT', time() - 86400*('7'));
	$$var_a = M('Archive')->get_archiveList($where, '`a_view_count` desc', '0,10', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li><a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul> <ul class="tabCntnt aul_hot"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_flag_30_keywords_a_view_count_desc_0_10';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$where['__ARCHIVE__.a_edit_time'] = array('GT', time() - 86400*('30'));
	$$var_a = M('Archive')->get_archiveList($where, '`a_view_count` desc', '0,10', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li><a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul> </dd> </dl><!--/.atab--> </div><!--/.w_300--> <div class="c"></div> </div> <div class="h_10 o_h"></div> <div class="m w_960"> <dl class="adl"> <dt><strong><?php echo(L("FLINK")); ?></strong><span><a href="<?php echo(Url::U("home@flink/apply_flink")); ?>"><?php echo(L("APPLY_FLINK")); ?></a> | <a href="<?php echo(Url::U("home@flink/list_flink")); ?>"><?php echo(L("ALL_FLINK")); ?></a></span></dt> <dd> <ul class="aul_3"> <?php
$var_fl = '_flink_list_cid_type_0_5';
$$var_fl = F('~list/~'.ltrim($var_fl, '_'));
if(empty($$var_fl)) {
	$where = array();
	$where['__FLINK__.f_status'] = array('EQ', 1);
	$$var_fl = M('Flink')->get_flinkList($where, '`f_display_order` ASC', '0,5');
	F('~list/~'.ltrim($var_fl, '_'), $$var_fl);
}
if($$var_fl) : foreach($$var_fl as $k => $item): 
?> <li><a target="_blank" href="<?php echo($item['f_site_url']); ?>"><?php echo($item['f_site_name']); ?></a></li> <?php endforeach; endif; ?> </ul> <div class="c"></div> </dd> </dl> </div> <div id="footer"> <div class="nav_footer m w_960"> <?php
$_menu_footer = M('Menu')->get_menuList('footer');
if(is_array($_menu_footer)) : foreach($_menu_footer as $k => $m): 
?> <a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a> <?php endforeach; endif; ?> <?php endforeach; endif; ?> <?php if($_SITE{'mobile_version'}) :  ?><a href="<?php echo(Url::U("home@common/toggle_ua?ua=mobile")); ?>"><?php echo(L("MOBILE_VERSION")); ?></a><?php endif; ?> <a target="_blank" href="<?php echo(SOFT_AUTHOR_URL); ?>"><span class="logo_tiny"></span></a> </div><!--/.nav_footer--> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l ta_l copyright"> <?php echo($_SITE['copyright']); ?> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l ta_r prowered_by"> 			Powered by <strong><a href="<?php echo(SOFT_AUTHOR_URL); ?>" target="_blank"><?php echo(SOFT_NAME); ?></a></strong> <?php echo(SOFT_CODENAME); ?> </div><!--/.w_300--> <div class="c"></div> </div><!--/.copyright--> </div><!--/#footer--> <script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script> <script> document.write('<script src="<?php echo(Url::U("member@common/get_member_info")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="<?php echo(Url::U("home@common/task?task={$TASK}")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
</script> <script src="/tpl/default/home/js/jcarousellite.js"></script> <script src="/tpl/default/home/js/c.js"></script> <?php echo($_SITE['stat_code']); ?> </body> </html>