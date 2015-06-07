<?php

/**
 *--------------------------------------
 * guestbook
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class GuestbookCtrlr extends ManageCtrlr {
	public function edit_option() {
		$this->assign('_O', get_extensionOption('guestbook'));

		$this->display();
	}
	public function edit_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);

		if(!edit_extensionOption('guestbook', $data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GUESTBOOK_OPTION') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('guestbook/edit_option'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GUESTBOOK_OPTION'));
		$this->success(L('EDIT_SUCCESS'), Url::U('guestbook/edit_option'));
	}

	public function list_guestbook() {
		$where = array();
		/* filter status */
		$gStatus = ARequest::get('g_status') ? ARequest::get('g_status') : '';
		if('n' == $gStatus) {
			$where['__GUESTBOOK__.g_status'] = array('EQ', 0);
		}
		elseif('p' == $gStatus) {
			$where['__GUESTBOOK__.g_status'] = array('EQ', 1);
		}
		elseif('f' == $gStatus) {
			$where['__GUESTBOOK__.g_status'] = array('EQ', 2);
		}

		/* filter content */
		$gContent = ARequest::get('g_content');
		if(!empty($gContent)) {
			$where['__GUESTBOOK__.g_content'] = array('LIKE', '%' . $gContent . '%');
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'guestbook_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Guestbook')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('guestbook/list_guestbook?g_status=' . $gStatus . '$g_content=' . $gContent . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* guestbook list */
		$_GL = M('Guestbook')->get_guestbookList($where, $order, $limit, false);
		$this->assign('_GL', $_GL);

		$this->display();
	}

	public function edit_guestbook() {
		$guestbookId = ARequest::get('guestbook_id');
		$_GI = M('Guestbook')->get_guestbookInfo($guestbookId);
		if(empty($_GI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('guestbook/list_guestbook'));
		}
		$this->assign('_GI', $_GI);

		$this->display();
	}
	public function edit_guestbook_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();

		$result = M('Guestbook')->edit_guestbook($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GUESTBOOK') . ': ID[' . $data['guestbook_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('guestbook/list_guestbook'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GUESTBOOK') . ': ID[' . $data['guestbook_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('guestbook/list_guestbook'));
	}

	public function delete_guestbook_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$guestbookId = ARequest::get('guestbook_id');
		$guestbookId = is_array($guestbookId) ? $guestbookId : explode(',', $guestbookId);
		$_L_ID = implode(', ', $guestbookId);

		foreach($guestbookId as $guestbookId) {
			$result = M('Guestbook')->delete_guestbook($guestbookId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_GUESTBOOK') . ': ID[' . $guestbookId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('guestbook/list_guestbook'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_GUESTBOOK') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('guestbook/list_guestbook'));
	}

	public function toggle_guestbook_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['guestbook_id'] = ARequest::get('guestbook_id');
		$data['g_status'] = ARequest::get('g_status');
		if(false === M('Guestbook')->update($data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GUESTBOOK') . ': ID[' . $data['guestbook_id'] . ']' . $result['error'], 0);
			$this->error(L('TOGGLE_FAILED'), Url::U('guestbook/list_guestbook'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_GUESTBOOK') . ': ID[' . $data['guestbook_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('guestbook/list_guestbook'));
	}

	public function pass_guestbook_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$guestbookId = ARequest::get('guestbook_id');
		$guestbookId = is_array($guestbookId) ? $guestbookId : explode(',', $guestbookId);
		$_L_ID = implode(', ', $guestbookId);

		foreach($guestbookId as $guestbookId) {
			$result = M('Guestbook')->pass_guestbook($guestbookId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_GUESTBOOK') . ': ID[' . $guestbookId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('guestbook/list_guestbook'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('PASS_GUESTBOOK') . ': ID[' . $_L_ID . ']');
		$this->success(L('PASS_SUCCESS'), Url::U('guestbook/list_guestbook'));
	}

	public function delete_same_ip_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$guestbookId = ARequest::get('guestbook_id');
		$guestbookId = is_array($guestbookId) ? $guestbookId : explode(',', $guestbookId);
		$_L_ID = implode(', ', $guestbookId);

		foreach($guestbookId as $guestbookId) {
			$result = M('Guestbook')->delete_same_ip($guestbookId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_GUESTBOOK') . ': ID[' . $guestbookId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('guestbook/list_guestbook'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_GUESTBOOK') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('guestbook/list_guestbook'));
	}
}

?>