<?php

/**
 *--------------------------------------
 * search
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-13
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class SearchCtrlr extends IndexCtrlr {
	public function search() {
		$_o_i = M('Option')->get_option('interaction');

		/* check search switch */
		if(!$_o_i['search_switch']) {
			$this->error(L('SEARCH_IS_OFF'), Url::U('search/search'));
		}

		$this->assign('_GCAP', 'home@search/search');

		$_ACL = M('ArchiveChannel')->get_channelList(0, 0, true);
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('SEARCH'), 'url' => ''))
		);

		$this->display('home/search');
	}
	public function search_do() {
		$_o_i = M('Option')->get_option('interaction');

		/* check search switch */
		if(!$_o_i['search_switch']) {
			$this->error(L('SEARCH_IS_OFF'), Url::U('search/search'));
		}

		if(!I('search', $_o_i['search_interval'])) {
			$this->error(L('_TRY_LATER_'), Url::U('search/search'));
		}

		$this->assign('_GCAP', 'home@search/search');

		/* analysis keywords */
		$keyword = AString::msubstr(AFilter::keyword(ARequest::get('keyword')), 0, 32);
		if(1 > AString::mstrlen($keyword)) {
			$this->error(L('KEYWORD_TOO_SHORT'), Url::U('search/search'));
		}
		$keywords = M('Search')->analysis_keywords($keyword);
		$keyword = implode(' ', $keywords);
		$this->assign('keyword', $keyword);

		/* keyword type */
		$keywordType = ('and' == ARequest::get('keyword_type')) ? 'AND' : 'OR';

		/* search type */
		$searchType = ('content' == ARequest::get('search_type')) ? 'content' : 'title';

		/* filter channel */
		$archiveChannelId = array();
		$_t_ac_id = intval(ARequest::get('archive_channel_id')) ? intval(ARequest::get('archive_channel_id')) : 0;
		if(0 < $_t_ac_id) {
			$_ACL = M('ArchiveChannel')->get_channelList();
			$act = new ATree($_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), $_t_ac_id);
			$archiveChannelId = $act->get_leafid($_t_ac_id);
		}

		/* publish date */
		$aEditTime = array();
		$publishDate = intval(ARequest::get('publish_date')) ? intval(ARequest::get('publish_date')) : 0;
		if(0 < $publishDate) {
			$aEditTime = array((time() - $publishDate * 86400), time());
		}

		/* sort list */
		$displayOrder = in_array(ARequest::get('display_order'), array('a_edit_time', 'a_view_count', 'archive_id')) ? ARequest::get('display_order') : 'a_edit_time';
		$orderby = $displayOrder . ' desc';

		/* page size */
		$pageSize = in_array(ARequest::get('page_size'), array(10, 20, 50)) ? ARequest::get('page_size') : 10;

		/* get paging */
		$rowsNum = M('Search')->count_archive($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime);
		if(0 < $rowsNum) {
			$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
			$p = new APage($rowsNum, $pageSize, Url::U('search/search_do?' . 'archive_channel_id=' . $_t_ac_id . '&keyword=' . $keyword . '&keyword_type=' . $keywordType . '&search_type=' . $searchType . '&publish_date=' . $publishDate . '&display_order=' . $displayOrder . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
			$this->assign('PAGING', $p->get_paging());
			$limit = $p->get_limit();

			/* result archive list */
			$_AL = M('Search')->search($keywords, $keywordType, $searchType, $archiveChannelId, $aEditTime, $limit, $orderby);
			$this->assign('_L', $_AL);
		}
		else {
			$this->assign('PAGING', '');
			$this->assign('_L', '');
		}

		I('search');
		/* current position */
		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('SEARCH'), 'url' => ''),
			array('name' => $keyword, 'url' => ''))
		);

		if('clip' == ARequest::get('type')) {
			$this->display('home/clip/search_result');
		}
		else {
			$this->display('home/search_result');
		}
	}

}

?>