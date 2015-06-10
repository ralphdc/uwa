<?php /* PFA Template Cache File. Create Time:2015-06-11 01:02:31 */ ?>
<!DOCTYPE html> <html> <head> <meta charset="utf-8" /> <title><?php echo($_V['ac_name']); ?> - <?php echo($_SITE['name']); ?></title> <link rel="stylesheet" type="text/css" href="/tpl/rz/home/css/c.css" /> <meta name="keywords" content="<?php echo($_V['ac_keywords']); ?>,<?php echo($_SITE['keywords']); ?>" /> <meta name="description" content="<?php echo($_V['ac_description']); ?>" /> </head> <body> <div class="header"> <div class="main"> <img class="f_left" src="<?php echo($_SITE['logo']); ?>"
			alt="<?php echo($_SITE['name']); ?>" /> <div class="f_right help"> <p class="f_gray">全国统一服务热线: 0755-82797719</p> <p class="f_blue">诚信经营 · 细心服务 · 专业产品</p> </div> <div class="clear"></div> </div> </div> <div id="nav_main"> <div class="m w_960"> <dl class="menu w_760 f_l"> <?php
$_menu_main = M('Menu')->get_menuList('main');
if(is_array($_menu_main)) : foreach($_menu_main as $k => $m): 
?> <dt class="a<?php if(get_url($_GCAP) == $m['url']) :  ?> on<?php endif; ?>"><a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a></dt> <?php if(!empty($m['m_sub_menu'])) :  ?><dd class="fs_13 fw_n"><ul> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <li class="a"><a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a></li> <?php endforeach; endif; ?> </ul></dd><?php endif; ?> <?php endforeach; endif; ?> </dl><!--/.menu--> </div> </div><!--/#nav_main--> <div class="position m w_960"><span><?php echo(L("POSITION")); ?></span><?php if(isset($_CP) and is_array($_CP)) : foreach($_CP as $k => $cp) : ?> <?php if(0==$k) :  ?> <?php if(!empty($cp['url'])) :  ?> <a href="<?php echo($cp['url']); ?>"><?php echo($cp['name']); ?></a> <?php else : ?> <?php echo($cp['name']); ?> <?php endif; ?> <?php else : ?> <?php if(!empty($cp['url'])) :  ?> 		 &raquo; <a href="<?php echo($cp['url']); ?>"><?php echo($cp['name']); ?></a> <?php else : ?> 		 &raquo; <?php echo($cp['name']); ?> <?php endif; ?> <?php endif; ?> <?php endforeach; endif; ?></div> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l"> <div> <?php
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
?> </div> <?php if(!empty($_FF)) :  ?> <div class="h_10 o_h"></div> <div class="adiv p_10"> <?php if(isset($_FF) and is_array($_FF)) : foreach($_FF as $f => $fp) : ?> <dl class="adl_h"> <dt><strong><?php echo($fp['name']); ?></strong></dt> <dd> <?php if(isset($fp['params']) and is_array($fp['params'])) : foreach($fp['params'] as $f) : ?> <a class="p_2_5 <?php if($f['value'] == ARequest::get($f['field'])) :  ?> fc_wht bg_b fw_b<?php else : ?> a fc_b<?php endif; ?>" href="<?php echo($f['url']); ?>"><?php echo($f['name']); ?></a> <?php endforeach; endif; ?> </dd> </dl> <?php endforeach; endif; ?> </div> <?php endif; ?> <div class="h_10 o_h"></div> <dl class="adl"> <dt><strong><?php echo($_V['ac_name']); ?></strong></dt> <dd><ul class="aul_2"> <?php if(isset($_L) and is_array($_L)) : foreach($_L as $k => $item) : ?> <?php if($k < 3) :  ?> <li class="pic"> <p class="a_thumb"><a href="<?php echo($item['a_url']); ?>"><img class="a" src="<?php echo($item['a_thumb']); ?>" /></a></p> <h3><a class="fs_14" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a> </h3> <p class="a_publish_date ta_r fc_gry fs_12 fw_n"><?php echo(L("PUBLISH_DATE")); ?>: <?php echo(date('m-d', $item['a_edit_time'])); ?></p> <p class="a_info fs_12"><?php echo(L("CHANNEL")); ?>: <a href="<?php echo($item['ac_url']); ?>"><?php echo($item['ac_name']); ?></a> <?php echo(L("VIEW")); ?>: <span class="fc_gry"><?php echo($item['a_view_count']); ?></span> <p class="a_description fc_gry"><?php echo($item['a_description']); ?></p> </li> <?php else : ?> <li class="fs_14<?php if(4 == $k%5) :  ?> part<?php endif; ?>"> 					[<a href="<?php echo($item['ac_url']); ?>"><?php echo($item['ac_name']); ?></a>] <a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo(AString::utf8_substr($item['a_title'], 60)); ?></a> <span class="fc_gry"><?php echo(date('m-d', $item['a_edit_time'])); ?></span> </li> <?php endif; ?> <?php endforeach; endif; ?> </ul></dd> </dl> <?php if(!empty($PAGING)) :  ?> <div id="page_list"> <!--first page--> <?php if(!empty($PAGING['firstPage']['url'])) :  ?> <a href="<?php echo($PAGING['firstPage']['url']); ?>" class="firstPage"><?php echo(L("_FIRST_PAGE_")); ?></a> <?php else : ?> <span class="firstPage"><?php echo(L("_FIRST_PAGE_")); ?></span> <?php endif; ?> <!--prev page--> <?php if(!empty($PAGING['prevPage']['url'])) :  ?> <a href="<?php echo($PAGING['prevPage']['url']); ?>" class="prevPage"><?php echo(L("_PREV_PAGE_")); ?></a> <?php else : ?> <span class="prevPage"><?php echo(L("_PREV_PAGE_")); ?></span> <?php endif; ?> <!--near prev page--> <?php if(!empty($PAGING['nearPrevPage'])) :  ?> <?php if(isset($PAGING['nearPrevPage']) and is_array($PAGING['nearPrevPage'])) : foreach($PAGING['nearPrevPage'] as $npp) : ?> <a href="<?php echo($npp['url']); ?>" class="nearPage"><?php echo($npp['page']); ?></a> <?php endforeach; endif; ?> <?php endif; ?> <!--current page--> <?php if(!empty($PAGING['currentPage'])) :  ?> <span class="currentPage"><?php echo($PAGING['currentPage']['page']); ?></span> <?php endif; ?> <!--near next page--> <?php if(!empty($PAGING['nearNextPage'])) :  ?> <?php if(isset($PAGING['nearNextPage']) and is_array($PAGING['nearNextPage'])) : foreach($PAGING['nearNextPage'] as $nnp) : ?> <a href="<?php echo($nnp['url']); ?>" class="nearPage"><?php echo($nnp['page']); ?></a> <?php endforeach; endif; ?> <?php endif; ?> <!--next page--> <?php if(!empty($PAGING['nextPage']['url'])) :  ?> <a href="<?php echo($PAGING['nextPage']['url']); ?>" class="nextPage"><?php echo(L("_NEXT_PAGE_")); ?></a> <?php else : ?> <span class="nextPage"><?php echo(L("_NEXT_PAGE_")); ?></span> <?php endif; ?> <!--last page--> <?php if(!empty($PAGING['lastPage']['url'])) :  ?> <a href="<?php echo($PAGING['lastPage']['url']); ?>" class="lastPage"><?php echo(L("_LAST_PAGE_")); ?></a> <?php else : ?> <span class="lastPage"><?php echo(L("_LAST_PAGE_")); ?></span> <?php endif; ?> <!--total info--> <span class="total"><?php echo(L("_TOTAL_PAGES_")); ?>:<?php echo($PAGING['totalPages']); ?> | <?php echo(L("_TOTAL_ROWS_")); ?>:<?php echo($PAGING['totalRows']); ?></span> </div> <?php endif; ?> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l"> <ul class="aul_1"> <?php if(isset($_V['ac_sibling']) and is_array($_V['ac_sibling'])) : foreach($_V['ac_sibling'] as $k => $item) : ?> <li class="a<?php if($AC_ID == $item['archive_channel_id']) :  ?> on<?php endif; ?>"><a href="<?php echo($item['ac_url']); ?>"><?php echo($item['ac_name']); ?></a></li> <?php endforeach; endif; ?> </ul> <div class="h_10 o_h"></div> <dl class="adl"> <dt><strong><?php echo(L("COMMEND")); ?></strong></dt> <dd><ul class="aul"> <?php
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
?> <li><a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul></dd> </dl> <div class="h_10 o_h"></div> <dl class="adl"> <dt><strong><?php echo(L("PICTURE_NEWS")); ?></strong></dt> <dd><ul class="aul"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_p_days_keywords_orderby_0_10';
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
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,10', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <?php if(0==$k) :  ?> <li class="pic"> <a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"> <img class="a" src="<?php echo($item['a_thumb']); ?>" alt="<?php echo($item['a_title']); ?>" /> <span><?php echo($item['a_title']); ?></span> <p class="fc_gry fs_12"><?php echo($item['a_description']); ?></p> </a> </li> <?php else : ?> <li><a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endif; ?> <?php endforeach; endif; ?> </ul></dd> </dl> <div class="h_10 o_h"></div> <dl class="adl"> <dt><strong><?php echo(L("HOT")); ?></strong></dt> <dd><ul class="aul_hot"> <?php
$var_a = '_a_list_aid_'.(isset($AC_ID) ? $AC_ID : 0).'_no_flag_days_keywords_a_view_count_desc_0_10';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	$where['__ARCHIVE__.a_status'] = array('EQ', 1);
$_aci = M('ArchiveChannel')->get_channelInfo(''.(isset($AC_ID) ? $AC_ID : 0).'');
C('AM_ID', $_aci['archive_model_id']);
$_ACL = M('ArchiveChannel')->get_channelList(0, ''.(isset($AC_ID) ? $AC_ID : 0).'');
$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), ''.(isset($AC_ID) ? $AC_ID : 0).'');
	$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid(''.(isset($AC_ID) ? $AC_ID : 0).'')));
	$$var_a = M('Archive')->get_archiveList($where, '`a_view_count` desc', '0,10', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li><a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul></dd> </dl> <div class="h_10 o_h"></div> <div> <?php
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
?> </div> <div class="h_10 o_h"></div> </div><!--/.w_300--> <div class="c"></div> </div> <div id="footer"> <div class="nav_footer m w_960"> <?php
$_menu_footer = M('Menu')->get_menuList('footer');
if(is_array($_menu_footer)) : foreach($_menu_footer as $k => $m): 
?> <a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a> <?php endforeach; endif; ?> <?php endforeach; endif; ?> <?php if($_SITE{'mobile_version'}) :  ?><a href="<?php echo(Url::U("home@common/toggle_ua?ua=mobile")); ?>"><?php echo(L("MOBILE_VERSION")); ?></a><?php endif; ?> <a target="_blank" href="<?php echo(SOFT_AUTHOR_URL); ?>"><span class="logo_tiny"></span></a> </div><!--/.nav_footer--> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l ta_l copyright"> <?php echo($_SITE['copyright']); ?> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l ta_r prowered_by"> 			Powered by <strong><a href="<?php echo(SOFT_AUTHOR_URL); ?>" target="_blank"><?php echo(SOFT_NAME); ?></a></strong> <?php echo(SOFT_CODENAME); ?> </div><!--/.w_300--> <div class="c"></div> </div><!--/.copyright--> </div><!--/#footer--> <script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script> <script> document.write('<script src="<?php echo(Url::U("member@common/get_member_info")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="<?php echo(Url::U("home@common/task?task={$TASK}")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
</script> <script src="/tpl/rz/home/js/c.js"></script> <?php echo($_SITE['stat_code']); ?> </body> </html>