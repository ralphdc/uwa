<?php

/**
 *--------------------------------------
 * member permission
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-10
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class MemberPermissionCtrlr extends ManageCtrlr {
	public function list_permission() {
		/* filter group */
		$mpGroup = ARequest::get('mp_group');
		if(!empty($mpGroup)) {
			$where['__MEMBER_PERMISSION__.mp_group'] = array('EQ', $mpGroup);
		}

		/* filtername */
		$mpName = ARequest::get('mp_name');
		if(!empty($mpName)) {
			$where['__MEMBER_PERMISSION__.mp_name'] = array('LIKE', '%' . $mpName . '%');
		}

		/* sort list */
		$orderBy = ARequest::get('order_by') ? ARequest::get('order_by') : 'member_permission_id';
		$orderTurn = ARequest::get('order_turn') ? ARequest::get('order_turn') : 'desc';
		$order = "`{$orderBy}` {$orderTurn}";

		/* get paging */
		$pageSize = (ARequest::get('page_size') > 0 ? ARequest::get('page_size') : 10);
		$_GET[C('VAR.PAGE')] = ARequest::get(C('VAR.PAGE')) ? ARequest::get(C('VAR.PAGE')) : 1;
		$rowsNum = M('MemberPermission')->where($where)->count();
		$p = new APage($rowsNum, $pageSize, Url::U('member_permission/list_permission?mp_group=' . $mpGroup . '&mp_name=' . $mpName . '&order_by=' . $orderBy . '&order_turn=' . $orderTurn . '&page_size=' . $pageSize . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* permission list */
		$_MPL = M('MemberPermission')->where($where)->order($order)->limit($limit)->select();
		$this->assign('_MPL', $_MPL);

		$this->display();
	}

	public function add_permission() {
		$_CL = get_ctrlrList(LIB_CTRLR_PATH . D_S . 'Member');
		$this->assign('_CL', $_CL);

		$this->display();
	}
	public function add_permission_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('MemberPermission')->add_permission($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_PERMISSION'), 0);
			$this->error($result['error'], Url::U('member_permission/list_permission'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('ADD_MEMBER_PERMISSION') . ': ID[' . $result['data'] . ']');
		$this->success(L('ADD_SUCCESS'), Url::U('member_permission/list_permission'));
	}

	public function edit_permission() {
		$memberPermissionId = ARequest::get('member_permission_id');

		$_MPI = M('MemberPermission')->get_permissionInfo($memberPermissionId);
		if(empty($_MPI)) {
			$this->error(L('ITEM_NOT_EXIST'), Url::U('member_permission/list_permission'));
		}
		$_MPI['mp_content'] = explode(',', $_MPI['mp_content']);
		$this->assign('_MPI', $_MPI);

		$_CL = get_ctrlrList(LIB_CTRLR_PATH . D_S . 'Member');
		$this->assign('_CL', $_CL);

		$this->display();
	}
	public function edit_permission_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$data = ARequest::get();
		$result = M('MemberPermission')->edit_permission($data);
		if(!empty($result['error'])) {
			M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_PERMISSION') . ': ID[' . $data['member_permission_id'] . ']' . $result['error'], 0);
			$this->error($result['error'], Url::U('member_permission/list_permission'));
		}
		M('AdminLog')->add_log(ASession::get('m_userid'), L('EDIT_MEMBER_PERMISSION') . ': ID[' . $data['member_permission_id'] . ']');
		$this->success(L('EDIT_SUCCESS'), Url::U('member_permission/list_permission'));
	}

	public function delete_permission_do() {
		if(!check_token()) {
			$this->error(L('DATA_INVALID'), AServer::get_preUrl());
		}

		$memberPermissionId = ARequest::get('member_permission_id');
		$memberPermissionId = is_array($memberPermissionId) ? $memberPermissionId : explode(',', $memberPermissionId);
		$_L_ID = implode(', ', $memberPermissionId);

		foreach($memberPermissionId as $memberPermissionId) {
			$result = M('MemberPermission')->delete_permission($memberPermissionId);
			if(!empty($result['error'])) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_PERMISSION') . ': ID[' . $memberPermissionId . ']' . $result['error'], 0);
				$this->error($result['error'], Url::U('member_permission/list_permission'));
			}
		}

		M('AdminLog')->add_log(ASession::get('m_userid'), L('DELETE_MEMBER_PERMISSION') . ': ID[' . $_L_ID . ']');
		$this->success(L('DELETE_SUCCESS'), Url::U('member_permission/list_permission'));
	}

	/* get action list of controller */
	public function get_actnList() {
		$ctrlr = ARequest::get('ctrlr');
		$file = LIB_CTRLR_PATH . D_S . 'Member' . D_S . $ctrlr . 'Ctrlr.class.php';
		$actnList = get_fileActnList($file);
		$this->ajax_return(array('data' => $actnList));
	}
}

?>