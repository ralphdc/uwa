<?php

/**
 *--------------------------------------
 * member favorite
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-16
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberFavoriteCtrlr extends ManageCtrlr {
	public function list_favorite() {
		$where = array();
		/* filter darchive */
		$archiveId = ARequest::get('archive_id') ? ARequest::get('archive_id') : 0;
		if($archiveId > 0) {
			$where['archive_id'] = array('EQ', $archiveId);
		}

		/* filter member */
		$memberId = ARequest::get('member_id') ? ARequest::get('member_id') : 0;
		if($memberId > 0) {
			$where['member_id'] = array('EQ', $memberId);
		}

		/* filter title */
		$mfTitle = ARequest::get('mf_title');
		if(!empty($mfTitle)) {
			$where['mf_title'] = array('LIKE', '%' . $mfTitle . '%');
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'member_favorite_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('MemberFavorite')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('member_favorite/list_favorite?archive_id=' . $archiveId . '&member_id=' . $memberId . '&mf_title=' . $mfTitle . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* favorite list */
		$_MFL = M('MemberFavorite')->get_favoriteList($where, $order, $limit);
		$this->assign('_MFL', $_MFL);

		$this->display();
	}

	public function delete_favorite_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberFavoriteId = ARequest::get('member_favorite_id');
		$memberFavoriteId = is_array($memberFavoriteId) ? $memberFavoriteId : explode(',', $memberFavoriteId);
		$_L_ID = implode(', ', $memberFavoriteId);

		foreach($memberFavoriteId as $memberFavoriteId) {
			$result = M('MemberFavorite')->delete_favorite($memberFavoriteId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_FAVORITE') . ': ID[' . $memberFavoriteId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_favorite/list_favorite'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_FAVORITE') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_favorite/list_favorite'));
	}
}

?>