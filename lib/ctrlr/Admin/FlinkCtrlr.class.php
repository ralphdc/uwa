<?php

/**
 *--------------------------------------
 * flink
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-18
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class FlinkCtrlr extends ManageCtrlr {
	public function edit_option() {
		$this->assign('_O', get_extensionOption('flink'));

		$this->display();
	}
	public function edit_option_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		unset($data['timeKey']);
		unset($data['token']);

		if(!edit_extensionOption('flink', $data)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK_OPTION') . ': ' . L('SAVE_CFG_FILE_FAILED'), 0);
			$this->error(L('SAVE_CFG_FILE_FAILED'), Url::U('flink/edit_option'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK_OPTION'));
		$this->success(L('EDIT_SUCCESS'), Url::U('flink/edit_option'));
	}

	public function list_flink() {
		/* flink category list */
		$_FCL = M('FlinkCategory')->get_categoryList();
		$this->assign('_FCL', $_FCL);

		$where = array();
		/* filter category */
		$flinkCategoryId = ARequest::get('flink_category_id') ? ARequest::get('flink_category_id') : 0;
		if($flinkCategoryId > 0) {
			$where['__FLINK__.flink_category_id'] = array('EQ', $flinkCategoryId);
		}

		/* filter show type */
		$fShowType = ARequest::get('f_show_type') ? ARequest::get('f_show_type') : '';
		if('t' == $fShowType) {
			$where['__FLINK__.f_show_type'] = array('EQ', 0);
		}
		elseif('l' == $fShowType) {
			$where['__FLINK__.f_show_type'] = array('EQ', 1);
		}

		/* filter status */
		$fStatus = ARequest::get('f_status') ? ARequest::get('f_status') : '';
		if('n' == $fStatus) {
			$where['__FLINK__.f_status'] = array('EQ', 0);
		}
		elseif('p' == $fStatus) {
			$where['__FLINK__.f_status'] = array('EQ', 1);
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'flink_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 20);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('Flink')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('flink/list_flink?flink_category_id=' . $flinkCategoryId . '&f_show_type=' . $fShowType . '&f_status=' . $fStatus . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* flink list */
		$_FL = M('Flink')->get_flinkList($where, $order, $limit);
		$this->assign('_FL', $_FL);

		$this->display();
	}

	public function add_flink() {
		$_FCL = M('FlinkCategory')->get_categoryList();
		$this->assign('_FCL', $_FCL);

		$this->display();
	}
	public function add_flink_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Flink')->add_flink($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_FLINK') . ': ' . $result['error'], 0);
			$this->error($result['error'], Url::U('flink/list_flink'));
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_FLINK') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('flink/list_flink'));
	}

	public function edit_flink() {
		$flinkId = ARequest::get('flink_id');
		$_FI = M('Flink')->get_flinkInfo($flinkId);
		if(empty($_FI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('flink/list_flink'));
		}
		$this->assign('_FI', $_FI);

		/* flink category list */
		$_FCL = M('FlinkCategory')->get_categoryList();
		$this->assign('_FCL', $_FCL);

		$this->display();
	}
	public function edit_flink_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('Flink')->edit_flink($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK') . ': ID[' . $data['flink_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('flink/list_flink'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK') . ': ID[' . $data['flink_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('flink/list_flink'));
	}

	public function delete_flink_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$flinkId = ARequest::get('flink_id');
		$flinkId = is_array($flinkId) ? $flinkId : explode(',', $flinkId);
		$_L_ID = implode(', ', $flinkId);

		foreach($flinkId as $flinkId) {
			$result = M('Flink')->delete_flink($flinkId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_FLINK') . ': ID[' . $flinkId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('flink/list_flink'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_FLINK') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('flink/list_flink'));
	}

	public function toggle_flink_status_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data['flink_id'] = ARequest::get('flink_id');
		$data['f_status'] = ARequest::get('f_status');
		$result = M('Flink')->edit_flink($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK') . ': ID[' . $data['flink_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('flink/list_flink'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK') . ': ID[' . $data['flink_id'] . ']');
		$this->success(L('TOGGLE_SUCCESS'), Url::U('flink/list_flink'));
	}

	public function update_flink_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$flinkId = ARequest::get('flink_id');
		$fDisplayOrder = ARequest::get('f_display_order');
		$_L_ID = is_array($flinkId) ? implode(', ', $flinkId) : $flinkId;

		if(!is_array($flinkId) or empty($flinkId)) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK') . ': ID[' . $flinkId . ']' . L('ITEM_NOT_EXIST'), 0);
			$this->error(L('ITEM_NOT_EXIST'), Url::U('flink/list_flink'));
		}

		$data = array();
		$error = false;
		foreach($flinkId as $k => $id) {
			$data['flink_id'] = $id;
			$data['f_display_order'] = $fDisplayOrder[$k];
			$result = M('Flink')->edit_flink($data);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK') . ': ID[' . $flinkId . ']', 0);
				$this->error(L('EDIT_FAILED'), Url::U('flink/list_flink'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_FLINK') . ': ID[' . $_L_ID . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('flink/list_flink'));
	}
}

?>