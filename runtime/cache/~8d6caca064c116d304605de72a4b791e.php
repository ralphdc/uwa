<?php /* PFA Template Cache File. Create Time:2015-06-06 01:17:24 */ ?>
<!DOCTYPE html> <html> <head> <meta charset="utf-8" /> <title><?php echo($_V['a_title']); ?> - <?php echo($_V['ac_name']); ?> - <?php echo($_SITE['name']); ?></title> <link rel="stylesheet" type="text/css" href="/tpl/default/home/css/c.css" /> <link rel="stylesheet" type="text/css" href="/tpl/default/home/js/snsshare/snsshare.css" /> <meta name="keywords" content="<?php echo($_V['a_keywords']); ?>,<?php echo($_V['ac_keywords']); ?>,<?php echo($_SITE['keywords']); ?>" /> <meta name="description" content="<?php echo($_V['a_description']); ?>" /> </head> <body> <div id="header"> <div id="topbar" class="m w_960"> <div id="uwa_member"></div><!--/#uwa_member--> <div id="nav_topbar"> <a href="<?php echo(Url::U("home@search/search")); ?>" target="_blank"><?php echo(L("ADVANCED_SEARCH")); ?></a> | <a href="<?php echo(Url::U("home@tag/index")); ?>" target="_blank"><?php echo(L("TAG")); ?></a> </div><!--/#nav_topbar--> </div> <div class="m w_960"> <h1><a href="<?php echo($_SITE['host']); ?>"><img src="<?php echo($_SITE['logo']); ?>" alt="<?php echo($_SITE['name']); ?>" /></a></h1> </div> </div><!--/#header--> <div id="nav_main"> <div class="m w_960"> <dl class="menu w_760 f_l"> <?php
$_menu_main = M('Menu')->get_menuList('main');
if(is_array($_menu_main)) : foreach($_menu_main as $k => $m): 
?> <dt class="a<?php if(get_url($_GCAP) == $m['url']) :  ?> on<?php endif; ?>"><a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a></dt> <?php if(!empty($m['m_sub_menu'])) :  ?><dd class="fs_13 fw_n"><ul> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <li class="a"><a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a></li> <?php endforeach; endif; ?> </ul></dd><?php endif; ?> <?php endforeach; endif; ?> </dl><!--/.menu--> <div class="search_box f_r"> <form method="post" action="<?php echo(Url::U("home@search/search_do")); ?>"> <input type="text" name="keyword" value="" class="required"><input type="submit" class="search_btn a" value="<?php echo(L("SEARCH")); ?>" /> </form> </div><!--/.search_box--> </div> </div><!--/#nav_main--> <div class="h_10 o_h"></div> <div class="position m w_960"><span><?php echo(L("POSITION")); ?></span><?php if(isset($_CP) and is_array($_CP)) : foreach($_CP as $k => $cp) : ?> <?php if(0==$k) :  ?> <?php if(!empty($cp['url'])) :  ?> <a href="<?php echo($cp['url']); ?>"><?php echo($cp['name']); ?></a> <?php else : ?> <?php echo($cp['name']); ?> <?php endif; ?> <?php else : ?> <?php if(!empty($cp['url'])) :  ?> 		 &raquo; <a href="<?php echo($cp['url']); ?>"><?php echo($cp['name']); ?></a> <?php else : ?> 		 &raquo; <?php echo($cp['name']); ?> <?php endif; ?> <?php endif; ?> <?php endforeach; endif; ?></div> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l"> <div> <?php
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
?> </div> <div class="h_10 o_h"></div> <div class="adiv p_20"> <div class="main_title lh_40"><h2 class="fs_18 fw_b"><?php echo($_V['a_title']); ?></h2></div><!--/.main_title--> <div class="main_info fc_gry_d"> <span><strong class="fc_gry"><?php echo(L("CHANNEL")); ?></strong><a href="<?php echo($_V['ac_url']); ?>"><?php echo($_V['ac_name']); ?></a></span> <?php if($_V['a_a_source']) :  ?><span><strong class="fc_gry"><?php echo(L("SOURCE")); ?></strong><?php echo($_V['a_a_source']); ?></span><?php endif; ?> <?php if($_V['a_a_author']) :  ?><span><strong class="fc_gry"><?php echo(L("AUTHOR")); ?></strong><?php echo($_V['a_a_author']); ?></span><?php endif; ?> <span><strong class="fc_gry"><?php echo(L("TIME")); ?></strong><?php echo(date('Y-m-d', $_V['a_edit_time'])); ?></span> <span><strong class="fc_gry"><?php echo(L("VIEW")); ?></strong> <script src="<?php echo(Url::U("home@archive/get_count?type=view&archive_id={$_V['archive_id']}")); ?>"></script> </span> </div><!--/.main_info--> <?php if($_V['a_keywords'] or $_V['a_description']) :  ?><div class="main_abstract fc_gry fs_12 br_5"> <?php if($_V['a_keywords']) :  ?><p><strong class="fc_gry_d"><?php echo(L("KEYWORDS")); ?></strong> <?php echo(keywords_to_tag($_V['a_keywords'])); ?></p><?php endif; ?> <?php if($_V['a_description']) :  ?><p><strong class="fc_gry_d"><?php echo(L("ABSTRACT")); ?></strong> <?php echo($_V['a_description']); ?></p><?php endif; ?> </div><!--/.main_abstract--><?php endif; ?> <?php if(!empty($_V['msg_err'])) :  ?> <div class="msg_err"> <?php echo($_V['msg_err']); ?> </div> <?php else : ?> <div class="main_content"> <div style="float:right;margin:0 0 10px 10px;"> <?php
$var_asi = '_asi_3';
$$var_asi = M('AdSpace')->get_spaceInfo('3');
$_ASI = $$var_asi;
if(!empty($_ASI) and 1 == $_ASI['as_status']) {
	$var_al = '_al_3';
	$$var_al = S('~list/~'.ltrim($var_al, '_'));
	if(empty($$var_al)) {
		$$var_al = M('Ad')->get_adList('3', true);
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
?> </div> <?php echo(garble_string($_V['a_a_content'])); ?> </div><!--/.main_content--> <?php if(!empty($PAGING)) :  ?> <div id="page_list"> <!--first page--> <?php if(!empty($PAGING['firstPage']['url'])) :  ?> <a href="<?php echo($PAGING['firstPage']['url']); ?>" class="firstPage"><?php echo(L("_FIRST_PAGE_")); ?></a> <?php else : ?> <span class="firstPage"><?php echo(L("_FIRST_PAGE_")); ?></span> <?php endif; ?> <!--prev page--> <?php if(!empty($PAGING['prevPage']['url'])) :  ?> <a href="<?php echo($PAGING['prevPage']['url']); ?>" class="prevPage"><?php echo(L("_PREV_PAGE_")); ?></a> <?php else : ?> <span class="prevPage"><?php echo(L("_PREV_PAGE_")); ?></span> <?php endif; ?> <!--near prev page--> <?php if(!empty($PAGING['nearPrevPage'])) :  ?> <?php if(isset($PAGING['nearPrevPage']) and is_array($PAGING['nearPrevPage'])) : foreach($PAGING['nearPrevPage'] as $npp) : ?> <a href="<?php echo($npp['url']); ?>" class="nearPage"><?php echo($npp['page']); ?></a> <?php endforeach; endif; ?> <?php endif; ?> <!--current page--> <?php if(!empty($PAGING['currentPage'])) :  ?> <span class="currentPage"><?php echo($PAGING['currentPage']['page']); ?></span> <?php endif; ?> <!--near next page--> <?php if(!empty($PAGING['nearNextPage'])) :  ?> <?php if(isset($PAGING['nearNextPage']) and is_array($PAGING['nearNextPage'])) : foreach($PAGING['nearNextPage'] as $nnp) : ?> <a href="<?php echo($nnp['url']); ?>" class="nearPage"><?php echo($nnp['page']); ?></a> <?php endforeach; endif; ?> <?php endif; ?> <!--next page--> <?php if(!empty($PAGING['nextPage']['url'])) :  ?> <a href="<?php echo($PAGING['nextPage']['url']); ?>" class="nextPage"><?php echo(L("_NEXT_PAGE_")); ?></a> <?php else : ?> <span class="nextPage"><?php echo(L("_NEXT_PAGE_")); ?></span> <?php endif; ?> <!--last page--> <?php if(!empty($PAGING['lastPage']['url'])) :  ?> <a href="<?php echo($PAGING['lastPage']['url']); ?>" class="lastPage"><?php echo(L("_LAST_PAGE_")); ?></a> <?php else : ?> <span class="lastPage"><?php echo(L("_LAST_PAGE_")); ?></span> <?php endif; ?> <!--total info--> <span class="total"><?php echo(L("_TOTAL_PAGES_")); ?>:<?php echo($PAGING['totalPages']); ?> | <?php echo(L("_TOTAL_ROWS_")); ?>:<?php echo($PAGING['totalRows']); ?></span> </div> <?php endif; ?> <?php endif; ?> <div class="main_interaction ta_c"> <span id="a_support" class="a btn"><span class="btn_in_love"><span id="a_support_count"><script src="<?php echo(Url::U("home@archive/get_count?type=support&archive_id={$_V['archive_id']}")); ?>"></script></span><span id="a_support_tip"><?php echo(L("SUPPORT")); ?></span></span></span><!--/#a_support--> <span id="a_oppose" class="a btn"><span class="btn_in_love"><span id="a_oppose_tip"><?php echo(L("OPPOSE")); ?></span><span id="a_oppose_count"><script src="<?php echo(Url::U("home@archive/get_count?type=oppose&archive_id={$_V['archive_id']}")); ?>"></script></span></span></span><!--/#a_oppose--> <?php if($_G['interaction']['report_switch']) :  ?><span class="a btn"><span class="btn_in_times"><a href="<?php echo(Url::U("home@report/add_report?r_item_type=archive&r_item_id={$_V['archive_id']}")); ?>"><?php echo(L("REPORT")); ?></a></span></span><?php endif; ?> <span class="a btn"><span class="btn_in_plus"><a href="<?php echo(Url::U("member@member_favorite/add_favorite_do?archive_id={$_V['archive_id']}")); ?>"><?php echo(L("FAVORITE")); ?></a></span></span> <span class="a btn"><span class="btn_in_arrow" id="share" onclick="$('#snsshare').toggle()"><?php echo(L("SHARE")); ?></span></span> </div><!--/.main_interaction--> <div id="snsshare" style="display:none" class="ta_r"> <?php echo(L("SHARE_TO")); ?>:
				<a title="<?php echo(L("SHARE_TO_TQQ")); ?>" class="snsshare ss_tqq"></a> <a title="<?php echo(L("SHARE_TO_QZONE")); ?>" class="snsshare ss_qzone"></a> <a title="<?php echo(L("SHARE_TO_TSINA")); ?>" class="snsshare ss_tsina"></a> <a title="<?php echo(L("SHARE_TO_RENREN")); ?>" class="snsshare ss_renren"></a> <a title="<?php echo(L("SHARE_TO_KAIXIN")); ?>" class="snsshare ss_kaixin"></a> <a title="<?php echo(L("SHARE_TO_DOUBAN")); ?>" class="snsshare ss_douban"></a> </div> <?php if(!empty($_V['a_related'])) :  ?><dl class="main_related"> <dt><strong><?php echo(L("RELATED_CONTENT")); ?></strong></dt> <dd><ul class="aul"> <?php
$var_a = '_a_list_'.$_V['a_related'].'_cid_no_flag_days_keywords_orderby_0_5';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	if(!empty($_V['a_related'])) {
		$where['__ARCHIVE__.archive_id'] = array('IN', ''.$_V['a_related'].'');
	}
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,5', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
?> <li><span class="fc_gry"><?php echo($item['ac_name']); ?></span> <a class="fc_gry_d" href="<?php echo($item['a_url']); ?>"><?php echo($item['a_title']); ?></a></li> <?php endforeach; endif; ?> </ul></dd> </dl><?php endif; ?> <div class="main_extra"> <ul class="main_context f_l"> <li><?php echo(L("PREV_ARCHIVE")); ?>: <?php if(!empty($_V['a_prev'])) :  ?><a href="<?php echo($_V['a_prev']['a_url']); ?>"><?php echo($_V['a_prev']['a_title']); ?></a><?php else : ?><?php echo(L("NONE")); ?><?php endif; ?></li> <li><?php echo(L("NEXT_ARCHIVE")); ?>: <?php if(!empty($_V['a_next'])) :  ?><a href="<?php echo($_V['a_next']['a_url']); ?>"><?php echo($_V['a_next']['a_title']); ?></a><?php else : ?><?php echo(L("NONE")); ?><?php endif; ?></li> </ul> <div class="c"></div> </div><!--/.main_extra--> </div><!--/.adiv--> <div class="h_10 o_h"></div> <iframe id="uwa_review" src="<?php echo(Url::U("home@archive_review/list_review?type=clip&archive_id={$_V['archive_id']}")); ?>" width="100%" height="auto" scrolling="no" frameborder="0"></iframe> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l"> <ul class="aul_1"> <?php if(isset($_V['ac_sibling']) and is_array($_V['ac_sibling'])) : foreach($_V['ac_sibling'] as $k => $item) : ?> <li class="a<?php if($AC_ID == $item['archive_channel_id']) :  ?> on<?php endif; ?>"><a href="<?php echo($item['ac_url']); ?>"><?php echo($item['ac_name']); ?></a></li> <?php endforeach; endif; ?> </ul> <div class="h_10 o_h"></div> <dl class="adl"> <dt><strong><?php echo(L("COMMEND")); ?></strong></dt> <dd><ul class="aul"> <?php
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
?> <a href="<?php echo($m['url']); ?>" title="<?php echo($m['m_tip']); ?>" target="<?php echo($m['m_target']); ?>"><?php echo($m['m_name']); ?></a> <?php if(isset($m['m_sub_menu']) and is_array($m['m_sub_menu'])) : foreach($m['m_sub_menu'] as $ms) : ?> <a href="<?php echo($ms['url']); ?>" title="<?php echo($ms['m_tip']); ?>" target="<?php echo($ms['m_target']); ?>"><?php echo($ms['m_name']); ?></a> <?php endforeach; endif; ?> <?php endforeach; endif; ?> <?php if($_SITE{'mobile_version'}) :  ?><a href="<?php echo(Url::U("home@common/toggle_ua?ua=mobile")); ?>"><?php echo(L("MOBILE_VERSION")); ?></a><?php endif; ?> <a target="_blank" href="<?php echo(SOFT_AUTHOR_URL); ?>"><span class="logo_tiny"></span></a> </div><!--/.nav_footer--> <div class="h_10 o_h"></div> <div class="m w_960"> <div class="w_650 f_l ta_l copyright"> <?php echo($_SITE['copyright']); ?> </div><!--/.w_650--> <div class="w_10 h_10 o_h f_l">&nbsp;</div> <div class="w_300 f_l ta_r prowered_by"> 			Powered by <strong><a href="<?php echo(SOFT_AUTHOR_URL); ?>" target="_blank"><?php echo(SOFT_NAME); ?></a></strong> <?php echo(SOFT_CODENAME); ?> </div><!--/.w_300--> <div class="c"></div> </div><!--/.copyright--> </div><!--/#footer--> <script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script> <script> /*s: support */
var url_support = '<?php echo(Url::U("home@archive/get_count?type=do_support&archive_id={$_V['archive_id']}")); ?>';
$('#a_support').click(function() {
	$.getJSON(url_support, function(data) {
		if(data.data == 1) {
			$('#a_support_count').text(parseInt($('#a_support_count').text()) + 1);
		}
		$('#a_support,#a_oppose').removeClass('a').unbind();
		$('#a_support_tip').text(data.info);
	});
});
/*e: support */
/*s: oppose */
var url_oppose = '<?php echo(Url::U("home@archive/get_count?type=do_oppose&archive_id={$_V['archive_id']}")); ?>';
$('#a_oppose').click(function() {
	$.getJSON(url_oppose, function(data) {
		if(data.data == 1) {
			$('#a_oppose_count').text(parseInt($('#a_oppose_count').text()) + 1);
		}
		$('#a_support,#a_oppose').removeClass('a').unbind();
		$('#a_oppose_tip').text(data.info);
	});
});
/*e: oppose */

document.write('<script src="<?php echo(Url::U("member@common/get_member_info")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="<?php echo(Url::U("home@common/task?task={$TASK}")); ?>&refresh='+Math.random()+'.js"></sc'+'ript>');
</script> <script src="/tpl/default/home/js/c.js"></script> <script src="/tpl/default/home/js/snsshare/snsshare.js"></script> <?php echo($_SITE['stat_code']); ?> </body> </html>