<?php

/**
 *--------------------------------------
 * member favorite
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-20
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberFavoriteCtrlr extends MemberCtrlr {
	public function list_favorite() {
		$this->assign('_GCAP', 'member@member_favorite/list_favorite');

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('MEMBER_CENTER'), 'url' => Url::U('member/index')),
			array('name' => L('MEMBER_FAVORITE'), 'url' => ''))
		);

		$where = array();
		$where['member_id'] = array('EQ', ASession::get('member_id'));
		/* filter title */
		$mfTitle = AFilter::plain_text(ARequest::get('mf_title'), 32);
		if(MAGIC_QUOTES_GPC) {
			$mfTitle = stripslashes($mfTitle);
		}
		$mfTitle = str_replace('\'', '', $mfTitle);
		$mfTitle = str_replace('"', '', $mfTitle);
		$mfTitle = preg_replace('/\s+/', ' ', $mfTitle);
		if(!empty($mfTitle)) {
			$where['mf_title'] = array('LIKE', '%' . $mfTitle . '%');
		}

		/* sort list */
		$order = "`mf_add_time` DESC";

		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('MemberFavorite')->where($where)->count();
		$p = new APage($rowsNum, 10, Url::U('member_favorite/list_favorite?mf_title=' . $mfTitle . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* favorite list */
		$_MFL = M('MemberFavorite')->get_favoriteList($where, $order, $limit);
		$this->assign('_MFL', $_MFL);

		if('clip' == ARequest::get('type')) {
			$this->display('member/clip/member_favorite/list_favorite');
		}
		else {
			$this->display();
		}
	}

	public function add_favorite_do() {
		$_o_i = M('Option')->get_option('interaction');
		if(!I('interaction', $_o_i['feedback_interval'])) {
			$this->error(L('_TRY_LATER_'), AServer::get_preUrl());
		}

		$archiveId = intval(ARequest::get('archive_id'));
		$_AI = M('Archive')->where(array('archive_id' => array('EQ', $archiveId)))->field('a_title,a_url_o')->find();
		if(empty($_AI)) {
			$this->error(L('ITEM_NOT_EXIST'), AServer::get_preUrl());
		}
		$_MFI = M('MemberFavorite')->where(array('member_id' => array('EQ', ASession::get('member_id')), 'archive_id' => array('EQ', $archiveId)))->find();
		if(!empty($_MFI)) {
			$this->error(L('FAVORITE_EXSIT'), Url::U('member_favorite/list_favorite'));
		}
		$data = array();
		$data['member_id'] = ASession::get('member_id');
		$data['archive_id'] = $archiveId;
		$data['mf_title'] = $_AI['a_title'];
		$data['mf_url'] = $_AI['a_url_o'];
		$data['mf_add_time'] = time();
		if(false === M('MemberFavorite')->insert($data)) {
			$this->error(L('ADD_FAVORITE_FAILED'), AServer::get_preUrl());
		}

		I('interaction');
		$this->success(L('ADD_FAVORITE_SUCCESS'), Url::U('member_favorite/list_favorite'));
	}

	public function delete_favorite_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$_o_i = M('Option')->get_option('interaction');
		if(!I('interaction', $_o_i['feedback_interval'])) {
			$this->error(L('_TRY_LATER_'), AServer::get_preUrl());
		}

		$where = array();
		$where['member_id'] = array('EQ', ASession::get('member_id'));
		$where['member_favorite_id'] = array('EQ', intval(ARequest::get('member_favorite_id')));

		if(false === M('MemberFavorite')->where($where)->delete()) {
			$this->error(L('DELETE_FAVORITE_FAILED'), AServer::get_preUrl());
		}

		I('interaction');
		$this->success(L('DELETE_FAVORITE_SUCCESS'), Url::U('member_favorite/list_favorite'));
	}

}

?>