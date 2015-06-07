<?php

/**
 *--------------------------------------
 * member notify
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-13
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberNotifyCtrlr extends ManageCtrlr {
	public function list_notify() {
		$where = array();
		/* filter status */
		$mnStatus = ARequest::get('mn_status') ? ARequest::get('mn_status') : '';
		if('u' == $mnStatus) {
			$where['mn_status'] = array('EQ', 0);
		}
		elseif('r' == $mnStatus) {
			$where['mn_status'] = array('EQ', 1);
		}

		/* 筛选标题 */
		$mnTitle = ARequest::get('mn_title');
		if(!empty($mnTitle)) {
			$where['mn_title'] = array('LIKE', '%' . $mnTitle . '%');
		}

		/* filter content */
		$mnContent = ARequest::get('mn_content');
		if(!empty($mnContent)) {
			$where['mn_content'] = array('LIKE', '%' . $mnContent . '%');
		}

		/* filter admin */
		$mnAdminUserId = ARequest::get('mn_admin_userid') ? ARequest::get('mn_admin_userid') : '';
		if(!empty($mnAdminUserId)) {
			$where['mn_admin_userid'] = array('EQ', $mnAdminUserId);
		}

		/* filter member */
		$mnMId = ARequest::get('mn_m_id') ? ARequest::get('mn_m_id') : 0;
		if($mnMId > 0) {
			$where['mn_m_id'] = array('EQ', $mnMId);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'member_notify_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 10);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('MemberNotify')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('member_notify/list_notify?mn_admin_userid' . $mnAdminUserId . '&mn_m_id=' . $mnMId . '&mn_status=' . $mnStatus . '&mn_title=' . $mnTitle . '&mn_content=' . $mnContent . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* member notify list */
		$_MNL = M('MemberNotify')->get_notifyList($where, $order, $limit);
		$this->assign('_MNL', $_MNL);

		$this->display();
	}

	public function add_notify_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$data['mn_admin_userid'] = ASession::get('m_userid');
		$data['mn_send_time'] = time();
		$mMId = explode(',', $data['mn_m_id']);
		$_L_ID = array();
		foreach($mMId as $mMId) {
			$data['mn_m_id'] = $mMId;
			$result = M('MemberNotify')->add_notify($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_NOTIFY') . ': ' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_notify/list_notify'));
			}
			$_L_ID[] = $result['data'];
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_NOTIFY') . ': ID[' . implode(',', $_L_ID) . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('member_notify/list_notify'));
	}

	public function delete_notify_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberNotifyId = ARequest::get('member_notify_id');
		$memberNotifyId = is_array($memberNotifyId) ? $memberNotifyId : explode(',', $memberNotifyId);
		$_L_ID = implode(', ', $memberNotifyId);

		foreach($memberNotifyId as $memberNotifyId) {
			$result = M('MemberNotify')->delete_notify($memberNotifyId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_NOTIFY') . ': ID[' . $memberNotifyId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_notify/list_notify'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_NOTIFY') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_notify/list_notify'));
	}
}

?>